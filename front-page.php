<?php define( 'WP_USE_THEMES', false ); get_header(); ?>

<div id="intro">
    <div class="container">
        <p>Democratizing history through digital media and tools.</p>
        <a href="#">Our Story</a>
    </div>
</div>

<div id="features">
    <div class="container">
        <div class="feature">We are <a href="#">innovative</a></div>
        <div class="feature">We are <a href="#">multifaceted</a></div>
        <div class="feature">We are <a href="#">collaborative</a></div>
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
            <a href="#" class="button">Support the Center</a>
        </div>
        <nav>
            <ul>
                <li><a href="#">About Us</a>
                    <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">A Brief History</a></li>
                        <li><a href="#">Awards</a></li>
                    </ul>
                </li>
                <li><a href="#">DH Fellows Program</a></li>
                <li><a href="#">Tools</a>
                    <ul>
                        <li><a href="#">Anthologize</a></li>
                        <li><a href="#">Omeka</a></li>
                        <li><a href="#">PressForward</a></li>
                        <li><a href="#">Scripto</a></li>
                        <li><a href="#">Serendip-o-Matic</a></li>
                        <li><a href="#">Zotero</a></li>
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