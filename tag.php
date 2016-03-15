<?php get_header(); ?>

<?php
$currentTagName = single_tag_title("", false);
$currentTagID = get_query_var('tag_id');

$whatWeDoPage = new WP_Query( 'pagename=what-we-do' );
$whatWeDoPageID = $whatWeDoPage->ID;

$projectsFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('projects'),
        ) ,
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => array($currentTagID),
        ),
    ),
);
$projects = get_posts($projectsFilters);
?>

<div class="what-we-do">
    <?php while ( $whatWeDoPage->have_posts() ) : $whatWeDoPage->the_post(); ?>
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
        <?php echo the_content(); ?>
        <?php echo $whatWeDoPageID; ?>
        <nav>
            <ul>
            <?php
            $projectNav = [];
            $customFields = get_post_custom($whatWeDoPageID);
            $customKeys = get_post_custom_keys($whatWeDoPageID);
            foreach ($customKeys as $customKey) {
                if (strpos($customKey, 'By ') !== false) {
                    $customFieldValue = $customFields[$customKey];
                    $tagsArray = [];
                    $tagsArray[$customKey] = explode(', ', $customFieldValue[key($customFieldValue)]);
                    for ($i = 0; $i < count($tagsArray[$customKey]); $i++) {
                        if ($tag = get_term_by('name', $tagsArray[$customKey][$i], 'post_tag')) {
                            $projectNav[$customKey][$i] = $tag;
                        }
                    }
                }
            }
            ?>
            <?php foreach($projectNav as $filter => $tags): ?>
                <li><?php echo $filter; ?>
                    <?php if (count($tags > 0)): ?>
                    <ul>
                        <?php foreach ($tags as $tag): ?>
                        <?php $tagID = $tag->term_id; ?>
                        <?php $active = ($tag->term_id == $currentTagID) ? 'class="active"' : ''; ?>
                        <li <?php echo $active; ?>><a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo $tag->name; ?> <?php echo ($active !== '') ? '(' . count($projects) . ')' : ''; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            </ul>
        </nav>
        <div class="projects">
            <?php foreach ($projects as $project): ?>
                <?php
                $projectID = $project->ID;
                $projectMeta = get_post_custom($projectID);
                $imgBgUrl = '';
                ?>
                <div class="project">
                    <?php
                    if ( has_post_thumbnail($projectID) ) {
                        $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
                        $imgBgUrl = $imgBgUrl[0];
                    } else if ($projectMeta['Image']) {
                        $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
                    }
                    ?>
                    <a href="<?php echo esc_url(get_permalink($projectID)); ?>"><div class="thumbnail"><?php echo ($imgBgUrl !== '') ? '<img src="' . $imgBgUrl . '">' : ''; ?></div></a>
                    <h4><a href="<?php echo esc_url(get_permalink($projectID)); ?>"><?php echo $project->post_title; ?></a></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>