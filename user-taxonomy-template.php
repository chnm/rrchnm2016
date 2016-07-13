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
    <?php echo the_content(); ?>
    <nav>
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
                            <li class="active"><a href="<?php echo site_url() . "/tag/$filter/$filterSlug"; ?>"><?php echo $filterName; ?> (<?php echo count($users); ?>)</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo site_url() . "/tag/$filter/$filterSlug"; ?>#staff"><?php echo $filterName; ?></a></li>
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
        <?php
        $userData = get_userdata($userId);
        $displayName = $userData->first_name . ' ' . $userData->last_name;
        $userUrl = get_author_posts_url($userId);
        ?>
        <div class="person">
            <a href="<?php echo $userUrl; ?>" class="avatar">
                <?php if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($userId, 'picture')): ?>
                    <?php $avatar = get_cimyFieldValue($userId, 'picture'); ?>
                <?php else: ?>
                    <?php $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png'; ?>
                <?php endif; ?>
                <img src="<?php echo $avatar; ?>" title="avatar for <?php echo $displayName; ?>">
            </a>
            <span class="name"><a href="<?php echo $userUrl; ?>"><?php echo $displayName; ?></a></span>
        </div>
    <?php endforeach; ?>
    </div>

</div>
</div>

<?php get_footer(); ?>