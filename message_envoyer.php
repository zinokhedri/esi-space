<?php 
    $q=$bdd->prepare("select idmessage from message where util_envoyer=:recevoir");
    $q->execute([
        'recevoir'=>$_SESSION['email']
    ]);
    $nbmsgsent=$q->rowcount();
?>
<div class="cour_msg_recv">
    <div class="_descrinf">
        <div class="_ttllst _toblc">
            <h1>message envoyer</h1>
            <span class="udub-slant"><span></span></span>
        </div>
        <div class="_nbttlmsg">
            <span class="">nombre des message : <?=$nbmsgsent?></span>
        </div>
        <div class="_blcmsgnv">
            <span class="_btn">nouveau message</span>
        </div>
    </div>
    <div class="_cntnt_msg" message-data="1">
       
        <div class="header-pen">
            <div class="fltr">
                <?php 
                $cntnpg='';
                $messag_max=1;
                $nbmsgsent=ceil($nbmsgsent/$messag_max);
                if($nbmsgsent>0){
                    $cntnpg='<span class="from-move" id="from-move"></span><ul class="page-list" id="page-list">
                    <li nombre-page="1" class="active"></li>';
                }else{
                    $cntnpg='il ya acune message'; 
                }
                for($i=2;$i<=$nbmsgsent;$i++){
                    $cntnpg=$cntnpg.'<li nombre-page="'.$i.'"></li>';
                };
                $cntnpg=$cntnpg.'</ul>';
                echo $cntnpg;
                ?>
            </div>
        </div>
    </div>