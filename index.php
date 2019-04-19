<?php 
session_start();
extract($_SESSION);
include "flash/deconect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>espace administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="fonts/css/main.css">
    <link rel="stylesheet" type="text/css" media="screen" href="fonts/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="fonts/css/sentmsg.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="fonts/css/login.css">
    <link rel="stylesheet" type="text/css" media="screen" href="fonts/css/smgb.css">

</head>

<body id="_body">
    <section id="work_space">
        <header>
            <nav class="nav_bar">
                <div class="element_bar">
                    <div class="bar_content">
                        <!-- logo et ces element -->
                        <div clas="guide-left_option">
                            <div class="guide-control_list">
                                <div>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <a class="guide-logo_img" href="index.php"f6>
                            <img class="image_logo_name"  alt="esi-space" title="espace de l'usage de l'ecole" src="fonts/img/logo_project.png" /> 
                            </a>
                        </div>
                        <!-- fin de code des element // zino -->
                        <!-- controle de la page des profile -->
                        <div class="profile_control">
                            <div class="BU_show">
                                <div class="img_profile">
                                    <img class="img_profile_user" alt="<?= isset($nom) && isset($prenom) ? $nom.' '.$prenom : "aucun utilisateur" ?>" title="name_user" src="<?= isset($photo_prf) ? $photo_prf : "inconnue" ?>" />
                                </div>
                                <div class="name_user">
                                    <span><?= isset($nom) && isset($prenom) ? $prenom[0].'.'.$nom : "aucun utilisateur" ?></span>
                                    <span class="click_show"> 
                                        <img src="fonts/img/click_logo.png"/>  
                                    </span>
                                </div>
                            </div>
                            <div class="list_barre_profil">
                                <span class="_option_list">
                                </span>
                                <div class="list_user_deroll">
                                    <div class="show_option_user">
                                        <div class="name_option">
                                            <a class="rederect_vers" href="?op=profile.php">
                                                <div class="_logo_option">
                                                    <img src="fonts/img/user.png">
                                                </div>
                                                <span>Profile</span>
                                            </a>
                                        </div>
                                        <div class="name_option">
                                            <a class="rederect_vers" href="logout.php">
                                                <div class="_logo_option">
                                                    <img src="fonts/img/logout.png">
                                                </div>
                                                <span>deconexion</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin des element // zino -->
                    </div>
                </div>
            </nav>
        </header>
        <div class="list_option">
            <div class="_listAll">
                <div class="_list_view">
                    <div class="number_block">
                        <div classs="_elem_block">
                            <div class="_list_block_number">
                                <div class="_page_block">
                                    <div class="_dthov">
                                        <a class="_page_link" href="?op=boit_reception.php" title="Boit de réception">
                                            <div class="_icon_page">
                                                <img class="_icon" alt="" src="fonts/img/box.png" title="" />
                                            </div>
                                            <span>Boit de réception</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="_page_block">
                                    <div class="_dthov">
                                        <a class="_page_link" href="?op=message_envoyer.php" title="Messages envoyés">
                                            <div class="_icon_page">
                                                <img class="_icon" alt="" src="fonts/img/email.png" title="" />
                                            </div>
                                            <span>Messages envoyés</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php 
                        if(isset($conected)){
                            include('option_user/'.$_SESSION['conected'].'.html');
                        }
                        require("basedonne/conecttobdd.php");
                            $q=$bdd->prepare("select idmessage from message where util_recevoir=:recevoir");
                            $q->execute([
                                'recevoir'=>$_SESSION['email']
                            ]);
                            $nbmsg=$q->rowcount();
                    ?>
                  </div>  
                </div>
            </div>
            <div id="gread_contenair_option">
                <div class="cour_page_select">
                    <?php 
                        if(isset($_GET['op'])){
                            include($_GET['op']);
                        }else{
                            ?>
                            <div class="cour_msg_recv">
                            <div class="_descrinf">
                                <div class="_ttllst _toblc">
                                    <h1>Boit de réception</h1>
                                    <span class="udub-slant"><span></span></span>
                                </div>
                                <div class="_nbttlmsg">
                                    <span class="">nombre des message : <?= $nbmsg?></span>
                                </div>
                                <div class="_blcmsgnv">
                                <span class="_btn">nouveau message</span>
                                </div>
                            </div>
                           <div class="_cntnt_msg" msg-data="0">                        
    
                            <div class="header-pen">
                                <div class="fltr">
                                    <?php 
                                    $cntnpg='';
                                    $messag_max=1;
                                    $nbpage=ceil($nbmsg/$messag_max);
                                    if($nbpage>0){
                                        $cntnpg='<span class="from-move" id="from-move"></span><ul class="page-list" id="page-list">
                                        <li nombre-page="1" class="active"></li>';
                                    }else{
                                        $cntnpg='il ya acune message'; 
                                    }
                                    for($i=2;$i<=$nbpage;$i++){
                                        $cntnpg=$cntnpg.'<li nombre-page="'.$i.'"></li>';
                                    };
                                    $cntnpg=$cntnpg.'</ul>';
                                    echo $cntnpg;
                                    ?>
                                </div>
                            </div>
                            

                            <?php
                        }
                    ?>
                </div>
            </div>
            <footer></footer>
    </section>
