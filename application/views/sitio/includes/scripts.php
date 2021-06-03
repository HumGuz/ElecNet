<!-- jquery js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery.min.js"></script> 

<!-- bootstrap js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/bootstrap.min.js"></script> 

<!-- owl.carousel.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/owl.carousel.min.js"></script> 

<!-- jquery.mobile-menu js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/mobile-menu.js"></script> 

<!--jquery-ui.min js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/jquery-ui.js"></script> 

<!-- main js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/main.js"></script> 

<!-- countdown js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/countdown.js"></script> 

<!-- Slider Js --> 
<script type="text/javascript" src="<?php echo base_url() ?>application/views/sitio/js/revolution-slider.js"></script> 
<script type='text/javascript'>
        jQuery(document).ready(function(){
            jQuery('#rev_slider_4').show().revolution({
                dottedOverlay: 'none',
                delay: 5000,
                startwidth: 865,
	            startheight: 450,

                hideThumbs: 200,
                thumbWidth: 200,
                thumbHeight: 50,
                thumbAmount: 2,

                navigationType: 'thumb',
                navigationArrows: 'solo',
                navigationStyle: 'round',

                touchenabled: 'on',
                onHoverStop: 'on',
                
                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,
            
                spinner: 'spinner0',
                keyboardNavigation: 'off',

                navigationHAlign: 'center',
                navigationVAlign: 'bottom',
                navigationHOffset: 0,
                navigationVOffset: 20,

                soloArrowLeftHalign: 'left',
                soloArrowLeftValign: 'center',
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,

                soloArrowRightHalign: 'right',
                soloArrowRightValign: 'center',
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,

                shadow: 0,
                fullWidth: 'on',
                fullScreen: 'off',

                stopLoop: 'off',
                stopAfterLoops: -1,
                stopAtSlide: -1,

                shuffle: 'off',

                autoHeight: 'off',
                forceFullWidth: 'on',
                fullScreenAlignForce: 'off',
                minFullScreenHeight: 0,
                hideNavDelayOnMobile: 1500,
            
                hideThumbsOnMobile: 'off',
                hideBulletsOnMobile: 'off',
                hideArrowsOnMobile: 'off',
                hideThumbsUnderResolution: 0,
					

                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0,
                fullScreenOffsetContainer: ''
            });
        });
        </script>