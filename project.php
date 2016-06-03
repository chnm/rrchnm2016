<?php /* Template Name: Project */ ?>

<?php $customFields = get_post_custom(); ?>

<?php define( 'WP_USE_THEMES', false ); get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro" <?php echo ($imgBgAttr) ? $imgBgAttr : ''; ?>>
    <div class="container">
    <?php if ($introTitle = $customFields['Intro title'][0]): ?>
    <h1><?php echo $introTitle; ?></h1>
    <?php else: ?>
    <h1><?php echo the_title(); ?></h1>
    <?php endif; ?>
    <?php if ($introText = $customFields['Intro text'][0]): ?>
    <p><?php echo $introText; ?></p>
    <?php endif; ?>
    </div>
</div>

<div class="container">
    <aside id="project-meta">
        <?php echo rrchnm_show_project_categories(); ?>
    </aside>
    <article id="project-description">
        <?php echo the_content(); ?>
    </article>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>