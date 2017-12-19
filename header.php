<!DOCTYPE html>
<meta charset="utf-8">

<html>

<head>
	<!-- Liens pour les fonts et les librairies javascript -->
	<link  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.4.0/d3.min.js"  charset="utf-8"></script>
  <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/style.css" rel="stylesheet">
	<?php wp_head();?>
</head>


<body <?php body_class();?>>

	<!-- On définit les couleurs en fonction de la page parente -->
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

	<!-- On rajoute à body la classe correspondant à la page parente -->
	<script>
		document.getElementsByTagName("body")[0].className+=" <?php echo $className?>";
	</script>

	<!-- On applique le style css pour les couleurs -->
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
			// Tableau associatif classe / source du logo
			var _logos = new Object();
			_logos["home"]           = "/wp-content/uploads/2017/12/logoISCD_blanc_2018.png";
			_logos["researchChild"]  = "/wp-content/uploads/2017/12/logoRouge_2018.png";
			_logos["aboutChild"]     = "/wp-content/uploads/2017/12/logoISCD_noir_2018.png";
			_logos["trainingChild"]  = "/wp-content/uploads/2017/12/logoVert_2018.png";
			_logos["expertiseChild"] = "/wp-content/uploads/2017/12/logoOrange_2018.png";
			_logos["faqChild"]       = "/wp-content/uploads/2017/12/logoTaupe_2018.png";
			_logos["default"]        = "/wp-content/uploads/2017/12/logoISCD_noir_2018.png";

			//On associe les logos aux classes qui correspondent
			document.getElementById("logoimg").src = null;
			var body = document.getElementsByTagName("body")[0];
			function hasClass(element, cls) {
    		return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
			}
			var hasAClass = 0;
			for (var classe in _logos){
				if hasClass(body, classe){
					document.getElementById("logoimg").src = _logos[classe];
					hasAClass = 1;
					break;
				}
			}
			if(hasAClass==0)
				document.getElementById("logoimg").src = _logos["default"];
		</script>
	</div>

	<!-- On compte les dernières news depuis 1 mois... -->
	<?php
		$args = array(
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'orderby' => 'date',
    			'order' => 'DESC',
    			'date_query' => array( array('after' => '1 month ago'))
		);
		$num = count($posts_array = get_posts( $args ));
	?>
	<!-- ... et on les affiche -->
	<span>
		<a href="http://iscd.upmc.fr/index.php/news">
			<i id="news" class="icon fa fa-newspaper-o" style="font-size:1.5em;"></i>
		</a>
	</span>
	<span id="newsLabel">
		<span class="icon">
			<?php echo($num); ?>
		</span>
	</span>

	<!-- On prépare la barre de recherche... -->
	<span>
		<a class="modalButton" link="searchPopup" title="search">
      <i id="search" class="icon fa fa-search" style="font-size:1.5em;"></i>
		</a>
  </span>

	<!-- ... et on l'affiche -->
	<div id="searchPopup" class="modal" width="70%">
		<!-- Avec la barre de recherche -->
	  <?php get_search_form() ?>
	  <br>
	  <h2>A-Z search</h2>
		<!-- Et avec la liste alphabétique -->
		<span id="azlist"></span>
		<script>
			$("#azlist").load("htmlTemplates/azlist.html");
		</script>
	</div>

	<!-- Icones pour intranet, plateforme et contact -->
	<span>
		<a href="http://iscd.upmc.fr/index.php/about/contact/" title="contact">
			<i id="contact" class="icon fa fa-envelope-o" style="font-size:1.5em;"></i>
		</a>
	</span>
	<span>
		<a href="http://iscd.upmc.fr/index.php/intranet/" title="intranet">
			<i id="intranet" class="icon fa fa-user-circle-o" style="font-size:1.5em;"></i>
		</a>
	</span>
	<span>
		<a href="http://iscd.upmc.fr/index.php/expertise/mesu/" title="platform">
			<i id="platforms" class="icon fa fa-microchip" style="font-size:1.5em;"></i>
		</a>
	</span>

	<!-- On change la couleur des icones en fonction de la page -->
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

	<!-- Breadcrumb navigation -->
	<div id="navigation">
		<?php
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
		?>
	</div>

	<!-- Menu -->
	<div id="mainMenu">
	  <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
	</div>
