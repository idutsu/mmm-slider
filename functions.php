<?php

add_action( 'wp_enqueue_scripts', function(){
    wp_enqueue_style( 'slick-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array('common-style'));
    wp_enqueue_style( 'slider-style', THEME_URL.'/mmm-slider/style.css', array('slick-style'), filemtime( dirname(__FILE__).'/style.css') );    
	wp_enqueue_script( 'slick-js','//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), false );
});


/*

スライダー出力関数

@param string $id
@param array $images
@example：
    $id = '#slideshow-1;
    $images = array(
        array( 'src' => THEME_URL.'/images/slide1.jpg', 'alt' => 'スライド１'  ),
        array( 'src' => THEME_URL.'/images/slide2.jpg', 'alt' => 'スライド２'  ),
        array( 'src' => THEME_URL.'/images/slide3.jpg', 'alt' => 'スライド３' )
    );
    mmm_slider( $id, $images );

*/
function mmm_slider( $id, $images ){
    ob_start();
    ?>
    <div id="<?php echo $id; ?>" class="mmm-slider">
        <?php
            $count = 1;
            foreach( $images as $image ){
                ?>
                    <img class="mmm-slider__img" src="<?php echo $image['src'] ? $image['src'] : ''; ?>" alt="<?php echo $image['alt'] ? $image['alt'] : '画像'.$count; ?>" />
                <?php
                $count ++;
            }
        ?>
    </div>
    <script>
        (function($){
            $("<?php echo $id; ?>").slick({
                autoplay:true,
                autoplaySpeed:5000,
                arrows:true,
                prevArrow:"<div class='mmm-slider__btn mmm-slider__btn--prev'><span class='mmm-slider__arrow mmm-slider__arrow--prev'></div>",
                nextArrow:"<div class='mmm-slider__btn mmm-slider__btn--next'><span class='mmm-slider__arrow mmm-slider__arrow--next'></div>",
            });
        })(jQuery);
    </script>
    <?php    
        $data = ob_get_contents();
        ob_end_clean();
        echo $data;
}





?>