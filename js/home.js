$('#home').animateCss('fadeIn', function() {
	$('#menu_wrapper').css('top','0px');
	$('#menu_wrapper').animateCss('slideInDown',()=>{
		$('#logo').css('opacity','1');
		$('#logo').animateCss('rotateIn',()=>{
			$('#frmCari').css('left','360px');
			$('#frmCari').animateCss('jackInTheBox',()=>{
				$('#cari').css('opacity','1');
				$('#cari').animateCss('tada');
			});
		});
	});
  });

  

$(document).ready(()=>{
    $('#tmenucari').mouseover(()=>{
        $('#tmenucari').animate({width:'600px'});
    });
    $('#tmenucari').mouseout(()=>{
        $('#tmenucari').animate({width:'100px'});
    });
});
