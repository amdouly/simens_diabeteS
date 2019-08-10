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
		
		var nbLigne = $('.champsAjoutAppareilSysteme').length; 
		$('#valueChampInputAppSysSelect_'+nbLigne).val($('.champInputAppSys_'+nbLigne+' select').val());
	}
	
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
		
	}else if(temoinSupprImagePika2 == 1){ //les iconographies dans examen physique
		confirmerSuppression(id, idadmission);
		$("#confirmation").dialog('open');
		
	}else{
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
	
	var liste = '<select id="listeAppareilSysteme_'+id+'" style="font-size: 17px;" onchange="getInfosAppareilAppelSysteme('+id+', this.value)">'+
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
						          '<input type="hidden" id="valueChampInputAppSysSelect_'+(nbLigne+1)+'">'+
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
			                                    '<input  type="Text" id="inspection'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;"> '+
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Palpitation  </span>'+ 
			                                    '<input  type="Text" id="palpitation'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Percussion   </span>'+ 
			                                    '<input  type="Text" id="percussion'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
			                                  '</label>'+
	                    		           '</td>'+
	                    		        '</tr>'+
	                    		        
	                    		        '<tr style="width: 100%" class="designStyleLabel">'+
	                    		           '<td style="width: 100%; padding-right: 23px;">'+
	                    		              '<label style="width: 100%; height:30px; text-align:left;">'+
			                           		    '<span style="font-size: 11px;">&#10148; </span><span>Auscultation    </span>'+ 
			                                    '<input  type="Text" id="auscultation'+(nbLigne+1)+'" style="float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;">'+ 
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

