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
		?>

		<?php if ( $query->have_posts() ) : ?>
		<div id="news_stickies">
			<?php $i = 0;?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				
				<?php 
					echo sticky(get_the_post_thumbnail_url(), get_the_title(), get_the_excerpt(), get_the_date("F d"), "highlight".$i);
					$loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : '';
					modal(get_the_title(), get_the_content(), $loc, "highlight".$i);
				?>

				<?php $i = $i + 1;?>

			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php echo 'Sorry, no post amongst the highlights.'; ?></p>
		<?php endif; ?>

		<br>

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
		?>
		<?php if ( $query->have_posts() ) : ?>
		<ul class="news_upcoming" >
			<?php $i = 0;?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				
				<?php 
					$sticky = (! is_sticky()) ? '' : '*';
					breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve'.$i);
					$loc = 'Location: ' . get_post_meta(get_the_ID(),"localization")[0];
					modal(get_the_title(), get_the_content(), $loc, "breve".$i);
				?>

				<?php $i = $i + 1;?>
			<?php endwhile; ?>
		</ul>

		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	
		<!--
		<h1>All tags</h1>
		<?php
		$tags = get_terms( 'post_tag',    'orderby=count&hide_empty=0' );
		foreach ( $tags as $tag ) {
        		echo '<a href="'. get_term_link( $tag ) .'">' . $tag->name . '</a> ';
    		}
		?>
		-->
	</div>


</div>


</div>

<?php get_footer();?>
