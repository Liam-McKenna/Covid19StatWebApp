	
<?php
// database configuration, separated for security

if ($_SERVER['REMOTE_ADDR'] == '::1') {
    $hn = 'localhost:3308';
    $db = 'covidapidata';
    $un = 'root';
    $pw = '';
} else {
    $hn = 'eu-cdbr-west-01.cleardb.com';
    $db = 'heroku_9c118c3fb745a2a';
    $un = 'b52e1d6bdd6241';
    $pw = '1fea9f02';
}
?>
    
  