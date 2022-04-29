<?php
    header('Content-Type: application/json');
    require 'professor.php';
    $request_method = $_SERVER['REQUEST_METHOD'];
    $professor = null;
    switch ($request_method) {
        case 'GET':
            $professor = new Professor();
            if(isset($_GET["id"])){
                $professor->setId(intval($_GET["id"]));
                echo json_encode($professor->findById());
            }else{
                echo json_encode($professor->findAll());
            }
            break;
        case "POST":
            $data = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor($data["firstName"], $data["lastName"], $data["city"], doubleval($data["salary"]));
            echo json_encode(array("r"=>$professor->save()));
        case 'PUT': 
            $data = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor($data["firstName"], $data["lastName"], $data["city"], doubleval($data["salary"]), intval($data["id"]));
            echo json_encode(array("r"=>$professor->update()));
        case 'DELETE':
            $ids = intval(explode("=", $_SERVER["QUERY_STRING"])[1]);
            $professor = new Professor();
            $professor->setId($ids);
            echo json_encode(array("r"=>$professor->delete(), "id"=>$ids));
        default:
            # code...
            break;
    }
