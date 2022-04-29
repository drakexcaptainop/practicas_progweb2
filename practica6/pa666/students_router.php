<?php
    header('Content-Type: application/json');

    require 'student.php';
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch($request_method) {
        case 'GET':
            $student = new Student();
            if (empty($_GET['id'])) {
                echo json_encode($student->findAll());
            } else {
                echo json_encode($student->findById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonStudent = json_decode(file_get_contents("php://input"), true);
            $student = new Student(
                $jsonStudent['firstName'],
                $jsonStudent['lastName'],
                $jsonStudent['city'],
                $jsonStudent['semester']
            );
            echo json_encode(['result' => $student->save()]);
            break;
        case 'PUT':
            $jsonStudent = json_decode(file_get_contents("php://input"), true);
            $student = new Student(
                $jsonStudent['firstName'],
                $jsonStudent['lastName'],
                $jsonStudent['city'],
                $jsonStudent['semester'],
                $jsonStudent['id']
            );
            echo json_encode(['result' => $student->update()]);
            break;
        case 'DELETE':
            $query = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $query);
            $student = new Student(
                $id = $jsonStudent['id']
            );
            echo json_encode(['result' => $student->delete()]);
            break;
    }
