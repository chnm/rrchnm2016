    <footer>
       <nav>
            <a href="<?php echo get_home_url(); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/img/rrchnm-logo.png" alt="RRCHNM Logo" /></a>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
       </nav>
        <div class="container">
            <a rel="license" href="//creativecommons.org/licenses/by-sa/4.0/">
            <img alt="Creative Commons License" style="border-width:0" src="//i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a>
            <a href="http://gmu.edu"><img src="<?php echo bloginfo('template_directory'); ?>/img/gmu-logo.png" alt="George Mason University Logo" /></a>
            <div class="neh">
                <a href="http://neh.gov"><img src="<?php echo bloginfo('template_directory'); ?>/img/neh-logo.png" alt="NEH Logo" /></a>
                <p>RRCHNM is supported in part by an endowment made possible by National Endowment for the Humanities Challenge Grants</p>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>