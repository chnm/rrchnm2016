<?php
/*
Template Name: Labs
*/
?>

<?php get_header(); ?>

<div id="intro">
    <div class="container">
    <h1><?php echo the_title(); ?></h1>
    </div>
</div>

<div id="content" class="container">
<?php
$page = $wp_query->post;
$parent_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE ID = '$page->post_parent;'");
if(!$parent_id) $parent_id = $post->ID;
?>

  <?php if(is_page(587) || $parent_id == 587 || in_array(587,$page->ancestors)): ?>
    <nav>
        <ul>
          <li>Findings
              <ul>
                  <?php $overviewPage = get_posts(array('name' => 'mobile-for-museums', 'post_type' => 'page' )); ?>
                  <?php $overviewStatus = ($post->ID == $overviewPage[0]->ID) ? 'class="current_page_item"' : ''; ?>
                  <li <?php echo $overviewStatus; ?>><a href="<?php echo get_permalink($overviewPage[0]); ?>">Overview</a></li>
                  <?php wp_list_pages('sort_column=menu_order&title_li=&child_of=587'); ?>
              </ul>
          </li>
        </ul>

        <h4>Annotated Bibliography</h4>
        <p>Join our <a title="Mobile Museums Zotero Group" href="//www.zotero.org/groups/mobile_museums/items" target="_blank">Zotero group</a> to view and add to the annotated bibliography.</p>
    </nav>
    <?php endif; ?>

    <div id="labs">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
        <?php $url = get_post_custom_values('URL'); ?>
        <?php $url = $url[0]; ?>
        <?php if($url != ''):?>
        <p><a href="//<?php echo $url; ?>"><?php echo $url; ?></a></p>
        <?php endif; ?>
        <?php endwhile; endif; ?>
    </div>

</div>
<?php get_footer(); ?>
