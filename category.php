<?php get_header(); ?>

<?php
$currentCategoryName = single_cat_title("", false);

$whatWeDoPage = get_page_by_path('what-we-do');
$whatWeDoPageID = $whatWeDoPage->ID;
?>

<div class="what-we-do">
    <?php $customFields = get_post_custom($whatWeDoPage->ID); ?>
    <div id="intro">
        <div class="container">
        <?php if ($introTitle = $customFields['Intro title'][0]): ?>
        <h1><?php echo $introTitle; ?></h1>
        <?php endif; ?>
        <?php if ($introText = $customFields['Intro text'][0]): ?>
        <p><?php echo $introText; ?></p>
        <?php endif; ?>
        </div>
    </div>
    <div id="content">
        <?php
            $whatWeDoContent = $whatWeDoPage->post_content;
            $whatWeDoContent = apply_filters('the_content', $whatWeDoContent);
            echo $whatWeDoContent;
        ?>
        <nav>
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
            <?php while ($projectQuery->have_posts()) : $projectQuery->the_post(); ?>
                <?php
                $projectID = get_the_ID();
                $projectMeta = get_post_custom($projectID);
                $imgBgUrl = '';
                ?>
                <div class="project">
                    <?php
                    if ( has_post_thumbnail($projectID) ) {
                        $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
                        $imgBgUrl = $imgBgUrl[0];
                    } else if (isset($projectMeta['Image'])) {
                        $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
                    }
                    ?>
                    <a href="<?php echo esc_url(get_permalink($projectID)); ?>" class="thumbnail" style="background-image:url('<?php echo $imgBgUrl; ?>')"></a>
                    <h4><a href="<?php echo esc_url(get_permalink($projectID)); ?>"><?php echo the_title(); ?></a></h4>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>