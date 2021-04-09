<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['userN'];
    $password = $_POST['pwd'];
    $repeatPassword = $_POST['repeatPwd'];

    require_once '../database/dbConnection.php';
    require_once 'userAccessFunctions.php';

    if (emptyInputSignup($name, $email, $username, $password, $repeatPassword) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invalidUsername");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }
    if (pwdMatch($password, $repeatPassword) !== false) {
        header("location: ../signup.php?error=passwordDontMatch");
        exit();
    }
    if (usernameExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernameOrEmailTaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $password,  $repeatPassword);
} else {
    header("location: ../index.php");
}
