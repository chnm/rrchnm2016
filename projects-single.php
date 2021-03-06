<div class="project">
    <?php
    $imgBgUrl = '';
    $projectID = $args['projectID'];
    $projectMeta = get_post_custom($projectID);
    if ( has_post_thumbnail($projectID) ) {
        $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
        $imgBgUrl = $imgBgUrl[0];
    } else if (isset($projectMeta['Image'])) {
        $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
    }
    ?>
    <a href="<?php echo esc_url(get_permalink($projectID)); ?>" class="thumbnail" style="background-image:url('<?php echo $imgBgUrl; ?>')"></a>
    <h4><a href="<?php echo esc_url(get_permalink($projectID)); ?>"><?php echo $featuredProject->post_title; ?></a></h4>
    <?php if (isset($projectMeta['Short Description'])): ?>
    <?php echo $projectMeta['Short Description'][0]; ?>
    <?php endif; ?>
</div>