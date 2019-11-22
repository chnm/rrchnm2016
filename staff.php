<?php /* Template Name: Who We Are */ ?>

<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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

    <nav>
        <h2>Meet Us</h2>
        <ul>
        <?php $filters = ['role', 'position']; ?>
        <?php foreach ($filters as $filter): ?>
            <?php $filterTerms = get_terms($filter); ?>
            <?php if (count($filterTerms) > 0): ?>
                <li>By <?php echo $filter; ?>
                    <ul>
                        <?php foreach ($filterTerms as $filterTerm): ?>
                        <?php $filterSlug = $filterTerm->slug; ?>
                        <?php $filterUsers = get_objects_in_term( $filterTerm->term_id, $filterTerm->taxonomy ); ?>
                        <?php if (count($filterUsers) > 0): ?>
                            <li><a href="<?php echo home_url() . "/tag/$filter/$filterSlug"; ?>#staff"><?php echo $filterTerm->name; ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>

    <div id="staff">
    <?php $affiliatedTerm = get_term_by('slug', 'affiliate', 'position'); ?>
    <?php $affiliateIDs = get_objects_in_term( $affiliatedTerm->term_id, 'position' ); ?>
    <?php $alumniTerm = get_term_by('slug', 'alumni', 'position'); ?>
    <?php $alumniIDs = get_objects_in_term( $alumniTerm->term_id, 'position' ); ?>
    <?php $inactiveIDs = array_merge($affiliateIDs, $alumniIDs); ?>
    <?php $chnmadmin = get_user_by('login', 'chnmadmin'); ?>
    <?php $chnmeditor = get_user_by('login', 'rrchnm-editor'); ?>
    <?php array_push($inactiveIDs, $chnmadmin->ID); ?>
    <?php array_push($inactiveIDs, $chnmeditor->ID); ?>
    <?php $users = get_users(array('exclude' => $inactiveIDs)); ?>

    <?php foreach ($users as $user): ?>
        <?php echo rrchnm_staff_member($user->ID); ?>
    <?php endforeach; ?>

    <h3>Affiliates</h3>
    <?php $affiliates = get_users(array('include' => $affiliateIDs)); ?>
    <?php foreach ($affiliates as $affiliate): ?>
        <?php echo rrchnm_staff_member($affiliate->ID); ?>
    <?php endforeach; ?>

    <h3>Alumni</h3>
    <?php $alumni = get_users(array('include' => $alumniIDs)); ?>
    <?php foreach ($alumni as $alumnus): ?>
        <?php echo rrchnm_staff_member($alumnus->ID); ?>
    <?php endforeach; ?>
    </div>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
