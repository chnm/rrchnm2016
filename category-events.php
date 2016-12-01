<?php
$customFields = get_post_custom();
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Events</h1>
</aside>

<?php if ( have_posts() ): ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="post">
        <aside class="post-meta">
        <?php echo the_post_thumbnail(); ?>
        </aside>
        <article>
        <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php echo the_content(); ?>
        </article>
    </div>

    <?php endwhile; ?>

    <nav class="pagination">
        <?php echo paginate_links(); ?>
    </nav>

<?php else: ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</div>

<?php get_footer(); ?>