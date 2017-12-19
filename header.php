<!DOCTYPE html>
<meta charset="utf-8">
<html>

<head>
	<link  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.4.0/d3.min.js"  charset="utf-8"></script>
  	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

	<link href="<?php bloginfo('template_directory');?>/style.css" rel="stylesheet">
	<?php wp_head();?>
</head>



<body <?php body_class();?>>
	<!-- On rajoute une classe a body pour les couleurs -->
	<?php
	//

	?>


	<?php
	$color      = "#666";
	$hoverColor = "#999";
	$className  = "none";
	if(is_tree(44)){$color="#00597c"; $hoverColor="#389"; $className="aboutchild";}
	if(is_tree(42)){$color="#b5384f"; $hoverColor="#c56"; $className="researchChild";}
	if(is_tree(86)){$color="#96c11f"; $hoverColor="#cc3"; $className="trainingChild";}
	if(is_tree(108)){$color="#e05206"; $hoverColor="#f72"; $className="expertiseChild";}
	if(is_tree(2378)){$color="#91785b"; $hoverColor="#ba7"; $className="faqChild";}
	if(is_tree(2622)){$color="#91785b"; $hoverColor="#ba7"; $className="faqChild";}
	if(in_array('category', get_body_class())){$color="#91785b"; $hoverColor="#ba7"; $className="faqChild";}
	if(in_array('home', get_body_class())){$color="#ccc"; $hoverColor="#fff"; $className="homeChild";}
	?>

	<script>
		document.getElementsByTagName("body")[0].className+=" <?php echo $className?>";
	</script>
	<style>
	.<?php echo $className?> .buttonDark,
	.<?php echo $className?> a,
	.<?php echo $className?> h1,
	.<?php echo $className?> h2,
	.<?php echo $className?> #secondaryMenu a:hover,
	.<?php echo $className?> #secondaryMenu .current a{
		color:<?php echo $color?>;
	}
	.<?php echo $className?> .buttonDark:hover{color:<?php echo $hoverColor?>}
	</style>


	<!-- logo -->
	<div id="logo">
		<a href="http://iscd.upmc.fr"><img style="width:265px;" id="logoimg" src=""></img></a>
		<script>
			document.getElementById("logoimg").src = null;
			function hasClass(element, cls) {
    				return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
			}
			var body = document.getElementsByTagName("body")[0];
			if( hasClass(body, 'home') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoISCD_blanc.png";
			}
			else if( hasClass(body, 'researchChild') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoRouge.png";
			}
			else if( hasClass(body, 'aboutChild') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoISCD_noir.png";
			}
			else if( hasClass(body, 'trainingChild') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoVert.png";
			}
			else if( hasClass(body, 'expertiseChild') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoOrange.png";
			}
			else if( hasClass(body, 'faqChild') ){
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoTaupe.png";
			}
			else{
				document.getElementById("logoimg").src = "/wp-content/uploads/2017/02/logoISCD_noir.png";
			}
		</script>
	</div>

	<?php
		$args = array(
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'orderby' => 'date',
    			'order' => 'DESC',
    			'date_query' => array( array('after' => '1 month ago'))
		);
		$num = count($posts_array = get_posts( $args ));
		echo('<span><a href="http://iscd.upmc.fr/index.php/news"><i id="news" class="icon fa fa-newspaper-o" style="font-size:1.5em;"></i></a></span>');
		echo('<span id="newsLabel"><span class="icon">' . $num . '</span></span>');
	?>

	<!-- menu -->
	<!--
	<div id="mainButton" style="display:none;">
	   <span><i id="icon" class="fa fa-bars" style="font-size:1.5em;"></i></span>
	</div>
	-->

	<span><a class="modalButton" link="searchPopup" title="search">
              <i id="search" class="icon fa fa-search" style="font-size:1.5em;"></i></a>
        </span>
	<div id="searchPopup" class="modal" width="70%">
	  <?php get_search_form() ?>
	  <br>
	  <h2>A-Z search</h2>

          <table style="width:100%; font-size:0.75em; border-spacing:1em;">
          <tbody style="vertical-align:top; text-align:left;">
          <tr>
              <td style="width:7%"><span style="font-size:1.5em;">A</span></td>
              <td style="width:31%"><a href="http://iscd.upmc.fr/index.php/about/">About ISCD</a><br>Affiliates<br>Applied mathematics</td>
	      <td style="width:31%">Access<br>Alumni<br>Apply for a job</td>
	      <td style="width:31%">Address<br>Administration<br>Anthropology<br>Archaeology</td>
          </tr>
          <tr>
              <td><span style="font-size:1.5em;">B</span></td>
	      <td>Bioinformatics</td>
	  </tr>
          <tr>
              <td><span style="font-size:1.5em;">C</span></td>
              <td>Calendar, events<br>Catalogue, training<br>Computational chemistry</td>
	      <td>Campus map<br>Chaire FaciLe<br>Contact</td>
	      <td>Carnot Smiles<br>Computational biology</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">D</span></td>
	      <td>Digital humanities</td>
	      <td>Directions</td>
          </tr>
 	  <tr><td><span style="font-size:1.5em;">E</span></td>
	      <td>Events</td>
              <td>Expertise catalogue</td>
          </tr>
 	  <tr><td><span style="font-size:1.5em;">F</span></td>
              <td>Forum MeSU</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">H</span></td>
	      <td>Healthcare analytics</br>HPC resources</td>
	      <td>HPC accounts</td>
              <td>HPC centre</td>
	  </tr>
	  <tr><td><span style="font-size:1.5em;">I</span></td>
	      <td>ISCD members</td>
              <td>ISCD missions</td>
	  </tr>
	  <tr><td><span style="font-size:1.5em;">J</span></td>
	      <td>Joint programs</td>
	  </tr>
	  <tr><td><span style="font-size:1.5em;">L</span></td>
	      <td>Labex description</td>
	      <td>Labex forms</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">M</span></td>
	      <td>Media-Press</td>
              <td>MeSU</td>
	      <td>Metagenomics</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">N</span></td>
	      <td>News</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">O</span></td>
	      <td>Open-source repository</td>
	      <td>Openings</td>
	      <td>Organisation</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">P</span></td>
	      <td>Project-teams</td>
	      <td>Publication policies</td>
	      <td>Publications</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">R</span></td>
	      <td>Room booking</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">S</span></td>
	      <td>Scientific Advisory Board</br>Staff<br>Support</td>
	      <td>Scientific initiatives</br>Steering Committee</td>
	      <td>Simseo</br>Summer school</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">T</span></td>
	      <td>Technical support</td>
	      <td>Training catalogue</td>
	      <td>Transportation</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">U</span></td>
	      <td>Usage policies HPC</td>
	      <td>Usage policy meeting room</td>
	      <td>User committee</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">V</span></td>
	      <td>ViSU</td>
          </tr>
	  <tr><td><span style="font-size:1.5em;">W</span></td>
	      <td>Wiki MeSU</td>
	          </tr>

	  </tbody></table>
	</div>

	<span><a href="http://iscd.upmc.fr/index.php/about/contact/" title="contact"><i id="contact" class="icon fa fa-envelope-o" style="font-size:1.5em;"></i></a></span>

	<span><a href="http://iscd.upmc.fr/index.php/intranet/" title="intranet"><i id="intranet" class="icon fa fa-user-circle-o" style="font-size:1.5em;"></i></a></span>

	<span><a href="http://iscd.upmc.fr/index.php/expertise/mesu/" title="platform"><i id="platforms" class="icon fa fa-microchip" style="font-size:1.5em;"></i></a></span>

	<script>
		icons = document.getElementsByClassName("icon");
		main  = document.getElementById("mainButton");
		var i;
		if( hasClass(body, 'home') ){
			main.className += " buttonLight";
			for (i = 0; i < icons.length; i++) {
				icons[i].className += " buttonLight";
			}
		}
		else{
			main.className += " buttonDark";
			for (i = 0; i < icons.length; i++) {
				icons[i].className += " buttonDark";
			}
		}
	</script>


	<div id="navigation">
		<?php // Breadcrumb navigation
 		if (is_page() && !is_front_page() || is_single() || is_category()) {
 			echo '<a title="home" href="' . home_url() . '">Home</a> / ';

 			if (is_page()) {
 			$ancestors = get_post_ancestors($post);

 				if ($ancestors) {
 					$ancestors = array_reverse($ancestors);

 					foreach ($ancestors as $crumb) {
 						echo '<a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a> / ';
 					}
 				}
 			}

 			if (is_single()) {
 				$category = get_the_category();
 				echo '<a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a> ';
 			}

 			if (is_category()) {
 				$category = get_the_category();
 				echo $category[0]->cat_name;
 			}

 			// Current page
 			if (is_page() || is_single()) {
			 	echo " " . get_the_title();
 			}

 		}
		elseif (is_front_page()) {}
		?>
	</div>

	<div id="mainMenu">
	  <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
	</div>
