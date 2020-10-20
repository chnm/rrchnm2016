<?php 
$whoWeArePage = get_page_by_path('who-we-are');
$whoWeArePageID = $whoWeArePage->ID;
$customFields = get_post_custom($whoWeArePageID);
if (has_post_thumbnail($whoWeArePageID)) {
    $GLOBALS['rrchnm'] = array();
    $GLOBALS['rrchnm']['headerImgBgUrl'] = wp_get_attachment_image_src( get_post_thumbnail_id($whoWeArePageID), 'large' );
}
  
define( 'WP_USE_THEMES', false ); get_header(); 
?>

<?php $whoWeArePage = new WP_Query( 'pagename=who-we-are' ); ?>

<div class="who-we-are">
<?php while ( $whoWeArePage->have_posts() ) : $whoWeArePage->the_post(); ?>

<div id="intro">
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    <?php if ($introText = $customFields['Intro text'][0]): ?>
    <p><?php echo $introText; ?></p>
    <?php endif; ?>
    </div>
</div>

<div id="content">
    <?php echo the_content(); ?>
    <nav class="side">
        <h2>Meet Us</h2>
        <ul>
        <?php
            endwhile;
            wp_reset_query();
            $taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $term_id = get_queried_object_id();
            $term = get_queried_object();
            $users = get_objects_in_term( $term_id, $term->taxonomy );
            $users = apply_filters( 'ut_template_users', $users );
            $termName = $term->name;
            $filters = ['division', 'role', 'position'];
        ?>
        <?php foreach ($filters as $filter): ?>
            <?php $filterTerms = get_terms($filter); ?>
            <?php if (count($filterTerms) > 0): ?>
                <li>By <?php echo $filter; ?>
                    <ul>
                        <?php foreach ($filterTerms as $filterTerm): ?>
                        <?php
                            $filterSlug = $filterTerm->slug;
                            $filterName = $filterTerm->name;
                        ?>
                        <?php $filterUsers = get_objects_in_term( $filterTerm->term_id, $filterTerm->taxonomy ); ?>
                        <?php if (count($filterUsers) > 0): ?>
                            <?php if (($termName == $filterName) && ($filter == $term->taxonomy)): ?>
                            <li class="active"><a href="<?php echo home_url() . "/tag/$filter/$filterSlug"; ?>"><?php echo $filterName; ?> (<?php echo count($users); ?>)</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo home_url() . "/tag/$filter/$filterSlug"; ?>#staff"><?php echo $filterName; ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>
    <div id="staff">
    <?php foreach ($users as $userId): ?>
        <?php echo rrchnm_staff_member($userId); ?>
    <?php endforeach; ?>
    </div>

</div>
</div>

<?php get_footer(); ?>
