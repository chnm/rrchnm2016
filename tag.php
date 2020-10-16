<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>News</h1>
    <label for="blog-archives">Archives</label>
    <select id="blog-archives" name="blog-archives" onchange="document.location.href=this.options[this.selectedIndex].value;">
        <option>Select by month</option>
        <?php wp_get_archives(array('format' => 'option')); ?>
    </select>
</aside>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
        <aside class="post-meta">
            <span class="date"><?php the_date('n/j/Y'); ?></span>
            <?php if (get_the_author_meta('user_firstname')): ?>
                <?php 
                    $authorID = get_the_author_id(); 
                    get_template_part('staff-single', null, array(
                        'userID' => $authorID,
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