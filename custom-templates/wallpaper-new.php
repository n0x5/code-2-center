<?php
/*
Template Name: Wallpaper New
*/
?>


<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<div id="main">
<div id="header">
<a href="/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/mclogo2.jpg" /></a>
<?php get_header(); ?>
	
<?php 
$parents = get_post_ancestors( $post->ID );
foreach ($parents as $value) {
    $title = get_the_title($value);
    $page_link = get_page_link($value);
	$page_url = '<a href=' . $page_link .'>' . $title . '</a>';
	$item_output1 = $page_url .' -> '. $item_output1;
	} ?>
   
<?php
$title2 = get_the_title($post->ID);
$page_link2 = get_page_link($post->ID);
$page_url2 = '<a href=' . $page_link2 .'>' . $title2 . '</a>';
$url = get_permalink(get_option('page_for_posts' ));
$title3 = get_the_title($url);
$page_url3 = '<a href=' . $url .'>' . 'Home' . '</a>';
echo '<h2>' . $page_url3 .' -> '. $item_output1 . $page_url2 . '</h2>';
?>
    

</div>

<div id="sidebar"> 

<?php wp_nav_menu(array('menu' => 'Wallpaper')); ?>
</div>

<div id="content">


<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<div class="post">
<?php the_content('-> read more'); ?>

<?php endwhile; ?>

<?php endif; ?>
</div>
</div>
</div>
