<?php /* Template Name: Who We Are */ ?>

<?php $customFields = get_post_custom(); ?>

<?php define( 'WP_USE_THEMES', false ); get_header(); ?>

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

    <div class="staff">
    <?php $users = get_users(); ?>
    <?php foreach ($users as $user): ?>
        <?php
        $userId = $user->id;
        $userData = get_userdata($userId);
        $displayName = $userData->display_name;
        ?>
        <div class="person">
            <?php echo get_avatar($userId); ?>
            <span class="name"><a href="<?php echo get_author_posts_url($userId); ?>"><?php echo $displayName; ?></a></span>
        </div>
    <?php endforeach; ?>
    </div>

    </div>
</div>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>