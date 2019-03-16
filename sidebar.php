<aside class="col-md-4 visible-md visible-lg" id="sidebar">
    <section>
        <ul class="list-group menu list-unstyled">
        <?php 
        if ( is_active_sidebar( 'sidebar-widget-area' ) ) {
            ob_start();
            dynamic_sidebar( 'sidebar-widget-area' );
            $sidebar = ob_get_contents();
            ob_end_clean();
            echo do_shortcode($sidebar);
        } else if ( is_home() || is_page() ) { ?>
            <h2><?php _e("Meta"); ?></h2>
            <ul class="list-group menu list-unstyled">
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
            <h2><?php _e("Links"); ?></h2>
            <ul>
                <?php wp_list_bookmarks(array( 'title_before' => '<h4>', 'title_after' => '</h4>' ) ); 
        } ?>
        </ul>               
    </section>
</aside>
