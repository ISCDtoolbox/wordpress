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

	<!-- Menu sous forme de liste de catégories -->
	<div id="secondaryMenu">
		<?php
			$args = array(
				'hide_empty' => 0,
				'title_li' => '',
				'exclude' => array(3),
			);
			wp_list_categories($args);
		?>
	</div>

	<div id="secondaryContent" style="">
		<div id="mainPart">

			<h1 class="contentTitle">News</h1>

			<!-- On affiche les highlights -->
			<h1>Highlights</h1>
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'post_type'=>'post',
				'post_status'=>'publish,future',
				'post__in'  => get_option( 'sticky_posts' ),
				'category__not_in' => array(3),
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
				echo('<p>Sorry, no post amongst the highlights.</p>');
			}
			echo("<br>");
			?>

			<!-- On affiche les évenements à venir -->
			<h1>Upcoming</h1>
			<?php
			$args = array(
				'post_type'=>'post',
				'post_status'=>'future',
				'category__not_in' => array(1,3),
				'orderby' => 'date',
				'order'   => 'ASC',
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ){
				echo('<ul class="news_upcoming" >');
				$i = 0;
				while ( $query->have_posts() ){
					$query->the_post();
					$sticky = (! is_sticky()) ? '' : '*';
					breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve'.$i);
					$loc = 'Location: ' . get_post_meta(get_the_ID(),"localization")[0];
					modal(get_the_title(), get_the_content(), $loc, "breve".$i);
					$i = $i + 1;
				}
				echo('</ul>');
				wp_reset_postdata();
			}
			else{
				echo('<p>Sorry, no posts matched your criteria.</p>');
			}
			echo("<br>");
			?>

		</div>
	</div>

</div>

<?php get_footer();?>
