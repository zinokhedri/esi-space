<?php 
session_start();
require "basedonne/conecttobdd.php";
if(!empty($_POST['tosent']) && !empty($_POST['text'])){
    if(strstr($_POST['tosent'],'@esi-space.dz')){
        $q=$bdd->prepare('insert into message (util_envoyer,util_recevoir,text) values (:env,:rec,:txt)');
        $q->execute([
            'env'=>$_SESSION['email'],
            'rec'=>$_POST['tosent'],
            'txt'=>$_POST['text']
        ]);
    if(isset($_POST['filechemnmsg']) && isset($_POST['filenamemsg'])){
        for($i=0;$i<count($_POST['filechemnmsg']);$i++){
            $chemain="filemsg/".$_POST['filenamemsg'][$i];
            $resultat=move_uploaded_file($_POST['filechemnmsg'][$i],$chemain);
        }
        if($resultat){
            echo 'sssss';
        }else{
            echo $_POST['filechemnmsg'][0];
        }
        
    }    
    }else{
        echo"qssqsq";
    }
}

?>