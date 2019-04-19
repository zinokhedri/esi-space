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

/* code pour fonction de liste */
var aplic_animate = false;
$('.guide-control_list').click(function() {
    if (parseInt($('.list_option').css("width")) > 60) {
        $('.list_option').animate({
            width: '50px'
        }, 150)
        $(this).css({
            'background': 'none'
        })
        $('#gread_contenair_option').css({
            'margin-left': '54px'
        })
        aplic_animate = true;
    } else {
        $('.list_option').animate({
            width: '240px'
        }, 150)
        $(this).css({
            'background': '#fafafa49'
        })
        $('#gread_contenair_option').css({
            'margin-left': '244px'
        })
        aplic_animate = false;
    }
})
$('.guide-control_list').hover(function() {
    if (aplic_animate) {
        $(this).css({
            'background': '#fafafa49'
        })
    }
}, function() {
    if (aplic_animate) {
        $(this).css({
            'background': 'none'
        })
    }
})
$('.list_option').hover(function() {
    if (aplic_animate) {
        $(this).animate({
            width: '240px'
        }, 150)
        $(this).css({
            'box-shadow': ' 0px 0px 15px #404a5ea2'
        })
    }
}, function() {
    if (aplic_animate) {
        $(this).animate({
            width: '50px'
        }, 150)
        $(this).css({
            'box-shadow': ' none'
        })
    }
})
$('._dthov').click(function() {
        if (parseInt($(this).parent('._page_block').find('._lst_drl').css('height')) == 0) {
            $(this).parent('._page_block').find('._lst_drl').addClass('active_derol');
            $(this).find('.flch_ct').css({
                'transform': 'rotate(0deg)'
            })
            $(this).addClass('active_block')
        } else {
            $(this).parent('._page_block').find('._lst_drl').removeClass('active_derol')
            $(this).find('.flch_ct').css({
                'transform': 'rotate(-90deg)'
            })
            $(this).removeClass('active_block')
        }
    })
    /* fin de code */
    /* code pour le list de profile */
$('.click_show').hover(function() {
        $('.list_barre_profil').css({
            'display': 'block'
        })
        $('.list_barre_profil').animate({
            top: '40px'
        }, 10)
        $('.list_barre_profil').hover(function() {

            $(this).css({
                'display': 'block'
            })
            $(this).animate({
                top: '40px'
            }, 10)
        }, function() {
            $(this).css({
                'display': 'none',
                'top': '100px'
            })
        })
    })
    /* fin de code */
    /* code pour gestion de photo de profile */
$('._chng_pic').click(function() {
    $('._chs_pic').css({
        'height': '100%'
    })
})
$('._closefrmh').click(function() {
        $('._chs_pic').css({
            'height': '0%'
        })
    })
    /* fin de code */


$('._supmsg').click(function() {

    })
    /* code zino to dj */