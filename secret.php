<?php

session_start();

var_dump($_SESSION);

if (!isset($_SESSION["email"])){
   header("Location: /sdk/login.php");
    exit();
}

?>

<p>Vous êtes connecté!</p>
