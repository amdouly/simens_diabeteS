    var base_url = window.location.toString();
	var tabUrl = base_url.split("public");
	
	
	//BOITE DE DIALOG POUR LA CONFIRMATION DE SUPPRESSION
    function confirmation(idpatient){
	  $( "#confirmation" ).dialog({
	    resizable: false,
	    height:170,
	    width:435,
	    autoOpen: false,
	    modal: true,
	    buttons: {
	        "Oui": function() {
	            $( this ).dialog( "close" ); 
	            
	            $.ajax({
	                type: 'POST',
	                url: tabUrl[0]+'public/consultation/supprimer-patient' ,
	                data:{ 'idpatient':idpatient },
	                success: function(data) {
	                	     var result = jQuery.parseJSON(data);  

	                	     if(result == 0){
	                	    	 alert('Impossible de supprimer, ce patient a deja des donnees de consultation'); return false;
	                	     } else {
		                	     $("#"+idpatient).parent().parent().fadeOut(function(){ 
		                	    	 $(location).attr("href",tabUrl[0]+"public/consultation/liste-dossiers-patients");
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
    
    function supprimerPatient(idpatient){
   	   confirmation(idpatient);
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
					   	
			   "sAjaxSource": ""+tabUrl[0]+"public/consultation/liste-dossiers-patients-ajax", 
			   
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
            	     
            	     $('#vue_patient').html(result);
            	     $('#contenu').fadeOut(function(){
            	    	 $('#titre span').html('ETAT CIVIL DU PATIENT'); 
            	    	 $('#vue_patient').fadeIn();
            	     });
            	     
            	     $('#terminer').click(function(){
            	    	 $('#vue_patient').fadeOut(function(){
            	    		 $('#titre span').html('LISTE DES DOSIIERS PATIENTS'); 
                	    	 $('#contenu').fadeIn();
                	    	 $('#vue_patient').html("");
                	     });
            	     });
            }
        
        });
    	
    }
    
    
    function modifierPatient(id){
    	vart=tabUrl[0]+'public/consultation/modifier-dossier/idpatient/'+id;
        $(location).attr("href",vart);
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
    
    
    
	