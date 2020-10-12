<?php
if (isset($_POST['blog_archives'])) {
	 header("Location: $_POST[blog_archives]");
}
$customFields = get_post_custom(); 
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>News</h1>
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
                <?php 
                    $authorID = get_the_author_id(); 
                    $authorUrl = get_author_posts_url($authorID); 
                    $displayName = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
                    if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($authorID, 'picture')) {
                        $avatar = get_cimyFieldValue($authorID, 'picture'); 
                    } else {
                        $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png';
                    }
                    get_template_part('staff-single', null, array(
                        'personName' => $displayName, 
                        'personID' => $authorID,
                        'avatar' => $avatar,
                        'jobTitle' => null,
                    ));
                ?>
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