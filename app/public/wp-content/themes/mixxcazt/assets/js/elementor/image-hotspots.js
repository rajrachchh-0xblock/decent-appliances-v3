(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/mixxcazt-image-hotspots.default', ($scope) => {
            let imgHotspotsElem = $scope.find('.mixxcazt-image-hotspots-container');
            imgHotspotsElem.each(function () {
                let imgHotspotsSettings = $(this).data('settings'),
                    triggerClick = null,
                    triggerHover = null;

                if (imgHotspotsSettings['layout'] === 'tooltips') {
                    if (imgHotspotsSettings['trigger'] === 'click') {
                        triggerClick = true;
                        triggerHover = false;

                    } else if (imgHotspotsSettings['trigger'] === 'hover') {
                        triggerClick = false;
                        triggerHover = true;
                    }

                    $(this).find('.tooltip-wrapper').tooltipster({
                        functionBefore() {
                            if (imgHotspotsSettings['hideMobiles'] && $(window).outerWidth() < 768) {
                                return false;
                            }
                        },
                        functionInit: function (instance, helper) {
                            var content = $(helper.origin).find("[id^='tooltip_content-']").detach();
                            instance.content(content);
                        },
                        functionReady: function () {
                            $(".tooltipster-box").addClass("tooltipster-box-" + imgHotspotsSettings['id']);
                            $(".tooltipster-arrow").addClass("tooltipster-arrow-" + imgHotspotsSettings['id']);
                        },
                        contentCloning: true,
                        plugins: ['sideTip'],
                        animation: imgHotspotsSettings['anim'],
                        animationDuration: imgHotspotsSettings['animDur'],
                        delay: imgHotspotsSettings['delay'],
                        trigger: "custom",
                        triggerOpen: {
                            click: triggerClick,
                            tap: true,
                            mouseenter: triggerHover
                        },
                        triggerClose: {
                            click: triggerClick,
                            tap: true,
                            mouseleave: triggerHover
                        },
                        arrow: imgHotspotsSettings['arrow'],
                        contentAsHTML: true,
                        autoClose: false,
                        minWidth: imgHotspotsSettings['minWidth'],
                        maxWidth: imgHotspotsSettings['maxWidth'],
                        distance: imgHotspotsSettings['distance'],
                        interactive: true,
                        minIntersection: 16,
                        side: imgHotspotsSettings['side']
                    });
                }
            });


        });
    });

})(jQuery);


