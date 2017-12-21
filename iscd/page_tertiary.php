<?php
/**
 * Template Name: Tertiary page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>


<?php get_header();?>
<div id="secondaryPage">


	<?php if ( ! post_password_required( $post ) ) {?>

	<?php
		$args = array( 'post_type' => 'page', 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order'   => 'ASC' );
		$the_query = new WP_Query( $args );
		$url = get_permalink($post->ID);

		/*Si la page a des enfants, on cree le menu avec un retour*/
		if ( $the_query->have_posts() ) {
			if (get_depth($post->ID)==2){
				echo '<div id="secondaryMenu">';
				echo '<li><h3><span><i class="icon fa fa-level-up" style="font-size:0.8em;"></i></span><a href="'. get_permalink(wp_get_post_parent_id( $post->ID )).'"> ' . get_the_title(wp_get_post_parent_id( $post->ID )) . '</a></h3></li>';
				echo '<li><h3><a href="'.get_permalink($post->ID).'">' . $post->post_name . '</a></h3></li>';
				echo '<ul>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$slug = get_post_field( 'post_name', get_post() );
					echo '<li href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				}
				wp_reset_postdata();
				echo '</ul>';
				echo '</div>';
			}
		}
		/*Si la page n'a pas d'enfant et est de niveau 3, on met juste un retour vers le dessus*/
		else{
			if (get_depth($post->ID)==2){
				echo '<div id="secondaryMenu">';
                                echo '<li><h3><span><i class="icon fa fa-level-up" style="font-size:0.8em;"></i></span><a href="'. get_permalink(wp_get_post_parent_id( $post->ID )).'"> ' . get_the_title(wp_get_post_parent_id( $post->ID )) . '</a></h3></li>';
                                echo '</div>';
			}
			else{
				$args = array( 'post_type' => 'page', 'post_parent' => wp_get_post_parent_id( $post->ID ), 'orderby' => 'menu_order', 'order'   => 'ASC' );
				$the_query = new WP_Query( $args );
				echo '<div id="secondaryMenu">';
				if(get_depth($post->ID)==3){
					echo '<li><h3><span><i class="icon fa fa-level-up" style="font-size:0.8em;"></i></span><a href="'. get_permalink(wp_get_post_parent_id(wp_get_post_parent_id( $post->ID ))).'"> ' . get_the_title(wp_get_post_parent_id(wp_get_post_parent_id( $post->ID ))) . '</a></h3></li>';
				}
				echo '<li><h3><a href="'. get_permalink(wp_get_post_parent_id( $post->ID )).'">' . get_post(wp_get_post_parent_id( $post->ID ))->post_name . '</a></h3></li>';
				echo '<ul>';
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
					//echo '<li href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				}
				wp_reset_postdata();
				echo '</ul>';
				echo '</div>';
			}
		}

		?>

	<div id="secondaryContent" style="">
		<div style="" id="mainPart" style="">
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
