    var base_url = window.location.toString();
	var tabUrl = base_url.split("public");
	//BOITE DE DIALOG POUR LA CONFIRMATION DE SUPPRESSION
    function confirmation(idfacturation){
	  $( "#confirmation" ).dialog({
	    resizable: false,
	    height:170,
	    width:435,
	    autoOpen: false,
	    modal: true,
	    buttons: {
	        "Oui": function() {
	            $( this ).dialog( "close" ); 
	            
	            var chemin = tabUrl[0]+'public/facturation/supprimer-facturation';
	            $.ajax({
	                type: 'POST',
	                url: chemin ,
	                data:{ 'idfacturation':idfacturation },
	                success: function(data) {
	                	     var result = jQuery.parseJSON(data);  
	                	     if(result == 1){
	                	    	 alert('impossible de supprimer il y a des analyses ayant deja des resultats '); return false;
	                	     } else {
		                	     $("#"+idfacturation).parent().parent().parent().fadeOut(function(){ 
		                	    	 $(location).attr("href",tabUrl[0]+"public/facturation/liste-patients-admis");
		                	     });
	                	     }
	                	     
	                },
	                error:function(e){console.log(e);alert("Une erreur interne est survenue!");},
	                dataType: "html"
	            });
	    	     
	    	     
	        },
	        "Annuler": function() {
                $( this ).dialog( "close" );
            }
	   }
	  });
    }
    
    function supprimer(idfacturation){
   	   confirmation(idfacturation);
       $("#confirmation").dialog('open');
   	}
    
    function listepatient(){
    	//Lorsqu'on clique sur terminer �a ram�ne la liste des ptients admis 
	    $("#terminer").click(function(){
	    	$("#titre2").replaceWith("<div id='titre' style='font-family: police2; color: green; font-size: 18px; font-weight: bold; padding-left: 20px;'><iS style='font-size: 25px;'>&curren;</iS> LISTE DES PATIENTS ADMIS </div>");
  	    	$("#vue_patient").fadeOut(function(){$("#contenu").fadeIn("fast"); });
  	    });
    }
    
    /**********************************************************************************/
    /**********************************************************************************/
    /**********************************************************************************/
    /**********************************************************************************/

    $(function(){
    	setTimeout(function() {
    		infoBulle();
    	}, 1000);
    });
    function infoBulle(){
    	/***
    	 * INFO BULLE FE LA LISTE
    	 */
    	 var tooltips = $( 'table tbody tr td infoBulleVue' ).tooltip({show: {effect: 'slideDown', delay: 250}});
    	     tooltips.tooltip( 'close' );
    	  $('table tbody tr td infoBulleVue').mouseenter(function(){
    	    var tooltips = $( 'table tbody tr td infoBulleVue' ).tooltip({show: {effect: 'slideDown', delay: 250}});
    	    tooltips.tooltip( 'open' );
    	  });
    }
    	
    var  oTable;
    function initialisation(){	
    	
     var asInitVals = new Array();
	 oTable = $('#patientAdmis').dataTable
	 ( {
		        
		  "sPaginationType": "full_numbers",
		  "aLengthMenu": [5,7,10,15],
		  "aaSorting": [], //On ne trie pas la liste automatiquement
		  "oLanguage": {
				"sInfo": "_START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
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
					   	
			   "sAjaxSource": ""+tabUrl[0]+"public/consultation/liste-patients-admettre-ajax", 
			   
			   "fnDrawCallback": function() 
				{
					//markLine();
					clickRowHandler();
				}
	} );

	//le filtre du select
	$('#filter_statut').change(function() 
	{					
		oTable.fnFilter( this.value );
	});
	
	$('#liste_service').change(function()
	{					
		oTable.fnFilter( this.value );
	});
	
	$("tfoot input").keyup( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $("tfoot input").index(this) );
	} );
	
	/*
	 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
	 * the footer
	 */
	$("tfoot input").each( function (i) {
		asInitVals[i] = this.value;
	} );
	
	$("tfoot input").focus( function () {
		if ( this.className == "search_init" )
		{
			this.className = "";
			this.value = "";
		}
	} );
	
	$("tfoot input").blur( function (i) {
		if ( this.value == "" )
		{
			this.className = "search_init";
			this.value = asInitVals[$("tfoot input").index(this)];
		}
	} );

    $(".boutonAnnuler").html('<button type="submit" id="terminer" style=" font-family: police2; font-size: 17px; font-weight: bold;"> Annuler </button>');
    $(".boutonTerminer").html('<button type="submit" id="terminer" style=" font-family: police2; font-size: 17px; font-weight: bold;"> Valider </button>');

    }
    
    
    function clickRowHandler() 
    {
    	var id;
    	$('#patientAdmis tbody tr').contextmenu({
    		target: '#context-menu',
    		onItem: function (context, e) { 
    			
    			if($(e.target).text() == 'Visualiser' || $(e.target).is('#visualiserCTX')){
    				if(id){ listeAnalyses(id); }
    			} 
    			
    		}
    	
    	}).bind('mousedown', function (e) {
    			var aData = oTable.fnGetData( this );
    		    id = aData[7]; 
    	});
    	
    	
    	
    	$("#patientAdmis tbody tr").bind('dblclick', function (event) {
    		var aData = oTable.fnGetData( this );
    		var id = aData[7]; 
    		if(id){ listeAnalyses(id); }
    	});
    	
    }
    
    
    function visualiser(id){
    	var cle = id;
        var chemin = tabUrl[0]+'public/consultation/infos-patient';
        $.ajax({
            type: 'POST',
            url: chemin ,
            data: $(this).serialize(),  
            data:'id='+cle,
            success: function(data) {
            	     var result = jQuery.parseJSON(data);  
            	     
            	     $('#vue_patient').css({'padding-left':'20px'}).html(result);
            	     $('#contenu').fadeOut(function(){
            	    	 $('#titre span').html('ETAT CIVIL DU PATIENT'); 
            	    	 $('#admissionZoneInfos').fadeIn();
            	     });
            	     
            	     $('#terminer').click(function(){
            	    	 $('#admissionZoneInfos').fadeOut(function(){
            	    		 $('#titre span').html('LISTE DES DOSIIERS PATIENTS'); 
                	    	 $('#contenu').fadeIn();
                	    	 $('#vue_patient').html("").css({'padding-left':'0px'});;
                	     });
            	     });
            }
        
        });
    	
    }
    
    
    
    function modifierPatient(id){
    	vart=tabUrl[0]+'public/consultation/modifier-dossier/idpatient/'+id;
        $(location).attr("href",vart);
    }
    
    
    
    function admettrePatient(id){
    	
        $("#titre span").html("ADMETTRE LE PATIENT");	

        var chemin = tabUrl[0]+'public/consultation/admettre-patient-vue';
        $.ajax({
            type: 'POST',
            url: chemin ,
            data:'idpatient='+id,
            success: function(data){
            	var result = jQuery.parseJSON(data);  
            	
            	var boutons = '<table style="margin-top: 35px; margin-bottom: 30px; width: 100%;  height: 12px;">'+
							   '<tr>'+
							     '<td style="width: 42%;"> </td>'+
							     '<td style="width: 10%;" id="thoughtbot" class="boutonAnnuler"  > </td>'+
							     '<td style="width: 10%;" id="thoughtbot" class="boutonTerminer" > </td>'+
							     '<td style="width: 38%;"> </td>'+
							   '</tr>'+
						     '</table>'; 
            	result +=boutons;
            	
            	$("#vue_patient").html(result);
 
            	//PASSER A SUIVANT
            	$('#admissionZoneInfos').animate({
            		height : 'toggle'
            	},1000);
            	$('#contenu').animate({
            		height : 'toggle'
            	},1000);
           	     
            	$(".boutonAnnuler").html('<button type="submit" id="annuler" style=" font-family: police2; font-size: 17px; font-weight: bold;"> Annuler </button>');
            	$(".boutonTerminer").html('<button type="submit" id="terminer" style=" font-family: police2; font-size: 17px; font-weight: bold;"> Admettre </button>');

            	//PRECEDENT --- PRECEDENT --- PRECEDENT --- PRECEDENT
            	$('#precedent').click(function(){

            		$("#titre span").html('LISTE DES DOSIIERS PATIENTS');	
           	    	$('#contenu').animate({
           	    		height : 'toggle'
           	    	},1000);
           	    	$('#admissionZoneInfos').animate({
           	    		height : 'toggle'
           	    	},1000);
           	    	
           	    	return false;
            	});
            	
            	$("#annuler").click(function(){
            	    vart = tabUrl[0]+'public/consultation/liste-patients-admettre';
            	    $(location).attr("href",vart);
                    return false;
                });
            	
            	$("#terminer").click(function(){
            	    vart = tabUrl[0]+'public/consultation/admettre-patient/idpatient/'+id;
            	    $(location).attr("href",vart);
                    return false;
                });
            	
            }
        });
        
    }
    
    
    
    
    
    
    
    

    
    
    function infos_parentales(id)
    {
    	
    	$('#infos_parentales_'+id).w2overlay({ html: "" +
    		"" +
    		"<div style='border-bottom:1px solid green; height: 30px; background: #f9f9f9; width: 600px; text-align:center; padding-top: 10px; font-size: 13px; color: green; font-weight: bold;'><img style='padding-right: 10px;' src='"+tabUrl[0]+"public/images_icons/Infos_parentales.png' >Informations parentales</div>" +
    		"<div style='height: 245px; width: 600px; padding-top:10px; text-align:center;'>" +
    		"<div style='height: 77%; width: 95%; max-height: 77%; max-width: 95%; ' class='infos_parentales' align='left'>  </div>" +
    		"</div>"+
    		"<script> $('.infos_parentales').html( $('.infos_parentales_tampon').html() ); </script>" 
    	});
    	
    }
    
    
    
	