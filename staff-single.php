<?php 
  $avatar = $args['avatar']; 
  $jobTitle = $args['jobTitle'];
?>

<div class="person">
    <a href="<?php echo get_author_posts_url($args['personID']); ?>">
        <span class="avatar" style="background-image:url('<?php echo $avatar; ?>')"><img src="<?php echo $avatar; ?>" alt="Profile picture for <?php echo $args['personName']; ?>" class="sr-only"></span>
        <span class="name"><?php echo $args['personName']; ?></span>
    </a>
    <?php if ($jobTitle !== null): ?>
    <span class="position"><?php echo $jobTitle; ?></span>
    <?php endif; ?>
</div>
