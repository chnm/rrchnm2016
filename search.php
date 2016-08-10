<?php
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Search results for: "<?php echo the_search_query(); ?>" (<?php echo $total_results; ?> results)</h1>
</aside>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
        <aside class="post-meta">
            <?php $postType =  get_post_type(); ?>
            <span class="post-type"><?php echo $postType; ?></span>
            <?php if ($postType == 'post'): ?>
                <?php if (get_the_author_meta('user_firstname')): ?>
                    <?php $authorID = get_the_author_meta('ID'); ?>
                    <?php $authorUrl = get_author_posts_url($authorID); ?>
                    <?php if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($authorID, 'picture')): ?>
                        <?php $avatar = get_cimyFieldValue($authorID, 'picture'); ?>
                    <?php else: ?>
                        <?php $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png'; ?>
                    <?php endif; ?>
                    <a href="<?php echo $authorUrl; ?>" class="avatar"><img src="<?php echo $avatar; ?>" title="avatar for <?php echo $authorName; ?>"></a>
                    <span class="author"><a href="<?php echo $authorUrl; ?>"><?php the_author_meta('user_firstname'); ?> <?php the_author_meta('user_lastname'); ?></a></span>
                <?php endif; ?>
            <?php elseif ($postType == 'essay'): ?>
                <?php $postMeta = get_post_custom(); ?>
                <?php if (isset($postMeta['Essay Author(s)'])): ?>
                <span class="author"><?php echo $postMeta['Essay Author(s)'][0]; ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </aside>
        <article>
        <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php echo the_excerpt(); ?>
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