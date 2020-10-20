<?php
$currentCategoryName = single_cat_title("", false);
$whatWeDoPage = get_page_by_path('what-we-do');
$whatWeDoPageID = $whatWeDoPage->ID;
$customFields = get_post_custom($whatWeDoPageID);
if (has_post_thumbnail($whatWeDoPageID)) {
    $GLOBALS['rrchnm'] = array();
    $GLOBALS['rrchnm']['headerImgBgUrl'] = wp_get_attachment_image_src( get_post_thumbnail_id($whatWeDoPageID), 'large' );
}
?>

<?php get_header(); ?>

<div class="what-we-do">
    <div id="intro" <?php echo (isset($imgBgAttr)) ? $imgBgAttr : ''; ?>>
        <div class="container">
            <h1><?php echo get_the_title($whatWeDoPageID); ?></h1>
        </div>
    </div>
    <div id="content">
        <?php
            $whatWeDoContent = $whatWeDoPage->post_content;
            $whatWeDoContent = apply_filters('the_content', $whatWeDoContent);
            echo $whatWeDoContent;
        ?>
        <nav class="side">
            <ul>
            <?php
            wp_reset_postdata();
            $projectsFilters = array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'post_status' => 'publish',
                'tax_query'	=> array(
                    array(
                    'taxonomy'  => 'category',
                    'field'     => 'term_id',
                    'terms'     => $cat,
                    'operator'  => 'IN'
                    )
                ),
            );
            $projectQuery = new WP_Query($projectsFilters);

            $projectNav = [];
            $projectCategory = get_term_by('name', 'Projects', 'category');
            $projectHeaders = get_terms('category', array('parent' => $projectCategory->term_id));
            foreach ($projectHeaders as $projectHeader) {
                $projectNav[$projectHeader->name] = get_terms('category', array('parent' => $projectHeader->term_id));
            }

            ?>
            <?php foreach($projectNav as $filter => $categories): ?>
                <?php if (count($categories) > 0): ?>
                <li>By <?php echo $filter; ?>
                    <ul>
                        <?php foreach ($categories as $category): ?>
                        <?php $active = ($category->name == $currentCategoryName) ? 'class="active"' : ''; ?>
                        <li <?php echo $active; ?>><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>#projects"><?php echo $category->name; ?> <?php echo ($active !== '') ? '(' . $projectQuery->found_posts . ')' : ''; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </nav>
        <div id="projects">
            <div class="section">
              <?php echo $imgBgUrl[0]; ?>
            <?php while ($projectQuery->have_posts()) : $projectQuery->the_post(); ?>
                <?php
                $projectID = get_the_ID();
                get_template_part('projects-single', null, array('projectID' => $projectID, 'isFeatured' => false));
                ?>
            <?php endwhile; ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>