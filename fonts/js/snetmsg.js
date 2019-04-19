function cntrlmsg(tab1, tab2) {
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
        var reader = new FileReader();
        reader.readAsDataURL(event.srcElement.files[0]);
        var me = this;
        reader.onload = function() {
            var fileContent = reader.result;
            var name;
            var file = $("#addimage")[0].files[0];
            var fileName = file.name;
            $('._nmflup').find('span').html(fileName);
            $('.___img').append('<div class="_imgselct"><img src="' + fileContent + '" alt="' + fileName + '" class=""><div class="_supimgslc _spimg"><span></span><span></span></div></div>');
            tab1[i] = fileContent;
            tab2[i] = fileName;
            i = +1;
            alert(filenamemsg[j])
            $('._spimg').click(function() {
                var nb_tot = $('._imgselct').length;
                if ($(this).parent('._imgselct').index() + 1 == nb_tot) {
                    $('._nmflup').find('span').html('Aucun fichier a éte selectioner')
                }
                $(this).parent('._imgselct').remove();
            })
        }
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