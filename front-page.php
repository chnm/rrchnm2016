<?php get_header(); ?>

<div id="intro">
    <div class="container">
        <p>Democratizing history through digital media and tools.</p>
        <a href="<?php echo get_permalink(get_page_by_path('our-story')); ?>">Our Story</a>
    </div>
</div>

<div id="features">
    <div class="container">
    <p>The <span class="center-name">Roy Rosenzweig Center for History and New Media (RRCHNM)</span> is a multi-disciplinary team that develops online teaching resources, digital collections and exhibits, open-source software, and training in digital literacy and skills.</p>
    </div>
</div>

<div id="keep-up">
    <a href="the-hub" class="hub-link">Keep up with our latest activity at The Hub</a>
    <div class="event feature">
        <h2>Upcoming RRCHNM Events</h2>
        <?php $eventPost = rrchnm_find_next_event(); ?>
        <h3><a href="<?php echo get_the_permalink($eventPost); ?>"><?php echo get_the_title($eventPost); ?></a></h3>
        <?php echo get_the_post_thumbnail($eventPost); ?>
        <?php echo $eventPost->post_content; ?>
        <?php $eventsCategory = get_category_by_slug('events'); ?>
        <a href="<?php echo get_category_link($eventsCategory->term_id); ?>" class="button">See all events</a>
    </div>
    <div class="news feature">
        <h2>News</h2>
        <?php $newsPosts = get_posts(array('posts_per_page' => 1, 'category__not_in' => array($eventsCategory->term_id))); ?>
        <?php foreach ($newsPosts as $post): setup_postdata($post); ?>
            <?php
            $authorID = get_the_author_meta('ID');
            if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($authorID, 'picture')) {
                $avatar = get_cimyFieldValue($authorID, 'picture');
            } else {
                $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png';
            }
            ?>
            <div class="avatar" style="background-image:url('<?php echo $avatar; ?>')"></div>
            <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
            <?php echo the_excerpt(); ?>
            <a href="news" class="button">Read more of the news</a>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
    <?php
        $featuredFilters = array(
            'posts_per_page' => 1,
            'post_type'     => 'page',
            'post_status' => 'publish',
            'orderby' => 'rand',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => array('featured'),
                ),
            ),
        );
        $featuredPost = get_posts($featuredFilters);
        $featuredCustom = get_post_custom($featuredPost[0]->ID);
    ?>
    <div class="projects feature">
        <h2>Featured Project</h2>
        <?php foreach ($featuredPost as $post): setup_postdata($post); ?>
            <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
            <?php echo the_excerpt(); ?>
        <?php endforeach; ?>
        <a href="what-we-do" class="button">Explore more projects</a>
    </div>
</div>

<div id="support">
    <div class="container">
        <p>Each year, the Roy Rosenzweig Center for History and New Media’s many project websites receive over 16 million visitors, and more than a million people rely on its digital tools to teach, learn, and conduct research. <a href="supporters">Donations from supporters help us sustain those resources.</a></p>
        <a href="http://advancement.gmu.edu/ihm02" class="button">Support the center today</a>
    </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>