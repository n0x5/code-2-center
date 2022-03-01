<?php
/*
Plugin Name: Nox Custom Posts 2
Version: 0.7
Plugin URI:
Description: Plugin to add custom post types
Author: Nox
Author URI:
*/

add_filter( 'xmlrpc_enabled', '__return_false' );

function wpdocs_scripts_method() {
    wp_enqueue_script( 'custom-script-2', plugin_dir_url( __FILE__ ) . 'jquery.min.js', array(), false, true );
    wp_enqueue_script( 'custom-script-3', plugin_dir_url( __FILE__ ) . 'jquery.fancybox.min.js', array(), false, true );
    wp_enqueue_script( 'custom-script-1', plugin_dir_url( __FILE__ ) . 'box.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );


function exclude_category( $query ) { if ( $query->is_home() && $query->is_main_query() ) { $query->set( 'cat', '-261' );
add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );}
}

add_action( 'pre_get_posts', 'exclude_category' );

function organic_origin_gutenberg_styles() {
	wp_register_style( 'custom-script-6',  plugin_dir_url( __FILE__ ) . 'nblock-styles.css' );
	wp_enqueue_style( 'custom-script-6'   );
}
add_action( 'enqueue_block_editor_assets', 'organic_origin_gutenberg_styles' );

function nox_custom_scripts() {
    wp_register_style( 'custom-script-4',  plugin_dir_url( __FILE__ ) . 'jquery.fancybox.min.css' );
    wp_enqueue_style( 'custom-script-4'   );
	wp_register_style( 'custom-script-5',  plugin_dir_url( __FILE__ ) . 'nox-style.css' );
    wp_enqueue_style( 'custom-script-5'   );
	wp_register_style( 'custom-script-6',  plugin_dir_url( __FILE__ ) . 'nblock-styles.css' );
  	wp_enqueue_style( 'custom-script-6'   );
}
add_action( 'wp_enqueue_scripts', 'nox_custom_scripts' );

function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
   }
add_action('admin_menu', 'all_settings_link');

add_filter( 'big_image_size_threshold', '__return_false' );


function modify_attachment_link( $markup, $id, $size, $permalink, $icon, $text )

{
        $_post = get_post( $id );

        if ( empty( $_post ) || ( 'attachment' !== $_post->post_type ) || ! wp_get_attachment_url( $_post->ID ) ) {
                return __( 'Missing Attachment' );
        }

        $url = wp_get_attachment_url( $_post->ID );

        if ( $permalink ) {
                $url = get_attachment_link( $_post->ID );
        }

        if ( $text ) {
                $link_text = $text;
        } elseif ( $size && 'none' !== $size ) {
                $link_text = wp_get_attachment_image( $_post->ID, $size, $icon, $attr );
        } else {
                $link_text = '';
        }

        if ( '' === trim( $link_text ) ) {
                $link_text = $_post->post_title;
        }

        if ( '' === trim( $link_text ) ) {
                $link_text = esc_html( pathinfo( get_attached_file( $_post->ID ), PATHINFO_FILENAME ) );
        }
        if ( is_attachment() ) {
        return "<a href='" . esc_url( $url ) . "'>$link_text</a>";
        }
    else {
     return "<a data-fancybox='gallery' href='" . esc_url( $url ) . "'>$link_text</a>";
    }
}

add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 6, );

add_filter( 'use_default_gallery_style', '__return_false' );
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'custom_gallery');

