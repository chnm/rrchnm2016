<?php get_header(); ?>

<div id="intro">
    <div class="container">
        <p>Democratizing history through digital media and tools.</p>
        <a href="<?php echo get_permalink(get_page_by_path('our-story')); ?>">Our Story</a>
    </div>
</div>

<div id="features">
    <div class="container">
    <p>The <span class="center-name">Roy Rosenzweig Center for History and New Media</span> is a multidisciplinary organization that has spent over 20 years using technology to encourage diverse,  popular participation in presenting and preserving the past.</p>
    </div>
</div>

<div id="keep-up">
    <a href="the-hub" class="hub-link">Keep up with our latest activity at The Hub</a>
    <?php
        $essayPost = get_posts(array('posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => 'essay'));
        $essayCustom = get_post_custom($essayPost[0]->ID);
    ?>
    <div class="essay feature">
        <h2>Classic Essay on History and New Media</h2>
        <?php foreach ($essayPost as $post): setup_postdata($post); ?>
            <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
            <span class="byline">by <?php echo $essayCustom['Essay Author(s)'][0]; ?></span>
            <?php echo the_excerpt(); ?>
        <?php endforeach; wp_reset_postdata()?>
            <a href="essay" class="button">See the full essay archive</a>
    </div>
    <div class="news feature">
        <h2>News</h2>
        <?php $newsPosts = get_posts(array('posts_per_page' => 1)); ?>
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
        <p>Each year, the Roy Rosenzweig Center for History and New Media’s many project websites receive over 16 million visitors, and more than a million people rely on its digital tools to teach, learn, and conduct research. Donations help us sustain these resources.</p>
        <a href="http://advancement.gmu.edu/ihm02" class="button">Support the center today</a>
    </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>