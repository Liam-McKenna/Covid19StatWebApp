<?php require_once "../partials/header.php"; ?>

<body>
    <?php include_once "../components/navbar.php"; ?>


    <section class="access-form">

        <div class="loginComponent">
            <h2>login</h2>
            <form action="../components/loginComponent.php" method="post">
                <input type="text" name="userid" placeholder="Username/email...">
                <input type="password" name="pwd" placeholder="Password...">
                <button type="submit" name="submit">Log In</button>
            </form>
        </div>
</body>

<?php
if (isset($_GET['error'])) {

    if ($_GET['error'] == "emptyinput") {
        echo "<p>Error - One or more of the fields are empty.</p>";
    }
    if ($_GET['error'] == "WrongCredentials") {
        echo "<p>Error - Username or Email does not exist</p>";
    }
    if ($_GET['error'] == "WrongPassword") {
        echo "<p>Error - Password is incorrect for this account.</p>";
    }
    if ($_GET['error'] == "loginSuccess") {
        echo "<p>You are now logged in.</p>";
    }
}
?>