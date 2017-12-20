<?php

//Change the maximumfile upload size
@ini_set( 'upload_max_size' , '10MB' );
@ini_set( 'post_max_size', '10MB');
@ini_set( 'max_execution_time', '300' );

//Support pour les featured image
add_theme_support( 'post-thumbnails' );

//Autoriser l'upload aux contributeurs
function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
	$contributor->add_cap('publish_posts');
}
if ( current_user_can('contributor') && !current_user_can('upload_files') ){
	add_action('admin_init', 'allow_contributor_uploads');
}

//Support pour l'excerpt
function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

//Support pour le logo custom
function theme_prefix_setup() {
	add_theme_support( 'custom-logo');
}
add_action( 'after_setup_theme', 'theme_prefix_setup' );
add_image_size('the_custom_logo', 225, 60);
function theme_prefix_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

//Ajout des menus
function register_my_menus() {
	register_nav_menus(array('main-menu' => __( 'Main Menu' ), 'secondary-menu' => __( 'Secondary Menu' )));
}
add_action( 'init', 'register_my_menus' );

//Image de la page d'accueil
$args = array(
	'flex-width'    => true,
	'width'         => 980,
	'flex-height'    => true,
	'height'        => 200,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
);
add_theme_support( 'custom-header', $args );

//Shortcode pour les "trombis"
function trombi_func( $atts ) {
	$a = shortcode_atts( array(
		'name' => 'toto',
		'inst' => 'iscd',
		'field' => 'computer science',
		'img' => '/wp-content/uploads/2016/10/chimp.png',
		'bio' => ''
	), $atts );
	$popup = "";
	$link  = "";
	$endLink = "";
	if($a['bio'] != ''){
		$popup = "<div class='modal' id='" . str_replace(' ', '', $a['name']) . "'>"
		. "<img style='position:relative;left:calc(50% - 60px);width:120px' src='" . $a['img'] . "'/>"
		. '<h1 style="text-align:center;">' . $a['name'] . '</h1>'
		. $a['bio']
		. "</div>";
		$link = "<a style='text-decoration:none;' class='people modalButton' link='"
		. str_replace(' ', '', $a['name'])
		. "'>";
		$endLink = "</a>";
	}
	else{
		$link    = "<span class='people'>";
		$endLink = "</span>";
	}

	return $link
	. "<img src='" . $a['img'] . "'/>"
	. "<div class='people-content'>"
	. "<div class='peopleIcon'>" . $a['field'] . "</div>"
	. "<h2>" . $a['name'] . "</h2>"
	. "<h3>" . $a['inst'] . "</h3>"
	. "</div>"
	. $endLink
	. $popup;
}
add_shortcode( 'trombi', 'trombi_func' );

// Fonction pour le niveau hiérarchique de la page
function get_depth($postid) {
	$depth = ($postid==get_option('page_on_front')) ? -1 : 0;
	while ($postid > 0) {
		$postid = get_post_ancestors($postid);
		$postid = $postid[0];
		$depth++;
	}
	return $depth;
}

//Shortcode pour les "cartes"
function card_func( $atts ) {
	$a = shortcode_atts( array(
		'color' => '#666',
		'name' => 'item',
		'icon' => '',
		'img' => '/wp-content/uploads/2016/10/orang.png',
		'text' => 'some text',
		'href' => ''
	), $atts );

	$link = "";
	$endLink = "";
	if($a['href'] != ''){
		$link = "<a style='color:black; text-decoration:none;' href=" . $a["href"] . ">";
		$endLink = "</a>";
	}

	//. "<a target='_self' href=" . $a['img'] . "><img src='" . $a['img'] . "'></a>"

	return sticky($a["img"], $a["name"], $a["text"], $a["icon"], $a["href"], "link");

	//return "<div class='card " . $a["color"] . "'>"
	//. $link
	//. "<img src='" . $a['img'] . "'>"
	//. "<div class='cardContent'>"
	//. "<div class='cardIcon'>" . $a["icon"] . "</div>"
	//. "<div class='cardTitle'>"
	//. "<h2 style='color:".$a["color"]."'>" . $a["name"] . "</h2>"
	//. "</div>"
	//. "<p>" . $a['text']. "</p>"
	//. "</div>" . $endLink . "</div>";

}
add_shortcode( 'card', 'card_func' );

