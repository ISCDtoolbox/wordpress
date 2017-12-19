<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="secondaryContent"><div id="mainPart">
<br>	
<?php get_search_form(); ?>
<br>	
	<?php if(have_posts()){?>
	<?php while (have_posts()) : the_post(); ?>
	<a href="<?php the_permalink() ?>">
	<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
  	<h2><?php echo $title; ?></h2>
	</a>
	<p><?php the_excerpt(); ?></p>
	<?php endwhile;}else{ ?>
	<p>Sorry, no results matched your search...</p>
	<?php } ?>
</div></div>

<?php get_footer(); ?>
