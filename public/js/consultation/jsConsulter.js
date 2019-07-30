var base_url = window.location.toString();
var tabUrl = base_url.split("public");

$(function(){
	//Les accordeons
//	$( "#accordionsssss").accordion();
//  $( "#accordionssss").accordion();
//	$( "#accordions_resultat" ).accordion();
//	$( "#accordions_demande" ).accordion();
//	$( "#accordionsss" ).accordion();

	$( "#accordionsMotifConstantes" ).accordion();
    $( "#accordions" ).accordion();
    
    
    //Les tables
    $( "#tabsAntecedents" ).tabs();
//	$( "#tabs" ).tabs();
//	$( "#tabsInstrumental,#tabsChirurgical" ).tabs();
    
    
    //Les boutons
    $( "button" ).button();
});
  













/**
 * GESTION DES ANTECEDENTS ET HISTORIQUES
 * GESTION DES ANTECEDENTS ET HISTORIQUES
 */

function scriptHistoriqueTerrainParticulier(){
	
	
	//CONSULTATION
	//CONSULTATION
	$("#titreTableauConsultation").toggle(false);
	$("#ListeConsultationPatient").toggle(false);
	$("#ListeCons").toggle(false);
	$("#boutonTerminerConsultation").toggle(false);
	
	//HOSPITALISATION
	//HOSPITALISATION
	$("#titreTableauHospitalisation").toggle(false);
	$("#boutonTerminerHospitalisation").toggle(false);
	$("#ListeHospitalisation").toggle(false);
	$("#ListeHospi").toggle(false);
	
	
	//CONSULTATION
	//CONSULTATION
	$(".image1").click(function(){
		
		 $("#MenuAntecedent").fadeOut(function(){ 
			 $("#titreTableauConsultation").fadeIn("fast");
			 $("#ListeConsultationPatient").fadeIn("fast"); 
			 $("#ListeCons").fadeIn("fast");
		     $("#boutonTerminerConsultation").toggle(true);
		     $(".pager").toggle(true);
		 });
	});
	
	setTimeout(function(){ 
		$(".TerminerConsultation" ).html("<button id='TerminerConsultation' style='height:35px;'>Terminer</button>"); 

		$("#TerminerConsultation").click(function(){
			$("#boutonTerminerConsultation").fadeOut();
			$(".pager").fadeOut();
			$("#titreTableauConsultation").fadeOut();
			$("#ListeCons").fadeOut();
			$("#ListeConsultationPatient").fadeOut(function(){ 
				$("#MenuAntecedent").fadeIn("fast");
			});
		
			return false;
		});
	
	},5000);
	
	
		
	//******************************************************************************
	//******************************************************************************
	//******************************************************************************
	
	//******************************************************************************
	//******************************************************************************
	//ANTECEDENTS PERSONNELS --- ANTECEDENTS PERSONNELS
	//ANTECEDENTS PERSONNELS --- ANTECEDENTS PERSONNELS
	$('#MenuAntecedentPersonnel').toggle(false);
	
	$(".image_fleche").click(function(){
		 $("#MenuAntecedentPersonnel").fadeOut(function(){ 
			 $("#MenuTerrainParticulier").fadeIn("fast");
		 });
	});
	
	$(".image1_TP").click(function(){
		 $("#MenuTerrainParticulier").fadeOut(function(){ 
			 $("#MenuAntecedentPersonnel").fadeIn("fast");
		 });
	});
	
	
		/**
		 * HABITUDE DE VIE (A Changer par : ) CONTENU DIABETE CONNU
		 */
		$(".image1_AP").click(function(){
			 $("#MenuAntecedentPersonnel").fadeOut(function(){ 
				 $("#ContenuDiabetiqueConnu").fadeIn("fast");
			 });
		});
		
		//setTimeout(function(){ 
			$(".TerminerContenuDiabetiqueConnu" ).html("<button id='TerminerContenuDiabetiqueConnu' style='height:35px;'>Terminer</button>"); 
		
			$("#TerminerContenuDiabetiqueConnu").click(function(){
				$("#ContenuDiabetiqueConnu").fadeOut(function(){ 
					$("#MenuAntecedentPersonnel").fadeIn("fast");
				});
	
				return false;
			}); 
		//},5000);
		
		
			
		/**
		 * GYNECO-OBSTETRIQUE (A Changer par : ) AUTRE TERRAIN CONNU
		 */
		$(".image4_AP").click(function(){
			 $("#MenuAntecedentPersonnel").fadeOut(function(){ 
				 $("#ContenuAutreTerrainConnu").fadeIn("fast");
			 });
		});
		
		//setTimeout(function(){ 
			$(".TerminerAutreTerrainConnu" ).html("<button id='TerminerAutreTerrainConnu' style='height:35px;'>Terminer</button>"); 
		
			$("#TerminerAutreTerrainConnu").click(function(){
				$("#ContenuAutreTerrainConnu").fadeOut(function(){ 
					$("#MenuAntecedentPersonnel").fadeIn("fast");
				});
	
				return false;
			}); 
		//},5000);
	   
		
		
	
	//ANTECEDENTS FAMILIAUX --- ANTECEDENTS FAMILIAUX
	//ANTECEDENTS FAMILIAUX --- ANTECEDENTS FAMILIAUX
    $('#MenuAntecedentsFamiliaux').toggle(false);
	
    $(".image2_TP").click(function(){ 
		$("#MenuTerrainParticulier").fadeOut(function(){ 
			 $("#MenuAntecedentsFamiliaux").fadeIn("fast");
		 });
	});
	
	//setTimeout(function(){ 
		$(".TerminerAntecedentsFamiliaux" ).html("<button id='TerminerAntecedentsFamiliaux' style='height:35px;'>Terminer</button>"); 
	
		$("#TerminerAntecedentsFamiliaux").click(function(){
			$("#MenuAntecedentsFamiliaux").fadeOut(function(){ 
				$("#MenuTerrainParticulier").fadeIn("fast");
			});

			return false;
		}); 
	//},5000);
			
		
}


