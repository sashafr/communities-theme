        </article>

        <footer role="contentinfo">

            <nav id="bottom-nav">
                <?php echo public_nav_main(); ?>
            </nav>

            <div id="footer-text">
                <?php echo get_theme_option('Footer Text'); ?>
                <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                    <p><?php echo $copyright; ?></p>
                <?php endif; ?>
                <p>Theme developed by the <a href="https://github.com/upenndigitalscholarship">Penn Libraries</a> |  <a href="https://github.com/upenndigitalscholarship/communities-theme">Get the Code</a></p>
            </div>

            <?php fire_plugin_hook('public_footer', array('view'=>$this)); ?>

        </footer>

    </div><!-- end wrap -->

    <script>
    
    jQuery(document).ready(function() {
        
        Omeka.showAdvancedForm();
        Omeka.skipNav();
        Omeka.megaMenu('#top-nav');
    });
    </script>
</body>
</html>
