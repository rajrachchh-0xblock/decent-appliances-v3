(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/mixxcazt-map-location.default', ($scope) => {
            let $tabs = $scope.find('.store-location .location-item');
            let $contents = $scope.find('.phone-location');
            let $contentsItem = $scope.find('.phone-content-item');
            let $sub = $scope.find('.store-location .location-sub .location-item .title');
            let $hidden = $scope.find('.store-location .location-sub');

            // Setup
            $tabs.first().addClass("active");
            $contentsItem.first().addClass("active");
            $sub.first().addClass("location-sub-title-active");

            $tabs.on('click', function (e) {
                e.preventDefault();
                $tabs.removeClass('active');
                $contentsItem.removeClass('active');
                $(this).addClass('active');
                let id = $(this).attr('data-setting-key');
                $contents.find('#' + id).addClass('active');
                $hidden.removeClass('active');
            });

            $('.store-location .location-hover').hover(function () {
                $hidden.addClass('active');
            }, function () {
                $hidden.removeClass('active');
            });

            $sub.on('click', function (e) {
                e.preventDefault();
                $sub.removeClass('location-sub-title-active');
                $(this).addClass('location-sub-title-active');
                let $contentlocation =  $scope.find('.location-sub-title-active').text();
                $scope.find('.location-country-title-active').text($contentlocation);

                let $link = $scope.find('.location-sub-title-active').attr('href');
                $scope.find('.js-content-location').attr('href',$link);

            });

            let $contentlocation =  $scope.find('.location-sub-title-active').text();
            $scope.find('.location-country-title-active').text($contentlocation);

            let $link = $('.location-sub-title-active').attr('href');
            $scope.find('.js-content-location').first().attr('href',$link);

        });
    });

})(jQuery);
