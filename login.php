<?php require_once "./partials/header.php"; ?>

<body>
    <?php include_once "./components/navbar.php"; ?>


    <section class="access-form">

        <div class="loginComponent">
            <h2>login</h2>
            <form action="./components/loginComponent.php" method="post">
                <input type="text" name="userid" placeholder="Username/email...">
                <div class="pwtoggleContainer">
                    <input id="password" type="password" name="pwd" placeholder="Password...">
                    <img id="togglePW" class="togglePassword" src="./img/eye-open.svg"></img>
                </div>
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


<Script>
    var togglePW = document.getElementById("togglePW");

    togglePW.addEventListener('click', function(e) {
        const pwinput = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', pwinput);

        const pwimg = togglePW.getAttribute('src') === './img/eye-open.svg' ? './img/eye-closed.svg' : './img/eye-open.svg';
        togglePW.setAttribute('src', pwimg);


    })
</script>