<?php
function emptyInputSignup($name, $email, $username, $password, $repeatPassword)
{
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($repeatPassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUsername($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdMatch($password, $repeatPassword)
{
    if ($password !== $repeatPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdValid($password)
{
    if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/", $password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function usernameExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../signup.php?error=statementFailed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ss", $username, $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($existingUser = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($statement);
        return $existingUser;
    } else {
        $result = false;
        mysqli_stmt_close($statement);
        return $result;
    }
}

function createUser($conn, $name, $email, $username, $password)
{
    $sql = "INSERT INTO users(name, email, username, password) VALUES(?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../signup.php?error=statementFailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    // header("location: ../signup.php?error=none");
    session_start();
    $_SESSION["userid"] = $username;
    $_SESSION["username"] = $name;
    header("location: ../index.php");
    exit();
}

function emptyInputLogin($username, $password)
{

    if (empty($username) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password)
{
    $userExists = usernameExists($conn, $username, $username);
    if ($userExists === false) {
        header("location: ../login.php?error=WrongCredentials");
        exit();
    }

    $pwdHashed = $userExists['password'];
    $checkPassword = password_verify($password, $pwdHashed);

    if ($checkPassword === false) {
        header("location: ../login.php?error=WrongPassword");
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["userid"] = $userExists['usersId'];
        $_SESSION["username"] = $userExists['username'];
        header("location: ../index.php");
    }
}
