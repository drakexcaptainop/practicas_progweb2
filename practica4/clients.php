<?php
header('Content-Type: application/json');
include_once 'connection.php';

$db = new DatabaseConnection();
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET['id'])) {
            $id = intval($_GET["id"]);
            get_client_by_id($id);
        } else {
            get_clients();
        }
        break;
    case 'POST':
        $client = json_decode(file_get_contents('php://input'), true);
        add_client($client);
        break;
    case 'PUT':
        $client = json_decode(file_get_contents('php://input'), true);
        update_client($client);
        break;
}

function get_clients() {
    global $db;
    $connection = $db->getConnstring();
    $query = "SELECT id, nit, name, last_name AS lastName FROM client";
    $clients = array();

    $result = $connection->query($query);

    while ($row = $result->fetch_assoc()) {
        array_push($clients, $row);
    }

    $connection->close();
    echo json_encode($clients);
}

function get_client_by_id($id) {
    global $db;
    $connection = $db->getConnstring();
    $sql = "SELECT id, nit, name, last_name AS lastName FROM client WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $client = null;

    while ($row = $result->fetch_assoc()) {
        $client = $row;
    }

    $connection->close();
    echo json_encode($client);
}

function add_client($client) {
    global $db;
    $connection = $db->getConnstring();

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $nit = $client['nit'];
    $name = $client['name'];
    $last_name = $client['lastName'];

    $sql = "INSERT INTO client(nit, name, last_name) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('sss', $nit, $name, $last_name);

    $stmt->execute();
    $connection->close();

    echo json_encode(array('result' => 'ok'));
}

function update_client($client) {
    global $db;
    $connection = $db->getConnstring();

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $id = $client['id'];
    $nit = $client['nit'];
    $name = $client['name'];
    $last_name = $client['lastName'];

    $sql = "UPDATE client SET nit=?, name=?, last_name=? WHERE id=?";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('sssi', $nit, $name, $last_name, $id);

    $stmt->execute();
    $connection->close();

    echo json_encode(array('result' => 'ok'));
}

?>