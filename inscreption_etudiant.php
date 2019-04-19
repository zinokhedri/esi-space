<?php
include 'function/function.php';
if(!empty($_POST['nu_ins']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dt_ns'])
  && !empty($_POST['le_ns']) && !empty($_POST['ann']) && !empty($_POST['sct']) && !empty($_POST['eml']) && !empty($_POST['grp'])){
      extract($_POST);
      $dt_ns=rmplc($dt_ns,'/','-');
      $dt_ns=to_date($dt_ns);
      require 'basedonne/conecttobdd.php';
      $q=$bdd->prepare('insert into utilisateur (idutilisateur,nom,prenom,email,motpass,type_utilisateur)
        values(:numdinsc,:nom,:prenom,:email,:motpass,:type_utilisateur);');
      $q->execute([
        'numdinsc'=>$nu_ins,
        'nom'=>$nom,
        'prenom'=>$prenom,
        'email'=>$eml,
        'motpass'=>sha1($nu_ins),
        'type_utilisateur'=>'d'
      ]);  
      $q=$bdd->prepare('insert into etudiant (utilisateur_idutilisateur,date_ns,lieu_ns,groupe,annee,section)
        values(:idetud,:dt,:ln,:grp,:ann,:sct);');
      $q->execute([
        'idetud'=>$nu_ins,
        'dt'=>$dt_ns,
        'ln'=>$le_ns,
        'grp'=>$grp,
        'ann'=>$ann,
        'sct'=>$sct
      ]);     
      echo "l'inscreption a ete fait avec succes";
  }else{
      echo "il y'a un erreur dans les information qui vous aver envoyer ";
  }
?>