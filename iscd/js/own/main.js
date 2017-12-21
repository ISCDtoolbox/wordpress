//Hover
$("#mainButton .icon").hover(
	function(){
		$(this).toggleClass("buttonHovered");
	}
);

$("#icon").click(
	function(){
		//Fermeture du contenu pour les projets
		if( $("body").hasClass("secondary_menu_open") ){
			$('#contentSideBar').animate({width: 'toggle'});
			$('#app').animate({width: '100%'});
			$("body").removeClass("secondary_menu_open");
			$('#buttons').fadeIn();
			$('#logo').fadeIn();
			$("#mainPage").fadeIn();
			$('#sponsors').fadeIn();
			$("#dock").fadeOut();
        		$(".canvas h1").first().fadeIn();
			$(".canvas h1").first().css("opacity","1");
		}
		//toggle du menu principal
		else{
			$('#mainMenu').animate({width: 'toggle'});
		}
		$(".icon").slideToggle();
		$("#newsLabel").slideToggle();
		$(this).toggleClass("buttonClicked");
		$(this).toggleClass("fa-bars");
		$(this).toggleClass("fa-close");
		//$(".mainPage .buttonLight, .mainPage .buttonDark").toggleClass("buttonLight buttonDark");
	}
);

$("#dock").on("click", "li", function(){
	$('#contentSideBar').html($(this).next("div").html());
});

$("#toProjects").click(
	function(){
		$('#contentSideBar').animate({width: 'toggle'});
		$('#logo').fadeOut();
		$("#dock").fadeIn();
		$("#icon").toggleClass("fa-close");
	        $("#icon").toggleClass("fa-bars");
        	$("#icon").toggleClass("buttonClicked");
        	$("body").addClass("secondary_menu_open");
		$("#icon").toggleClass("buttonLight buttonDark");
	        //$(".mainPage .buttonLight, .mainPage .buttonDark").toggleClass("buttonLight buttonDark");
	        $('#sponsors').fadeOut();
		$("#mainPage").fadeOut();//css("display","none");
		$("#app").fadeIn();
		$("#app").css("display","block");
		$(".icon").fadeToggle();
		$("#newsLabel").slideToggle();
	}
);
$("#toAbout").click(function(){
	window.location.href = '134.157.66.222/about';
})

$("#mainMenu ul ul li").click(function(){
	$(this).next("ul").children("li").toggle(200);
});

$("#faq li").next("p").hide();
$("#faq li").click(function(){
        $(this).next("p").toggle(200);
});

//link each button (class modalButton) with its link (class modal) via the link attribute
$(".modalButton").each(function(){
        var link = $(this).attr("link");
        var modal = $("#"+link);
        modal.prepend("<span class='close'>×</span>" )
        modal.wrapInner("<div class='modal-content' style='width:"+modal.attr("width")+"'></div>");
})
$(".modalButton").click(function(e){
	var link = $(this).attr("link");
	var modal = $("#"+link);
	modal.fadeIn();
	$("#standaloneMenu").fadeOut();
	$("#standaloneMenu").prev().slideToggle();
	$(".icon").fadeOut();
	$("#mainButton").fadeOut();
	$("#navigation").fadeOut();
	$("#menu-mymenu").fadeOut();
})
function close_modal(){
	$("#standaloneMenu").fadeIn();
        $("#standaloneMenu").prev().slideDown();
        $(".icon").fadeIn();
        $("#mainButton").fadeIn();
        $("#navigation").fadeIn();
        $("#menu-mymenu").fadeIn();
}
$(".close").click(function(){
	$(this).parent().parent().fadeOut();
	close_modal();
})
$(".modal").not("#searchPopup").click(function(){
	$(this).fadeOut();
	close_modal();
})
$("#back").click(function(){
	window.location.href = 'http://iscd.upmc.fr';
})

$('.cat-item a').each(function(){
	if(window.location.href == $(this).attr("href")){
		$(this).parent().addClass("current");
	}
});

var mylist = $('#az');
var listitems = mylist.children('li').get();
listitems.sort(function(a, b) {
   return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
})
$.each(listitems, function(idx, itm) { mylist.append(itm); });

//Rajout de la fonctionnalite 3D
$('body').on('click','.play',function(){
    $(this).parent().find(".play").fadeOut(300);
    $(this).parent().find(".stop").fadeIn(300);
    var iframe = $(this).parent().find('iframe');
    iframe.attr("src", iframe.attr('link'));
});
$('body').on('click','.stop',function(){
    $(this).parent().find(".play").fadeIn(300);
    $(this).parent().find(".stop").fadeOut(300);
    var iframe = $(this).parent().find('iframe');
    iframe.attr("src", "about:blank");
});

$("#menu_container li").mouseover(function(){
	$(this).animate({width:"200px"}).clearQueue();
});
$("#menu_container li").mouseout(function(){
        $(this).animate({width:'50px'});
});
