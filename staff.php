<?php /* Template Name: Who We Are */ ?>

<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
        <?php $filters = ['division', 'role', 'position']; ?>
        <?php foreach ($filters as $filter): ?>
            <?php $filterTerms = get_terms($filter); ?>
            <?php if (count($filterTerms) > 0): ?>
                <li>By <?php echo $filter; ?>
                    <ul>
                        <?php foreach ($filterTerms as $filterTerm): ?>
                        <?php $filterSlug = $filterTerm->slug; ?>
                        <li><a href="<?php echo site_url() . "/tag/$filter/$filterSlug"; ?>#staff"><?php echo $filterTerm->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>

    <div id="staff">
    <?php $users = rrchnm_get_users_by_cimy_field_value('ACTIVE', 'YES'); ?>
    <?php foreach ($users as $user): ?>
        <?php echo rrchnm_staff_member($user->ID); ?>
    <?php endforeach; ?>
    <h3>Affiliates</h3>
    <?php $affiliatedTerm = get_term_by('slug', 'affiliate', 'position'); ?>
    <?php $users = get_objects_in_term( $affiliatedTerm->term_id, 'position' ); ?>
    <?php $users = get_users(array('include' => $users)); ?>
    <?php foreach ($users as $user): ?>
        <?php echo rrchnm_staff_member($user->ID); ?>
    <?php endforeach; ?>
    <h3>Alumni</h3>
    <?php $alumni = rrchnm_get_users_by_cimy_field_value('ACTIVE', 'NO'); ?>
    <?php foreach ($alumni as $user): ?>
        <?php echo rrchnm_staff_member($user->ID); ?>
    <?php endforeach; ?>
    </div>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>