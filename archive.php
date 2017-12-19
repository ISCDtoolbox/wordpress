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



		<?php if (is_category('events')) : ?>
			<p>This is the text to describe the category "Events"</p>
		<?php elseif (is_category('media')) : ?>
			<p>This is the text to describe the category "Media"</p>
		<?php elseif (is_category('posts')) : ?>
                        <p>This is the text to describe the category "Posts"</p>
		<?php endif; ?>




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
			<p>Sorry, no hilighted post in this category</p>
		<?php endif; ?>



		<?php if (is_category('events')) : ?>

		<h1>Upcoming</h1>
		<?php
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
		?>

		<?php if ( $query->have_posts() ) : ?>
		<ul class="news_upcoming" >
			<?php $i = 0;?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				

				<?php 
                                        $sticky = (! is_sticky()) ? '' : '*';
                                        breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve_upcoming'.$i);
                                        $loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : "";
                                        modal(get_the_title(), get_the_content(), $loc, "breve_upcoming".$i);
                                ?>
				<?php $i = $i + 1;?>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p>
				<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			</p>
		<?php endif; ?>
		<br>

		<?php endif;?>





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
		?>
		<?php if ( $query->have_posts() ) : ?>
		<ul class="news_upcoming" >
			<?php $i = 0;?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<?php 
                                        $sticky = (! is_sticky()) ? '' : '*';
                                        breve( get_the_date('F'), get_the_date('d'), $sticky, get_the_title(), get_the_excerpt(), 'breve_past'.$i);
					$loc = (has_category("events",get_the_ID())) ? 'Location: ' . get_post_meta(get_the_ID(),"localization")[0] : "";
                                        modal(get_the_title(), get_the_content(), $loc, "breve_past".$i);
                                ?>
				<?php $i = $i + 1;?>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p>
				<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			</p>
		<?php endif; ?>












	</div>
</div>


</div>

<?php get_footer();?>
