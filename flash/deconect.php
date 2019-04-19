<?php 
if(!isset($_SESSION['numdinsc']) && !isset($_SESSION['email']) && !isset($_SESSION['conected'])){
    header('Location:login.php');
    exit();
}

?>