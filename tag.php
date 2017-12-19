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


		<?php if (is_category('news')) : ?>
			<p>This is the text to describe category A</p>
		<?php elseif (is_category('hilights')) : ?>
			<p>This is the text to describe category B</p>
		<?php else : ?>
			<p>This is some generic text to describe all other category pages, I could be left blank</p>
		<?php endif; ?>



		<h1>Sticky</h1>
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
					$class = "none";
					$color = "#666";
					//Categories principales
					if (has_category('iscd',get_the_ID())){
						$class = "news_iscd";
						$color = "#03a";
					}
					elseif (has_category('research',get_the_ID())){
						$class = "news_research";
						$color = "#a00";
					}
					elseif (has_category('training',get_the_ID())){
						$class = "news_training";
						$color = "#080";
					}
					elseif (has_category('expertise',get_the_ID())){
						$class = "news_expertise";
						$color = "#a50";
					}

					?>

					<?php
						$stickyType="toto";
						if( get_post_meta(get_the_ID(),'main',true) ){
							$stickyType="stickyMain";
						}
						else{
							$stickyType="stickySecondary";
						}
					?>
					<div class="sticky modalButton <?php echo $stickyType;?> <?php echo $class;?>" link='news_stickies_<?php echo $i?>'>
						<?php
						if(has_post_thumbnail()){
							echo '<img class="mainImage" src="' . get_the_post_thumbnail_url() . '"></img>';
						}
						else{
							echo '<img class="mainImage" src="http://medias.tourismebretagne.com/images/d/e/-/B/o/full_Plage-de-Boutrouilles-1.jpg"></img>';
						}
						?>
						<h1 class="title"><?php the_title();?></h1>
						<span style="background-color:<?php echo $color?>" class="badge"><?php the_category(", ")?></span>
						<span style="color:#333" class="date"><?php echo get_the_date("Y/m/d");?></span>
						<div style="color:#333" class="text"><?php the_excerpt();?></div>
					</div>

					<div class="modal" id="news_stickies_<?php echo $i?>">
						<h1><?php the_title();?></h1>
						<p><?php the_tags()?></p>
						<?php the_content();?>
					</div>

					<?php $i = $i + 1;?>

			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p>
				<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			</p>
		<?php endif; ?>

		<script>
		jQuery('#news_stickies').masonry({
			// options...
			columnWidth: '.stickySecondary',
			itemSelector: '.sticky',
			percentPosition: true
		});
		</script>









		<br><br>


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
				<li class="breve">
					<?php
					$class = "none";
					$color = "666666";
					//Categories principales
					if (has_category('iscd',get_the_ID())){
						$class = "news_iscd";
						$color = "0033aa";
					}
					elseif (has_category('research',get_the_ID())){
						$class = "news_research";
						$color = "aa0000";
					}
					elseif (has_category('training',get_the_ID())){
						$class = "news_training";
						$color = "008800";
					}
					elseif (has_category('expertise',get_the_ID())){
						$class = "news_expertise";
						$color = "aa5500";
					}

					?>
					<div class="modalButton <?php echo $class;?>" link='news_upcoming_<?php echo $i?>'>
						<div style="vertical-align:top;width:100px;font-weight:bold;font-size:1.2em;color:#444;display:inline-block">
							<span><?php echo get_the_date('F');?></span>
							<br>
							<span><?php echo get_the_date('d');?></span>
						</div>
						<div style="display:inline-block;">
								<!--
								<span style="font-weight:bold;color:#<?php echo $color;?>;"><?php $ar=get_the_category(); echo $ar[0]->name;?></span>
								-->
								<h1 style="font-size:0.95em;color:#<?php echo $color;?>;"><?php the_title();?></h1>
								<span style="color:#333"><?php the_excerpt();?></span>
								<?php if(is_sticky()){echo 'sticky';}?>
						</div>
					</div>



				</li>
				<div class="modal" id="news_upcoming_<?php echo $i?>">
					<h1><?php the_title();?></h1>
					<?php the_content();?>
					<!--<a href="<?php the_permalink(); ?>">View article</a>-->
				</div>
				<?php $i = $i + 1;?>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p>
				<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			</p>
		<?php endif; ?>







		<br><br>


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
				<li class="breve">
					<?php
					$class = "none";
					$color = "666666";
					//Categories principales
					if (has_category('iscd',get_the_ID())){
						$class = "news_iscd";
						$color = "0033aa";
					}
					elseif (has_category('research',get_the_ID())){
						$class = "news_research";
						$color = "aa0000";
					}
					elseif (has_category('training',get_the_ID())){
						$class = "news_training";
						$color = "008800";
					}
					elseif (has_category('expertise',get_the_ID())){
						$class = "news_expertise";
						$color = "aa5500";
					}

					?>
					<div class="modalButton <?php echo $class;?>" link='news_past_<?php echo $i?>'>
						<div style="vertical-align:top;width:100px;font-weight:bold;font-size:1.2em;color:#444;display:inline-block">
							<span><?php echo get_the_date('F');?></span>
							<br>
							<span><?php echo get_the_date('d');?></span>
						</div>
						<div style="display:inline-block;">
								<!--<span style="font-weight:bold;color:#<?php echo $color;?>;"><?php $ar=get_the_category(); echo $ar[0]->name;?></span>-->
								<h1 style="font-size:0.95em;color:#<?php echo $color;?>;"><?php the_title();?></h1>
								<span style="color:#333"><?php the_excerpt();?></span>
								<?php if(is_sticky()){echo 'sticky';}?>
						</div>
					</div>



				</li>
				<div class="modal" id="news_past_<?php echo $i?>">
					<h1><?php the_title();?></h1>
					<?php the_content();?>
					<!--<a href="<?php the_permalink(); ?>">View article</a>-->
				</div>
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
