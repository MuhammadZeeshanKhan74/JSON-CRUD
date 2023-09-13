<?php
$conn = mysqli_connect('localhost', 'root', '', 'json_crud');
// Action Conditions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $response =array(); // Define an empty array

    //Insert Data

    if ($_POST['action'] == 'add') { // Checking Form Action 

        // Store your form field data into an Array
        $data = ['name' => $_POST['name'], 'fatherName' => $_POST['fatherName'], 'phone' => $_POST['phone'], 'email' => $_POST['email'], 'password' => $_POST['password']];  
        if ($data) { // Checking data variable isset or not.
            // Checking SQL query if query is successfully run then return $response array For showing MsgStatus Success.
            if (mysqli_query($conn, 'INSERT INTO users (details) VALUES ("' . mysqli_real_escape_string($conn, json_encode($data))
                . '")')) { 
                $response = ['msgStatus' => 'success', 'msg' => 'Data Inserted Successfully'];
            } else { // else showing MsgStatus Failed
                $response = ['msgStatus' => 'fail', 'msg' => 'Data Insertion Failed'];
            }
        } else { // showing MsgStatus Failed if $data variable is not set.
            $response = ['msgStatus' => 'fail', 'msg' => 'Data Error'];
        }
        echo json_encode($response); // now convert array to JSON OBJ by using json_encode and return.
    }

    // Fetch Data
    if ($_POST['action'] == 'GET') {

        if ($getQue = mysqli_query($conn, "SELECT * FROM users")) {

            while ($result = mysqli_fetch_assoc($getQue)) {
                $response[] = $result;
            }
        }
        echo json_encode($response);
    }

    // Fetch Data for input field
    if ($_POST['action'] == 'edit') {
        if ($getQue = mysqli_query($conn, 'SELECT * FROM users WHERE id="' . $_POST['id'] . '"')) {

            $response = mysqli_fetch_assoc($getQue);
        }
        echo json_encode($response);
    }

    // Update Data 
    if ($_POST['action'] == 'update') {
        $data = ['name' => $_POST['name'], 'fatherName' => $_POST['fatherName'], 'phone' => $_POST['phone'], 'email' => $_POST['email'], 'password' => $_POST['password']];
        if ($data) {
            if (mysqli_query($conn, 'UPDATE users SET details="' . mysqli_real_escape_string($conn, json_encode($data)) . '" WHERE id="' . $_POST['edit_id'] . '"')) {
                $response = ['msgStatus' => 'success', 'msg' => 'Data Updated Successfully'];
            } else {
                $response = ['msgStatus' => 'fail', 'msg' => 'Data Updation Failed'];
            }
        } else {
            $response = ['msgStatus' => 'fail', 'msg' => 'Data Error'];
        }
        echo json_encode($response);
    }

    // Delete Data
    if ($_POST['action'] == 'delete') {

        if (mysqli_query($conn, 'DELETE FROM users WHERE id="' . $_POST['id'] . '"')) {
            $response = ['msgStatus' => 'success', 'msg' => 'Data Updated Successfully'];
        } else {
            $response = ['msgStatus' => 'fail', 'msg' => 'Data Updation Failed'];
        }

        echo json_encode($response);
    }
   
}
