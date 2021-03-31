<?php
//print_r($_POST);
if (isset($_POST['submit'])) {
    echo "Search is: " . $_POST['search'];
}
?>

<form action="" method="POST">
    Name: <input type="text" name="search" value="">
    <input type="submit" name="submit" valuer="submit">
</form>