function custom_gallery($attr) {

    $post = get_post();
    static $instance = 0;
    $instance++;
    $attr['columns'] = 1;
    $attr['size'] = 'full';
    $attr['link'] = 'none';
    $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;
    # We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
    }
    extract(shortcode_atts(array(
        'order'      => 'DESC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'p',
        'columns'    => 1,
        'size'       => 'medium',
        'include'    => '',
        'exclude'    => ''
    ), $attr));
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';
    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';
    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "<!-- see gallery_shortcode() in functions.php -->";
    $gallery_div = "<div class='gallery gallery-columns-1 gallery-size-full'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
    foreach ( $attachments as $id => $attachment ) {
                 $lr3nfo = wp_get_attachment_metadata($id);
                 $cam = $lr3nfo[image_meta][camera];
                 $lr2nfo = "$lr3nfo[width] x $lr3nfo[height]";
                 $lr5nfo = $lr3nfo[file];
                 $lr6nfo = substr($lr5nfo, strpos($lr5nfo, "/") + 1);
                 $lr4nfo = substr($lr6nfo, strpos($lr6nfo, "/") + 1);
                 $trunc_nfo = $string = substr($lr4nfo,0,45);
				 $date5 = get_the_date('M d, Y', $attachment);

        $link = wp_get_attachment_link($id, 'medium', false, false);

        $output .= "
                         <div class='imgc'>
                $link <div class=\"dimensions\">$lr2nfo
				<div class=\"dlc\"> <div title=\"$lr4nfo\" class=\"filename1\">$trunc_nfo</div></div>
                     
					  <div class=\"uploaded\">Uploaded: $date5</div>
            </div></div>";
        $output .= "";
    }
    $output .= "</div>\n";
    return $output;
}

/*
function wp78649_extend_search( $query ) {
    $search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_NUMBER_INT) ?: 0;
    if (
        $query->is_search
        && !is_admin()
        && $query->is_main_query()
        // && your extra condition
    ) {
        $query->set('meta_query', [
            [
                'key' => 'meta_key',
                'value' => $search_term,
                'compare' => '='
            ]
        ]);

        add_filter( 'get_meta_sql', function( $sql )
        {
            global $wpdb;

            static $nr = 0;
            if( 0 != $nr++ ) return $sql;

            $sql['where'] = mb_eregi_replace( '^ AND', ' OR', $sql['where']);

            return $sql;
        });
    }
    return $query;
}

add_action( 'pre_get_posts', 'wp78649_extend_search');

*/

add_filter('wp_generate_attachment_metadata', 'add_metac', 10, 2);


function add_metac($meta, $id){

    update_post_meta($id, 'height', (int) $meta['height']);
    update_post_meta($id, 'width', (int) $meta['width']);
    update_post_meta($id, 'camera', (string) $meta['image_meta']['camera']);
    update_post_meta($id, 'date_taken', (string) $meta['image_meta']['created_timestamp']);
    update_post_meta($id, 'credit', (string) $meta['image_meta']['credit']);
	update_post_meta($id, 'copyright', (string) $meta['image_meta']['copyright']);
    update_post_meta($id, 'file', (string) $meta['file']);
    return $meta;

}

add_action( 'admin_menu', 'wpse_91693_register' );

function wpse_91693_register()
{
    add_menu_page(
        'Edit top level pages',     // page title
        'Top level pages',     // menu title
        'manage_options',   // capability
        'include-text',     // menu slug
        'wpse_91693_render' // callback function
    );
}

function wpse_91693_render()
{
    global $title;

    
    print "<h1>$title</h1>";

    $file = plugin_dir_path( __FILE__ ) . "included.html";

    if ( file_exists( $file ) )
        require $file;

    print "";

 
}

