<?php get_header(); ?>

<div id="intro">
    <div class="container">
        <p>Democratizing history through digital media and tools.</p>
        <a href="<?php echo get_permalink(get_page_by_path('our-story')); ?>">Our Story</a>
    </div>
</div>

<div id="keep-up">
    <div class="container">
        <div class="follow">
            <p><a href="#">Keep up on Center activity at the Hub</a></p>
            <p>Follow us on<br>
            <a href="#" class="twitter-icon"></a>
            <a href="#" class="facebook-icon"></a>
            </p>
        </div>
        <nav>
            <ul>
                <li><a href="https://securemason.gmu.edu/s/1564/match/index-1col.aspx?sid=1564&gid=2&pgid=651&cid=1709&dids=176&appealcode=IHM01">Support the Center</a></li>
                <li><a href="http://chnm.gmu.edu/courses/fellowship/">DH Fellows Program</a></li>
                <li><a href="<?php echo site_url(); ?>/what-we-do">Featured Projects</a>
                    <ul>
                    <?php
                    $featuredFilters = array(
                        'posts_per_page' => -1,
                        'post_type'     => 'page',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => array('featured'),
                            ),
                        ),
                    );
                    $featuredPosts = get_posts($featuredFilters);
                    ?>
                    <?php foreach ($featuredPosts as $featuredPost): ?>
                        <?php $featuredPostID = $featuredPost->ID; ?>
                        <li><a href="<?php echo esc_url(get_permalink($featuredPostID)); ?>"><?php echo $featuredPost->post_title; ?></a></li>
                    <?php endforeach; ?>
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