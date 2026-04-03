(function ($) {
    'use strict';

    function tooltip() {
        $('body').on('mouseenter', '.group-action .opal-add-to-cart-button:not(.tooltipstered) ,' + '.mixxcazt-color-type:not(.tooltipstered)', function () {

            var $element = $(this);
            if (typeof $.fn.tooltipster !== 'undefined') {
                $element.tooltipster({
                    position: 'top',
                    functionBefore: function (instance, helper) {
                        instance.content(instance._$origin.text());
                    },
                    theme: 'opal-product-tooltipster',
                    delay: 0,
                    animation: 'grow'
                }).tooltipster('show');
            }
        }),$('.product-style-1').on('mouseenter', '.product-block .woosw-btn:not(.tooltipstered)',function () {
			var $element = $(this);
			if (typeof $.fn.tooltipster !== 'undefined') {
				$element.tooltipster({
					position: 'left',
					functionBefore: function (instance, helper) {
						instance.content(instance._$origin.text());
					},
					theme: 'opal-product-tooltipster',
					delay: 0,
					animation: 'grow'
				}).tooltipster('show');
			}
		}),$('body').on('mouseenter', '.product-list .product-image .woosw-btn:not(.tooltipstered)',function () {
			var $element = $(this);
			if (typeof $.fn.tooltipster !== 'undefined') {
				$element.tooltipster({
					position: 'left',
					functionBefore: function (instance, helper) {
						instance.content(instance._$origin.text());
					},
					theme: 'opal-product-tooltipster',
					delay: 0,
					animation: 'grow'
				}).tooltipster('show');
			}
		}),$('.product-style-2, .product-style-3, .product-style-4, .product-style-6').on('mouseenter', '.product-block .woosc-btn:not(.tooltipstered), .product-block .woosq-btn:not(.tooltipstered), .product-block .woosw-btn:not(.tooltipstered)',function () {
			var $element = $(this);
			if (typeof $.fn.tooltipster !== 'undefined') {
				$element.tooltipster({
					position: 'top',
					functionBefore: function (instance, helper) {
						instance.content(instance._$origin.text());
					},
					theme: 'opal-product-tooltipster',
					delay: 0,
					animation: 'grow'
				}).tooltipster('show');
			}
		}),$('.product-style-5').on('mouseenter', '.product-block .woosc-btn:not(.tooltipstered), .product-block .woosq-btn:not(.tooltipstered), .product-block .woosw-btn:not(.tooltipstered)',function () {
			var $element = $(this);
			if (typeof $.fn.tooltipster !== 'undefined') {
				$element.tooltipster({
					position: 'left',
					functionBefore: function (instance, helper) {
						instance.content(instance._$origin.text());
					},
					theme: 'opal-product-tooltipster',
					delay: 0,
					animation: 'grow'
				}).tooltipster('show');
			}
		}),$('.products-list-7').on('mouseenter', '.group-action .woosc-btn:not(.tooltipstered), .group-action .woosq-btn:not(.tooltipstered), .group-action .woosw-btn:not(.tooltipstered)',function () {
			var $element = $(this);
			if (typeof $.fn.tooltipster !== 'undefined') {
				$element.tooltipster({
					position: 'top',
					functionBefore: function (instance, helper) {
						instance.content(instance._$origin.text());
					},
					theme: 'opal-product-tooltipster',
					delay: 0,
					animation: 'grow'
				}).tooltipster('show');
			}
		});

    }

    function ajax_wishlist_count() {

        $(document).on('added_to_wishlist removed_from_wishlist', function () {
            var counter = $('.header-wishlist .count, .footer-wishlist .count, .header-wishlist .wishlist-count-item');
            $.ajax({
                url: yith_wcwl_l10n.ajax_url,
                data: {
                    action: 'yith_wcwl_update_wishlist_count'
                },
                dataType: 'json',
                success: function (data) {
                    counter.html(data.count);
                    $('.wishlist-count-text').html(data.text);
                },
            });
        });

        $('body').on('woosw_change_count', function(event,count){
            var counter = $('.header-wishlist .count, .footer-wishlist .count, .header-wishlist .wishlist-count-item');

            $.ajax({
                url: woosw_vars.ajax_url,
                data: {
                    action: 'woosw_ajax_update_count'
                },
                dataType: 'json',
                success: function (data) {
                    $('.wishlist-count-text').html(data.text);
                },
            });
            counter.html(count);
        });
    }

    function woo_widget_categories() {
        var widget = $('.widget_product_categories'),
            main_ul = widget.find('ul');
        if ( main_ul.length ) {
            var dropdown_widget_nav = function () {

                main_ul.find('li').each(function () {

                    var main = $(this),
                        link = main.find('> a'),
                        ul = main.find('> ul.children');
                    if (ul.length) {

                        //init widget
                        // main.removeClass('opened').addClass('closed');

                        if (main.hasClass('closed')) {
                            ul.hide();

                            link.before('<i class="icon-plus"></i>');
                        }
                        else if (main.hasClass('opened')) {
                            link.before('<i class="icon-minus"></i>');
                        }
                        else {
                            main.addClass('opened');
                            link.before('<i class="icon-minus"></i>');
                        }

                        // on click
                        main.find('i').on('click', function(e) {

                            ul.slideToggle('slow');

                            if (main.hasClass('closed')) {
                                main.removeClass('closed').addClass('opened');
                                main.find('>i').removeClass('icon-plus').addClass('icon-minus');
                            }
                            else {
                                main.removeClass('opened').addClass('closed');
                                main.find('>i').removeClass('icon-minus').addClass('icon-plus');
                            }

                            e.stopImmediatePropagation();
                        });

                        main.on('click', function(e){

                            if( $(e.target).filter('a').length)
                                return ;

                            ul.slideToggle('slow');

                            if (main.hasClass('closed')) {
                                main.removeClass('closed').addClass('opened');
                                main.find('i').removeClass('icon-plus').addClass('icon-minus');
                            }
                            else {
                                main.removeClass('opened').addClass('closed');
                                main.find('i').removeClass('icon-minus').addClass('icon-plus');
                            }

                            e.stopImmediatePropagation();
                        });
                    }
                });
            };
            dropdown_widget_nav();
        }
    }

    function cross_sells_carousel() {
        var csell_wrap = $('body.woocommerce-cart .cross-sells ul.products');
        var item = csell_wrap.find('li.product');

        if(item.length > 3) {
            csell_wrap.slick(
                {
                    dots: true,
                    arrows: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: parseInt(3),
                    autoplay: false,
                    slidesToScroll: 1,
                    lazyLoad: 'ondemand',
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: parseInt(3),
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: parseInt(1),
                            }
                        }
                    ]
                }
            );
        }
    }

    function quick_product_variable() {
        var btnSelector = '.products .product-type-variable .add_to_cart_button';
        var xhr = false;
        $(document).on('click', btnSelector, function (e) {
            e.preventDefault();

            var $this = $(this),
                $product = $this.parents('.product').first(),
                $content = $product.find('.quick-shop-form'),
                id = $this.data('product_id'),
                loadingClass = 'btn-loading';

            if ($this.hasClass(loadingClass)) return;

            if ($product.hasClass('quick-shop-loaded')) {
                $product.addClass('quick-shop-shown');
                $('body').trigger('mixxcazt-quick-view-displayed');
                return;
            }

            $this.addClass(loadingClass);
            $product.addClass('loading-quick-shop');

            $.ajax({
                url: mixxcaztAjax.ajaxurl,
                data: {
                    action: 'mixxcazt_quick_shop',
                    id: id,
                },
                method: 'get',
                success: function (data) {
                    // insert variations form
                    $content.append(data);

                    initVariationForm($product);
                    // mixxcaztThemeModule.swatchesVariations();

                },
                complete: function () {
                    setTimeout(function () {
                        $this.removeClass(loadingClass);
                        $product.removeClass('loading-quick-shop');
                        $product.addClass('quick-shop-shown quick-shop-loaded');
                        $('body').trigger('mixxcazt-quick-view-displayed');
                    }, 100);
                },
                error: function () {
                },
            });

        }).on('click', '.quick-shop-close', function () {
            var $this = $(this),
                $product = $this.parents('.product');
            $product.removeClass('quick-shop-shown');
        }).on('submit', 'form.cart', function (e) {

            var $productWrapper = $(this).parents('.product');
            if ($productWrapper.hasClass('product-type-external') || $productWrapper.hasClass('product-type-zakeke')) return;

            e.preventDefault();

            var form = $(this);
            form.block({message: null, overlayCSS: {background: '#fff', opacity: 0.6}});

            var formData = new FormData(form[0]);
            formData.append('add-to-cart', form.find('[name=add-to-cart]').val());
            formData.delete('woosq-redirect');
            if (xhr) {
                xhr.abort();
            }
            // Ajax action.
            xhr = $.ajax({
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'mixxcazt_add_to_cart'),
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                complete: function (response) {

                    // Redirect to cart option
                    if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                        window.location = wc_add_to_cart_params.cart_url;
                        return;
                    }

                    response = response.responseJSON;

                    if (!response) {
                        return;
                    }

                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                        return;
                    }

                    var $thisbutton = form.find('.single_add_to_cart_button'); //

                    // Trigger event so themes can refresh other areas.
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

                    // Remove existing notices
                    $('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();

                    // Add new notices
                    $('.single-product .main .woocommerce-notices-wrapper').append(response.fragments.notices_html)

                    form.unblock();
                    xhr = false;
                }
            });

        });
        $(document.body).on('added_to_cart', function () {
            $('.product').removeClass('quick-shop-shown');
        });
    }

    function initVariationForm($product) {
        $product.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').change();
        $product.find('.variations_form').trigger('wc_variation_form');
    }

    $(document).ready(function () {
        cross_sells_carousel();
    });

    function productHoverRecalc() {
		var heightHideInfo = $('.product-style-2 .product-block .product-caption-bottom, .product-style-6 .product-block .product-caption-bottom').outerHeight();
		$('.product-style-2 .product-block .content-product-imagin, .product-style-6 .product-block .content-product-imagin').css({
			marginBottom: -heightHideInfo
		});

	}

    quick_product_variable();
    woo_widget_categories();
    tooltip();
    ajax_wishlist_count();
	productHoverRecalc();
})(jQuery);
