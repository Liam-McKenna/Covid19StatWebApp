<?php require_once "./partials/header.php"; ?>

<body>
    <?php include_once "./components/navbar.php"; ?>


    <section class="access-form">

        <div class="signupComponent">
            <h2> Sign Up</h2>
            <form action="./components/signupComponent.php" method="post">
                <input type="text" name="name" placeholder="Full name...">
                <input type="text" name="email" placeholder="Email...">
                <input type="text" name="userN" placeholder="Username...">
                <div class="pwtoggleContainer">
                    <input id="password" type="password" name="pwd" placeholder="Password...">
                    <img id="togglePW" class="togglePassword" src="./img/eye-open.svg"></img>
                </div>
                <div class="pwtoggleContainer">
                    <input id="confrimPw" type="password" name="repeatPwd" placeholder="Confirm password...">
                    <img id="toggleCPW" class="toggleCPassword" src="./img/eye-open.svg"></img>
                </div>


                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
</body>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo "<p>Please Fill in all fields.</p>";
    } else if ($_GET['error'] == "invalidUsername") {
        echo "<p>User name is invalid.</p>";
    } else if ($_GET['error'] == "emptyinput") {
        echo "<p>One or more of the fields is empty.</p>";
    } else if ($_GET['error'] == "invalidEmail") {
        echo "<p>The email address is invalid.</p>";
    } else if ($_GET['error'] == "passwordDontMatch") {
        echo "<p>The passwords do not match.</p>";
    } else if ($_GET['error'] == "statementFailed") {
        echo "<p>Something strange happened. there was an error but please try again.</p>";
    } else if ($_GET['error'] == "usernameOrEmailTaken") {
        echo "<p>The Username Or Email is already taken.</p>";
    } else if ($_GET['error'] == "none") {
        echo "<p>Sign up completed! Congratulations!</p>";
    }
} ?>


<Script>
    var togglePW = document.getElementById("togglePW");
    var toggleCPW = document.getElementById("toggleCPW");

    togglePW.addEventListener('click', function(e) {
        const pwinput = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', pwinput);

        const pwimg = togglePW.getAttribute('src') === './img/eye-open.svg' ? './img/eye-closed.svg' : './img/eye-open.svg';
        togglePW.setAttribute('src', pwimg);


    })

    toggleCPW.addEventListener('click', function(e) {
        const pwcinput = confrimPw.getAttribute('type') === 'password' ? 'text' : 'password';
        confrimPw.setAttribute('type', pwcinput);

        const pwimg = toggleCPW.getAttribute('src') === './img/eye-open.svg' ? './img/eye-closed.svg' : './img/eye-open.svg';
        toggleCPW.setAttribute('src', pwimg);




    })
</Script>