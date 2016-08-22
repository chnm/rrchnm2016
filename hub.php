<?php /* Template Name: Project */ ?>

<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro" class="the-hub">
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    </div>
</div>

<div class="container">
    <?php echo the_content(); ?>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>