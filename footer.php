    <footer>
        <address class="vcard" id="hcard-chnm">
            <div class="logo"><a href="<?php echo get_site_url(); ?>">Roy Rosenzweig Center for History and New Media</a></div>
            <span id="hisdept-org"><a href="//historyarthistory.gmu.edu/">Department of History and Art History</a></span>
            <span class="adr" id="chnm-address">
                <a href="//www.gmu.edu" class="university">George Mason University</a><br>
                4400 University Drive, MSN 1E7<br>
                Fairfax, VA 22030
            </span>
            <span class="tel"><a href="tel:7039939277">703-993-9277</a> T</span>
            <span class="fax"><a href="tel:7039934585">703-993-4585</a> F</span>
            <a href="mailto:chnm@gmu.edu" class="email">chnm@gmu.edu</a>
        </address>

        <div class="license">
            <?php $requestsPage = get_page_by_title('Permission Requests'); ?>
            <a rel="license" href="//creativecommons.org/licenses/by-sa/3.0/">
            <img alt="Creative Commons License" style="border-width:0" src="//i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br />
            <span xmlns:dct="//purl.org/dc/terms/" property="dct:title">Content on this site</span> by <a xmlns:cc="//creativecommons.org/ns#" href="<?php echo get_site_url(); ?>" property="cc:attributionName" rel="cc:attributionURL">Center for History and New Media</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 License</a>. Request permissions beyond the scope of this license <a xmlns:cc="//creativecommons.org/ns#" href="<?php echo get_page_link($requestsPage->ID); ?>" rel="cc:morePermissions">here.</a>
        </div>

        <div class="copyright">
            <?php $copyrightPage = get_page_by_title('Copyright'); ?>
            <?php $policyPage = get_page_by_title('RRCHNM User Generated Content Policy'); ?>
            &copy; 1996&ndash;2016, Roy Rosenzweig Center for History and New Media. (<a href="<?php echo get_page_link($copyrightPage->ID); ?>">Copyright Notice</a> &amp; <a href="<?php echo get_page_link($policyPage->ID); ?>">User Generated Content Policy</a>)
        </div>

        <div class="neh">
            <img src="<?php echo bloginfo('template_directory'); ?>/img/neh-logo.png" alt="NEH Logo" />
            RRCHNM is supported in part by an endowment made possible by a National Endowment for the Humanities Challenge Grant
        </div>

        <div id="description">Building a Better Yesterday, Bit by Bit</div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>