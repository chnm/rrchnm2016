<?php get_header(); ?>

<div id="intro">
    <div class="container">
        <p>Democratizing history through digital media and tools.</p>
        <a href="<?php echo get_permalink(get_page_by_path('our-story')); ?>">Our Story</a>
    </div>
</div>

<div id="features">
    <div class="container">
        <div class="feature">We are <a href="<?php echo get_permalink(get_page_by_path('who-we-are')); ?>">versatile</a></div>
        <div class="feature">We are <a href="<?php echo get_permalink(get_page_by_path('what-we-do')); ?>">innovative</a></div>
        <div class="feature">We are <a href="<?php echo get_permalink(get_page_by_path('who-we-work-with')); ?>">collaborative</a></div>
    </div>
</div>

<div id="keep-up">
    <div class="container">
        <a href="#" class="hub-link">Keep up on Center activity at the Hub</a>
        <div class="follow">
            <p>Follow us on<br>
            <a href="#" class="twitter-icon"></a>
            <a href="#" class="facebook-icon"></a>
            </p>
        </div>
        <nav>
            <ul>
                <li><a href="https://securemason.gmu.edu/s/1564/match/index-1col.aspx?sid=1564&gid=2&pgid=651&cid=1709&dids=176&appealcode=IHM01">Support the Center</a></li>
                <li><a href="http://chnm.gmu.edu/courses/fellowship/">DH Fellows Program</a></li>
                <li><a href="<?php echo site_url(); ?>/category/projects/content/software">Tools</a>
                    <ul>
                        <li><a href="http://omeka.org">Omeka</a></li>
                        <li><a href="http://pressforward.org">PressForward</a></li>
                        <li><a href="http://scripto.org">Scripto</a></li>
                        <li><a href="http://zotero.org">Zotero</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>