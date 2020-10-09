<div class="project">
    <?php
    $imgBgUrl = '';
    $projectID = $args['projectID'];
    $projectMeta = get_post_custom($projectID);
    $projectTitle = get_the_title($projectID);
    if ( has_post_thumbnail($projectID) ) {
        $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
        $imgBgUrl = $imgBgUrl[0];
    } else if (isset($projectMeta['Image'])) {
        $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
    }
    ?>
    <a href="<?php echo esc_url(get_permalink($projectID)); ?>">
        <span class="thumbnail" style="background-image:url('<?php echo $imgBgUrl; ?>')"><img src="<?php echo $imgBgUrl; ?>" alt="Logo for <?php echo $projectTitle; ?>" class="sr-only"></span>
        <h4><?php echo $projectTitle; ?></h4>
    </a>
    <?php if (isset($projectMeta['Short Description']) && ($args['isFeatured'] == true)): ?>
    <?php echo $projectMeta['Short Description'][0]; ?>
    <?php endif; ?>
</div>