<?php get_header(); ?>

<div id="intro">
    <div class="container">
        <h1><span class="anniversary">25 years</span> of making better yesterdays</h1>

        <div id="anniversary-row">
            <a href="<?php echo get_permalink(get_page_by_path('our-story')); ?>" class="story">
                <h2>Our Story</h2>
                <p>Roy Rosenzweig founded the Center in 1994 with early support from the National Endowment for the Humanities, creating digital projects that pushed the boundaries of history and the humanities. We have since produced almost 100 different projects,  used by tens of millions of people every year. Though Roy passed away in 2007, his vision continues to drive everything we do.</p>
            </a>
            <a href="<?php echo get_permalink(get_page_by_path('who-we-are')); ?>" class="people">              
                <h2>Our People</h2>
                <p>Our greatest strength is our people. More than 130 individuals have worked here over
the past 25 years, including multi-disciplinary humanities scholars, researchers, software developers, designers, and media producers. We are proud that our collaborators span many academic fields and technical specialties, both in the United States and around the world.</p>
            </a>
            <a href="<?php echo get_permalink(get_page_by_path('what-we-do')); ?>" class="projects">
                <h2>Our Work</h2>
                <p>Since our inception, we have pushed the boundaries of digital humanities by using technology to democratize history: to incorporate multiple voices, reach diverse audiences, and encourage popular participation in preserving the past. In 2018, our projects attracted over 35 million visits from more than 20 million individuals. Our work is always open source and open access, available to all.</p>
            </a>
        </div>
    </div>
</div>

<div id="support">
    <div class="container">
        <a href="http://advancement.gmu.edu/ihm02" class="button">Support the center today</a>
        <p>Each year, the Roy Rosenzweig Center for History and New Media’s many project websites receive over 16 million visitors, and more than a million people rely on its digital tools to teach, learn, and conduct research. <a href="our-story/supporters">Donations from supporters help us sustain those resources.</a></p>
    </div>
</div>

<div id="keep-up">
    <a href="the-hub" class="hub-link">Keep up with our latest activity at The Hub</a>
    <div class="event feature">
        <h2>RRCHNM Events</h2>
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
            <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
            <?php if ( has_post_thumbnail()): ?>
            <?php the_post_thumbnail(); ?>
            <?php endif; ?>
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
            <?php if ( has_post_thumbnail()): ?>
            <?php the_post_thumbnail(); ?>
            <?php endif; ?>
            <?php echo the_excerpt(); ?>
        <?php endforeach; ?>
        <a href="what-we-do" class="button">Explore more projects</a>
    </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>