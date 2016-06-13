<?php
$authorID = get_the_author_meta('ID');
$authorName = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
$cimyFieldsTrue = function_exists('get_cimyFieldValue');
define( 'WP_USE_THEMES', false ); get_header();
?>

<div class="container">
    <?php if ($cimyFieldsTrue && get_cimyFieldValue($authorID, 'picture')): ?>
        <?php $avatar = get_cimyFieldValue($authorID, 'picture'); ?>
    <?php else: ?>
        <?php $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png'; ?>
    <?php endif; ?>
    <img src="<?php echo $avatar; ?>" title="avatar for <?php echo $authorName; ?>" class="avatar">
    <h1><?php echo $authorName; ?></h1>
    <aside id="staff-meta">
        <?php if ($cimyFieldsTrue): ?>
            <div class="field jobtitle"><?php echo get_cimyFieldValue($authorID, 'jobtitle'); ?></div>
        <?php endif; ?>
        <?php if (get_the_author_meta('description')): ?>
            <div class="field description"><?php the_author_meta('description'); ?></div>
        <?php endif; ?>
    </aside>
    <div id="staff-projects">
        <?php
            $projectArgs = array(
                'posts_per_page' => -1,
                'post_type'     => 'page',
                'post_status' => 'publish',
                'author_name' => get_the_author_meta('user_login'),
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array('projects'),
                    ),
                ),
            );
            $projectQuery = new WP_Query($projectArgs);
        ?>
        <h2>Projects</h2>
        <?php if ( $projectQuery->have_posts() ) : while ( $projectQuery->have_posts() ) : $projectQuery->the_post(); ?>
            <div class="project">
            <?php $projectMeta = get_post_custom(); ?>
            <?php
            if ( has_post_thumbnail() ) {
                $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                $imgBgUrl = $imgBgUrl[0];
            } else if ($projectMeta['Image'][0]) {
                $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
            }
            ?>
            <a href="<?php echo esc_url(get_permalink($projectID)); ?>"><div class="thumbnail"><?php echo ($imgBgUrl !== '') ? '<img src="' . $imgBgUrl . '">' : ''; ?></div></a>
            <h3><?php the_title(); ?></h3>
            </div>
        <?php endwhile; else: ?>
        No projects
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>