//******************************************************************************
//******************************************************************************
//ANTECEDENTS PERSONNELS --- ANTECEDENTS PERSONNELS
//ANTECEDENTS PERSONNELS --- ANTECEDENTS PERSONNELS

function getContenuDiabeteConnu(id){
	if(id==1){
		$("#contenuDiabeteConnuSiOui").toggle(true);
	}else{
		$("#contenuDiabeteConnuSiOui").toggle(false);
	}
}

function getAutresTerrainConnuHtaSiOui(id){
	if(id==1){
		$(".colTraitement1").toggle(true);
		$(".colPlusTrait1").toggle(false);
		$(".colTerrainConnu1").css({"padding-right":"18px"});
	}else{
		$(".colTraitement1").toggle(false);
		$(".colPlusTrait1").toggle(true);
		$(".colTerrainConnu1").css({"padding-right":"25px"});
	}
}

function getDyslipidemieSiOui(id){
	if(id==1){
		$(".colTraitement2").toggle(true);
		$(".colPlusTrait2").toggle(false);
		$(".colDyslipidemie1").css({"padding-right":"18px"});
	}else{
		$(".colTraitement2").toggle(false);
		$(".colPlusTrait2").toggle(true);
		$(".colDyslipidemie1").css({"padding-right":"25px"});
	}
}

function getTabagismeSiOui(id){
	if(id==1){
		$(".colNbPaquet").toggle(true);
		$(".colPlusNbPaquet").toggle(false);
		$(".colTabagisme").css({"padding-right":"18px"});
	}else{
		$(".colNbPaquet").toggle(false);
		$(".colPlusNbPaquet").toggle(true);
		$(".colTabagisme").css({"padding-right":"25px"});
	}
}