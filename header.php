<?php
global $post;
$slug = get_post($post)->post_name;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(' - ', true, 'right'); ?> Roy Rosenzweig Center for History and New Media</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic,300|Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo bloginfo('template_directory'); ?>/style.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="<?php echo bloginfo('template_directory'); ?>/js/globals.js"></script>
    <?php if ( is_page() && has_post_thumbnail() ): ?>
    <?php $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
    <style>
        <?php echo '.' . $slug; ?> #intro:before {
            background-image: url('<?php echo $imgBgUrl[0]; ?>');
        }
    </style>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class($slug); ?>>

    <header>
        <div class="logo"><a href="<?php echo site_url(); ?>">Roy Rosenzweig Center for History and New Media</a></div>

        <nav id="global">
            <a href="#" class="mobile-toggle"></a>
           <?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?>
        </nav>
    </header>