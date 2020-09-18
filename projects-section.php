<?php $projects = $args['projects']; ?>
<?php if (count($projects) > 0): ?>
 <div class="section">
    <h3><?php echo $args['title']; ?></h3>
    <?php foreach ($projects as $project): ?>
      <?php $projectID = $project->ID; ?>
      <?php $isFeatured = ($args['title'] == 'Featured') ? true : false; ?>
      <?php get_template_part('projects-single', null, array('projectID' => $projectID, 'isFeatured' => $isFeatured)); ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>