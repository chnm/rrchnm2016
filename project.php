<?php /* Template Name: Project */ ?>

<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro">
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    <?php if (isset($customFields['Intro text'])): ?>
    <p><?php echo $customFields['Intro text'][0]; ?></p>
    <?php endif; ?>
    </div>
</div>

<div class="container">
    <aside id="project-meta">
        <?php if ($projectURL = $customFields['URL'][0]): ?>

            <div id="project-website" class="meta-field">
                <h3>Website</h3>
                <a href="<?php echo '//' . $projectURL; ?>"><?php echo $projectURL; ?></a>
            </div>
        <?php endif; ?>
        <div id="project-contributors" class="meta-field">
            <h3>Contributors</h3>
            <?php echo rrchnm_show_project_contributors(); ?>
        </div>
        <div id="project-categories" class="meta-field">
            <?php echo rrchnm_show_project_categories(); ?>
        </div>
    </aside>
    <article id="project-description">
        <?php echo the_content(); ?>
    </article>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>