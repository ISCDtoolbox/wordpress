<?php
/**
 * Template Name: Secondary page, the real deal
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>


<?php get_header();?>

<?php if ( ! post_password_required( $post ) ) {?>

<div id="secondaryPage">
	<?php
		$args = array( 'post_type' => 'page', 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order'   => 'ASC' );
		$the_query = new WP_Query( $args );

		if (get_depth($post->ID)==1 && ( get_post_field('post_name',get_post())=="about" ) ) {
			echo '<div id="secondaryMenu">';
			echo '<li><h3><a href="'.get_permalink($post->ID).'">' . $post->post_name . '</a></h3></li>';
			echo '<ul>';
			$url = get_permalink($post->ID);
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$slug = get_post_field( 'post_name', get_post() );
				if(get_the_permalink() == $url){
					echo '<li class="current" href="'
					. $slug
					. '"><a href="'
					. get_the_permalink()
					.'">' . get_the_title() . '</a></li>';
				}
				else{
					echo '<li href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				}
			}
			wp_reset_postdata();
			echo '</ul>';
			echo '</div>';
		}

		elseif( get_depth($post->ID)==1 ){echo '';}

		else{
			$args = array( 	'post_type' => 'page',
					'post_parent' => wp_get_post_parent_id( $post->ID ),
					'orderby' => 'menu_order',
					'order'   => 'ASC' );
			$the_query = new WP_Query( $args );
			echo '<div id="secondaryMenu" class="pasabout">';
			echo '<li><h3><a href="'
				. get_permalink(wp_get_post_parent_id( $post->ID )).'">'
				. get_post(wp_get_post_parent_id( $post->ID ))->post_name
				. '</a></h3></li>';
			echo '<ul>';
			$url = get_permalink($post->ID);
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$slug = get_post_field( 'post_name', get_post() );
				if(get_the_permalink() == $url){
					echo '<li class="current" href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				}
				else{
					echo '<li href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				}
			}
			wp_reset_postdata();
			echo '</ul>';
			echo '</div>';
		}

		?>

	<div id="secondaryContent">
		<div id="mainPart">
			<?php
				echo '<h1 class="contentTitle">' . $post->post_title . '</h1>';
				echo apply_filters('the_content', get_post_field('post_content', $post->ID));
			?>
		</div>
	</div>


	<?php
	}
	else{
	?>
        <div id="secondaryContent">
                <div id="mainPart">
		<?php echo get_the_password_form();?>
                </div>
        </div>
	<?php
	}
	?>



</div>

<?php get_footer();?>
