<?php 
extract($_SESSION);
include "basedonne/conecttobdd.php";
?>
<style>
    ._frmch {
    position: relative;
    width: 500px;
    height: 300px;
    margin: auto;
    margin-top: 12%;
    border-radius: 5px;
    display: block;
    text-align: center;
    background: white;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.24);
}
._closefrmh {
    top: -12px;
    right: -12px;
    background: #1fbda5c7;
    width: 30px;
    height: 30px;
    border-radius: 20px;
    z-index:20;
}

._closefrmh>span {
    top: 13px;
    width: 24px;
    height: 4px;
}
._imgche{
    position:absolute;
    width:100%;
}
.__shmsslct {
    position: relative;
    width: 150px;
    height: 150px;
    margin:10px auto;
}
.__shmsslct >img{
    max-width:100%;
    max-height:100%;
}
.__elmchnge{
    width:100%;
}
._frchngmg{
    width:0px;
    height:0px;
    overflow:hidden;
}
.__chnmsgph{
    margin-top:35px;
}
.__chnmsgph>input,.__chnmsgph>label{
    display:inline-block;
    margin:15px;
}
</style>

<div class="cour_profil">
    <div class="_image_user">
        <img class="image_user" alt="name_user" src="<?= isset($photo_prf) ? $photo_prf : "inconnue" ?>" title="" />
        <div class="_chng_pic">
            <img class="_lgch" src="fonts/img/picchng.png">
        </div>
    </div>
    <div class="_chs_pic">
        <div class="_rglt1">
            <div class="_frmch">
            <div class="_supimgslc  _closefrmh">
                <span></span>
                <span></span>
            </div>
                <div class="_imgche">
                    <div class="__shmsslct">
                        <img src="" alt="" >
                    </div>
                    <div class="__elmchnge">
                        <form class="__chnmsgph" method="post" enctype="multipart/form-data">
                            <label for="__ismgchng" class="_btn">choiser votre photo</label>
                            <input type="file" name="_chpic"  class="_frchngmg" id="__ismgchng">
                            <input type="button" name="_save" value="changer" id="_savechngmsg" class="_btn">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_info_profile">
        <div class="info_profile">
            <div class=" user-details">
                <div class="user-info-block">
                    <div class="user-heading">
                        <h3><?= isset($nom) && isset($prenom) ? $nom.' '.$prenom : "aucun utilisateur" ?></h3>
                        <span class="help-block"><?= isset($conected) ? $conected : "inconnue" ?></span>
                    </div>
                    <div id="conteneur">
                        <div id="menu">

                            <ul class="navigation">
                                <li class="_cselmntp">
                                    <a id="_elmactive" class="_shinfhv" data-toggle="tab" href="#">
                                        <span class="img-user">
                                        <img class="_dfnlg" src="fonts/img/man-user.png">
                                    </span>
                                        <div class="_elmnhvr">
                                            <span class="_flchshow"></span>
                                            <span class="_txthv">information</span>
                                        </div>
                                    </a>
                                </li>


                                <li class="_cselmntp">
                                    <a class="_shinfhv" data-toggle="tab" href="#">
                                        <span class="img-user">
                                         <img class="_dfnlg" src="fonts/img/education.png">
                                    </span>
                                        <div class="_elmnhvr">
                                            <span class="_flchshow"></span>
                                            <span class="_txthv">presonnel</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="_cselmntp">
                                    <a class="_shinfhv" data-toggle="tab" href="#">
                                        <span class="img-user">
                                             <img class="_dfnlg" src="fonts/img/friends.png">
                                        </span>
                                        <div class="_elmnhvr">
                                            <span class="_flchshow"></span>
                                            <span class="_txthv">mes collegues</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="_cselmntp">
                                    <a class="_shinfhv" data-toggle="tab" href="#">
                                        <span class="img-user">
                                                 <img class="_dfnlg" src="fonts/img/businessman.png">
                                            </span>
                                        <div class="_elmnhvr">
                                            <span class="_flchshow"></span>
                                            <span class="_txthv">detail</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="_cours_elemnt">
                            <div id="middle">
                                <div class="_elmncrnt _elmntactv">
                                    <div class="_crthis">
                                        <fieldset>
                                            <legend>Information Personnel</legend>
                                            <div class="blc_info">
                                                <div class="title_info">
                                                    <span>Nom</span>
                                                    <span>Prenom</span>
                                                    <span>Date de naissance</span>
                                                    <span>Lieu de naissance</span>
                                                </div>
                                                <div class="info_mm">
                                                    <span><?= isset($nom) ? $nom : "inconnue" ?></span>
                                                    <span><?= isset($prenom) ? $prenom : "inconnue" ?></span>
                                                    <span><?= isset($date_ns) ? $date_ns : "inconnue" ?></span>
                                                    <span><?= isset($lieu_ns) ? $lieu_ns : "inconnue" ?></span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="_elmncrnt">
                                    <div class="_crthis">
                                        <h3>Information D'étude</h3>
                                        <div class="inf2">
                                            Année Scolaire

                                            <span>2emme Classe Preparatoire</span>
                                        </div>
                                        <div class="inf2">
                                            Groupe
                                            <span> 04</span>
                                        </div>
                                        <div class="inf2">
                                            Section
                                            <span>A</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="_elmncrnt">
                                    <div class="_crthis">
                                        <div>
                                            cscsc
                                        </div>
                                    </div>
                                </div>
                                <div class="_elmncrnt">
                                    <div class="_crthis">
                                        paragraphe4
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   document.getElementById("__ismgchng").onchange = function(event) {
      var reader = new FileReader();
         reader.readAsDataURL(event.srcElement.files[0]);
             var me = this;
                reader.onload = function() {
                  var fileContent = reader.result;
                    var name; 
                    var file = $("#__ismgchng")[0].files[0];
                     var fileName = file.name;
                    var sizefile=file.size;
                  if(sizefile<4097152){
                     $('#_savechngmsg').attr("type","submit")
                                        $('.__shmsslct').find('img').attr("src",fileContent)
                                    }else{
                                        flasherr("la taille de fichier est trop grande ","flsh_dng");
                                    }
                                    
                                }
                            }
                        </script>
                        