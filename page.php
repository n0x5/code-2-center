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
if ( $post->post_parent ) {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->post_parent,
        'echo'     => 0
    ) );
   $page_link = get_page_link( $post->post_parent );
    $title = get_the_title( $post->post_parent );
} else {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->ID,
        'echo'     => 0
    ) );
    $page_link = get_page_link( $post->post_parent );
    $title = get_the_title( $post->ID );
}

if ( $post->post_parent ) : ?>
    <h2><?php // echo $title ; ?></h2>
    <h2><?php echo '<a href="/blog">Home</a> -> <a href=' . $page_link .'>' . $title . '</a>'; ?> -> <?php the_title(); ?></h2>
    <ul>
        <?php // echo $children; ?>
    </ul>

<?php else : ?>
<h2><a href="/blog">Home</a></h2>

<h2 style="text-align: center;"> -> <?php the_title() ; ?></h2>

<?php endif; ?>
<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
	
<div class="post">
<?php the_content('-> read more'); ?>

<?php endwhile; ?>

<?php endif; ?>
</div>
</div>
</div>