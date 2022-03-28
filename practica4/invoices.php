<?php
header('Content-Type: application/json');
include_once 'connection.php';

$db = new DatabaseConnection();
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'POST':
        $invoice = json_decode(file_get_contents('php://input'), true);
        add_invoice($invoice);
        break;
}

function add_invoice($invoice) {
    global $db;
    $connection = $db->getConnstring();
    $connection->begin_transaction();

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $client_id = $invoice['clientId'];
    
    $sql = "INSERT INTO invoice_master(client_id, invoice_date) VALUES (?, sysdate())";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('i', $client_id);

    $stmt->execute();

    $connection_id = $connection->insert_id;

    $stmt->close();

    foreach ($invoice['details'] as $detail) {
        $sql_detail = "INSERT INTO invoice_detail(invoice_master_id, product_id, product_quantity) VALUES (?, ?, ?)";
        $stmt_detail = $connection->prepare($sql_detail);

        $stmt_detail->bind_param('iii', $connection_id, $detail['productId'], $detail['quantity']);

        $stmt_detail->execute();
        $stmt_detail->close();
    }
    
    $connection->commit();
    $connection->close();

    echo json_encode(array('result' => 'ok'));
}

?>