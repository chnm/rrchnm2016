<?php $projects = $args['projects']; ?>
<?php if (count($projects) > 0): ?>
 <div class="section">
    <h3><?php echo $args['title']; ?></h3>
    <?php foreach ($projects as $project): ?>
      <?php $projectID = $project->ID; ?>
      <?php get_template_part('projects-single', null, array('projectID' => $projectID)); ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>