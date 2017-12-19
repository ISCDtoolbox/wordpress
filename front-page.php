<?php get_header();?>

<div id="mainPage">

	<div id="mainPage_image">
		<img src="<?php header_image(); ?>" alt="" />
	</div>

	<div id="mainPage_content">
		<h1 style="color:white;"><b>Data, computing and simulation</b></h1>

		<p style="font-size:1.em;">High performance computing and data science are profoundly transforming sciences, humanities and medicine.</p>
		<p style="font-size:1.em;">The institute for computing and data sciences (ISCD) provides a favourable environment to stimulate and advance multidisciplinary research efforts spanning a broad range of domains and applications.
		</p>
		<!--
		<button id="toProjects">Research areas</button>
		<button id="toAbout">About ISCD</button>
	-->
		<style>
		#mainPage_content h1{font-size:3.6em;}
		#mainPage_content p{ font-size: 1.4em; }
		@media only screen and (max-width: 1440px){
                  #mainPage_content h1{ font-size: 2.4em; }
                        #mainPage_content p{ font-size: 1em; }
                        #toProjects{font-size:1em}
                        #toAbout{font-size:1em}
                        #mainPage_content button{padding:10px 15px;margin-top:15px;margin-right:15px;}
                }
		@media only screen and (max-width: 1080px), screen and  (max-height: 640px){
		  #mainPage_content h1{ font-size: 2em; }
			#mainPage_content p{ font-size: 0.7em; }
			#toProjects{font-size:0.7em}
			#toAbout{font-size:0.7em}
			#mainPage_content button{padding:10px 15px;margin-top:15px;margin-right:15px;}
		}
		@media only screen and (max-width: 540px), screen and  (max-height: 380px) {
		  #mainPage_content h1{ font-size: 1.3em; }
			#mainPage_content p{ font-size: 0.5em; }
			#toProjects{font-size:0.5em}
			#toAbout{font-size:0.5em}
			#mainPage_content button{padding:5px 10px;margin-top:7px;margin-right:7px;}
		}
		</style>
	</div>
</div>


<!--
	<div id="dock" style="display:none;">
	<ul id="carousel">
		<?php
			$hilights_category = get_category_by_slug('hilights');
			$the_query = new WP_Query( array( 'category_name' => $hilights_category->name, 'orderby' => 'title', 'order' => 'ASC' ) );
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$the_content = get_the_content();
				$content     = wpautop( $the_content, true);

				echo '<li><a href="#" id="'
				. get_the_title()
				. '" title="' . get_the_excerpt() . '"><img src="'
				. get_the_post_thumbnail_url()
				. '"></img></a></li>';
				echo '<div style="display:none;" id="'
				. get_the_title() . '_content">' . $content
				. '</div>';
			}
		?>
	</ul>
	</div>
	<style>
	#carousel {
		height:100vh;
		margin:0px;padding:0px;
	}
	#carousel li {
		list-style-type:none;
		padding:0px;
		margin:15px;
		margin-bottom:-5px;
		text-align:center;
	}
	#carousel li img{
		list-style-type:none;
		padding:0px;
		margin:0px;
		transition:0.5s;
	}
	#carousel{width:22.5%;vertical-align:middle}
	</style>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		var r = 1.8;
		var x = $("#carousel a").length;
		$("#carousel li a img").css("height", $("#carousel").height()/x - 15 + "px" );
		$("#carousel li a img")
		.hover(function() {
			var y = $("#carousel").height() / (x -1 + r) - 15;
			$(this).css( "height", r * y +"px");
			$("#carousel li a img").not(this).css( "height" , y + "px" );
			$(this).css( "max-height" , $("carousel").width() - 15);
		})
		$("#carousel a").click(function(event) {
    event.preventDefault();
		;});
		$("#carousel").mouseout(function(){$("#carousel li a img").css("height",$("#carousel").height()/x - 15 +"px");});
	});
	</script>
-->

<!--
<div id="contentSideBar"></div>
-->

<?php get_footer();?>
