$(document).ready(()=>{
    scrolled();
    $('#home').animate({
        opacity:1
    },1000);
    $(document).scroll(()=>{
        scrolled();
    });
    $('#tmenucari').mouseover(()=>{
        $('#tmenucari').animate({width:'600px'});
    });
    $('#tmenucari').mouseout(()=>{
        $('#tmenucari').animate({width:'100px'});
    });
    $('#menu_wrapper').animate({
        top:'0px'
    },1000,()=>{
        $('#frmCari').animate({
            left:'0px'
        },2000,()=>{
            $('#cari').animate({
                opacity:1
            },4000);
        });
    });
});

function scrolled(){
    let user_scroll = $(document).scrollTop();
        if (user_scroll>=10) {
            $('#yuk-bali').animate({
                opacity:1
            },2000);
        }
}