(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/mixxcazt-testimonials.default', ($scope) => {
            let $carousel = $('.mixxcazt-carousel', $scope);
            if ($carousel.length > 0) {
                if($carousel.hasClass('layout-style-4')){
                    let $nav = $('.testimonial-image-style',$scope);
                    $carousel.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        fade: true,
                        asNavFor: $nav
                    });
                    $nav.slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: $carousel,
                        dots: true,
                        centerMode: true,
                        focusOnSelect: true
                    });
                }else {
                    let data = $carousel.data('settings');
                    $carousel.slick(
                        {
                            dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                            arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                            infinite: data.loop,
                            speed: 300,
                            slidesToShow: parseInt(data.items),
                            autoplay: data.autoplay,
                            autoplaySpeed: data.autoplaySpeed,
                            slidesToScroll: 1,
                            lazyLoad: 'ondemand',
                            rtl: data.rtl,
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: parseInt(data.items_tablet),
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: parseInt(data.items_mobile),
                                    }
                                }
                            ]
                        }
                    );
                }
            }
        });
    });

})(jQuery);
