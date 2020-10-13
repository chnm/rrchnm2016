<?php
get_header();
$authorID = get_the_author_meta('ID');
$authorName = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
$cimyFieldsTrue = function_exists('get_cimyFieldValue');
?>

<div class="container">
    <?php if ($cimyFieldsTrue && get_cimyFieldValue($authorID, 'picture')): ?>
        <?php $avatar = get_cimyFieldValue($authorID, 'picture'); ?>
    <?php else: ?>
        <?php $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png'; ?>
    <?php endif; ?>
    <img src="<?php echo $avatar; ?>" title="avatar for <?php echo $authorName; ?>" alt="avatar for <?php echo $authorName; ?>" class="avatar">
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
            $coauthorProjects = get_posts(array(
                'posts_per_page' => -1,
                'post_type'     => 'page',
                'post_status' => 'publish',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array('projects'),
                    ),
                    array(
                        'taxonomy' => 'author',
                        'field' => 'slug',
                        'terms' => 'cap-' . get_the_author_meta('user_login')
                    )
                ),
            ));
            $authorProjects = get_posts(array(
                'posts_per_page' => -1,
                'post_type'     => 'page',
                'post_status' => 'publish',
                'author_name' =>  get_the_author_meta('user_login'),
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array('projects'),
                        'operator' => 'IN'
                    ),
                    array(
                        'taxonomy' => 'author',
                        'field' => 'slug',
                        'terms' => 'cap-' . get_the_author_meta('user_login'),
                        'operator' => 'NOT IN'
                    )
                ),
            ));
            $projects = array_merge($authorProjects, $coauthorProjects);
        ?>
        <h2>Projects</h2>
        <?php if (count($projects) > 0): ?>
            <?php foreach($projects as $project): ?>
                <?php $projectID = $project->ID; ?>
                <?php get_template_part('projects-single', null, array('projectID' => $projectID, 'isFeatured' => false)); ?>
            <?php endforeach; ?>
        <?php else: ?>
        No projects
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>