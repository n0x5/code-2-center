<?php
/*
Template Name: Gallery Single Page
*/
?>

<body>
<link rel='stylesheet' id='nox-styles-css'  href='/wp-content/plugins/nox-custom-posts/nox-style.css?ver=5.7' type='text/css' media='all' />

<link rel='stylesheet' id='custom-script-4-css'  href='/wp-content/plugins/nox-custom-posts/jquery.fancybox.min.css?ver=5.7' type='text/css' media='all' />
<style type="text/css">
.mainbody {
width: 800px;
margin-left: auto;
margin-right: auto;
}

body {
background-color: black;
color: #dbdbdb;
}

.post-entry {
}

.categoryl {
height: 1045px;
width: 430px;
float: left;
}

.category2 {
height: 100px;
width: 430px;
display: block;
}

a.titlecat2 {
font-size: 13px;
color: #e91e63;
}

a.titlecat3 {
font-size: 13px;
color: white;
}

a {
text-decoration: none;
color: white;
}

a:visited {
color: #c1c1c1;
}

.grid-item {
}

a.titlecat {
font-size: 30px;
color: #e91e63;
}

.headtitle {
text-align: center;
font-size: 80px;
}

.descr {
text-align: center;
font-size: 20px;
}

.lists {
/*padding-left: 350;*/
}

p.recent {
font-size: 12px;
}

.banner{
margin-bottom: 20px;
}

.content {
width: 900px;
margin-left: auto;
margin-right: auto;
}

.entry {
width: 900px;
}

</style>

<title><?php echo esc_html( get_the_title() ); ?></title>
	
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

if ( $children ) : ?>
    <h2><?php // echo $title ; ?></h2>
    <h2><?php echo '<center><a href="/">Home</a> -> <a href=' . $page_link .'>' . $title . '</a>'; ?> -> <?php the_title(); ?></center></h2>
    <ul>
        <?php // echo $children; ?>
    </ul>

<?php else : ?>
<h2><a href="/">Home</a></h2>

<h2 style="text-align: center;"><?php the_title() ; ?></h2>

<?php endif; ?>
	
<?php // get_header(); ?>
<div id="main">



	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="content">


		<div class="entry">
			<div class="navigation">
            	<br clear="all" />
			</div>
                 <?php wp_link_pages('before=Sections:&next_or_number=number&pagelink=Page %'); ?>       
			<?php the_content('more))'); ?>
			<br clear="left" />
		</div>
	</div>
	</div>
	
	<?php endwhile; ?>
	<?php endif; ?>
</div>
<script type='text/javascript' src='/wp-content/plugins/nox-custom-posts/jquery.min.js?ver=5.7' id='custom-script-2-js'></script>
<script type='text/javascript' src='/wp-content/plugins/nox-custom-posts/jquery.fancybox.min.js?ver=5.7' id='custom-script-3-js'></script>
<script type='text/javascript' src='/wp-content/plugins/nox-custom-posts/box.js?ver=5.7' id='custom-script-1-js'></script>	
		<div class="time2"><?php the_time('F jS, Y') ?></div>
<?php // get_footer(); ?>