/******************/

<div class="_message_sent">
    <div class="_supimgslc _clsmsg">
        <span></span>
        <span></span>
    </div>
    <div class="_cntrlbtmsg">
        <div class="_nmmsg">
            <span>Nouveau Message</span>
        </div>
    </div>
    <div class="_senttomsg">
        <span>A:</span>
        <div class="_writto" contenteditable="true">

        </div>
    </div>
    <div class="_cntallimg">
        <div class="___img">

        </div>
        <div class="___doc">

        </div>

    </div>
    <div class="_inptwrite">
        <div class="_extwrite">
            <span class="_inptmsgenv" contenteditable="true">Taper votre message</span>
        </div>
        <div class="_elmeaddmsg">
            <div class="_elmfrm">
                <div class="__blcsent">
                    <form class="_elmfrm" method="post" enctype="multipart/form-data">
                        <div class="_fil_">
                            <label for="addimage" class="">
                                    <img src="fonts/img/addimage.png" alt="" >
                                </label>
                        </div>
                        <input type="file" name="addimage" id="addimage" class="_nwimage">
                    </form>
                </div>
                <div class="__blcsent">
                    <div class="_fil_">
                        <label for="adddocm" class="">
                                    <img src="fonts/img/adddoc.png" alt="" class="">
                                </label>
                    </div>
                    <input type="file" id="adddocm" class="_nwimage" id="">
                </div>
            </div>
            <div class="_nmflup">
                <span class="">Aucun fichier a éte selectioner</span>
            </div>
            <div class="_cnfsent">
                <img src="fonts/img/email.png" alt="" class="">
            </div>
        </div>
    </div>
</div>

/*********************/
    <div id="_err" class="_flasherr">
        <span class="__incld"></span>
        <div class="_closeflash"><span></span><span></span></div>
    </div>
    <script type="text/javascript" src="fonts/js/jquery.js"></script>
    <script type="text/javascript" src="fonts/js/xlsx.full.min.js"></script>
    <script type="text/javascript" src="fonts/js/index.js"></script>
    <script type="text/javascript" src="fonts/js/controle_excel.js"></script>
    <script type="text/javascript" src="fonts/js/snetmsg.js"></script>
    <script type="text/javascript">
    $('._cselmnt').click(function() {
    $('#_elmactiveins').removeAttr('id');
    $(this).find('a').attr('id', '_elmactiveins');
    $('._cours_elemnt').find('div').removeClass('_elmntactv');
    var my_index = $(this).index();
    $('._cours_elemnt').find('._elmncrnt').eq(my_index).addClass('_elmntactv');
})

