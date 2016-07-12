<?php
$customFields = get_post_custom();
$essayNav = [];
$essayCategory = get_term_by('name', 'Essay Types', 'category');
$essayFilters = get_terms('category', array('parent' => $essayCategory->term_id));
?>

<?php get_header(); ?>

<div id="intro">
    <div class="container">
    <h1>Essays on History and New Media</h1>
    </div>
</div>

<div id="content" class="container">

<nav id="essay-nav">
    <h2>Browse Topics</h2>
    <ul>
        <?php foreach ($essayFilters as $essayFilter): ?>
            <li><a href="#<?php echo $essayFilter->slug; ?>"><?php echo $essayFilter->name; ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>

<div class="essays">
<?php foreach ($essayFilters as $essayFilter): ?>
    <h3 id="<?php echo $essayFilter->slug; ?>"><?php echo $essayFilter->name; ?></h3>
    <?php
    $essays = get_posts(array(
        'post_type' => 'essay',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $essayFilter->slug,
            ),
        ),
    )); ?>
    <ul>
    <?php foreach ($essays as $essay): ?>
        <?php $essayID = $essay->ID; ?>
        <?php $essayCustomFields = get_post_custom($essayID); ?>
        <li>
            <a href="<?php echo get_the_permalink($essayID); ?>"><?php echo get_the_title($essayID); ?></a><br>
            <?php echo $essayCustomFields['Essay Author(s)'][0]; ?>, <?php echo $essayCustomFields['Essay Date'][0]; ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endforeach; ?>
</div>

</div>

<?php get_footer(); ?>