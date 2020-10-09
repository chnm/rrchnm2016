<?php /* Template Name: About Us */ ?>

<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro" <?php echo (isset($imgBgAttr)) ? $imgBgAttr : ''; ?>>
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    <?php if (isset($customFields['Intro text'][0])): ?>
    <?php $introText = $customFields['Intro text'][0]; ?>
    <p><?php echo $introText; ?></p>
    <?php endif; ?>
    </div>
</div>

<div class="container">
    <nav id="about-nav" class="side">
       <?php wp_nav_menu( array( 'theme_location' => 'about-menu') ); ?>
    </nav>
    <section>
        <?php echo the_content(); ?>
    </section>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>