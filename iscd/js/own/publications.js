function show_publications(){

 var URL="http://api.archives-ouvertes.fr/search/"+
      "?q=collCode_s:ICS"+
      "&wt=json" +
      "&sort=ePublicationDateY_i desc"+
      "&fl=authFullName_s,title_s,producedDateY_i,journalTitle_s,uri_s,docType_s,issue_s,page_s"+
      "&rows=100";
  
  var REQ = new XMLHttpRequest();
  REQ.open("GET", URL, false);
  REQ.send();
  
  if(REQ.status == 200){
    var arr = JSON.parse(REQ.responseText);
    var docs = arr.response.docs;    
    var HTML = [];
    var baseURL = "https://hal.archives-ouvertes.fr/ICS/hal-";
    
    HTML.push("<span class='publications'>");

//    for (var annee=2017; annee>=2013; annee--){
//	HTML.push("<span style='width:19%;display:inline-block;' id='bouton" + String(annee) + "'>"+String(annee)+"</span>");
//    }

    HTML.push("List of publications extracted from <a href='http://hal.upmc.fr/search/index/q/ics/labStructName_t/Institut+du+Calcul+et+de+la+Simulation/sort/producedDate_tdate+desc/'>ISCD's HAL repository</a>.")

    for (var annee=2017; annee>=2013; annee--){
      //HTML.push("<div class='tabContent' id='tab"+annee+"'")
      HTML.push("<h2 class='annee' id='"+annee+"'>"+annee+"</h2><hr>");
      HTML.push('<ol class="list-of-publications">');
      for(var i=0;i<docs.length;i++) {
        var article = docs[i];
        if(article["producedDateY_i"] == annee){
          HTML.push("<li class='publication'>");
          
          //Noms des auteurs
          var etal = 0;
          for(var j = 0 ; j < article["authFullName_s"].length ; j++){
            if(!etal){
              if(j<2){
                HTML.push(article["authFullName_s"][j] + ", ");
              }
              else{
                HTML.push(article["authFullName_s"][j] + " ");
              }
            }
            else{
              
            }
            if(j==2){
              etal=1;
              HTML.push("et al");
            }
          }
          
          //Nom du journal, revue et pages
          if(article['docType_s']=="ART"){
            HTML.push("<br><span style='font-style:italic;'>" + article['journalTitle_s'] + "</span>");
	    if(String(article['issue_s']) != "undefined"){
              HTML.push(", Issue " + article['issue_s']);
            }
            if(String(article['issue_s']) != "undefined"){
	      HTML.push(", pp." + article['page_s']);
            }
          }
          else if(article['docType_s']=="COMM"){
            HTML.push("<br>Conference report");
          }
          else if(article['docType_s']=="REPORT"){
            HTML.push("<br>Research report");
          }
          else if(article['docType_s']=="UNDEFINED"){
            HTML.push("<br>Preprint, working paper...");
          }
          
          //Titre de la publication et lien
          HTML.push("<br><a target='blank' href=" + article["uri_s"] + "> " + article["title_s"] +  "</a>" );
          HTML.push("</li><br>");
        }
        
      }
      HTML.push("</ol>");
      //HTML.push("</div>")
    }
    HTML.push("</span>");
    document.getElementById("HAL").innerHTML = HTML.join("\n");
  }
  
  else{
    document.getElementById("HAL").innerHTML = "<p>Connection to <a href='http://hal.upmc.fr/'> failed...</a></p>";
    console.log(arr);
  }

}
