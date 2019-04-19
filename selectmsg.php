<?php 
session_start();
include 'function/function.php';
if(isset($_POST['msg'])){
    require "basedonne/conecttobdd.php";
    $q=$bdd->prepare("SELECT message.util_envoyer,message.util_recevoir ,message.text,utilisateur.photo_prf,utilisateur.nom,utilisateur.prenom  from message inner join utilisateur where (idmessage = :idmsg and utilisateur.email = message.util_envoyer)");
    $q->execute([
        'idmsg'=> decrypter($_POST['msg'])
    ]);
    $data=$q->fetch();
    if($_SESSION['email']==$data['util_recevoir']){
        $recevoir='moi';
    }else{
        $recevoir=$data['util_recevoir'];
    }
    if($_SESSION['email']==$data['util_envoyer']){
        $envoyer='moi';
    }else{
        $envoyer=$data['util_envoyer'];
    }
    $result='<div class="___crmsgone">
    <div class="_rdmsg">
        <div class="__blcntrlmsg">
            <div class="__cntmsgslct">
                <img src="fonts/img/back.png" alt="" class="">
            </div>
            <div class="__cntmsgslct">
                <img src="fonts/img/sup.png" alt="" class="">
            </div>
        </div>
        <div class="_athinfmsg">
            <div class="__mgusrsnt">
                <img src="'.$data['photo_prf'].'" alt="" class="">
            </div>
            <div class="__hosntmsg">
                <div class="__mnsusr">
                    <span class="___nm">'.$data['prenom'].' '.$data['nom'].'</span>
                    <div class="____elm">
                        <span class="___fch"></span>
                        <div class="___mlsnt">
                        '.$envoyer.'
                        </div>
                    </div>
                </div>
                <div class="__tousms">
                    <strong>à:</strong>
                    <span>'.$recevoir.'</span>
                </div>
            </div>
        </div>
        <div class="____allmsgcntnt">
            <div class="_____msgtxt">
                '.$data['text'].'
            </div>
            <span class="___ttlfls">Fichier associè</span><div class="____flasc">';
      $q2=$bdd->prepare("select chemain from file_msg where message_idmessage=:idmsg");
      $q2->execute([
     'idmsg'=>$_POST['msg']
      ]); 
      if($q2->rowCount()>0){
      while($data=$q2->fetch()){
        $result=$result.'<div class="____isfl">
        <div class="___tpefle">
            <img src="fonts/img/demande.png" alt="" class="">
        </div>
        <div class="__flmne">demande.png</div>
        <a href="'.$data['chemian'].'" download>
            <div class="__btdwnld">
                <img src="fonts/img/download.png" alt="" class="">
            </div>
        </a>
    </div>';}
      }else{
        $result=$result.'aucun fichier asoscie';
      }
      $result=$result.'   </div>
      </div>
      <div class="___rpndmsg">
          <span class="_btn">répondre</span>
      </div>
  </div>
</div>';
echo $result;     
}


?>