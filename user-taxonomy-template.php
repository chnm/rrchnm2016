<?php define( 'WP_USE_THEMES', false ); get_header(); ?>

<?php $whoWeArePage = new WP_Query( 'pagename=who-we-are' ); ?>

<div class="who-we-are">
<?php while ( $whoWeArePage->have_posts() ) : $whoWeArePage->the_post(); ?>
<?php $customFields = get_post_custom($whoWeArePage->ID); ?>

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
    <div class="container">
        <?php echo the_content(); ?>
    <nav>
        <h2>Meet Us</h2>
        <ul>
        <?php $filters = ['division', 'role', 'position']; ?>
        <?php foreach ($filters as $filter): ?>
            <?php $filterTerms = get_terms($filter); ?>
            <?php if (count($filterTerms) > 0): ?>
                <li>By <?php echo $filter; ?>
                    <ul>
                        <?php foreach ($filterTerms as $filterTerm): ?>
                        <?php $filterSlug = $filterTerm->slug; ?>
                        <li><a href="<?php echo site_url() . "/tag/$filter/$filterSlug"; ?>"><?php echo $filterTerm->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>

<?php
    endwhile;
    wp_reset_query();
    $taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $term_id = get_queried_object_id();
    $term = get_queried_object();
    $users = get_objects_in_term( $term_id, $term->taxonomy );
    $users = apply_filters( 'ut_template_users', $users );
?>

    <div class="staff">
    <?php foreach ($users as $userId): ?>
        <?php
        $userData = get_userdata($userId);
        $displayName = $userData->display_name;
        ?>
        <div class="person">
            <?php echo get_avatar($userId); ?>
            <span class="name"><?php echo $displayName; ?></span>
        </div>
    <?php endforeach; ?>
    </div>

    </div>
</div>
</div>

<?php get_footer(); ?>