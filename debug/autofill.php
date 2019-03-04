<?php

// this line is very important, by using this line
// the browser can recognize that the data sent from
// the server as a json object.
header("Content-type: application/json");

$formattedData  = [];

if (isset($_GET['username'])) {
    $username       = trim($_GET['username']);
    // to be sure that the username is not empty
    if(empty($username)) {
        print json_encode($formattedData);
        exit;
    }
    $konek          = mysqli_connect("localhost", "root", "", "spdb", 3306);
    $return         = mysqli_query($konek, "SELECT * FROM tb_auth WHERE username = '" . $username . "' LIMIT 1");
    // use mysqli_fetch_assoc instead of mysqli_fetch_array
    // $rows           = mysqli_fetch_array($return);
    $rows           = mysqli_fetch_assoc($return);
    $formattedData  = json_encode($rows);
    // very important every connection created need to be closed
    mysqli_close($konek);
}
print $formattedData;
?>