$('._cselmntp').click(function() {
    $(this).parent('ul').find('li').find('a').removeAttr('id');
    $(this).find('a').attr('id', '_elmactive');
    $('._cours_elemnt').find('div').removeClass('_elmntactv');
    var my_index = $(this).index();
    $('._cours_elemnt').find('._elmncrnt').eq(my_index).addClass('_elmntactv');
})
$('._cselmntp').hover(function() {
        $(this).find('._elmnhvr').css({
            'visibility': 'visible',
            'opacity': '1',
            'margin-top': '20px'
        })
    }, function() {
        $(this).find('._elmnhvr').removeAttr('style')
    })
    // this is my script // Abdennour  (:
$(".page-list li").addClass('_unshow');
for (i = 0; i <= 4; i++) {
    $(".page-list li").eq(i).removeClass('_unshow')
}
$(".page-list li").click(function() {
    var nb_pg = $(".page-list").find('li').length;
    var delay = 0.05,
        init = 1;
    var li_ind = $(this).index();
    var i;
    if (li_ind > 1 && li_ind < nb_pg - 2) {
        $(".page-list li").addClass('_unshow');
        for (i = li_ind - 2; i <= li_ind + 2; i++) {
            $(".page-list li").eq(i).removeClass('_unshow')
        }
    } else if (li_ind <= 1) {
        $(".page-list li").addClass('_unshow');
        for (i = 0; i <= 4; i++) {
            $(".page-list li").eq(i).removeClass('_unshow')
        }
    } else {
        $(".page-list li").addClass('_unshow');
        for (i = nb_pg; i >= nb_pg - 5; i--) {
            $(".page-list li").eq(i).removeClass('_unshow')
        }
    }
    var li_ind_prev = $(".active").index();
    var li_length = $(this).length;
    var li_diff = li_ind - $(".active").index();
    var dur = Math.abs(li_diff)
    var left_pos = $(this).position().left + 48.5;
    $("#from-move").css({ "left": left_pos });

    if (li_diff > 0) {
        for (i = li_ind_prev; i < li_ind; i++) {
            dur = delay * init;
            $("#page-list").find("li").eq(i).addClass("animate-right").css({ "animation-delay": dur + "s" });
            init = init + 1;
        }
    } else {
        for (i = li_ind_prev; i > li_ind; i--) {
            dur = delay * init;
            $("#page-list").find("li").eq(i).addClass("animate-left").css({ "animation-delay": dur + "s" });
            init = init + 1;
        }
    }
    $("#from-move").addClass("animate");

    $("#page-list li").removeClass("active");
    $(this).addClass("active");

    $("#from-move").bind("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function() {
        $("#from-move").removeClass("animate");
        $("#from-move").unbind("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend");
    });
    $(".page-list li").bind("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function() {
        $(".page-list li").removeClass("animate-right").removeAttr("style");
        $(".page-list li").removeClass("animate-left").removeAttr("style");
        $("#page-list li").unbind("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd");
    });

})
$('#page-list li').click(function(){
       nbpage= parseInt($(this).attr("nombre-page"));
})
function shlstmsg(nbpage){
    var idmsg= parseInt($('._cntnt_msg').attr('message-data'));
    $.ajax({
        url:'showmessage.php',
        method:'POST',
        data:{nbpage:nbpage,idmsg:idmsg}
    })
    .done(function(data){
        $('._cntnt_msg').prepend(data);
        $('._msg_').click(function(){
            var idmsg=$(this).attr('id');
            $.ajax({
                url:'selectmsg.php',
                method:'post',
                data:{msg:idmsg}
            })
            .done(function(data){
                $('._cntnt_msg').css({
                    'visibility': 'hidden',
                    'overflow': 'hidden',
                    'height': '0px'
                });
                $('.cour_msg_recv').append(data);
                $('.__cntmsgslct').click(function(){
                    $('.cour_msg_recv').find('.___crmsgone').remove();
                    $('._cntnt_msg').removeAttr('style');
                })
            })
        })
    })
}
shlstmsg(1);
cntrlmsg();
/*********************************** */
function cntrlmsg(tab1) {
    $('._clsmsg').click(function() {
        $('._message_sent').remove();
    })
    $('._inptmsgenv').focus(function() {
        if ($(this).html() == 'Taper votre message') {
            $(this).html('');
            $(this).css({
                'opacity': '1'
            })
        }
    })
    $('._inptmsgenv').blur(function() {
        if ($(this).html() == '') {
            $(this).html('Taper votre message');
            $(this).removeAttr('style')
        }
    })
    $('._cntrlbtmsg').click(function() {
        if (parseInt($('._message_sent').css('height')) == 420) {
            $('._message_sent').animate({
                height: '50px'
            }, 300)
            $('._inptwrite').animate({
                bottom: '-200px'
            }, 300)
        } else {
            $('._message_sent').animate({
                height: '420px'
            }, 300)
            $('._inptwrite').animate({
                bottom: '0px'
            }, 300)
        }
    })
    var i = 0
    document.getElementById("addimage").onchange = function(event) {
        var formData = new FormData($('._elmfrm'));
        var file = $("#addimage")[0].files[0];
        var fileName = file.name; // get the form data
                    $.ajax({
                            url: 'movefilemsg.php', // the url where we want to POST
                            data: formData, // our data object
                            method: 'POST',
                            // define the type of HTTP verb we want to use (POST for our form)
                            processData: false,
                            contentType: false
                    })
                    .done(function(data){
                        alert(data)
                        $('.___img').append('<div class="_imgselct"><img src="' + data + '" alt="' + fileName + '" class=""><div class="_supimgslc _spimg"><span></span><span></span></div></div>');
                        tab1[i] = data;
                        i = +1;
                        $('._spimg').click(function() {
                            var nb_tot = $('._imgselct').length;
                            if ($(this).parent('._imgselct').index() + 1 == nb_tot) {
                                $('._nmflup').find('span').html('Aucun fichier a éte selectioner')
                            }
                            $(this).parent('._imgselct').remove();
                        })
                    })
    }
    document.getElementById("adddocm").onchange = function(event) {
        var reader = new FileReader();
        reader.readAsDataURL(event.srcElement.files[0]);
        var me = this;
        reader.onload = function() {
            var fileContent = reader.result;
            var name;
            var file = $("#adddocm")[0].files[0];
            var fileName = file.name;
            var word = fileName.split('.');
            var extenfil = word[word.length - 1];
            var extn = ['docx', 'xlsx', 'txt', 'pdf', 'rar', 'pptx'],
                extnmg = ['jpg', 'png', 'jpeg'];
            $('._nmflup').find('span').html(fileName);
            if ($.inArray(extenfil, extn) != -1) {
                $('.___doc').append('<div class="_fleblcdwnld"><img src="fonts/img/' + extenfil + '.png" alt=""><div class="_ssflp"><div class="_frsspan" fileaddresse="' + fileContent + '"><div>' + fileName + '</div></div></div><div class="_supimgslc _spdoc"><span></span><span></span></div></div>');
                tab1[i] = fileContent;
                tab2[i] = fileName;
                i = +1;
            } else if ($.inArray(extenfil, extnmg) != -1) {
                $('.___img').append('<div class="_imgselct"><img src="' + fileContent + '" alt="' + fileName + '" class=""><div class="_supimgslc _spimg"><span></span><span></span></div></div>');
                tab1[i] = fileContent;
                tab2[i] = fileName;
                i = +1;
                $('._spimg').click(function() {
                    var nb_tot = $('._imgselct').length;
                    if ($(this).parent('._imgselct').index() + 1 == nb_tot) {
                        $('._nmflup').find('span').html('Aucun fichier a éte selectioner')
                    }
                    $(this).parent('._imgselct').remove();
                })
            } else {
                $('.___doc').append('<div class="_fleblcdwnld"><img src="fonts/img/unknown.png" alt=""><div class="_ssflp"><div class="_frsspan" fileaddresse="' + fileContent + '"><div>' + fileName + '</div></div></div><div class="_supimgslc _spdoc"><span></span><span></span></div></div>');
                tab1[i] = fileContent;
                tab2[i] = fileName;
                i = +1;
            }
            $('._spdoc').click(function() {
                var nb_tott = $('._fleblcdwnld').length;
                if ($(this).parent('._fleblcdwnld').index() + 1 == nb_tott) {
                    $('._nmflup').find('span').html('Aucun fichier a éte selectioner')
                }
                $(this).parent('._fleblcdwnld').remove();
            })
        }
    }
}

