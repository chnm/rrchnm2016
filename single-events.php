<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Events</h1>
    <?php $eventsCategory = get_category_by_slug('events'); ?>
    <a class="back-link" href="<?php echo get_category_link($eventsCategory->term_id); ?>">Back to all events</a>
</aside>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
        <aside class="post-meta">
            <?php the_post_thumbnail(); ?>
        </aside>
        <article>
        <h2><?php the_title(); ?></h2>
        <?php echo the_content(); ?>
        </article>
    </div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</div>

<?php get_footer(); ?>