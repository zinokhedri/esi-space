<?php 
session_start();
require("view_element/login_view.html");
if(isset($_POST['cnt_to'])){
    require "basedonne/conecttobdd.php";
    extract($_POST);
    if(!empty($ident) && !empty($motpass) && !empty($selectuser)){
        if($selectuser=="Etudiant"){
            $q=$bdd->prepare("SELECT * from utilisateur inner join etudiant WHERE ((utilisateur.idutilisateur = :ident or utilisateur.email = :ident) AND utilisateur.idutilisateur=etudiant.utilisateur_idutilisateur AND utilisateur.motpass = :motpass)");
            $q->execute([
                'ident'=>$ident,
                'motpass'=>sha1($motpass)
            ]);
            $userfound = $q->rowCount();
            if($userfound){
            $data=$q->fetch(PDO::FETCH_OBJ);
            $_SESSION['idutilisateur']=$data->idutilisateur;
            $_SESSION['nom']=$data->nom;
            $_SESSION['prenom']=$data->prenom;
            $_SESSION['email']=$data->email;
            $_SESSION['date_ns']=$data->date_ns;
            $_SESSION['lieu_ns']=$data->lieu_ns;
            $_SESSION['groupe']=$data->groupe;
            $_SESSION['annee']=$data->annee;
            $_SESSION['photo_prf']=$data->photo_prf;
            $_SESSION['section']=$data->section;
            $_SESSION['conected']="etudiant";
            header('Location:index.php');
            exit();
            }else{
                ?>
                <script type="text/javascript">
                flasherr("confirmer votre information puis conecter","flsh_dng");
                </script>
                <?php
            }
        }else if($selectuser="Ensiegnant"){
            
        }
    }else{
        if(!empty($ident) && !empty($motpass)){
            $q=$bdd->prepare("SELECT * from utilisateur WHERE ( email = :ident AND motpass = :motpass and type_utilisateur = :tp)");
            $q->execute([
                'ident'=>$ident,
                'motpass'=>$motpass,
                'tp'=>'a'
            ]);
            $userfound = $q->rowCount();
            if($userfound){
                $data=$q->fetch(PDO::FETCH_OBJ);
                $_SESSION['nom']=$data->nom;
                $_SESSION['prenom']=$data->prenom;
                $_SESSION['email']=$data->email;
                $_SESSION['photo_prf']=$data->photo_prf;
                $_SESSION['conected']="admin";
                $_SESSION['idutilisateur']=$data->idutilisateur;
                header('Location:index.php');
                exit();
            }else{
                ?>
                <script type="text/javascript">
                flasherr("selectioner un etudiant ou un ensiegnent puis reconnecter ","flsh_info");
                </script>
                <?php 
            }
        }
    }
}


?>