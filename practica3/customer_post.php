<?php
    header('Content-Type: application/json');

    $conn = new mysqli('localhost', 'root', '', 'assignment3', '3308');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return;
    }

    
    $json = file_get_contents('php://input');
    $array = json_decode($json, true);
    $first_name = $array['first_name'];
    $last_name = $array['last_name'];
    $birth_date = $array['birth_date'];
    $city = $array['city'];
    $sql = "INSERT INTO customer(first_name, last_name, birth_date, city) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('ssss', $first_name, $last_name, $birth_date, $city);

    $stmt->execute();
    $conn->close();

    echo json_encode(array('result' => 'ok'));
