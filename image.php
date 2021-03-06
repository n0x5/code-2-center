<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="main">

<div id="header">
<a href="/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/mclogo2.jpg" /></a>
<?php get_header(); ?>
</div>
<div id="sidebar"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
<div id="content">
<?php
$title2 = get_the_title($post->ID);
$url = get_permalink(get_option('page_for_posts' ));
$page_url3 = '<a href=' . $url .'>' . 'Home' . '</a>';
echo '<h2>' . $page_url3 .' -> '. $title2 . '</h2>';
?>
<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
	
<div class="post">
<?php the_content('-> read more'); ?>

<?php  echo wp_get_attachment_image( $post->ID, array( $attachment_size, 720 ) ); ?>

<?php
$metadata = wp_get_attachment_metadata();
$width = $metadata['width'];
$height = $metadata['height'];
$caption = $metadata['image_meta']['caption'];
$camera = $metadata['image_meta']['camera'];
$copyright = $metadata['image_meta']['copyright'];
$aperture = $metadata['image_meta']['aperture'];
$timestamp = $metadata['image_meta']['created_timestamp'];
$credit = $metadata['image_meta']['credit'];
$title = $metadata['image_meta']['title'];
$focal_length = $metadata['image_meta']['focal_length'];
$iso = $metadata['image_meta']['iso'];
$shutter_speed = $metadata['image_meta']['shutter_speed'];
$orientation = $metadata['image_meta']['orientation'];
$keywords1 = $metadata['image_meta']['keywords'][0];
$keywords2 = $metadata['image_meta']['keywords'];
$mimetype = $metadata['sizes']['large']['mime-type'];
?>

<h2>Metadata:</h2>
<div class="metastuff">
Uploaded: <?php echo $date3; ?> <?php echo $uploaded; ?> <br>
File Url: <?php echo $url3; ?> <br>
Mime type: <?php echo get_post_mime_type(); ?> <br><br>

Dimensions: <?php echo $width; ?>x<?php echo $height; ?> <br>
Camera: <?php echo $camera; ?> <br>
Date taken: <?php echo gmdate("Y-m-d H:i:s", $timestamp); ?> <br>
Caption: <?php echo $caption; ?> <br>
Copyright: <?php echo $copyright; ?> <br>
Credit: <?php echo $credit; ?> <br>
Title: <?php echo $title; ?> <br>
Aperture: <?php echo $aperture; ?> <br>
Focal length: <?php echo $focal_length; ?> <br>
ISO: <?php echo $iso; ?> <br>
Shutter speed: <?php echo $shutter_speed; ?> <br>
Orientation: <?php echo $orientation; ?> <br>
Keywords: <br> <?php foreach ($keywords2 as $value){echo $value . '<br>';} ?>

<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>
