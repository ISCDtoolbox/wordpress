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

<!-- On protège les pages avec mot de passe -->
<?php if ( ! post_password_required( $post ) ) {?>

<div id="secondaryPage">

	<!-- Menu de gauche -->
	<?php
		$isFaq = ( get_post_field('post_name',get_post())=="faq" ? 1 : 0 );
		$depth = get_depth($post->ID);

		//Si la page n'est pas FAQ, on affiche le menu à gauche
		if( $isFaq==0 ){

			$argsLvl1   = array( 'post_type' => 'page', 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order'   => 'ASC' );
			$argsLvlSup = array( 	'post_type' => 'page', 'post_parent' => wp_get_post_parent_id( $post->ID ), 'orderby' => 'menu_order', 'order'   => 'ASC' );

			$args = ( $depth>1 ? $argsLvlSup : $argsLvl1 );
			$the_query = new WP_Query( $args );

			$url = get_permalink($post->ID);
			echo '<div id="secondaryMenu">';

			//Tri en fonction du niveau (pages cousines ou enfantes)
			if($depth == 1)
				echo '<li><h3><a href="'.$url.'">' . $post->post_name . '</a></h3></li>';
			else
				echo '<li><h3><a href="'. get_permalink(wp_get_post_parent_id( $post->ID )).'">'. get_post(wp_get_post_parent_id( $post->ID ))->post_name. '</a></h3></li>';

			//Puis les pages enfants (donc de même niveau que la page actuelle)
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$slug = get_post_field( 'post_name', get_post() );
				if(get_the_permalink() == $url)
					echo '<li class="current" href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
				else
					echo '<li href="' . $slug . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
			}
			wp_reset_postdata();
			echo '</ul>';
			echo '</div>';
		}

		/*
		//Si la page est de premier niveau, et n'est pas FAQ, on affiche le menu
		if ( $depth==1 && $isFaq!=0 ) {

			$args = array( 'post_type' => 'page', 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order'   => 'ASC' );
			$the_query = new WP_Query( $args );

			$url = get_permalink($post->ID);
			echo '<div id="secondaryMenu">';

			//On affiche d'abord le titre de la page active
			echo '<li><h3><a href="'.$url.'">' . $post->post_name . '</a></h3></li>';

			//Puis les pages enfant
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$slug = get_post_field( 'post_name', get_post() );
				//Si c'est cette page, alors on la marque comme "current"
				if(get_the_permalink() == $url){
					echo '<li class="current" href="'.$slug. '>"'
					.'<a href="'. get_the_permalink().'">'
					.get_the_title()
					.'</a></li>';
				}
				//Sinon, on ne la marque pas
				else{
					echo '<li href="' . $slug . '">'
					.'<a href="'.get_the_permalink().'">' . get_the_title() . '</a>'
					.'</li>';
				}
			}
			//On finit
			wp_reset_postdata();
			echo '</ul>';
			echo '</div>';
		}
		//Si la page est FAQ, on n'affiche rien
		elseif( get_depth($post->ID)==1 ){echo '';}
		//Si la page est de niveau supérieur, on va chercher la query de ses enfants, et on rajoute un retour
		else{

			$args = array( 	'post_type' => 'page', 'post_parent' => wp_get_post_parent_id( $post->ID ), 'orderby' => 'menu_order', 'order'   => 'ASC' );
			$the_query = new WP_Query( $args );

			$url = get_permalink($post->ID);
			echo '<div id="secondaryMenu">';

			//On affiche le titre de la page parente
			echo '<li><h3><a href="'
				. get_permalink(wp_get_post_parent_id( $post->ID )).'">'
				. get_post(wp_get_post_parent_id( $post->ID ))->post_name
				. '</a></h3></li>';

			//Puis les pages enfants (donc de même niveau que la page actuelle)
			echo '<ul>';
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
		*/
	?>

	<!-- Contenu -->
	<div id="secondaryContent">
		<div id="mainPart">
			<?php
				echo '<h1 class="contentTitle">' . $post->post_title . '</h1>';
				echo apply_filters('the_content', get_post_field('post_content', $post->ID));
			?>
		</div>
	</div>

	<!-- Si la page est protégée avec un mot de passe... -->
	<?php
	}
	else{
	?>

	<!-- Alors on affiche le formulaire / mot de passe -->
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
