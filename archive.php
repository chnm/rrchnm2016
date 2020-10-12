<?php
if (isset($_POST['blog_archives'])) {
	 header("Location: $_POST[blog_archives]");
}
$customFields = get_post_custom(); 
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Archives: <?php single_month_title(' '); ?></h1>
    <form action="" method="post">
    <label for="blog_archives">Archives</label>
    <select id="blog_archives" name="blog_archives">
        <option>Select by month</option>
        <?php wp_get_archives(array('format' => 'option')); ?>
    </select>
    <button type="submit">Go</button>
    </form>
</aside>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
        <aside class="post-meta">
            <span class="date"><?php the_date('n/j/Y'); ?></span>
            <?php if (get_the_author_meta('user_firstname')): ?>
                <?php $authorID = get_the_author_id(); ?>
                <?php $authorUrl = get_author_posts_url($authorID); ?>
                <?php if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($authorID, 'picture')): ?>
                    <?php $avatar = get_cimyFieldValue($authorID, 'picture'); ?>
                <?php else: ?>
                    <?php $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png'; ?>
                <?php endif; ?>
                <a href="<?php echo $authorUrl; ?>" class="avatar"><img src="<?php echo $avatar; ?>" title="avatar for <?php echo $authorName; ?>"></a>
                <span class="author"><a href="<?php echo $authorUrl; ?>"><?php the_author_meta('user_firstname'); ?> <?php the_author_meta('user_lastname'); ?></a></span>
            <?php endif; ?>
        </aside>
        <article>
        <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php echo the_content(); ?>
        </article>
    </div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<nav class="pagination">
    <?php echo paginate_links(); ?>
</nav>

</div>

<?php get_footer(); ?>