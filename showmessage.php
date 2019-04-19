<?php 
session_start();
include 'function/function.php';
if(isset($_POST['idmsg']) && isset($_POST['nbpage'])){
    require "basedonne/conecttobdd.php";
    extract($_POST);
    $nbmsgmax=50;
    $resultat='';
    $debut_msg=($nbpage-1) * $nbmsgmax;
    if($idmsg==0){
    $q=$bdd->prepare("SELECT message.idmessage, message.text,utilisateur.photo_prf,utilisateur.nom,utilisateur.prenom  from message inner join utilisateur where (util_recevoir = :util_recevoir and utilisateur.email = message.util_envoyer) LIMIT $debut_msg,$nbmsgmax");
    $q->execute([
        'util_recevoir'=>$_SESSION['email']
    ]);
    }else if($idmsg==1){
        $q=$bdd->prepare("SELECT message.idmessage, message.text,utilisateur.photo_prf,utilisateur.nom,utilisateur.prenom  from message inner join utilisateur where (util_envoyer = :util_recevoir and utilisateur.email = message.util_envoyer) LIMIT $debut_msg,$nbmsgmax");
    $q->execute([
        'util_recevoir'=>$_SESSION['email']
    ]);
    }else{

    }
    while($data=$q->fetch()){
        if($data['prenom']==$_SESSION['prenom'] && $data['nom']==$_SESSION['nom']){
            $name="moi";
        }else{
            $name=$data['prenom'].' '.$data['nom'];
        }
        $resultat=$resultat.'<div class="_msg_" id="'.crypter($data['idmessage']).'">
        <div class="_img_msg">
            <img src="'.$data['photo_prf'].'" style="width:100%;heigth:100%;" />
        </div>
        <div class="_name_info">
            <div class="_rglinfo">
                <span class="_usenv">'.$name.'</span>
                <span class="_pttmsg">'.$data['text'].'</span>
            </div>
        </div>
        <div class="_dtmsg">
            <div class="_datemsg">
                <span class="_supmsg">
                                    <img src="fonts/img/sup.png"/>
                                    </span>
                <span>12:15</span>
            </div>
        </div>
    </div>';
    }
    echo $resultat;
    

}

?>