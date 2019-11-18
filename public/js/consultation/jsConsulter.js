var base_url = window.location.toString();
var tabUrl = base_url.split("public");

$(function(){
	//Les accordeons
	$( "#accordions" ).accordion();
	$( "#consultationDeSuivi" ).accordion();
    
	
    
    //Les tables
    $( "#tabsAntecedents" ).tabs();

    
    
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
	$("#ListeConsultationsDeSuivisPatient").toggle(false);
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
			 $("#ListeConsultationsDeSuivisPatient").fadeIn("fast"); 
			 $("#ListeCons").fadeIn("fast");
		     $("#boutonTerminerConsultation").toggle(true);
		 });
	});
	
	setTimeout(function(){ 
		$(".TerminerConsultation" ).html("<button id='TerminerConsultation' style='height:35px;'>Terminer</button>"); 

		$("#TerminerConsultation").click(function(){ 
			$("#boutonTerminerConsultation").fadeOut();
			$("#titreTableauConsultation").fadeOut();
			$("#ListeCons").fadeOut();
			$("#ListeConsultationsDeSuivisPatient").fadeOut(function(){ 
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
	   
		
		/**
		 * ANTECEDENTS MEDICAUX --- ANTECEDENTS MEDICAUX
		 */
		$(".image2_AP").click(function(){
			 $("#MenuAntecedentPersonnel").fadeOut(function(){ 
				 $("#ContenuAntecedentsMedicaux").fadeIn("fast");
			 });
		});
		
		//setTimeout(function(){ 
			$(".TerminerAntecedentsMedicaux" ).html("<button id='TerminerAntecedentsMedicaux' style='height:35px;'>Terminer</button>"); 
		
			$("#TerminerAntecedentsMedicaux").click(function(){
				$("#ContenuAntecedentsMedicaux").fadeOut(function(){ 
					$("#MenuAntecedentPersonnel").fadeIn("fast");
				});
	
				return false;
			}); 
		//},5000);
			
			
		/**
		 * ANTECEDENTS CHIRURGICAUX --- ANTECEDENTS CHIRURGICAUX
		 */
		$(".image3_AP").click(function(){
			 $("#MenuAntecedentPersonnel").fadeOut(function(){ 
				 $("#ContenuAntecedentsChirurgicaux").fadeIn("fast");
			 });
		});
		
		//setTimeout(function(){ 
			$(".TerminerAntecedentsChirurgicaux" ).html("<button id='TerminerAntecedentsChirurgicaux' style='height:35px;'>Terminer</button>"); 
		
			$("#TerminerAntecedentsChirurgicaux").click(function(){
				$("#ContenuAntecedentsChirurgicaux").fadeOut(function(){ 
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
			
		
		
		
		
		
		
	$( "#annulerConsultation" ).click(function(){
			
		$( "#confirmationAnnulation" ).dialog({
			resizable: false,
		    height:180,
		    width:520,
		    autoOpen: false,
		    modal: true,
		    buttons: {
		    	"Non": function() {
		        	$( this ).dialog( "close" );
		        },
		        
		        "Oui": function() {
		        	$( this ).dialog( "close" );
		    		$(location).attr("href",tabUrl[0]+"public/consultation/liste-consultations");
		        },
		   }
		});
		
		$("#confirmationAnnulation").dialog('open');
		
		return false;
	});
		
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

function getChirurgieRapportAvecDiabete(id){
	if(id==1){
		$('#labelChirurgieRapportAvecDiabete').toggle(true);
	}else{
		$('#labelChirurgieRapportAvecDiabete').toggle(false);
	}
}

function getInfosAppareilAppelSysteme(interfaceChamp, id){ 
	if(id==0){
		$('.examenPhysiqueInfos'+interfaceChamp+', #examen_physique_plus').toggle(false);
	}else{
		$('.examenPhysiqueInfos'+interfaceChamp+', #examen_physique_plus').toggle(true);
	}
	
	var nbLigne = $('.champsAjoutAppareilSysteme').length; 
	$('#valueChampInputAppSysSelect_'+nbLigne).val($('.champInputAppSys_'+nbLigne+' select').val());
}

































/***
*=======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
									* Application du plugin PIKACHOOSE   
									* Application du plugin PIKACHOOSE
									* Application du plugin PIKACHOOSE
**======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
*/


/**
 * Application du plugin PIKACHOOSE
 * Application du plugin PIKACHOOSE
 * Application du plugin PIKACHOOSE
 */
function scriptExamenMorpho() {
   	   var a = function(self){
       	  self.anchor.fancybox();
        };
        $("#pikame").PikaChoose({buildFinished:a, carousel:true, carouselOptions:{wrap:'circular'}});
}
/***
 * PREMIER APPEL POUR LE CHARGEMENT DES IMAGES 
 * PREMIER APPEL POUR LE CHARGEMENT DES IMAGES 
 * PREMIER APPEL POUR LE CHARGEMENT DES IMAGES 
 */
var entre = 0;
function getimagesExamensMorphologiques()
{
	var idadmission = $("#idadmission").val(); 
	
	$.ajax({
          type: 'POST',
          url: tabUrl[0]+'public/consultation/image-iconographie',
          data: { 'ajout':0, 'idadmission': idadmission, 'position': 1 },
          success: function(data) {
        	  
        	  if(entre == 0){ RecupererImageAjouterDansBD(); entre = 1; }
        	  
              var result = jQuery.parseJSON(data);
              
              if(result != "") {
              		$("#pika2").fadeOut(function(){ 
              			$("#AjoutImage").toggle(true);
                      	$("#pika").html(result);
                      	return false;
                    });
              }
        }
     });
}


/**
 * AJOUTER DES IMAGES RADIOS
 * AJOUTER DES IMAGES RADIOS
 * AJOUTER DES IMAGES RADIOS
 */
function RecupererImageAjouterDansBD(){
	$('#AjoutImage input[type="file"]').change(function() {

		var file = $(this);
		var reader = new FileReader;
		var idadmission = $("#idadmission").val(); 
		
		reader.onload = function(event) {
    		var img = new Image();
            //Ici on recupere l'image 
		    document.getElementById('fichier_tmp').value = img.src = event.target.result;
		    $("#imageWaiting").html('<table style="width: 100%; text-align: center;"> <tr> <td style="font-size: 12px; color: red;"> Chargement en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');

		    /**
		     * CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
		    
	    	$.ajax({
	            type: 'POST',
	            url: tabUrl[0]+'public/consultation/image-iconographie',
	            data: {'ajout': 1, 'fichier_tmp': $("#fichier_tmp").val(), 'idadmission': idadmission, 'position':1},
	            success: function(data) {
	                var result = jQuery.parseJSON(data); 
	                if(result != ""){
	                	$("#pika2").fadeOut(function(){ 
		                	$("#pika").html(result);
		                	$("#imageWaiting").html("");
		                	return false;
		                });
	                }else{
	                	$("#imageWaiting").html("");
	                	alert("Fichier non reconnu"); return false;
	                }
	          }
	        });
	    	
	    	/**
		     * FIN CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
	};
	reader.readAsDataURL(file[0].files[0]);
	
  });
}

/**
 * Raffrichissement
 * @param idadmission
 */
function raffraichirImagesIconographies(idadmission)
{
     $.ajax({
        type: 'POST',
        url: tabUrl[0]+'public/consultation/image-iconographie',
        data: { 'ajout':0 , 'idadmission': idadmission, 'position':1},
        success: function(data) {
        	var result = jQuery.parseJSON(data); 
        	
            if(result != "") {
        		$("#pika2").fadeOut(function(){ 
                	$("#pika").html(result);
                	$("#imageWaiting").html("");
                	return false;
                });
        	}
            
            $("#imageWaiting").html("");
        }
     });
}


/**
 * Appel du pop-up de confirmation de la suppression
 * Appel du pop-up de confirmation de la suppression
 * Appel du pop-up de confirmation de la suppression
 */
function confirmerSuppression(id, idadmission){
	$('#nbImgPosAppSys1').html(id);

	$( "#confirmation" ).dialog({
	  resizable: false,
	  height:190,
	  width:420,
	  autoOpen: false,
	  modal: true,
		  buttons: {
			  
		      "Oui": function() {
		    	  
		          $( this ).dialog( "close" );
		
		          $("#imageWaiting").html('<table style="width: 100%; text-align: center;"> <tr> <td style=" font-size: 12px; color: red;"> Suppression en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');
		          
		          var chemin = tabUrl[0]+'public/consultation/supprimer-image-iconographie';
		          $.ajax({
		              type: 'POST',
		              url: chemin ,
		              data: { 'id':id, 'idadmission':idadmission, 'position':1 },
		              success: function() {
		            	  raffraichirImagesIconographies(idadmission);
		              }
		          });
		      },
		      
		      "Annuler": function() {
		          $( this ).dialog( "close" );
		      }
		 }
	 });
}

/**
 * Appel de la suppression
 * Appel de la suppression
 * Appel de la suppression
 */ 

function supprimerImage(id){
	var idadmission = $("#idadmission").val();

	if(temoinSupprImagePika2 == 50){ //Si c'est le NFS
		confirmerSuppressionOther(id, idadmission, 'Nfs');
		$("#confirmationNfs").dialog('open');
		
	}else if(temoinSupprImagePika2 == 51){ //Si c'est le ECG
		confirmerSuppressionOther(id, idadmission, 'Ecg');
		$("#confirmationEcg").dialog('open');
		
	}else if(temoinSupprImagePika2 == 52){ //Si c'est le RSD (Radiographie standard)
		confirmerSuppressionOther(id, idadmission, 'Rsd');
		$("#confirmationRsd").dialog('open');
		
	}else if(temoinSupprImagePika2 == 53){ //Si c'est le SCA (Scanner)
		confirmerSuppressionOther(id, idadmission, 'Sca');
		$("#confirmationSca").dialog('open');
		
	}else if(temoinSupprImagePika2 == 54){ //Si c'est le Eco (Echographie)
		confirmerSuppressionOther(id, idadmission, 'Eco');
		$("#confirmationEco").dialog('open');
		
	}else if(temoinSupprImagePika2 == 1){ //les images iconographies "position 1" dans examen physique
		confirmerSuppression(id, idadmission);
		$("#confirmation").dialog('open');
		
	}else if(temoinSupprImagePika2 == 100){ //les iconographies dans examens physiques pour SUIVI DES PATIENTS
		confirmerSuppressionAutoSuiv(id, temoinSupprImagePika2Suiv);
		$("#confirmationSuppSuiv"+temoinSupprImagePika2Suiv).dialog('open');
		
	}else if(temoinSupprImagePika2 == 101){ //les NFS pour SUIVI DES PATIENTS
		confirmerSuppressionOtherSuiv(id, 'Nfs');
		$("#confirmationSuivNfs").dialog('open');
		
	}else if(temoinSupprImagePika2 == 102){ //les Rsd pour SUIVI DES PATIENTS
		confirmerSuppressionOtherSuiv(id, 'Rsd');
		$("#confirmationSuivRsd").dialog('open');
		
	}else if(temoinSupprImagePika2 == 103){ //les Sca pour SUIVI DES PATIENTS
		confirmerSuppressionOtherSuiv(id, 'Sca');
		$("#confirmationSuivSca").dialog('open');
		
	}else if(temoinSupprImagePika2 == 104){ //les Eco pour SUIVI DES PATIENTS
		confirmerSuppressionOtherSuiv(id, 'Eco');
		$("#confirmationSuivEco").dialog('open');
		
	}else { //les autres images iconographies "à partir de la position 2" dans examen physique
		confirmerSuppressionAuto(id, idadmission, temoinSupprImagePika2);
		$("#confirmation"+temoinSupprImagePika2).dialog('open');
		
	}
	
}
/***
*=======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
**======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
**======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
*/












/***
*=======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
									* Ajout automatique d'examen physique APPAREIL ou SYSTEME 
									* Ajout automatique d'examen physique APPAREIL ou SYSTEME
									* Ajout automatique d'examen physique APPAREIL ou SYSTEME
**======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
*/
var tabDisabledSelect = [0,0,0,0,0,0,0,0,0];
var temoinSupprImagePika2 = 0;

function getModeleInputAppSys(id){
	
	var liste = '<select id="appareil_appel_systeme_'+id+'" style="font-size: 17px;" onchange="getInfosAppareilAppelSysteme('+id+', this.value)">'+
	               '<option value=0 ></option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[1]+'" value=1 >Appareil cardio-circulatoire</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[2]+'" value=2 >Appareil respiratoire</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[3]+'" value=3 >Appareil digestif</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[4]+'" value=4 >Appareil uro-g&egrave;nital</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[5]+'" value=5 >Appareil musculo-squelettique</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[6]+'" value=6 >Appareil cutan&eacute;o-t&eacute;gumentaire</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[7]+'" value=7 >Appareil h&eacute;matopoi&eacute;tique et glandulaire</option>'+
	               '<option class="disabledSelectOption'+tabDisabledSelect[8]+'" value=8 >Syst&egrave;me nerveux</option>'+
	            "</select>";
	
	return liste;
}

function ajouterExamenPhysiqueAppareilSysteme(){
	
	var nbLigne = $('.champsAjoutAppareilSysteme').length; 
	var valInputAppSysSelect = $('#valueChampInputAppSysSelect_'+nbLigne).val();
	tabDisabledSelect[valInputAppSysSelect] = 1;
	

	var nbImgPika1 = (nbLigne+1)*2;
	var nbImgPika2 = nbImgPika1+1;
	
	var interfaceChamps = '<table style="width:100%; margin-top: 10px; border-top: 2px solid #eeeeee;" class="champsAjoutAppareilSysteme champsAjoutAppareilSysteme_'+(nbLigne+1)+'">'+
						      
	                          '<tr style="width: 100%" class="designStyleLabel RadiusLabel">'+
							    '<td style="width: 59%; padding-top: 5px;">'+
						          '<label class="modeleInputAppSys champInputAppSys_'+(nbLigne+1)+'" style="width: 98%; height:30px; text-align:left; margin-bottom: 7px;">'+
						            '<span style="font-size: 14px;">&#10045; </span><span style="font-weight: bold; font-style: italic;">Appareil d\'appel ou syst&egrave;me - '+(nbLigne+1)+' </span>'+ 
						             getModeleInputAppSys((nbLigne+1))+
						          '</label>'+
						          '<input type="hidden" id="valueChampInputAppSysSelect_'+(nbLigne+1)+'"  name="valueChampInputAppSysSelect_'+(nbLigne+1)+'">'+
						          
						        '</td>'+
						        
						        '<td rowspan="2" style="width:41%; vertical-align: top; padding-top: 5px;">'+
		 			               '<div style="width: 95%; padding: 3px; padding-bottom: 1px; margin-left: 22px; display: none;" class="examenPhysiqueInfos'+(nbLigne+1)+' zoneContenuObmrePikaImg">'+

		 			               
				 			              '<table style="width: 100%;" >'+
		                    		        '<tr style="width: 100%" class="designStyleLabel">'+
		                    		           '<td style="width: 20%; padding-right: 23px; vertical-align: top;">'+
		                    		              '<label style="width: 100%; height:15px; text-align:left; line-height: 0.7em;">'+
				                           		    '<span style="font-size: 11px;">&#10148; </span><span>Iconographie</span>'+ 
				                                  '</label>'+
		                    		           '</td>'+
		                    		           
		                    		           '<td rowspan="2" style="width: 80%; padding-right: 23px;" id="zonePikaImage'+(nbLigne+1)+'">'+
		                    		           
		                                          '<div id="pika'+nbImgPika1+'" style="margin-top: 5px; margin-bottom: -15px;">'+
		                                            '<div id="pika'+nbImgPika2+'" align="center">'+
		                                               '<div class="pikachoose" style="height: 210px;">'+
		                                                  '<ul id="pikame'+(nbLigne+1)+'" class="jcarousel-skin-pika"></ul>'+
		                                               '</div>'+
		                                            '</div>'+
		                                          '</div>'+
		                                     
		                                          '<script> setTimeout(function(){ scriptPikameChoose('+(nbLigne+1)+'); }); </script>'+
                                                  '<script> setTimeout(function(){ scriptAddImageInDataBase('+(nbLigne+1)+'); }); </script>'+
                                                  '<script> setTimeout(function(){ $("#zonePikaImage'+(nbLigne+1)+'").hover(function(){ temoinSupprImagePika2 = '+(nbLigne+1)+';}); }); </script>'+
                                                  '<script> setTimeout(function(){ getImagesIconographiesAuto('+(nbLigne+1)+'); }); </script>'+
                                                  
		                                          '<div class="AjoutImage" id="AddImageAuto'+(nbLigne+1)+'" style="position: relative; bottom: 25px; left: 15px; float: right;">'+
		                                                 '<input type="file" name="fichier" />'+
					                                     '<input type="hidden" id="fichier_tmp'+(nbLigne+1)+'" name="fichier_tmp'+(nbLigne+1)+'" />'+
		                                          '</div>'+
		                    		           
		                    		           '</td>'+
		                    		        '</tr>'+
		                    		        
		                    		        '<tr style="width: 100%; height: 197px;">'+
		                    		           '<td style="width: 20%; padding-right: 23px;" id="imageWaiting'+(nbLigne+1)+'"></td>'+
		                    		        '</tr>'+
		                    		        
		                   		         '</table>'+
		                    		   
						                 '<div id="confirmation'+(nbLigne+1)+'" title="Confirmation de la suppression" style="display:none;">'+
						                   '<p style="font-size: 14px;">'+
						                      '<span style="float:left; margin:0 0px 20px 0; ">'+
						                      '<img src="../images_icons/warning_16.png" />'+
						                      'Etes-vous s&ucirc;r de vouloir supprimer l\'image n&deg;<span id="nbImgPosAppSys'+(nbLigne+1)+'"></span> <br> (Appareil ou systeme - '+(nbLigne+1)+')?</span>'+
						                   '</p>'+
						                 '</div>'+
		 			               
		 			               
		 			               '</div>'+
			 			        '</td>'+
			                  '</tr>'+
		                         
			                  
			 			      '<tr style="width:100%;">'+
		                        '<td style="width:59%; vertical-align: top;" class="zoneContenuObmre">'+
		                           '<div style="width: 100%; padding: 3px; padding-bottom: 1px; display: none;" class="examenPhysiqueInfos'+(nbLigne+1)+'">'+

		                           
			                           '<table style="width: 100%;" >'+
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Inspection </span> '+
			                                    '<input  type="Text" id="inspection_'+(nbLigne+1)+'" name="inspection_'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;"> '+
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Palpation  </span>'+ 
			                                    '<input  type="Text" id="palpitation_'+(nbLigne+1)+'" name="palpitation_'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Percussion   </span>'+ 
			                                    '<input  type="Text" id="percussion_'+(nbLigne+1)+'" name="percussion_'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Auscultation    </span>'+ 
			                                    '<input  type="Text" id="auscultation_'+(nbLigne+1)+'"  name="auscultation_'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
		 			                 '</table>'+
		                           
		                           
		                           '</div>'+
			 			        '</td>'+
						      '</tr>'+  
						      
						  '</table>';

	
	$('.champsAjoutAppareilSysteme_'+(nbLigne)).after(interfaceChamps);
	
	if((nbLigne+1) > 1){ 
		$('#examen_physique_moins').toggle(true);
	}else if((nbLigne+1) == 1){
		$('#examen_physique_plus').toggle(false);
	}
	
	$('#examen_physique_plus').toggle(false);
	$('.champInputAppSys_'+nbLigne+' select').attr("disabled", true);
	$(".disabledSelectOption1").toggle(false);
	$(".disabledSelectOption0").toggle(true);
	
	$('#nbChampsInputAppSysSelect').val(nbLigne+1);
}


function enleverExamenPhysiqueAppareilSysteme(){
	
	var nbLigne = $('.champsAjoutAppareilSysteme').length; 
	if(nbLigne > 1){
		$('.champsAjoutAppareilSysteme_'+nbLigne).remove();
		if(nbLigne == 2){ $('#examen_physique_moins').toggle(false); }
		
		$('#examen_physique_plus').toggle(true);
		$('.champInputAppSys_'+(nbLigne-1)+' select').attr("disabled", false);
		
		var valInputAppSysSelect = $('#valueChampInputAppSysSelect_'+(nbLigne-1)).val();
		tabDisabledSelect[valInputAppSysSelect] = 0;
		
		$('#nbChampsInputAppSysSelect').val(nbLigne-1);
	}
	
}


function scriptPikameChoose(id) {
	var ab = function(self){ self.anchor.fancybox(); };
	$("#pikame"+id).PikaChoose({buildFinished:ab, carousel:true,carouselOptions:{wrap:'circular'}});
}


function scriptAddImageInDataBase(id){
	
	$('#AddImageAuto'+id+' input[type="file"]').change(function() {

		var file = $(this);
		var reader = new FileReader;
		var idadmission = $("#idadmission").val(); 
		
		reader.onload = function(event) {
    		var img = new Image();
            //Ici on recupere l'image 
		    document.getElementById('fichier_tmp'+id).value = img.src = event.target.result;
		    $("#imageWaiting"+id).html('<table style="width: 100%; text-align: center;"> <tr> <td style="font-size: 12px; color: red;"> Chargement en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');

		    /**
		     * CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
		    
	    	$.ajax({
	            type: 'POST',
	            url: tabUrl[0]+'public/consultation/image-iconographie',
	            data: {'ajout': 1, 'fichier_tmp': $("#fichier_tmp"+id).val(), 'idadmission': idadmission, 'position':id},
	            success: function(data) {
	                var result = jQuery.parseJSON(data); 
	                if(result != ""){
	                	var nbImgPika1 = id*2;
	                	var nbImgPika2 = nbImgPika1+1;
	                	
	                	$("#pika"+nbImgPika2).fadeOut(function(){ 
		                	$("#pika"+nbImgPika1).html(result);
		                	$("#imageWaiting"+id).html("");
		                	return false;
		                });
	                }else{
	                	$("#imageWaiting"+id).html("");
	                	alert("Fichier non reconnu"); return false;
	                }
	          }
	        });
	    	
	    	/**
		     * FIN CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
	};
	reader.readAsDataURL(file[0].files[0]);
	
  });
}

function confirmerSuppressionAuto(id, idadmission, position){
	
	$('#nbImgPosAppSys'+position).html(id);

	$( "#confirmation"+position ).dialog({
	  resizable: false,
	  height:190,
	  width:420,
	  autoOpen: false,
	  modal: true,
		  buttons: {
			  
		      "Oui": function() {
		    	  
		          $( this ).dialog( "close" );
		
		          $("#imageWaiting"+position).html('<table style="width: 100%; text-align: center;"> <tr> <td style=" font-size: 12px; color: red;"> Suppression en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');
		          
		          var chemin = tabUrl[0]+'public/consultation/supprimer-image-iconographie';
		          $.ajax({
		              type: 'POST',
		              url: chemin ,
		              data: { 'id':id, 'idadmission':idadmission, 'position':position },
		              success: function() {
		            	  raffraichirImagesIconographiesAuto(idadmission, position);
		              }
		          });
		      },
		      
		      "Annuler": function() {
		          $( this ).dialog( "close" );
		      }
		 }
	 });
}


function raffraichirImagesIconographiesAuto(idadmission, position)
{
     $.ajax({
        type: 'POST',
        url: tabUrl[0]+'public/consultation/image-iconographie',
        data: { 'ajout':0 , 'idadmission': idadmission, 'position':position},
        success: function(data) {
        	var result = jQuery.parseJSON(data); 
        	
            if(result != "") {
        		
        		var nbImgPika1 = position*2;
            	var nbImgPika2 = nbImgPika1+1;
            	
            	$("#pika"+nbImgPika2).fadeOut(function(){ 
                	$("#pika"+nbImgPika1).html(result);
                	$("#imageWaiting"+position).html("");
                	return false;
                });
        		
        	}
            
            $("#imageWaiting"+position).html("");
        }
     });
}


function getImagesIconographiesAuto(position){
	
	var idadmission = $("#idadmission").val(); 
	
	$.ajax({
		
          type: 'POST',
          url: tabUrl[0]+'public/consultation/image-iconographie',
          data: { 'ajout':0, 'idadmission': idadmission, 'position': position},
          success: function(data) {
              var result = jQuery.parseJSON(data);
              
              if(result != "") {
              	var nbImgPika1 = position*2;
              	var nbImgPika2 = nbImgPika1+1;
              	
              	$("#pika"+nbImgPika2).fadeOut(function(){ 
	                	$("#pika"+nbImgPika1).html(result);
	                	$("#imageWaiting"+position).html("");
	                	return false;
	                });
              }
              
          }
          
     });
}



































/***
*=======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
									* Ajout automatique d' Examens biologiques 
									* Ajout automatique d' Examens biologiques 
									* Ajout automatique d' Examens biologiques 
**======================================================================================================================================
*=======================================================================================================================================
*=======================================================================================================================================
*/

function scriptPikameChooseOther(examen) {
	var ab = function(self){ self.anchor.fancybox(); }
	$("#pikame"+examen).PikaChoose({buildFinished:ab, carousel:true,carouselOptions:{wrap:'circular'}});
}



function scriptAddImageInDataBaseOther(examen){
	
	$('#AjoutImage'+examen+' input[type="file"]').change(function() {

		var file = $(this);
		var reader = new FileReader;
		var idadmission = $("#idadmission").val(); 
		
		reader.onload = function(event) {
    		var img = new Image();
            //Ici on recupere l'image 
		    document.getElementById('fichier_tmp'+examen).value = img.src = event.target.result;
		    $("#imageWaiting"+examen).html('<table style="width: 100%; text-align: center;"> <tr> <td style="font-size: 12px; color: red;"> Chargement en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');

		    // CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		    
	    	$.ajax({
	            type: 'POST',
	            url: tabUrl[0]+'public/consultation/images-differents-examens',
	            data: {'ajout': 1, 'fichier_tmp': $("#fichier_tmp"+examen).val(), 'idadmission': idadmission, 'examen':examen},
	            success: function(data) {
	                var result = jQuery.parseJSON(data); 
	                if(result != ""){
	                	
	                	$("#pika2"+examen).fadeOut(function(){ 
		                	$("#pika"+examen).html(result);
		                	$("#imageWaiting"+examen).html("");
		                	return false;
		                });
	                }else{
	                	$("#imageWaiting"+examen).html("");
	                	alert("Fichier non reconnu"); return false;
	                }
	          }
	        });
	    	
	    	// FIN CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
	    	
	};
	reader.readAsDataURL(file[0].files[0]);
	
  });
}


function confirmerSuppressionOther(id, idadmission, examen){
	$('#nbImagesPositionPopup'+examen).html(id);
	
	$( "#confirmation"+examen ).dialog({
	  resizable: false,
	  height:175,
	  width:420,
	  autoOpen: false,
	  modal: true,
		  buttons: {
			  
		      "Oui": function() {
		    	  
		          $( this ).dialog( "close" );
		
		          $("#imageWaiting"+examen).html('<table style="width: 100%; text-align: center;"> <tr> <td style=" font-size: 12px; color: red;"> Suppression en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');
		          
		          var chemin = tabUrl[0]+'public/consultation/supprimer-images-differents-examens';
		          $.ajax({
		              type: 'POST',
		              url: chemin ,
		              data: { 'id':id, 'idadmission':idadmission, 'examen':examen },
		              success: function(data) {
		            	  var result = jQuery.parseJSON(data);
		            	  scriptRaffraichirImagesExamenOther(idadmission, examen);
		              }
		          });
		      },
		      
		      "Annuler": function() {
		          $( this ).dialog( "close" );
		      }
		 }
	 });
}


function scriptRaffraichirImagesExamenOther(idadmission, examen)
{
     $.ajax({
        type: 'POST',
        url: tabUrl[0]+'public/consultation/images-differents-examens',
        data: { 'ajout':0 , 'idadmission': idadmission, 'examen':examen},
        success: function(data) {
        	var result = jQuery.parseJSON(data); 
        	
            if(result != "") {
            	$("#pika2"+examen).fadeOut(function(){ 
                	$("#pika"+examen).html(result);
                	$("#imageWaiting"+examen).html("");
                	return false;
                });
        	}
            
            $("#imageWaiting"+examen).html("");
        }
        
     });
     
}


function getImagesExamensOther(examen){
	
	var idadmission = $("#idadmission").val(); 
	
	$.ajax({
		
          type: 'POST',
          url: tabUrl[0]+'public/consultation/images-differents-examens',
          data: { 'ajout':0, 'idadmission': idadmission, 'examen': examen},
          success: function(data) {
              var result = jQuery.parseJSON(data);
              
              if(result != "") {
              	$("#pika2"+examen).fadeOut(function(){ 
              		$("#pika"+examen).html(result);
                  	$("#imageWaiting"+examen).html("");
              	});
              	return false;
          	}
              
          }
          
     });
}







































var tabDisabledComplicationSelect = [0,0,0,0,0,0,0,0,0,0];

function getModeleComplicationSelect(id){
	
	var liste = '<select id="listeComplicationsSelect_'+id+'" style="float:right; width: 60%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;" onchange="getComplicationDisabledSelect('+id+', this.value)">'+
	               '<option value=0 ></option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[1]+'" value=1 >Acido-c&eacute;tose</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[2]+'" value=2 >Coma hyperosmolaire</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[3]+'" value=3 >N&eacute;phropathie diab&egrave;tique</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[4]+'" value=4 >R&eacute;tinopathie diab&egrave;tique</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[5]+'" value=5 >Neuropathie p&eacute;riph&eacute;rique</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[6]+'" value=6 >ACOMI</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[7]+'" value=7 >AVC</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[8]+'" value=8 >IDM</option>'+
	               '<option class="disabledComplicationSelectOption'+tabDisabledComplicationSelect[9]+'" value=9 >Pied diab&egrave;tique</option>'+
	            "</select>";
	
	return liste;
}


function getComplicationDisabledSelect(ligne, id){ 
	
	if(id==0){
		$('#complication_plus').toggle(false);
	}else{
		$('#complication_plus').toggle(true);
		
		var nbLigne = $('.complicationDiagEntree').length; 
		$('#valueChampInputComplication_'+nbLigne).val($('.champInputComplication_'+nbLigne+' select').val());
	}
	
}

function ajouterComplicationDiagEntree(){ 
	
	var nbLigne = $('.complicationDiagEntree').length; 
	var valInputComplicationSelect = $('#valueChampInputComplication_'+nbLigne).val();
	tabDisabledComplicationSelect[valInputComplicationSelect] = 1;
	
	
	
	var interfaceChamps = '<table style="width: 100%;" class="complicationDiagEntree complicationDiagEntree_'+(nbLigne+1)+'">'+
	                        '<tr style="width: 100%" class="designStyleLabel">'+
		        
							   '<td style="width: 40%; padding-right: 25px;" class="complicationDiagEntCol1">'+
							     '<label class="modeleChampInputComplication champInputComplication_'+(nbLigne+1)+'" style="width: 100%; height:30px; text-align:left;">'+
						           '<span style="font-size: 11px;">&#10148; </span><span>Complication '+(nbLigne+1)+' </span>'+ 
						           getModeleComplicationSelect((nbLigne+1))+
						         '</label>'+
						         '<input type="hidden" id="valueChampInputComplication_'+(nbLigne+1)+'" name="valueChampInputComplication_'+(nbLigne+1)+'">'+
							   '</td>'+
							   
							   '<td style="width: 60%; padding-right: 13px;" class="complicationDiagEntCol2">'+
							     '<label style="width: 100%; height:30px; margin-left: -10px; text-align:right;">'+
							       '<span> Note '+(nbLigne+1)+'&nbsp;&nbsp; </span>'+ 
							       '<input type="Text" id="noteInputComplication_'+(nbLigne+1)+'" name="noteInputComplication_'+(nbLigne+1)+'" style="float:right; width: 85%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+
							     '</label>'+
							   '</td>'+
							   
	                        '</tr>'+
                          '</table>';
	
	
	
	
	
	$('.complicationDiagEntree_'+(nbLigne)).after(interfaceChamps);
	
	if((nbLigne+1) > 1){ 
		$('#complication_moins').toggle(true);
	}else if((nbLigne+1) == 1){
		$('#complication_plus').toggle(false);
	}
	
	if(nbLigne == 0){ $('#complication_moins').toggle(false); }

	$('#complication_plus').toggle(false);
	$('.champInputComplication_'+nbLigne+' select').attr("disabled", true);
	$(".disabledComplicationSelectOption1").toggle(false);
	$(".disabledComplicationSelectOption0").toggle(true);
	
	$('#nbComplicationDiagEntree').val(nbLigne+1);
}


function enleverComplicationDiagEntree(){
	
	var nbLigne = $('.complicationDiagEntree').length; 
	if(nbLigne > 1){
		$('.complicationDiagEntree_'+nbLigne).remove();
		if(nbLigne == 2){ $('#complication_moins').toggle(false); }
		
		$('#complication_plus').toggle(true);
		$('.champInputComplication_'+(nbLigne-1)+' select').attr("disabled", false);
		
		var valInputComplicationSelect = $('#valueChampInputComplication_'+(nbLigne-1)).val();
		tabDisabledComplicationSelect[valInputComplicationSelect] = 0;
		
		$('#nbComplicationDiagEntree').val(nbLigne-1);
	}
	
}


function getHospitalisationInfos(id){
	if(id==1){
		$("#hospitalisationInfos").toggle(true);
	}else{
		$("#hospitalisationInfos").toggle(false);
	}
	
}




































/**
 * -------------------------------------------------------------------------
 * *************************************************************************
 * '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
 * PARTIE GESTION DU SUIVI DU PATIENT --- PARTIE GESTION DU SUIVI DU PATIENT
 * PARTIE GESTION DU SUIVI DU PATIENT --- PARTIE GESTION DU SUIVI DU PATIENT
 * PARTIE GESTION DU SUIVI DU PATIENT --- PARTIE GESTION DU SUIVI DU PATIENT
 * =========================================================================
 * =========================================================================
 * """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
 * _________________________________________________________________________
 *  
 */ 

/**
 * PLAINTES DE LA CONSULTATION DE SUIVI --- PLAINTES DE LA CONSULTATION DE SUIVI
 * PLAINTES DE LA CONSULTATION DE SUIVI --- PLAINTES DE LA CONSULTATION DE SUIVI
 * PLAINTES DE LA CONSULTATION DE SUIVI --- PLAINTES DE LA CONSULTATION DE SUIVI
 */


var tabDisabledPlainteSelect = [0,0,0,0,0,0];

function getModelePlainteSelect(id){
	
	var liste = '<select id="listePlaintesSelect_'+id+'" style="float:right; width: 60%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;" onchange="getPlainteDisabledSelect('+id+', this.value)">'+
	               '<option value=0 ></option>'+
	               '<option class="disabledPlainteSelectOption'+tabDisabledPlainteSelect[1]+'" value=1 >Polyurie</option>'+
	               '<option class="disabledPlainteSelectOption'+tabDisabledPlainteSelect[2]+'" value=2 >Polydipsie</option>'+
	               '<option class="disabledPlainteSelectOption'+tabDisabledPlainteSelect[3]+'" value=3 >Polyphagie</option>'+
	               '<option class="disabledPlainteSelectOption'+tabDisabledPlainteSelect[4]+'" value=4 >Alt&eacute;ration de l\'&eacute;tat g&eacute;n&eacute;ral</option>'+
	               '<option class="disabledPlainteSelectOption'+tabDisabledPlainteSelect[5]+'" value=5 >Amaigrissement</option>'+
	            "</select>";
	
	return liste;
}


var tableauPlaintesSelectionnees = new Array();
var tableauNotePlaintesSelect = new Array();

function getPlainteDisabledSelect(ligne, id){
	
	if(id==0){
		$('#plainte_plus').toggle(false);
		
		/**Enregistrer les plaintes dans la table**/
		tableauPlaintesSelectionnees[ligne] = -1;
	}else{
		$('#plainte_plus').toggle(true);
		
		var nbLigne = $('.plainteEntree').length; 
		$('#valueChampInputPlainte_'+nbLigne).val($('.champInputPlainte_'+nbLigne+' select').val());
		
		/**Enregistrer les plaintes dans la table**/
		tableauPlaintesSelectionnees[nbLigne] = $('#valueChampInputPlainte_'+nbLigne).val();
	}
	
}


function ajouterUneNouvellePlainte(){
	
	var nbLigne = $('.plainteEntree').length; 
	var valInputPlainteSelect = $('#valueChampInputPlainte_'+nbLigne).val();
	tabDisabledPlainteSelect[valInputPlainteSelect] = 1;
	
	
	var interfaceChamps = '<table style="width: 100%;" class="plainteEntree plainteEntree_'+(nbLigne+1)+'">'+
	                        '<tr style="width: 100%" class="designStyleLabel">'+
		        
							   '<td style="width: 40%; padding-right: 25px;" class="PlainteDiagEntCol1">'+
							     '<label class="modeleChampInputPlainte champInputPlainte_'+(nbLigne+1)+'" style="width: 100%; height:30px; text-align:left;">'+
							       '<span id="suppPlainteEntree_'+(nbLigne+1)+'" onclick="suppPlainteEntree('+(nbLigne+1)+');" style="visibility: hidden; color: red; position: relative; font-family: arial; top: -10px; margin-left: 0px; font-size: 12px;">X</span>'+
						           '<span style="font-size: 11px;">&#10148; </span><span>Plainte '+(nbLigne+1)+' </span>'+ 
						           getModelePlainteSelect((nbLigne+1))+
						         '</label>'+
						         '<input type="hidden" id="valueChampInputPlainte_'+(nbLigne+1)+'" name="valueChampInputPlainte_'+(nbLigne+1)+'">'+
							   '</td>'+
							   
							   '<td style="width: 60%; padding-right: 13px;" class="PlainteDiagEntCol2">'+
							     '<label style="width: 100%; height:30px; margin-left: -10px; text-align:right;">'+
							       '<span> Note &nbsp;&nbsp; </span>'+ 
							       '<input type="Text" id="noteInputPlainte_'+(nbLigne+1)+'" name="noteInputPlainte_'+(nbLigne+1)+'" style="float:right; width: 85%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+
							     '</label>'+
							   '</td>'+
							   
	                        '</tr>'+
                          '</table>';
	
	
	$('.plainteEntree_'+(nbLigne)).after(interfaceChamps);
	
	
	if((nbLigne+1) > 1){
		$('#plainte_moins').toggle(true);
	}else if((nbLigne+1) == 1){
		$('#plainte_plus').toggle(false);
	}
	
	if(nbLigne == 0){ $('#plainte_moins').toggle(false); }

	$('#plainte_plus').toggle(false);
	$('.champInputPlainte_'+nbLigne+' select').attr("disabled", true);
	$(".disabledPlainteSelectOption1").toggle(false);
	$(".disabledPlainteSelectOption0").toggle(true);
	
	$('#nbPlaintesEntree').val(nbLigne+1);
	
	
	/**Affichage de l'icone supprime**/
	$(".plainteEntree_"+(nbLigne+1)+" label").hover(function(){
		$("#suppPlainteEntree_"+(nbLigne+1)).css({'visibility':'visible'});
	},function(){
		$("#suppPlainteEntree_"+(nbLigne+1)).css({'visibility':'hidden'});
	});
	
	/**Gestion de la note des plaintes**/
	$('#noteInputPlainte_'+(nbLigne+1)).keyup(function(){
		tableauNotePlaintesSelect[nbLigne+1] = $(this).val(); 
	});
	
}


function enleverUnePlainte(){
	
	var nbLigne = $('.plainteEntree').length; 
	if(nbLigne > 1){
		$('.plainteEntree_'+nbLigne).remove();
		if(nbLigne == 2){ $('#plainte_moins').toggle(false); }
		
		$('#plainte_plus').toggle(true);
		$('.champInputPlainte_'+(nbLigne-1)+' select').attr("disabled", false);
		
		var valInputPlainteSelect = $('#valueChampInputPlainte_'+(nbLigne-1)).val();
		tabDisabledPlainteSelect[valInputPlainteSelect] = 0;
		
		$('#nbPlaintesEntree').val(nbLigne-1);
		
		/**Enregistrer les plaintes dans la table**/
		tableauPlaintesSelectionnees[nbLigne] = -1;
	}
	
}


function suppPlainteEntree(id){
	
	$('#suppPlainteEntree_'+id).w2overlay({ html: "" +
		"" +
		"<div style='border-bottom: 1px solid gray; height: 28px; background: #f9f9f9; width: 100px; text-align:center; padding-top: 10px; font-size: 13px; color: gray; font-weight: bold;'>Supprimer</div>" +
		"<div style='height: 35px; width: 80px; padding-top: 10px; margin-left: 10px;'>" +
		"<button class='commentChoicePVBut' onclick='popupFermer();'>Non</button>"+
		"<button class='commentChoicePVBut' onclick='supprimerLaPlainte("+id+");'>Oui</button>"+
		"</div>"+
		"<style> .w2ui-overlay{ margin-left: -35px; border: 1px solid gray; } </style>"
	});

}


function popupFermer() {
	$(null).w2overlay(null);
}


function supprimerLaPlainte(id){
	$(null).w2overlay(null);
	
	/**On élimine la valeur à supprimer*/
	tableauPlaintesSelectionnees[id] = -1;
	var tamponTableauPlainteSelect = tableauPlaintesSelectionnees;
	
	/**On réinitialise tout*/
	$(".plainteEntree").remove();
	tableauPlaintesSelectionnees = new Array();
	tabDisabledPlainteSelect = [0,0,0,0,0,0];
	
	/**On affiche les nouvelles valeurs*/
	var indice = 1;
	var newTableauNotePlaintesSelect = new Array();
	for(var i=1 ; i<tamponTableauPlainteSelect.length ; i++){
		
		if(tamponTableauPlainteSelect[i] != -1){
			ajouterUneNouvellePlainte();
			newTableauNotePlaintesSelect[indice] = tableauNotePlaintesSelect[i];
			$("#listePlaintesSelect_"+indice).val(tamponTableauPlainteSelect[i]).trigger('change');
			$('#noteInputPlainte_'+indice).val(tableauNotePlaintesSelect[i]);
			
			indice++;
		}else if(i==1 && (i+1)==tamponTableauPlainteSelect.length){
			ajouterUneNouvellePlainte();
		}
	}
	
	tableauNotePlaintesSelect = newTableauNotePlaintesSelect;
	
}


/**
 * EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL
 * EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL
 * EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL --- EXAMEN GENERAL
 */

function getValeurIMCSuiv(id){
	var poids_suiv = $("#poids_suiv").val();
	var taille_suiv = $("#taille_suiv").val();
	
	if(poids_suiv && taille_suiv){
		var taille_metre = (taille_suiv/100).toFixed(2);
		var taille_metre_carre = (taille_metre*taille_metre).toFixed(2);
		
		var resultat = poids_suiv/taille_metre_carre;
		$("#imc_constante_suiv").val(resultat.toFixed(1));
	}
}

function getValeurIMC(id){
	var poids  = $("#poids").val();
	var taille = $("#taille").val();
	
	if(poids && taille){
		var taille_metre = (taille/100).toFixed(2);
		var taille_metre_carre = (taille_metre*taille_metre).toFixed(2);
		
		var resultat = poids/taille_metre_carre;
		$("#imc_constante").val(resultat.toFixed(1));
	}
}








/**
 * APPAREIL ou SYSTEME --- APPAREIL ou SYSTEME  --- APPAREIL ou SYSTEME  
 * APPAREIL ou SYSTEME --- APPAREIL ou SYSTEME  --- APPAREIL ou SYSTEME  
 * APPAREIL ou SYSTEME --- APPAREIL ou SYSTEME  --- APPAREIL ou SYSTEME  
 */
var tabDisabledSelectSuiv = [0,0,0,0,0,0,0,0,0];
var temoinSupprImagePika2Suiv = 0;

function getModeleInputAppSysSuiv(id){
	
	var liste = '<select id="appareil_appel_systeme_suiv_'+id+'" style="font-size: 16px;" onchange="getInfosAppareilAppelSystemeSuiv('+id+', this.value)">'+
	               '<option value=0 ></option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[1]+'" value=1 >Appareil cardio-circulatoire</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[2]+'" value=2 >Appareil respiratoire</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[3]+'" value=3 >Appareil digestif</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[4]+'" value=4 >Appareil uro-g&egrave;nital</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[5]+'" value=5 >Appareil musculo-squelettique</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[6]+'" value=6 >Appareil cutan&eacute;o-t&eacute;gumentaire</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[7]+'" value=7 >Appareil h&eacute;matopoi&eacute;tique et glandulaire</option>'+
	               '<option class="disabledSelectOptionSuiv'+tabDisabledSelectSuiv[8]+'" value=8 >Syst&egrave;me nerveux</option>'+
	            "</select>";
	
	return liste;
}

function ajouterExamenPhysiqueAppareilSystemeSuiv(){
	
	var nbLigne = $('.champsAjoutAppareilSystemeSuiv').length; 
	var valInputAppSysSelectSuiv = $('#valueChampInputAppSysSelectSuiv_'+nbLigne).val();
	tabDisabledSelectSuiv[valInputAppSysSelectSuiv] = 1;
	
	var nbImgPika1 = (nbLigne+1)*2;
	var nbImgPika2 = nbImgPika1+1;
	
	var interfaceChamps = '<table style="width:100%; margin-top: 10px; border-top: 2px solid #eeeeee;" class="champsAjoutAppareilSystemeSuiv champsAjoutAppareilSystemeSuiv_'+(nbLigne+1)+'">'+
						      
	                          '<tr style="width: 100%" class="designStyleLabel RadiusLabel">'+
							    '<td style="width: 55%; padding-top: 5px;">'+
						          '<label class="modeleInputAppSys champInputAppSysSuiv_'+(nbLigne+1)+'" style="width: 98%; height:30px; text-align:left; margin-bottom: 7px;">'+
						            '<span style="font-size: 14px;">&#10045; </span><span style="font-weight: bold; font-style: italic;">Appareil d\'appel - '+(nbLigne+1)+' </span>'+ 
						             getModeleInputAppSysSuiv((nbLigne+1))+
						          '</label>'+
						          '<input type="hidden" id="valueChampInputAppSysSelectSuiv_'+(nbLigne+1)+'"  name="valueChampInputAppSysSelectSuiv_'+(nbLigne+1)+'">'+
						          
						        '</td>'+
						        
						        '<td rowspan="2" style="width:45%; vertical-align: top; padding-top: 5px;">'+
		 			               '<div style="width: 95%; padding: 3px; padding-bottom: 1px; margin-left: 22px; display: none;" class="examenPhysiqueInfosSuiv'+(nbLigne+1)+' zoneContenuObmrePikaImg">'+

		 			               
				 			              '<table style="width: 100%;" >'+
		                    		        '<tr style="width: 100%" class="designStyleLabel">'+
		                    		           '<td style="width: 20%; padding-right: 23px; vertical-align: top;">'+
		                    		              '<label style="width: 100%; height:15px; text-align:left; line-height: 0.7em;">'+
				                           		    '<span style="font-size: 11px;">&#10148; </span><span>Iconographie</span>'+ 
				                                  '</label>'+
		                    		           '</td>'+
		                    		           
		                    		           '<td rowspan="2" style="width: 80%; padding-right: 23px;" id="zonePikaImageSuiv'+(nbLigne+1)+'">'+
		                    		           
		                                          '<div id="pikaSuiv'+nbImgPika1+'" style="margin-top: 5px; margin-bottom: -15px;">'+
		                                            '<div id="pikaSuiv'+nbImgPika2+'" align="center">'+
		                                               '<div class="pikachoose" style="height: 210px;">'+
		                                                  '<ul id="pikameSuiv'+(nbLigne+1)+'" class="jcarousel-skin-pika"></ul>'+
		                                               '</div>'+
		                                            '</div>'+
		                                          '</div>'+
		                                     
		                                          '<script> setTimeout(function(){ scriptPikameChooseSuiv('+(nbLigne+1)+'); }); </script>'+
                                                  '<script> setTimeout(function(){ scriptAddImageInDataBaseSuiv('+(nbLigne+1)+'); }); </script>'+
                                                  '<script> setTimeout(function(){ $("#zonePikaImageSuiv'+(nbLigne+1)+'").hover(function(){ temoinSupprImagePika2 = 100; temoinSupprImagePika2Suiv = '+(nbLigne+1)+';}); }); </script>'+
                                                  '<script> setTimeout(function(){ getImagesIconographiesAutoSuiv('+(nbLigne+1)+'); }); </script>'+
                                                  
		                                          '<div class="AjoutImage" id="AddImageAutoSuiv'+(nbLigne+1)+'" style="position: relative; bottom: 25px; left: 15px; float: right;">'+
		                                                 '<input type="file" name="fichier" />'+
					                                     '<input type="hidden" id="fichier_tmp_Suiv'+(nbLigne+1)+'" name="fichier_tmp_Suiv'+(nbLigne+1)+'" />'+
		                                          '</div>'+
		                    		           
		                    		           '</td>'+
		                    		        '</tr>'+
		                    		        
		                    		        '<tr style="width: 100%; height: 197px;">'+
		                    		           '<td style="width: 20%; padding-right: 23px;" id="imageWaitingSuiv'+(nbLigne+1)+'"></td>'+
		                    		        '</tr>'+
		                    		        
		                   		         '</table>'+
		                    		   
						                 '<div id="confirmationSuppSuiv'+(nbLigne+1)+'" title="Confirmation de la suppression" style="display:none;">'+
						                   '<p style="font-size: 14px;">'+
						                      '<span style="float:left; margin:0 0px 20px 0; ">'+
						                      '<img src="../images_icons/warning_16.png" />'+
						                      'Etes-vous s&ucirc;r de vouloir supprimer l\'image n&deg;<span id="nbImgPosAppSysSuiv'+(nbLigne+1)+'"></span> <br> (Appareil ou systeme - '+(nbLigne+1)+')?</span>'+
						                   '</p>'+
						                 '</div>'+
		 			               
		 			               
		 			               '</div>'+
			 			        '</td>'+
			                  '</tr>'+
		                         
			                  
			 			      '<tr style="width:100%;">'+
		                        '<td style="width:55%; vertical-align: top;" class="zoneContenuObmre">'+
		                           '<div style="width: 100%; padding: 3px; padding-bottom: 1px; display: none;" class="examenPhysiqueInfosSuiv'+(nbLigne+1)+'">'+

		                           
			                           '<table style="width: 100%;" >'+
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Inspection </span> '+
			                                    '<input  type="Text" id="inspectionSuiv_'+(nbLigne+1)+'" name="inspectionSuiv_'+(nbLigne+1)+'" style="float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;"> '+
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Palpation  </span>'+ 
			                                    '<input  type="Text" id="palpitationSuiv_'+(nbLigne+1)+'" name="palpitationSuiv_'+(nbLigne+1)+'" style="float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Percussion   </span>'+ 
			                                    '<input  type="Text" id="percussionSuiv_'+(nbLigne+1)+'" name="percussionSuiv_'+(nbLigne+1)+'" style="float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Auscultation    </span>'+ 
			                                    '<input  type="Text" id="auscultationSuiv_'+(nbLigne+1)+'"  name="auscultationSuiv_'+(nbLigne+1)+'" style="float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
		 			                 '</table>'+
		                           
		                           
		                           '</div>'+
			 			        '</td>'+
						      '</tr>'+  
						      
						  '</table>';

	
	$('.champsAjoutAppareilSystemeSuiv_'+(nbLigne)).after(interfaceChamps);
	
	if((nbLigne+1) > 1){ 
		$('#examen_physique_moins_Suiv').toggle(true);
	}else if((nbLigne+1) == 1){
		$('#examen_physique_plus_Suiv').toggle(false);
	}
	
	$('#examen_physique_plus_Suiv').toggle(false);
	$('.champInputAppSysSuiv_'+nbLigne+' select').attr("disabled", true);
	$(".disabledSelectOptionSuiv1").toggle(false);
	$(".disabledSelectOptionSuiv0").toggle(true);
	
	$('#nbChampsInputAppSysSelectSuiv').val(nbLigne+1);
	
}


function enleverExamenPhysiqueAppareilSystemeSuiv(){
	
	var nbLigne = $('.champsAjoutAppareilSystemeSuiv').length; 
	if(nbLigne > 1){
		$('.champsAjoutAppareilSystemeSuiv_'+nbLigne).remove();
		if(nbLigne == 2){ $('#examen_physique_moins_Suiv').toggle(false); }
		
		$('#examen_physique_plus_Suiv').toggle(true);
		$('.champInputAppSysSuiv_'+(nbLigne-1)+' select').attr("disabled", false);
		
		var valInputAppSysSelectSuiv = $('#valueChampInputAppSysSelectSuiv_'+(nbLigne-1)).val();
		tabDisabledSelectSuiv[valInputAppSysSelectSuiv] = 0;
		
		$('#nbChampsInputAppSysSelectSuiv').val(nbLigne-1);
	}
	
}


function getInfosAppareilAppelSystemeSuiv(interfaceChamp, id){ 
	if(id==0){
		$('.examenPhysiqueInfosSuiv'+interfaceChamp+', #examen_physique_plus_Suiv').toggle(false);
	}else{
		$('.examenPhysiqueInfosSuiv'+interfaceChamp+', #examen_physique_plus_Suiv').toggle(true);
	}
	
	var nbLigne = $('.champsAjoutAppareilSystemeSuiv').length; 
	$('#valueChampInputAppSysSelectSuiv_'+nbLigne).val($('.champInputAppSysSuiv_'+nbLigne+' select').val());
}



/**
 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI 
 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI 
 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI 
 * */
function scriptPikameChooseSuiv(id) {
	var ab = function(self){ self.anchor.fancybox(); };
	$("#pikameSuiv"+id).PikaChoose({buildFinished:ab, carousel:true,carouselOptions:{wrap:'circular'}});
}

function scriptAddImageInDataBaseSuiv(id){
	
	$('#AddImageAutoSuiv'+id+' input[type="file"]').change(function() {

		var file = $(this);
		var reader = new FileReader;
		var idadmission = $("#idadmissionsuiv").val(); 
		
		reader.onload = function(event) {
    		var img = new Image();
            //Ici on recupere l'image 
		    document.getElementById('fichier_tmp_Suiv'+id).value = img.src = event.target.result;
		    $("#imageWaitingSuiv"+id).html('<table style="width: 100%; text-align: center;"> <tr> <td style="font-size: 12px; color: red;"> Chargement en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');

		    /**
		     * CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
		    
	    	$.ajax({
	            type: 'POST',
	            url: tabUrl[0]+'public/consultation/image-iconographie-suivi',
	            data: {'ajout': 1, 'fichier_tmp': $("#fichier_tmp_Suiv"+id).val(), 'idadmission': idadmission, 'position':id},
	            success: function(data) {
	                var result = jQuery.parseJSON(data); 
	                if(result != ""){
	                	var nbImgPika1 = id*2;
	                	var nbImgPika2 = nbImgPika1+1;
	                	
	                	$("#pikaSuiv"+nbImgPika2).fadeOut(function(){ 
		                	$("#pikaSuiv"+nbImgPika1).html(result);
		                	$("#imageWaitingSuiv"+id).html("");
		                	return false;
		                });
	                }else{
	                	$("#imageWaitingSuiv"+id).html("");
	                	alert("Fichier non reconnu"); return false;
	                }
	          }
	        });
	    	
	    	/**
		     * FIN CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		     */
	};
	reader.readAsDataURL(file[0].files[0]);
	
  });
}

function confirmerSuppressionAutoSuiv(id, position){
	
	var idadmission = $("#idadmissionsuiv").val(); 
	
	$('#nbImgPosAppSysSuiv'+position).html(id);
	$( "#confirmationSuppSuiv"+position).dialog({
	  resizable: false,
	  height:190,
	  width:420,
	  autoOpen: false,
	  modal: true,
		  buttons: {
			  
		      "Oui": function() {
		    	  
		          $( this ).dialog( "close" );
		
		          $("#imageWaitingSuiv"+position).html('<table style="width: 100%; text-align: center;"> <tr> <td style=" font-size: 12px; color: red;"> Suppression en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');
		          
		          var chemin = tabUrl[0]+'public/consultation/supprimer-image-iconographie-suivi';
		          $.ajax({
		              type: 'POST',
		              url: chemin ,
		              data: { 'id':id, 'idadmission':idadmission, 'position':position },
		              success: function() {
		            	  raffraichirImagesIconographiesAutoSuiv(idadmission, position);
		              }
		          });
		      },
		      
		      "Annuler": function() {
		          $( this ).dialog( "close" );
		      }
		 }
	 });
}


function raffraichirImagesIconographiesAutoSuiv(idadmission, position)
{
	
     $.ajax({
        type: 'POST',
        url: tabUrl[0]+'public/consultation/image-iconographie-suivi',
        data: { 'ajout':0 , 'idadmission': idadmission, 'position':position},
        success: function(data) {
        	var result = jQuery.parseJSON(data); 
        	
            if(result != "") {
        		
        		var nbImgPika1 = position*2;
            	var nbImgPika2 = nbImgPika1+1;
            	
            	$("#pikaSuiv"+nbImgPika2).fadeOut(function(){ 
                	$("#pikaSuiv"+nbImgPika1).html(result);
                	$("#imageWaitingSuiv"+position).html("");
                	return false;
                });
        		
        	}
            
            $("#imageWaitingSuiv"+position).html("");
        }
     });
}


function getImagesIconographiesAutoSuiv(position){
	
	var idadmission = $("#idadmissionsuiv").val(); 
	
	$.ajax({
		
          type: 'POST',
          url: tabUrl[0]+'public/consultation/image-iconographie-suivi',
          data: { 'ajout':0, 'idadmission': idadmission, 'position': position},
          success: function(data) {
              var result = jQuery.parseJSON(data);
              
              if(result != "") {
              	var nbImgPika1 = position*2;
              	var nbImgPika2 = nbImgPika1+1;
              	
              	$("#pikaSuiv"+nbImgPika2).fadeOut(function(){ 
	                	$("#pikaSuiv"+nbImgPika1).html(result);
	                	$("#imageWaitingSuiv"+position).html("");
	                	return false;
	                });
              }
              
          }
          
     });
}




/***
*=============================================================================
* Ajout automatique d'Examens biologiques pour tous les autres images de SUIVI
* Ajout automatique d'Examens biologiques pour tous les autres images de SUIVI
* Ajout automatique d'Examens biologiques pour tous les autres images de SUIVI
*=============================================================================
*/

function scriptPikameChooseOtherSuiv(examen) {
	var ab = function(self){ self.anchor.fancybox(); }
	$("#pikameSuiv"+examen).PikaChoose({buildFinished:ab, carousel:true,carouselOptions:{wrap:'circular'}});
}



function scriptAddImageInDataBaseOtherSuiv(examen){
	
	$('#AjoutImageSuiv'+examen+' input[type="file"]').change(function() {

		var file = $(this);
		var reader = new FileReader;
		var idadmission = $("#idadmissionsuiv").val(); 
		
		reader.onload = function(event) {
    		var img = new Image();
            //Ici on recupere l'image 
		    document.getElementById('fichier_tmpSuiv'+examen).value = img.src = event.target.result;
		    $("#imageWaitingSuiv"+examen).html('<table style="width: 100%; text-align: center;"> <tr> <td style="font-size: 12px; color: red;"> Chargement en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');

		    // CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
		    
	    	$.ajax({
	            type: 'POST',
	            url: tabUrl[0]+'public/consultation/images-differents-examens-suivi',
	            data: {'ajout': 1, 'fichier_tmp': $("#fichier_tmpSuiv"+examen).val(), 'idadmission': idadmission, 'examen':examen},
	            success: function(data) {
	                var result = jQuery.parseJSON(data); 
	                if(result != ""){
	                	
	                	$("#pikaSuiv2"+examen).fadeOut(function(){ 
		                	$("#pikaSuiv"+examen).html(result);
		                	$("#imageWaitingSuiv"+examen).html("");
		                	return false;
		                });
	                }else{
	                	$("#imageWaitingSuiv"+examen).html("");
	                	alert("Fichier non reconnu"); return false;
	                }
	          }
	        });
	    	
	    	// FIN CODE AJAX POUR L'AJOUT DE L'IMAGE DANS LA BASE DE DONNEES
	    	
	};
	reader.readAsDataURL(file[0].files[0]);
	
  });
}


function confirmerSuppressionOtherSuiv(id, examen){
	$('#nbImagesPositionPopupSuiv'+examen).html(id);
	
	var idadmission = $("#idadmissionsuiv").val(); 
	
	$( "#confirmationSuiv"+examen ).dialog({
	  resizable: false,
	  height:175,
	  width:420,
	  autoOpen: false,
	  modal: true,
		  buttons: {
			  
		      "Oui": function() {
		    	  
		          $( this ).dialog( "close" );
		
		          $("#imageWaitingSuiv"+examen).html('<table style="width: 100%; text-align: center;"> <tr> <td style=" font-size: 12px; color: red;"> Suppression en cours </td> </tr>  <tr> <td align="center"> <img style="margin-top: 20px; width: 30px; height: 30px;" src="../images/loading/Chargement_5.gif" /> </td> </tr> </table>');
		          
		          var chemin = tabUrl[0]+'public/consultation/supprimer-images-differents-examens-suivi';
		          $.ajax({
		              type: 'POST',
		              url: chemin ,
		              data: { 'id':id, 'idadmission':idadmission, 'examen':examen },
		              success: function(data) {
		            	  var result = jQuery.parseJSON(data);
		            	  scriptRaffraichirImagesExamenOtherSuiv(idadmission, examen);
		              }
		          });
		      },
		      
		      "Annuler": function() {
		          $( this ).dialog( "close" );
		      }
		 }
	 });
}


function scriptRaffraichirImagesExamenOtherSuiv(idadmission, examen)
{
     $.ajax({
        type: 'POST',
        url: tabUrl[0]+'public/consultation/images-differents-examens-suivi',
        data: { 'ajout':0 , 'idadmission': idadmission, 'examen':examen},
        success: function(data) {
        	var result = jQuery.parseJSON(data); 
        	
            if(result != "") {
            	$("#pikaSuiv2"+examen).fadeOut(function(){ 
                	$("#pikaSuiv"+examen).html(result);
                	$("#imageWaitingSuiv"+examen).html("");
                	return false;
                });
        	}
            
            $("#imageWaitingSuiv"+examen).html("");
        }
        
     });
     
}


function getImagesExamensOtherSuiv(examen){
	
	var idadmission = $("#idadmissionsuiv").val(); 
	
	$.ajax({
          type: 'POST',
          url: tabUrl[0]+'public/consultation/images-differents-examens-suivi',
          data: { 'ajout':0, 'idadmission': idadmission, 'examen': examen},
          success: function(data) {
              var result = jQuery.parseJSON(data);
              
              if(result != "") {
              	$("#pikaSuiv2"+examen).fadeOut(function(){ 
              		$("#pikaSuiv"+examen).html(result);
                  	$("#imageWaitingSuiv"+examen).html("");
              	});
              	return false;
          	}
          }
          
     });
}



function getHistoriquesDesConsultationsDeSuivis(idpatient){
	
	//alert(idpatient);
	
	var asInitVals = new Array();
	var oTableHistoriqueConsultationPatient = $('#ListeConsultationsDeSuivisPatient').dataTable( {
				"sPaginationType": "full_numbers",
				"aLengthMenu": [3,5,7],
				"iDisplayLength": 5,
				"aaSorting": [], //On ne trie pas la liste automatiquement
				"oLanguage": {
					"sInfo": "_START_ &agrave; _END_ sur _TOTAL_ consultations",
					"sInfoEmpty": "0 &eacute;l&eacute;ment &agrave; afficher",
					"sInfoFiltered": "",
					"sUrl": "",
					"oPaginate": {
						"sFirst":    "|<",
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">|"
					}
				},

				"sAjaxSource":  tabUrl[0] + "public/consultation/historiques-consultations-suivi-patient-ajax/"+idpatient,
				"fnDrawCallback": function() 
				{
					//markLine();
					//clickRowHandler();
				}
  
	} );
}

