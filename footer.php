    <footer>
       <nav>
            <a href="<?php echo get_site_url(); ?>"><img src="<?php echo bloginfo('template_directory'); ?>/img/rrchnm-logo.png" alt="George Mason University Logo" /></a>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
       </nav>

        <div class="license">
            <?php $requestsPage = get_page_by_title('Permission Requests'); ?>
            <a rel="license" href="//creativecommons.org/licenses/by-sa/3.0/">
            <img alt="Creative Commons License" style="border-width:0" src="//i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br />Content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>
        </div>

        <div class="gmu">
            <a href="http://gmu.edu"><img src="<?php echo bloginfo('template_directory'); ?>/img/gmu-logo.png" alt="George Mason University Logo" /></a>
        </div>

        <div class="neh">
            <a href="http://neh.gov"><img src="<?php echo bloginfo('template_directory'); ?>/img/neh-logo.png" alt="NEH Logo" /></a>
            RRRCHNM is supported in part by an endowment made possible by National Endowment for the Humanities Challenge Grants
        </div>

        <div id="description">Building a Better Yesterday, Bit by Bit</div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>