/********************************** */
$('._blcmsgnv').click(function(){
    $.ajax({
        url: 'sentimg.html',
        method: 'GET',
        datatype:'html'
    })
    .done(function(data){
        $('body').append(data);
        var filechemnmsg =[],filenamemsg =[];
        cntrlmsg(filechemnmsg,filenamemsg);
        $('._cnfsent').click(function() {
        var tosent=$('._writto').html();
        if(tosent.indexOf("@esi-space.dz")!=-1){
            var msgsentis=$('._inptmsgenv').html();
            if(msgsentis!='Taper votre message'){
                $.ajax({
                    url:'message.php',
                    method:'POST',
                    data:{tosent:tosent,text:msgsentis,filechemnmsg:filechemnmsg,filenamemsg:filenamemsg}
                })
                .done(function(data){
                    alert(data)
                })
            }
        }else{
            flasherr("vous pouvez que envoyez des message a des utilisateur de l'ecole","flsh_dng");
        }
        })
    })
})
        // this is my script // Abdennour  (:
    </script>
</body>

</html>

</html>
<?php 
                            if(isset($_POST['_save'])){
                             if(isset($_FILES['_chpic']) && !empty($_FILES['_chpic']['name'])){
                                $tailemax=4097152;
                                $extension=['jpg','png','jpeg'];
                                if($_FILES['_chpic']['size']<=$tailemax){
                                    $exeuplod=strtolower(substr(strrchr($_FILES['_chpic']['name'],'.'),1));
                                    if(in_array($exeuplod,$extension)){
                                        $chemain= "photo_profile/".$nom.$prenom.'.'.$exeuplod;
                                        $resultat=move_uploaded_file($_FILES['_chpic']['tmp_name'],$chemain);
                                        echo $_FILES['_chpic']['tmp_name'];
                                        if($resultat){
                                            $q=$bdd->prepare(" UPDATE utilisateur SET photo_prf = :photo_prf WHERE idutilisateur = :numdinsc ");
                                            $q->execute([
                                                'photo_prf' =>$chemain,
                                                'numdinsc' =>$idutilisateur
                                            ]);
                                            $_SESSION['photo_prf']=$chemain;
                                        }else{
                                            ?>
                                        <script type="text/javascript">
                                        flasherr("il y a un ereur de transfert de fichier esseyer plus tard ","flsh_dng");
                                        </script>
                                        <?php 
                                        }
                    
                                    }else{
                                        ?>
                                        <script type="text/javascript">
                                        flasherr("selectioner un image dans l'extension jpg,png ou jpeg ","flsh_dng");
                                        </script>
                                        <?php   
                                    }
                                }else{
                                                    ?>
                                <script type="text/javascript">
                                flasherr("la taille de fichier est trop grande ","flsh_dng");
                                </script>
                                <?php 
                                                }
                             }else{
                                ?>
                                <script type="text/javascript">
                                flasherr("il ya un ereur dans le chargement de fichier ","flsh_dng");
                                </script>
                                <?php 
                             }
                            }

                                    
                     ?>