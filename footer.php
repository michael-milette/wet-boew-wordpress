
<footer role="contentinfo" id="wb-info" class="visible-sm visible-md visible-lg wb-navcurr">
    <div class="container">
        <?php ob_start(); ?>
        <section class="row">
            <div class="col-md-3 widget-area">
                <?php if (is_active_sidebar('first-footer-widget-area')) dynamic_sidebar( 'first-footer-widget-area' ); ?>
            </div>
            <div class="col-md-3 widget-area">
                <?php if (is_active_sidebar('second-footer-widget-area')) dynamic_sidebar( 'second-footer-widget-area' ); ?>
            </div>
            <div class="col-md-3 widget-area">
                <?php if (is_active_sidebar('third-footer-widget-area')) dynamic_sidebar( 'third-footer-widget-area' ); ?>
            </div>
            <div class="col-md-3 widget-area">
                <?php if (is_active_sidebar('fourth-footer-widget-area')) dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
            </div>
        </section>
        <p><?php if (is_active_sidebar('bottom-footer-widget-area')) dynamic_sidebar( 'bottom-footer-widget-area' ); ?></p>
        <?php
            $sidebar = ob_get_contents();
            ob_end_clean();
            echo do_shortcode($sidebar);
        ?>
    </div>
</footer>
<!--[if gte IE 9 | !IE ]><!-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/wet-boew/js/wet-boew.min.js"></script>
<!--<![endif]-->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_directory') ?>/wet-boew/js/ie8-wet-boew2.min.js"></script>

<![endif]-->

<?php wp_footer(); ?>

</body>
</html>