/* Block styles */
register_block_style(
    'core/image',
    array(
        'name'         => 'nrotate',
        'label'        => __( 'nRotate', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nghostly',
        'label'        => __( 'nGhostly', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/heading',
    array(
        'name'         => 'nsmoke',
        'label'        => __( 'nSmoke', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'npath1',
        'label'        => __( 'nPath1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nshattered',
        'label'        => __( 'nShattered', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe1',
        'label'        => __( 'nFrame 1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe2',
        'label'        => __( 'nFrame 2', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe3',
        'label'        => __( 'nFrame 3', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe4',
        'label'        => __( 'nFrame 4', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/paragraph',
    array(
        'name'         => 'ConBG1',
        'label'        => __( 'Background 1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

function add_img_s1ze( $block_content = '', $block = [] ) {
  if ( isset( $block['blockName'] ) && 'core/image' === $block['blockName'] ) {
    $args2 = wp_parse_args( $block);
    $innr = $args2['attrs']['id'];
    $metadata = wp_get_attachment_metadata($innr);
    $width = $metadata['width'];
    $height = $metadata['height'];
	$lr5nfo = esc_url(wp_get_attachment_url($innr));
	$uploaded = get_the_time('', $innr);
	$date5 = get_the_date('M d, Y', $innr);
	$url3 = explode("/", $lr5nfo);
	$url4 = end($url3);
    $html = str_replace(
      '</figure>',
     '<div class="dimensions">' . $url4 . '<br>---<br>' . $width . 'x' . $height . '</div></figure>'  ,
      $block_content
    );

    return $html;
}
  return $block_content;
}

add_filter( 'render_block', 'add_img_s1ze', 10, 2 );


function post_static_save( $post_id, $post ) {
    $title = $post->post_title;
    $title2 = preg_replace('/\//', '_', $title);
    $date3 = $post->post_date;
    $date2 = date('Y_m_d_G_H_i_', strtotime($date3));
    $titlebig = '<h1>' . $post->post_title . '</h1>';
    $pcontent = apply_filters('the_content', $post->post_content);
    $permalink = get_permalink( $post_id );
    if($post->post_type === 'post') {
        $myfile = fopen("/home/coax/websites/rnd/wp-content/static/posts/" . $date2 . '_' . $title2 . ".html", "w") or die("Unable to open file!");
    }
    if($post->post_type === 'page') {
        $myfile = fopen("/home/coax/websites/rnd/wp-content/static/pages/" . $date2 . '_' . $title2 . ".html", "w") or die("Unable to open file!");
    }
    fwrite($myfile, $titlebig);
    fwrite($myfile, $date2);
    fwrite($myfile, $pcontent);
    fclose($myfile);
}
add_action( 'publish_post', 'post_static_save', 10, 2 );
add_action( 'publish_page', 'post_static_save', 10, 2 );

add_filter( 'wp_lazy_loading_enabled', '__return_false' );

function akv3_query_format_standard($query) {
	if (isset($query->query_vars['post_format']) &&
		$query->query_vars['post_format'] == 'post-format-standard') {
		if (($post_formats = get_theme_support('post-formats')) &&
			is_array($post_formats[0]) && count($post_formats[0])) {
			$terms = array();
			foreach ($post_formats[0] as $format) {
				$terms[] = 'post-format-'.$format;
			}
			$query->is_tax = null;
			unset($query->query_vars['post_format']);
			unset($query->query_vars['taxonomy']);
			unset($query->query_vars['term']);
			unset($query->query['post_format']);
			$query->set('tax_query', array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'terms' => $terms,
					'field' => 'slug',
					'operator' => 'NOT IN'
				)
			));
		}
	}
}
add_action('pre_get_posts', 'akv3_query_format_standard');

function zip_upload_mimes($existing_mimes = array()) {
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    return $existing_mimes;
}
add_filter('upload_mimes', 'zip_upload_mimes', 999, 1);

add_theme_support( 'post-thumbnails' );

/**
 * Auto add subpages to nav menus
 */
function custom_walker_nav_menu_start_el ( $item_output, $item, $depth, $args) {
 
    // filter only page menu items
    if( $item->object == 'page' ) {
     
        // set args
        $args = array( 
            'depth' => 1,
            'child_of' => $item->object_id,
            'echo' => 0, 
            'title_li' => ''
            );
         
        // check for children
        $children = wp_list_pages( $args );
 
        // append them as list if any
        if ( $children )
            $item_output = $item_output . '<ul class="children" >' . $children . '</ul>';
     
    }
     
    return $item_output;
     
}
 
add_filter( 'walker_nav_menu_start_el', 'custom_walker_nav_menu_start_el', 10, 4 );