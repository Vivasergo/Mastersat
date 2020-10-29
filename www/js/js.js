
jQuery(function(){
    $("#date_in").mask("99:99:99 99.99.2099");

});
$(document).ready(function(){
    if($('div').hasClass('animation'))
    {
        function anim_bl()
        {
            var rand_x = Math.floor(Math.random()* 685);
            $('#an_bl_1').css({
                left:rand_x,
                top:0,
                opacity:1
            });
            var rand_y = Math.floor(Math.random()* 165);
            var imgs=['discovery-showcase1.PNG', 'football__middle.PNG', 'exclusive_TV1000.png',
            'exclusive_TV1000action.png', 'exclusive_TV1000Rus.png', 'exclusive_viasatexplorer.PNG',
            'exclusive_viasathistory.PNG', 'exclusive_viasatnature.png', 'preview_1_1.png',
            'preview_1avomob.png', 'preview_1delovoy.png', 'preview_1Nathionalniy.png',
            'preview_2_2_100_100.png', 'preview_11.061.jpg', 'preview_21_stoletie.png',
            'preview_24.png', 'preview_24tehno.png', 'preview_48_1sn.gif.jpg',
            'preview_69_1sn.gif.jpg', 'Nickelodeon.png', 'preview_a1.png', 'preview_aljazeera.jpg',
            'preview_ATR.png', 'preview_axnscifi.png', 'preview_Babay.png', 'preview_Bez_imeni-1.png',
            'preview_business.png', 'preview_Cartoon.png', 'preview_cbs-reality-logo.png', 'preview_CNN.png',
            'preview_detsky_logo.jpg', 'preview_Discovery_channel.png', 'preview_dobro.png', 'preview_DW.png',
            'preview_ERA.png', 'preview_esp.png', 'preview_euronews.png', 'preview_evrokino.png',
            'preview_Extreme_Sports.jpg', 'preview_fineliving.png', 'preview_FOX_copy.jpg', 'preview_France_24.png',
            'preview_GTV_Logo.jpg', 'preview_Gumor.png', 'preview_ICTV.png', 'preview_kidsco_logo.png',
            'preview_KRT.png', 'preview_kyiv.jpg', 'preview_logo_big.png', 'preview_logo_RGB.jpg',
            'preview_M1.png', 'preview_Maxxi.png', 'preview_Menu_TV_logo_2.png', 'preview_MGM.jpg',
            'preview_Mtv.png', 'preview_music_box.png', 'preview_national_geografic_channel.png', 'preview_News_one.png',
            'preview_noviy.png', 'preview_nst.png', 'preview_Ohota_i_ribalka.png', 'preview_OK.PNG',
            'preview_original_Diva_Universal.png', 'preview_Otv.png', 'preview_pershyi-ukraine-logo.JPG', 'preview_Pogoda.PNG',
            'preview_PRO_BCE.png', 'preview_RBK.png', 'preview_RealTV.png', 'preview_russkiy_illuzion4.png',
            'preview_Star.png', 'preview_STB.png', 'preview_TBI.png', 'preview_TCM.png',
            'preview_TET.PNG', 'preview_Tonis.png', 'preview_tv5monde.jpg', 'preview_uashione.png',
            'preview_UBR.png', 'preview_universal2.png', 'preview_VH1.png', 'preview_zagruzhennoe.png'];
            var n=imgs.length -1;
            var rand_el=Math.floor(Math.random()* n);
            var pic = imgs[rand_el];
            document.getElementById('an_bl_1').innerHTML='<img src="/img/anim/'+pic+'" alt="" />';
            $('#an_bl_1').animate({
                left:rand_x,
                top:'160px',
                opacity:0
            }, {
                duration:1500,
                easing:'swing'
            });
        }
        setInterval(anim_bl,2000);
    }
    $('#adm_button').click(function()
    {
        $('#bg_adm').css({
            'display':'block'
        });
    })

    //Проверка поля ввода на пустоту
    $('#sub_mail, #bg_adm form input[type="submit"], form input[type="submit"]').click(function()
    {
        error=0;
        $('form').has(this).find($('.required')).each(function(){
            $(this).css({
                'border':'1px solid #ccc'
            })
            if($(this).attr('value')=='')
            {
                $(this).css({
                    'border':'1px solid red'
                })
                error =1;
            }
        })
        if (error ==0)
        {
            $('#mail_us, #bg_adm form input["submit"], .form_cl input[type="submit"]').submit()
        }
        else
            return false;
    });

    $('#search').focus(function()
    {
        $(this).attr({
            'value':''
        })
    })
    $('.del').click(function()
    {
        var new_href=$(this).attr('href')
        $(this).attr({
            'href':'javascript:void=0'
        })
        $('.gray_bg').css({
            'display':'block'
        })
        $('.warn a.confirm').attr({
            'href':new_href
        });
    })
    $('.cancel').click(function()
    {
        $('.gray_bg').css({
            'display':'none'
        })
    })
});

function display_off()
{
    $('#bg_adm').css({
        'display':'none'
    });
}
