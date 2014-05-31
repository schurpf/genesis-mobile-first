(function( $ ) {

$.hisrc.speedTest({ speedTestUri: '50K.jpg' });

$(document).ready(function(){

  $(".hisrc img").hisrc({
	useTransparentGif: false,
    speedTestUri: '50K.jpg'
	//transparentGifSrc: 'TEST/spacer.gif' // use for IE
  });

});

})(jQuery);