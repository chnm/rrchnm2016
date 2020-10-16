<?php 
  $jobTitle = $args['jobTitle'];
  $userID = $args['userID'];
  $userData = get_userdata($userID);
  $displayName = $userData->first_name . ' ' . $userData->last_name;
  $userUrl = get_author_posts_url($userID);
  if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($userID, 'picture')) {
      $avatar = get_cimyFieldValue($userID, 'picture');
  } else {
      $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png';
  }
?>

<div class="person">
    <a href="<?php echo get_author_posts_url($args['userID']); ?>">
        <span class="avatar" style="background-image:url('<?php echo $avatar; ?>')"><img src="<?php echo $avatar; ?>" alt="Profile picture for <?php echo $args['personName']; ?>" class="sr-only"></span>
        <span class="name"><?php echo $displayName; ?></span>
    </a>
    <?php if ($jobTitle !== null): ?>
    <span class="position"><?php echo $jobTitle; ?></span>
    <?php endif; ?>
</div>
