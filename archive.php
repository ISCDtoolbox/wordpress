<?php
/**
 * Template Name: Secondary page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header();?>
<script src="/wp-content/themes/ISCD/js/own/masonry.js"></script>
<?php global $query;?>

<div id="secondaryPage">

	<!-- Menu avec les catégories-->
	<div id="secondaryMenu">
		<li class="cat-item"><a href="http://iscd.upmc.fr/index.php/news">all news</a></li>
		<?php
			$args = array(
				'hide_empty' => 0,
				'title_li' => '',
				'exclude' => array(3,1),
			);
			wp_list_categories($args);
		?>
	</div>

	<div id="secondaryContent" style="">
		<div id="mainPart">

			<h1 class="contentTitle">News</h1>

			<!-- Texte d'introduction de la catégorie -->
			<?php
			if (is_category('events'))
				echo('<p>This is the text to describe the category "Events"</p>');
			elseif (is_category('media'))
				echo('<p>This is the text to describe the category "Media"</p>');
			elseif (is_category('posts'))
	      echo('<p>This is the text to describe the category "Posts"</p>');
			?>

			<!-- Postes qui sont "sticky" -->
			<h1>Highlights</h1>
			<?php
			$args = array(
				'category__in'=> $cat,
				'post_type'=>'post',
				'post_status'=>'publish,future',
				'post__in'  => get_option( 'sticky_posts' ),
				'orderby' => 'date',
				'order'   => 'ASC',
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ){
				echo('<div id="news_stickies">');
				$i = 0;
				while ( $query->have_posts() ){
					$query->the_post();
	        echo sticky(get_the_post_thumbnail_url(), get_the_title(), get_the_excerpt(), get_the_date("F d"), "highlight".$i);
	        $loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : '';
	        modal(get_the_title(), get_the_content(), $loc, "highlight".$i);
	        $i = $i + 1;
				}
				echo('</div>');
				wp_reset_postdata();
			}
			else{
				echo('<p>Sorry, no hilighted post in this category</p>');
			}
			?>

			<!-- Si la catégorie est "events", on affiche les events à venir -->
			<?php
			if (is_category('events')){
				echo('<h1>Upcoming</h1>');
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'post_type'=>'post',
					'post_status'=>'future',
					'category__not_in' => array(2),
					'orderby' => 'date',
					'order'   => 'ASC',
					'category__in'=> $cat,
				);
				$query = new WP_Query($args);
				if ( $query->have_posts() ){
					echo('<ul class="news_upcoming" >');
					$i = 0;
					while ( $query->have_posts() ){
						$query->the_post();
						$sticky = (! is_sticky()) ? '' : '*';
	          breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve_upcoming'.$i);
	          $loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : "";
	          modal(get_the_title(), get_the_content(), $loc, "breve_upcoming".$i);
						$i = $i + 1;
					}
					echo('</ul>');
					wp_reset_postdata();
				}
				else{
					echo('Sorry, no posts matched your criteria.');
				}
				echo('<br>');
			}
			?>

			<!-- On affiche les news passées -->
			<h1>Past</h1>
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'paged'=>$paged,
				'post_type'=>'post',
				'post_status'=>'publish',
				'category__not_in' => array(2),
				'orderby' => 'date',
				'order'   => 'ASC',
				'category__in'=> $cat,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ){
				echo('<ul class="news_upcoming">');
				$i = 0;
				while ( $query->have_posts() ){
					$query->the_post();
					$sticky = (! is_sticky()) ? '' : '*';
					breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve_past'.$i);
					$loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : "";
					modal(get_the_title(), get_the_content(), $loc, "breve_past".$i);
					$i = $i + 1;
				}
				echo('</ul>');
				wp_reset_postdata();
			}
			else{
				echo('Sorry, no posts matched your criteria.');
			}
			?>

		</div>
	</div>

</div>

<?php get_footer();?>
