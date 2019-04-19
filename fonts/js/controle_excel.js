/* conrole insc manu */
function addmnul() {
    $('#insertmnl').click(function() {
        $('#_mnltbletd').append(
            [
                '<tr class="_block_load">',
                '<td class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '<td class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '<td class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '<td  class="_elem_load"><div class="_lngtb"></div></td>',
                '</tr>'
            ].join('') //un seul append pour limiter les manipulations directes du DOM
        );
        manul();
        addmnul();
    })
}
addmnul()
    /* controle table manauelle */
function manul() {
    $('._tbl_mnl').find('td').hover(function() {
        $(this).find('._lngtb').attr("contenteditable", "true");
    })
    $('._tbl_mnl').find('td').find('._lngtb').blur(function() {
        $(this).removeAttr("contenteditable");
    })
}
manul()
    /* fin manual */
    /* fin de fonction */
document.getElementById("exel_file").onchange = function(event) {
        flasherr("en cours d'importaion...", "flsh_info");
        var reader = new FileReader();
        reader.readAsDataURL(event.srcElement.files[0]);
        var me = this;
        reader.onload = function() {
            flasherr("fin d'importaion", "flsh_scc");
            var fileContent = reader.result;
            var name;
            var file = $("#exel_file")[0].files[0];
            var fileName = file.name;
            if ((fileName.indexOf(".xlsx") != -1) || (fileName.indexOf(".xls") != -1)) {
                $('#exel').find('._show_name').html('<img class = "_lgexcel"src = "fonts/img/Logo_Excel.png"/><span>' + fileName + '</span>');
                exeltojson(fileContent);
            } else {
                flasherr("importer un fichier excel (.xlsx ou .xls)", "flsh_dng")
            }
        }
    }
    /* fonction flash msgg ereur */
function flasherr(txt_ereur, type_errer) {
    $('#_err').find('.__incld').html(txt_ereur);
    $('#_err').removeClass('flsh_dng');
    $('#_err').removeClass('flsh_scc');
    $('#_err').removeClass('flsh_info');
    $('#_err').addClass(type_errer);
    $('#_err').addClass('show');
    $('._closeflash').click(function() {
        $('#_err').removeClass('show');
    })
}
/* debut fonction*/
function exeltojson(fileContent) {
    var url = fileContent;
    var oReq = new XMLHttpRequest();
    oReq.open("GET", url, true);
    oReq.responseType = "arraybuffer";

    oReq.onload = function(e) {
        var arraybuffer = oReq.response;

        /* convert data to binary string */
        var data = new Uint8Array(arraybuffer);
        var arr = new Array();
        for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
        var bstr = arr.join("");

        /* Call XLSX */
        var workbook = XLSX.read(bstr, {
            type: "binary"
        });

        /* DO SOMETHING WITH workbook HERE */
        var first_sheet_name = workbook.SheetNames[0];
        /* Get worksheet */
        var worksheet = workbook.Sheets[first_sheet_name];
        var table = XLSX.utils.sheet_to_html(worksheet);
        $('.tblauto').html(table);
        $('.tblauto').find('meta').remove();
        $('.tblauto').find('title').remove();
        $('.tblauto').find('td').removeAttr('t');
        $('.tblauto').find('td').addClass('_elem_load');
        $('.tblauto').find('table').addClass('table');
        $('.tblauto').find('tr').addClass('_block_load');
        controlexcel();
        var nu_ins, nom, prenom, dt_ns, le_ns, grp, ann, sct, eml, nb_etudiant, i;
        $('#inserer').click(function() {
            nb_etudiant = $('.tblauto').find('tr').length;
            for (i = 1; i < nb_etudiant; i++) {
                nu_ins = $('.tblauto').find('tr').eq(i).find('td').eq(0).find('._lngtb').html();
                nom = $('.tblauto').find('tr').eq(i).find('td').eq(1).find('._lngtb').html();
                prenom = $('.tblauto').find('tr').eq(i).find('td').eq(2).find('._lngtb').html();
                dt_ns = $('.tblauto').find('tr').eq(i).find('td').eq(3).find('._lngtb').html();
                le_ns = $('.tblauto').find('tr').eq(i).find('td').eq(4).find('._lngtb').html();
                grp = $('.tblauto').find('tr').eq(i).find('td').eq(5).find('._lngtb').html();
                sct = $('.tblauto').find('tr').eq(i).find('td').eq(6).find('._lngtb').html();
                ann = $('.tblauto').find('tr').eq(i).find('td').eq(7).find('._lngtb').html();
                eml = $('.tblauto').find('tr').eq(i).find('td').eq(8).find('._lngtb').html();
                insrt_etud(nu_ins, nom, prenom, dt_ns, le_ns, grp, ann, sct, eml);
            }
        })
    }
    oReq.send();
    $('._inslst').find('._insone').html('<button type="" class="_btn" id="inserer">insecrer votre liste</button>');
}
/* fonction pour inscrer un etudiant*/
function insrt_etud(nu_ins, nom, prenom, dt_ns, le_ns, grp, ann, sct, eml) {
    flasherr("l'inscreption a étè en attent...", "flsh_info");
    $.ajax({
            url: "inscreption_etudiant.php",
            method: "POST",
            data: {
                nu_ins: nu_ins,
                nom: nom,
                prenom: prenom,
                dt_ns: dt_ns,
                le_ns: le_ns,
                grp: grp,
                ann: ann,
                sct: sct,
                eml: eml
            }
        })
        .done(function(data) {
            if (data == "l'inscreption a ete fait avec succes") {
                flasherr(data, "flsh_scc");
            } else {
                flasherr(data, "flsh_dng");
            }
        });

}
/* fin de fonction */
/* controle tab excel*/
function controlexcel() {
    var i, j, nb_tr = $('.tblauto').find('tr').length;
    var email_erud;
    for (i = 0; i < nb_tr; i++) {
        if (i != 0) {
            email_erud = $('.tblauto').find('tr').eq(i).find('td').eq(2).html();
            if (email_erud[0] != "") {
                email_erud = email_erud[0] + '.' + $('.tblauto').find('tr').eq(i).find('td').eq(1).html() + '@esi-space.dz';
                $('.tblauto').find('tr').eq(i).append('<td class="_elem_load">' + email_erud + '</td>');
            }
            if (i % 2 == 0) {
                $('.tblauto').find('tr').eq(i).addClass('_drktr  ')
            }
        } else {
            $('.tblauto').find('tr').eq(i).append('<td class="_elem_load">adresse email</td>');
        }
        var nb_td = $('.tblauto').find('tr').eq(i).find('td').length;
        for (j = 0; j < nb_td; j++) {

            $('.tblauto').find('tr').eq(i).find('td').eq(j).html('<div class="_lngtb">' + $('.tblauto').find('tr').eq(i).find('td').eq(j).html() + '</div>')
        }
    }
    $('.tblauto').find('td').hover(function() {
        $(this).find('._lngtb').attr("contenteditable", "true");
    })
    $('.tblauto').find('td').find('._lngtb').blur(function() {
        $(this).removeAttr("contenteditable");
    })
}
/* controle de tableau excel*/