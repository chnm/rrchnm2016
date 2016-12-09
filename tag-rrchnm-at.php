<?php
$customFields = get_post_custom();
$eventCategory = get_term_by('slug', 'events', 'category');
$rrchnmAtTag = get_term_by('slug', 'rrchnm-at', 'post_tag');
$atRrchnmTag = get_term_by('slug', 'at-rrchnm', 'post_tag');
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Events: RRCHNM@</h1>

    <a href="<?php echo get_tag_link($rrchnmAtTag->term_id); ?>" class="at-rrchnm tag">@RRCHNM</a>
    <a href="<?php echo get_category_link($eventCategory->term_id); ?>" class="back-link">Back to all events</a>
</aside>

<?php include('event-posts.php'); ?>

</div>

<?php get_footer(); ?>