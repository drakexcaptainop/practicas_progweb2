<?php
header('Content-Type: application/json');
include_once 'connection.php';

$db = new DatabaseConnection();
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET['id'])) {
            $id = intval($_GET["id"]);
            get_product_by_id($id);
        } else {
            get_products();
        }
        break;
    case 'POST':
        $product = json_decode(file_get_contents('php://input'), true);
        add_product($product);
        break;
    case 'PUT':
        $product = json_decode(file_get_contents('php://input'), true);
        update_product($product);
        break;
}

function get_products() {
    global $db;
    $connection = $db->getConnstring();
    $query = "SELECT id, name, description, price, image FROM product";
    $products = array();

    $result = $connection->query($query);

    while ($row = $result->fetch_assoc()) {
        array_push($products, $row);
    }

    $connection->close();
    echo json_encode($products);
}

function get_product_by_id($id) {
    global $db;
    $connection = $db->getConnstring();
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $product = null;

    while ($row = $result->fetch_assoc()) {
        $product = $row;
    }

    $connection->close();
    echo json_encode($product);
}

function add_product($product) {
    global $db;
    $connection = $db->getConnstring();

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $name = $product['name'];
    $description = $product['description'];
    $price = $product['price'];
    $image = $product['image'];

    $sql = "INSERT INTO product(name, description, price, image) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('ssds', $name, $description, $price, $image);

    $stmt->execute();
    $connection->close();

    echo json_encode(array('result' => 'ok'));
}

function update_product($product) {
    global $db;
    $connection = $db->getConnstring();

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $id = $product['id'];
    $name = $product['name'];
    $description = $product['description'];
    $price = $product['price'];
    $image = $product['image'];

    $sql = "UPDATE product SET name=?, description=?, price=?, image=? WHERE id=?";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('ssdsi', $name, $description, $price, $image, $id);

    $stmt->execute();
    $connection->close();

    echo json_encode(array('result' => 'ok'));
}

?>