//Fonction pour vérifier si on est dans un arbre
function is_tree($pid) {
	//$pid = The ID of the ancestor page
	global $post; //load details about this page
	$anc = get_post_ancestors( $post->ID );
	foreach($anc as $ancestor) {
		if(is_page() && $ancestor == $pid) {
			return true;
		}
	}
	if ( is_page() && (is_page($pid)) ) {
		return true; // we’re at the page or at a sub page
	}
	else {
		return false; //we’re elsewhere
	}
}

//Surbrillance pour les résultats de recherche
function highlight_results($text){
	if(is_search()){
		$keys = implode('|', explode(' ', get_search_query()));
		$text = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $text);
	}
	return $text;
}
add_filter('the_content', 'highlight_results');
add_filter('the_excerpt', 'highlight_results');
add_filter('the_title', 'highlight_results');
function highlight_results_css() {
	echo("<style>.search-highlight { background-color:#FF0; font-weight:bold; }</style>");
}
add_action('wp_head','highlight_results_css');

//Rajout du jquery
wp_enqueue_script('jquery');

//Texte pour expliquer l'ajout des news
add_action( 'edit_form_after_title', 'myprefix_edit_form_after_title' );
function myprefix_edit_form_after_title() {
	echo '<h2 style="color:red; margin:0px">Important:</h2><p style="color:#a00;margin-top:0px">When creating a news concerning an upcoming event, please specify the location and time in the excerpt, in the format "Location - Time" <br>i.e. "room 206, 33-34, second floor - 14h"</p>';
}

// A virer - Envoi de mail pour les nouveaux posts
add_action( 'transition_post_status', 'pending_post_status', 10, 3 );
function pending_post_status( $new_status, $old_status, $post ) {
    if ( $new_status === "new" or $new_status === "pending") {
			  $to = "loic.norgeot@gmail.com";
				$subject = "Validation de post";
				$message = "un nouveau post a ete pondu, merci de le verifier!";
        wp_mail($to,$subject,$message);
				// Le message
				$message = "Line 1\r\nLine 2\r\nLine 3";
				$message = wordwrap($message, 70, "\r\n");
				mail('loic.norgeot@gmail.com', 'Mon Sujet', $message);
    }
}

//Fonction pour les news "sticky"
function sticky($src, $title, $text, $sub, $link, $type="modal"){
	$html = '';
	if($type=="modal"){$html = $html . '<div class="sticky modalButton" link="' . $link . '">';}
        else{$html = $html . '<a class="sticky" href="' . $link . '">';}
        $html = $html . '<img class="mainImage" src="' . $src . '"></img>'
        . '<span class="badge"><span style="color:#666" class="date">' . $sub . '</span></span>'
        . '<div class="text">' . $title . '</div>'
        . '<div style="color:#333;display:block;" class="excerpt">' . $text . '</div>';
        if($type=="modal"){$html = $html . '</div>';}
        else{$html = $html . '</a>';}
	return $html;
}
//Fonction pour les news de type "brèves"
function breve($month, $day, $sticky, $title, $text, $link){
	echo '<li class="breve modalButton" link="' . $link . '">';
        echo '<div class="date"><span>' . $month . '</span><br><span>' . $day . ' ' . $sticky . '</span></div>';
        echo '<div class="content">';
	echo '<h1 style="font-size:0.95em;">' . $title . '</h1>';
      	echo '<span style="color:#333"><p>' . $text . '</p></span>';
        echo '</div>';
	echo '</li>';
}
//Fonction pour les pop-up
function modal($title, $content, $loc, $link){
	echo '<div class="modal" id="' . $link . '">';
  echo '<h1>' . $title . '</h1>';
  echo '<p>' . $loc . '</p>';
	echo $content;
	echo '</div>';
}

//Filtres pour le contenu
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

?>
