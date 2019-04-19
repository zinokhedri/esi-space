<?php 
try{
$bdd=new PDO('mysql:host=localhost;dbname=esispace','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e){
    die('erreur:'.$e->getMessage());
}
?>