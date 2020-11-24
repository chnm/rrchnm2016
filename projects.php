<?php /* Template Name: What We Do */ ?>

<?php
$projectNav = [];
$projectCategory = get_term_by('name', 'Projects', 'category');
$projectHeaders = get_terms('category', array('parent' => $projectCategory->term_id));
foreach ($projectHeaders as $projectHeader) {
    $projectNav[$projectHeader->name] = get_terms('category', array('parent' => $projectHeader->term_id));
}
$projectsFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'orderby' => 'ASC',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('projects'),
        ),
    ),
);
$featuredFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('featured'),
        ),
    ),
);
$activeFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('active'),
        ),
    ),
);
$archivedFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('archived'),
        ),
    ),
);
$sections = array(
  'Featured' => get_posts($featuredFilters),
  'Current' => get_posts($activeFilters),
  'Legacy' => get_posts($archivedFilters),
  'Other' => get_posts($projectsFilters)
);
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro">
    <div class="container">
    <?php $customFields = get_post_custom(); ?>
    <h1><?php echo the_title(); ?></h1>
    <?php if ($introText = $customFields['Intro text'][0]): ?>
    <p><?php echo $introText; ?></p>
    <?php endif; ?>
    </div>
</div>

<div id="content">
    <?php echo the_content(); ?>
    <nav class="side">
        <h2>Browse Projects</h2>
        <ul>
        <?php foreach($projectNav as $filter => $categories): ?>
            <?php if (count($categories) > 0): ?>
            <li>By <?php echo $filter; ?>
                <ul>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>#projects"><?php echo $category->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>
    <div id="projects">
        <?php foreach($sections as $key => $projects): ?>
        <?php get_template_part('projects-section', null, array('title' => $key, 'projects' => $projects)); ?>
        <?php endforeach; ?>
    </div>
</div>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>