<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                mixxcazt_site_branding();
                if (mixxcazt_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php mixxcazt_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php mixxcazt_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php mixxcazt_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    mixxcazt_header_account();
                    if (mixxcazt_is_woocommerce_activated()) {
                        mixxcazt_header_wishlist();
                        mixxcazt_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
