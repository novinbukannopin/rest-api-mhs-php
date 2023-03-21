<?php
require_once "method.php";
$mhs = new Mahasiswa();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case "GET":
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $mhs->getMhsById($id);
        } else {
            $mhs->getAll();
        }
        break;
    case "POST":
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $mhs->updateMhs($id);
        } else {
            $mhs->insertMhs();
        }
        break;
    case "DELETE":
        $id = intval($_GET["id"]);
        $mhs->deleteMhs($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
        break;
}
