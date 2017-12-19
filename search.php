<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header(); ?>

<div id="secondaryContent">

	<div id="mainPart">

		<!-- Barre de recherche -->
		<br>
		<?php get_search_form(); ?>

		<!-- On parcoure les résultats -->
		<br>
		<?php
		if(have_posts()){
			while(have_posts()){
				the_post();
		?>
		<!-- On écrit le lien avec le titre -->
		<a href="<?php the_permalink() ?>">
			<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
			<h2><?php echo $title; ?></h2>
		</a>
		<!-- Et l'excerpt de la page ou de la news -->
		<p>
			<?php the_excerpt(); ?>
		</p>
		<!-- On clot le parcours -->
		<?php
			}
		}
		else{
			echo("<p>Sorry, no results matched your search...</p>");
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
