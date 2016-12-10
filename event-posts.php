<?php if ( have_posts() ): ?>
    <?php $currentMonth = ''; ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php $eventDate = new DateTime(get_field('event_start_date')); ?>
    <?php $eventDate = $eventDate->format('F Y'); ?>
    <?php if ($eventDate !== $currentMonth): ?>
    <h3><?php echo $eventDate; ?></h3>
    <?php $currentMonth = $eventDate; ?>
    <?php endif; ?>

    <div class="post">
        <aside class="post-meta">
        <?php echo the_post_thumbnail(); ?>
        </aside>
        <article>
        <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php echo the_content(); ?>
        <?php if (has_tag('rrchnm-at')): ?>
        <a href="<?php echo get_tag_link($rrchnmAtTag->term_id); ?>" class="rrchnm-at tag">RRCHNM@</a>
        <?php endif; ?>
        <?php if (has_tag('at-rrchnm')): ?>
        <a href="<?php echo get_tag_link($atRrchnmTag->term_id); ?>" class="at-rrchnm tag">@RRCHNM</a>
        <?php endif; ?>
        </article>
    </div>

    <?php endwhile; ?>

    <nav class="pagination">
        <?php echo paginate_links(); ?>
    </nav>

<?php else: ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
