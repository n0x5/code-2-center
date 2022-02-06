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
<?php
if(has_tag()) {
$post_tags = get_the_tags();
?>

<div class="post" style="background-color: #740000;">


<?php
$imdbid = $post_tags[0]->name;
$dir = 'sqlite:/home/coax/websites/rnd/wp-content/movies-flm.db';
$dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
$query = "select moviesflm.*, actressflm.actress, flm_actress2.name, flm_actress2.actress_born from moviesflm left join actressflm on substr(moviesflm.title, -7, -100) = actressflm.title collate nocase left join flm_actress2 on flm_actress2.films like '%' || moviesflm.imdb || '%' where moviesflm.imdb like '%" . $imdbid . "%' group by moviesflm.imdb order by year desc";
foreach ($dbh->query($query) as $row) {
?> <h1 style="display:inline;">Movie review:</h1> <h2 style="display:inline;"> <a style="color:white;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> <?php
$img_file =  explode('/', $row[0]);
$im_final = $img_file[4] . '.jpg';
?>

	
<img style="display:inline;" src=/wp-content/covers/<?php echo $im_final; ?> width="200" />

<div class="infos"> <?php echo $row[3]; ?> </div>
	<br><h2>Gallery:</h2><br>
<?php
$img_dir = '/home/coax/websites/rnd/wp-content/flm_images/' . $img_file[4];
if (file_exists($img_dir)) {
    $files = glob("$img_dir/*");
    sort($files, SORT_NATURAL | SORT_FLAG_CASE);
    foreach ($files as $file) {
    $file_final = explode("/", $file); ?>
  <a href="/wp-content/flm_images/<?php echo $file_final[7]; ?>/<?php echo $file_final[8]; ?>"><img src="/wp-content/flm_images/<?php echo $file_final[7]; ?>/<?php echo $file_final[8]; ?>" width="90" /></a> 


	
<?php }} ?>
	

	<br><br><h2>The review:</h2>
	<?php the_content('-> read more'); ?>
	</div>
<br><br>
	
<?php                                    
}
$dbh = null;
} else { ?>
    <div class="title"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div class="subhead"><?php the_time('F jS, Y') ?></div></div>
    <div class="post">
    <?php the_content('-> read more'); ?>
    </div>
<?php
}
?>

<?php endwhile; ?>
<?php endif; ?>
<?php next_posts_link(__('&laquo; Previous Entries', 'code2center')) ?><br>
<?php previous_posts_link(__('Newer Entries &raquo;','code2center')); ?>
</div>
</div>
</body>