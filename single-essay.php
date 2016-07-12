<?php $customFields = get_post_custom(); ?>

<?php define( 'WP_USE_THEMES', false ); get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro" <?php echo ($imgBgAttr) ? $imgBgAttr : ''; ?>>
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    <?php if ($essayAuthor = $customFields['Essay Author(s)'][0]): ?>
    <span class="essay-author"><?php echo $essayAuthor; ?></span>
    <?php endif; ?>
    <?php if ($essayDate = $customFields['Essay Date'][0]): ?>
    <span class="essay-date"><?php echo $essayDate; ?></span>
    <?php endif; ?>
    </div>
</div>

<div class="container">
    <?php if ($essayPubInfo = $customFields['Essay Publication Info'][0]): ?>
    <p class="publication-note"><?php echo $essayPubInfo; ?></p>
    <?php endif; ?>
    <?php echo the_content(); ?>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>