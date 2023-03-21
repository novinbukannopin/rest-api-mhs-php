<?php
require_once "connection.php";
class Mahasiswa
{
    public function getAll()
    {
        global $mysqli;
        $query = "SELECT * FROM restapi_mahasiswa";
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }

        $response = array(
            "status" => 1,
            "message" => "Get Data Mahasiswa Succesfully",
            "data" => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function getMhsById($id)
    {
        global $mysqli;
        $query = "SELECT * FROM restapi_mahasiswa";
        if ($id != 0) {
            $query .= " WHERE id =" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);

        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_object($result);
            $data[] = $row;
            $response = array(
                "status" => 1,
                "message" => "Get Data Mahasiswa ID " . $id . " Succesfully",
                "data" => $data
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                "status" => 2,
                "message" => "Get Data Mahasiswa ID " . $id . " Failed",
                "data" => null
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function insertMhs()
    {
        global $mysqli;
        $arrCheck = array(
            'name' => '', 'pob' => '', 'dob' => '', 'religion' => '', 'address' => '', 'phone' => '', 'gender' => '',
            'hobies' => '', 'photo' => ''
        );
        $count = count(array_intersect_key($_POST, $arrCheck));
        if ($count == count($arrCheck)) {
            $result = mysqli_query($mysqli, "INSERT INTO restapi_mahasiswa SET name = '$_POST[name]',
            pob = '$_POST[pob]',
            dob = '$_POST[dob]',
            religion = '$_POST[religion]',
            address = '$_POST[address]',
            phone = '$_POST[phone]',
            gender = '$_POST[gender]',
            hobies = '$_POST[hobies]',
            photo = '$_POST[photo]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Mahasiswa Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Mahasiswa Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function updateMhs($id)
    {
        global $mysqli;
        $arrCheck = array(
            'name' => '', 'pob' => '', 'dob' => '', 'religion' => '', 'address' => '', 'phone' => '', 'gender' => '',
            'hobies' => '', 'photo' => ''
        );
        $count = count(array_intersect_key($_POST, $arrCheck));
        if ($count == count($arrCheck)) {
            $result = mysqli_query($mysqli, "UPDATE restapi_mahasiswa SET name = '$_POST[name]',
            pob = '$_POST[pob]',
            dob = '$_POST[dob]',
            religion = '$_POST[religion]',
            address = '$_POST[address]',
            phone = '$_POST[phone]',
            gender = '$_POST[gender]',
            hobies = '$_POST[hobies]',
            photo = '$_POST[photo]'
            WHERE id = $id");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Mahasiswa Updated Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Mahasiswa Updated Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        };
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function deleteMhs($id)
    {
        global $mysqli;
        $query = "DELETE FROM restapi_mahasiswa WHERE id =" . $id;
        if (mysqli_query($mysqli, $query)) {

            $response = array(
                'status' => 1,
                'message' => 'Mahasiswa Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Mahasiswa Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
