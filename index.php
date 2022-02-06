<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="main">

<div id="header">
<a href="/blog"><img src="<?php echo get_template_directory_uri(); ?>/images/mclogo2.jpg" /></a>
<?php get_header(); ?>
</div>
<div id="sidebar"><?php get_sidebar(); ?></div>
<div id="content">

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<div class="title"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div class="subhead"><?php the_time('F jS, Y') ?></div></div>
<div class="post">
<?php the_content('-> read more'); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php next_posts_link(__('&laquo; Previous Entries', 'code2center')) ?><br>
<?php previous_posts_link(__('Newer Entries &raquo;','code2center')); ?>
</div>
</div>
</body>