<?php require_once "../partials/header.php";


if (isset($_POST["submit"])) {
    $loginUsername = $_POST['userid'];
    $loginPassword = $_POST['pwd'];

    require_once '../database/dbConnection.php';
    require_once 'userAccessFunctions.php';

    if (emptyInputLogin($loginUsername, $loginPassword) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $loginUsername, $loginPassword);
} else {
    header("location: ../login.php?error=failed");
    exit();
}
