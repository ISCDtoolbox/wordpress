<?php
/**
 * Template Name: Default template (index.php)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header();?>

<?php the_excerpt(); ?>
	<?php
		$args = array( 'post_type' => 'page', 'post_parent' => $post->ID );
		$the_query = new WP_Query( $args );

		/*On cree le menu secondaire*/
		if ( $the_query->have_posts() ) {
			echo '<div id="secondaryMenu">';
			echo '<li href="mainPart"><h3><a>' . $post->post_name . '</a></h3></li>';
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$slug = get_post_field( 'post_name', get_post() );
				echo '<li href="' . $slug . '"><a>' . get_the_title() . '</a></li>';
			}
			wp_reset_postdata();
			echo '</ul>';
			echo '</div>';
		}

		?>

<div id="secondaryContent" style="">

		<?php
		/*On ajoute des div de contenu, display = none, qui seront affichés lors des clics dans le menu secondaire*/
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$the_content = get_the_content();

				$content     = wpautop( $the_content, true);
				$slug = get_post_field( 'post_name', get_post() );
				echo '<div style="display:none;" id="' . $slug . '"><h1>' . get_the_title() . '</h1>' . $content . '</div>';
			}
			wp_reset_postdata();
		}
		?>
		<div style="" id="mainPart" style="">
			<?php
				echo '<h1>' . $post->post_title . '</h1>';
				echo apply_filters('the_content', get_post_field('post_content', $post->ID));
			?>
		</div>

</div>

<?php get_footer();?>
