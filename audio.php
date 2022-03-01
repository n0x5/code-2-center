<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	
<div id="main">

<div id="header">
<a href="/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/mclogo2.jpg" /></a>
<?php get_header(); ?>
</div>
<div id="sidebar"><?php get_sidebar(); ?></div>
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

<p><video controls> <source src='<?php echo wp_get_attachment_url(); ?>' type='video/mp4'>Your browser does not support the video/audio tag.</video></p>

<?php
$uploaded = esc_attr(get_the_time());
$date3 = get_the_date();
$url3 = esc_url(wp_get_attachment_url());
$post_url = esc_url(get_permalink($post->post_parent));
$post_title = get_the_title($post->post_parent);
?>
			<h2>Metadata:</h2>
			<?php
			$metadata = wp_get_attachment_metadata();
			$fsize = $metadata['filesize'];
			$length = $metadata['length_formatted'];
			$encoder = $metadata['encoder'];
			$encoder_options = $metadata['encoder_options'];
			$fformat = $metadata['fileformat'];
			$dformat = $metadata['dataformat'];
			$audio_codec = $metadata['codec'];
			$sample_rate = $metadata['sample_rate'];
			$channels = $metadata['channels'];
			$bitrate_mode = $metadata['bitrate_mode'];
			$lossless = $metadata['lossless'];
			$compression_ratio = $metadata['compression_ratio'];
			$channelmode = $metadata['channelmode'];
			$artist = $metadata['artist'];
			$album = $metadata['album'];
			?>
			Uploaded: <?php echo $date3; ?> <?php echo $uploaded; ?> <br>
			File Url: <?php echo $url3; ?> <br>
			Mime type: <?php echo get_post_mime_type(); ?> <br><br>
					
			Length: <?php echo $length; ?> <br>
			Format: <?php echo $fformat; ?> <br>
			Audio codec: <?php echo $audio_codec; ?> <br>
			Encoder: <?php echo $encoder; ?> <br>
			Encoder options: <?php echo $encoder_options; ?> <br>
			Compression ratio: <?php echo $compression_ratio; ?> <br>
			Channels: <?php echo $channels; ?> <br>
			Bitrate mode: <?php echo $bitrate_mode; ?> <br>
			Channel mode: <?php echo $channelmode; ?> <br>
			Artist: <?php echo $artist; ?> <br>
			Album: <?php echo $album; ?> <br>

<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>
