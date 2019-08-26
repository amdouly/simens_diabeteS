<?php

namespace Consultation\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Consultation\View\Helper\DateHelper;
use Zend\Json\Json;
use Consultation\Form\ConsultationForm;
use Consultation\Form\PatientForm;

class ConsultationController extends AbstractActionController {
	
	protected $personneTable;
	protected $patientTable;
	protected $consultationTable;
	
	
	
	public function getPersonneTable() {
		if (! $this->personneTable) {
			$sm = $this->getServiceLocator ();
			$this->personneTable = $sm->get ( 'Consultation\Model\PersonneTable' );
		}
		return $this->personneTable;
	}
	
	public function getPatientTable() {
		if (! $this->patientTable) {
			$sm = $this->getServiceLocator ();
			$this->patientTable = $sm->get ( 'Personnel\Model\PatientTable' );
		}
		return $this->patientTable;
	}
	
	public function getConsultationTable() {
	    if (! $this->consultationTable) {
	        $sm = $this->getServiceLocator ();
	        $this->consultationTable = $sm->get ( 'Consultation\Model\ConsultationTable' );
	    }
	    return $this->consultationTable;
	}
	
	//=============================================================================================
	//---------------------------------------------------------------------------------------------
	//=============================================================================================
	
	public function baseUrl(){
	    $baseUrl = $_SERVER['REQUEST_URI'];
	    $tabURI  = explode('public', $baseUrl);
	    return $tabURI[0];
	}
	
	public function baseUrlFile(){
	    $baseUrl = $_SERVER['SCRIPT_FILENAME'];
	    $tabURI  = explode('public', $baseUrl);
	    return $tabURI[0];
	}
	
	public function creerNumeroFacturation($numero) {
		$nbCharNum = 10 - strlen($numero);
		
		$chaine ="";
		for ($i=1 ; $i <= $nbCharNum ; $i++){
			$chaine .= '0';
		}
		$chaine .= $numero;
		
		return $chaine;
	}
	
	public function numeroFacture() {
		$derniereFacturation = $this->getFacturationTable()->getDerniereFacturation();
		if($derniereFacturation){
			return $this->creerNumeroFacturation($derniereFacturation['numero']+1);
		}else{
			return $this->creerNumeroFacturation(1);
		} 
	}
	
	protected function nbJours($debut, $fin) {
	    //60 secondes X 60 minutes X 24 heures dans une journee
	    $nbSecondes = 60*60*24;
	
	    $debut_ts = strtotime($debut);
	    $fin_ts = strtotime($fin);
	    $diff = $fin_ts - $debut_ts;
	    return (int)($diff / $nbSecondes);
	}
	
	public function prixMill($prix) {
	    $str="";
	    $long =strlen($prix)-1;
	
	    for($i = $long ; $i>=0; $i--)
	    {
	        $j=$long -$i;
	        if( ($j%3 == 0) && $j!=0)
	        { $str= " ".$str;   }
	        $p= $prix[$i];
	
	        $str = $p.$str;
	        }
	
			if(!$str){ $str = $prix; }
	
			return($str);
	}
	
	public function etatCivilPatientAction($idpatient) {
	    
	    //MISE A JOUR DE L'AGE DU PATIENT
	    //MISE A JOUR DE L'AGE DU PATIENT
	    //MISE A JOUR DE L'AGE DU PATIENT
	    //$personne = $this->getPatientTable()->miseAJourAgePatient($idpatient);
	    //*******************************
	    //*******************************
	    //*******************************
	     
		$listeProfessions = $this->getPersonneTable()->getListeProfessions();
		$listeEthnies = $this->getPersonneTable()->getListeEthnies();
		$listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
		$listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
		
		
		$patient = $this->getPatientTable()->getPatient($idpatient);
	    $personne = $this->getPersonneTable()->getPersonne($idpatient);
	    $date_naissance = null;
	    if($personne->date_naissance){ $date_naissance = (new DateHelper())->convertDate( $personne->date_naissance ); }
	    
	    $personne->photo = $personne->photo ? $personne->photo : 'identite.jpg';
	    $personne->profession = ($personne->profession) ? $listeProfessions[$personne->profession] : '';
	    $patient->ethnie      = ($patient->ethnie)      ? $listeEthnies[$patient->ethnie] : '';
	    $personne->regime_matrimonial = ($personne->regime_matrimonial) ? $listeRegimeMatrimonial[$personne->regime_matrimonial] : '';
	    $personne->statut_matrimonial = ($personne->statut_matrimonial) ? $listeStatutMatrimonial[$personne->statut_matrimonial] : '';
	    
	    
	    $html ="
	  
	    <div style='width: 100%; margin-top: 8px;' align='center'>
	  
	    <table style='width: 96%; height: 100px; margin-top: 8px;' >
		
	        <tr style='width: 100%'>
				<td colspan='3' style='height: 25px; '> 
				
				  <a id='precedent' style='text-decoration: none; font-family: police2; width:50px; color: black; cursor: pointer;'>
	                <img src='".$this->baseUrl()."public/images_icons/transfert_gauche.png' />
		            Pr&eacute;c&eacute;dent
		          </a>
	        		
				</td>
				 
			</tr>
	                		
			<tr style='width: 100%;' class='dateNaissanceDiv'>
	  
			    <td style='width: 15%;' >
				  <img id='photo' src='".$this->baseUrl()."public/images/photos_patients/".$personne->photo."' style='width:105px; height:105px; margin-bottom: 10px; margin-top: 5px;'/>";
	     
	    //Gestion des AGES
	    //Gestion des AGES
	    //Gestion des AGES
	    if($personne->age && !$personne->date_naissance){
	    	$html .="<div style=' margin-left: 20px; margin-top: 145px; font-family: time new romans; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$personne->age." ans </span></div>";
	    }else{
	    	$aujourdhui = (new \DateTime() ) ->format('Y-m-d');
	    	$age_jours = $this->nbJours($personne->date_naissance, $aujourdhui);
	    	$age_annees = (int)($age_jours/365);
	    
	    	if($age_annees == 0){
	    
	    		if($age_jours < 31){
	    			$html .="<div style='margin-left: 20px; margin-top: 145px; font-family: time new romans; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_jours." jours </span></div>";
	    		}else if($age_jours >= 31) {
	    			 
	    			$nb_mois = (int)($age_jours/31);
	    			$nb_jours = $age_jours - ($nb_mois*31);
	    			if($nb_jours == 0){
	    				$html .="<div style='margin-left: 20px; margin-top: 145px; font-family: time new romans; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$nb_mois."m </span></div>";
	    			}else{
	    				$html .="<div style='margin-left: 20px; margin-top: 145px; font-family: time new romans; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$nb_mois."m ".$nb_jours."j </span></div>";
	    			}
	    
	    		}
	    
	    	}else{
	    		$age_jours = $age_jours - ($age_annees*365);
	    
	    		if($age_jours < 31){
	    
	    			if($age_annees == 1){
	    				if($age_jours == 0){
	    					$html .="<div style='margin-left: 15px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 14px;'> Age: </span> <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an </span></div>";
	    				}else{
	    					$html .="<div style='margin-left: 10px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 14px;'> Age: </span> <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$age_jours." j </span></div>";
	    				}
	    			}else{
	    				if($age_jours == 0){
	    					$html .="<div style='margin-left: 15px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 14px;'> Age: </span> <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans </span></div>";
	    				}else{
	    					$html .="<div style='margin-left: 10px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 14px;'> Age: </span> <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$age_jours."j </span></div>";
	    				}
	    			}
	    			 
	    		}else if($age_jours >= 31) {
	    			 
	    			$nb_mois = (int)($age_jours/31);
	    			$nb_jours = $age_jours - ($nb_mois*31);
	    
	    			if($age_annees == 1){
	    				if($nb_jours == 0){
	    					$html .="<div style='margin-left: 5px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 13px;'> Age: </span> <span style='font-size:18px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$nb_mois."m </span></div>";
	    				}else{
	    					$html .="<div style='margin-left: 2px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 13px;'> Age: </span> <span style='font-size:17px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$nb_mois."m ".$nb_jours."j </span></div>";
	    				}
	    
	    			}else{
	    				if($nb_jours == 0){
	    					$html .="<div style='margin-left: 5px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 13px;'> Age: </span> <span style='font-size:18px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$nb_mois."m </span></div>";
	    				}else{
	    					$html .="<div style='margin-left: 2px; margin-top: 145px; font-family: time new romans; '> <span style='font-size: 13px;'> Age: </span> <span style='font-size:17px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$nb_mois."m ".$nb_jours."j </span></div>";
	    				}
	    			}
	    
	    		}
	    
	    	}
	    
	    }
	    
	    //Fin gestion des ages
	    //Fin gestion des ages
	     
	    $html .="</td>
	  
				 <td style='width: 72%;' >
	  
					 <!-- TABLEAU DES INFORMATIONS -->
				     <!-- TABLEAU DES INFORMATIONS -->
					 <!-- TABLEAU DES INFORMATIONS -->
	    
				     <table id='etat_civil' style='width: 100%;'>
                        <tr style='width: 100%;'>
	    		
						    <td style='width:27%; font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>Pr&eacute;nom</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->prenom." </p></div>
						   	</td>
				
						   	<td style='width:35%; font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>Origine g&eacute;ographique</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->origine_geographique."  </p></div>
						   	</td>
				
						    <td style='width:38%; font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>T&eacute;l&eacute;phone</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->telephone." </p></div>
						   	</td>
			   		          		
			            </tr>
	  
			            <tr style='width: 100%;'>
			               <td style='width:27%; font-family: police1;font-size: 12px; vertical-align: top;'>
			   		          <div id='aa'><a style='text-decoration: underline;'>Nom</a><br><p style='font-weight: bold; font-size: 19px;'> ".$personne->nom." </p></div>
			   	           </td>";
	    
						   $html .="<td style=' font-family: police1;font-size: 12px; vertical-align: top;'>
						   <div id='aa'><a style='text-decoration: underline;'>Statut matrimonial</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->statut_matrimonial." </p></div>
						   </td>";
						   
						   $html .="<td style=' font-family: police1;font-size: 12px; vertical-align: top;'>
						   <div id='aa'><a style='text-decoration: underline;'>Ethnie</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->ethnie." </p></div>
						   </td>
					    		
			            </tr>
	  
			            <tr style='width: 100%;'>
			   		          		
						   	<td style=' font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>Date de naissance</a><br><p style='font-weight: bold;font-size: 19px;'> ".$date_naissance." </p></div>
						   	</td>
						   				
						    <td style=' font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>R&eacute;gime matrimonial</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->regime_matrimonial." </p></div>
						   	</td>
						   				
						   	<td style=' font-family: police1;font-size: 12px; vertical-align: top;'>
						   		<div id='aa'><a style='text-decoration: underline;'>Race</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->race." </p></div>
						   	</td>
			   		          		
			            </tr>

	  
			            <tr style='width: 100%;'>
						   
						   <td style='width: 27%; font-family: police1;font-size: 12px; vertical-align: top;'>
						   
							   <div id='aa'><a style='text-decoration: underline; '>Sexe</a><br>
							   <p style='font-weight: bold;font-size: 19px;'>
							   ".$personne->sexe."
							    
							   </p>
							   </div>
						   
						   </td>
						   
						   <td style='width: 195px; font-family: police1;font-size: 12px;'>
						   	   <div id='aa'><a style='text-decoration: underline;'>Adresse</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->adresse." </p></div>
						   </td>
						   
						   <td  style='width: 195px; font-family: police1;font-size: 12px;'>
						   	   <div id='aa'><a style='text-decoration: underline;'>Profession</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->profession." </p></div>
						   </td>";
						   
	    $html .="     </tr>
	  
                     </table>
 					 <!-- FIN TABLEAU DES INFORMATIONS -->
           			 <!-- FIN TABLEAU DES INFORMATIONS -->
			   		 <!-- FIN TABLEAU DES INFORMATIONS -->
				</td>
	  
				<td style='width: 10%;' >
				  <span style='color: white; '>
                    <img src='".$this->baseUrl()."public/images/photos_patients/".$personne->photo."' style='width:105px; height:105px; opacity: 0.09; margin-top: 5px;'/>
                    <div style='margin-top: 20px; width: 105px; margin-right: 40px; font-size:17px; font-family: Iskoola Pota; color: green; float: right; font-style: italic; opacity: 1;'>".$patient->numero_dossier." </div>
                  </span>
				</td>
	  
			</tr>
		</table>
	  
		</div>";
	     
	    return $html;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//GESTION DE CREATION DES DOSSIERS PATIENTS --- GESTION DE CREATION DES DOSSIERS PATIENTS
	//GESTION DE CREATION DES DOSSIERS PATIENTS --- GESTION DE CREATION DES DOSSIERS PATIENTS
	//GESTION DE CREATION DES DOSSIERS PATIENTS --- GESTION DE CREATION DES DOSSIERS PATIENTS
	
	public function creerDossierAction() {
	    $this->layout ()->setTemplate ( 'layout/consultation' );
	    
		$form = new PatientForm();
		
		$listeProfessions = $this->getPersonneTable()->getListeProfessions();
		$listeEthnies = $this->getPersonneTable()->getListeEthnies();
		$listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
		$listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
		
		$form->get('PROFESSION')->setvalueOptions($listeProfessions);
		$form->get('ETHNIE')->setvalueOptions($listeEthnies);
		$form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
		$form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
		
		$request = $this->getRequest();
		if ($request->isPost()) {
		
		    $donnees = $this->getRequest()->getPost()->toArray();
		   
		    $personne = array();
		    
		    $fileBase64 = substr($this->params ()->fromPost ('fichier_tmp'), 23);
		    if($fileBase64){ $img = imagecreatefromstring(base64_decode($fileBase64)); } else { $img = false; }
		    
		    if ($img != false) {
		        $photo = (new \DateTime ( 'now' )) ->format ( 'dmy_His' ).'.jpg';
		        imagejpeg ( $img, $this->baseUrlFile().'public/images/photos_patients/' . $photo );
		        $personne['PHOTO'] = $photo;
		    }
		    
		    //Enregistrement données personne
		    $idpersonne = $this->getPersonneTable() ->savePersonne($donnees, $personne);

		    //Enregistrement données patient
		    if($donnees['SEXE'] == 'Masculin'){ $sexe = 1; }else{ $sexe = 2; }
		    $idemploye = $this->layout()->user['id_employe'];
		    $this->getPatientTable()->savePatient($donnees, $idpersonne, $idemploye, $sexe);
		    
		    
		    return $this->redirect()->toRoute('consultation' , array('action'=>'liste-dossiers-patients') );
		}
		
		
		return array (
				'form' => $form,
		);
	}
	
	
	public function listeDossiersPatientsAjaxAction() {
	    $output = $this->getPatientTable()->getListePatientsAjax();
	    return $this->getResponse ()->setContent ( Json::encode ( $output, array ( 'enableJsonExprFinder' => true ) ) );
	}
	
	public function listeDossiersPatientsAction() {
	    $this->layout ()->setTemplate ( 'layout/consultation' );
	}
	
	
	public function infosPatientAction() {
	
	    $id = ( int ) $this->params ()->fromPost ( 'id', 0 );
	
	    $control = new DateHelper();
	
	    $patient = $this->getPatientTable()->getPatient($id);
	    $personne = $this->getPersonneTable()->getPersonne($id);

	    $date_naissance = null;
	    if($personne->date_naissance){ $date_naissance = $control->convertDate( $personne->date_naissance ); }
	
	    $listeProfessions = $this->getPersonneTable()->getListeProfessions();
	    $listeEthnies = $this->getPersonneTable()->getListeEthnies();
	    $listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
	    $listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
	    
	    $personne->photo = $personne->photo ? $personne->photo : 'identite.jpg';
	    $personne->profession = ($personne->profession) ? $listeProfessions[$personne->profession] : '';
	    $patient->ethnie      = ($patient->ethnie)      ? $listeEthnies[$patient->ethnie] : '';
	    $personne->regime_matrimonial = ($personne->regime_matrimonial) ? $listeRegimeMatrimonial[$personne->regime_matrimonial] : '';
	    $personne->statut_matrimonial = ($personne->statut_matrimonial) ? $listeStatutMatrimonial[$personne->statut_matrimonial] : '';
	     
	    
	    $html ="
	
	    <div style='width: 100%;'>
	
        <img id='photo' src='../images/photos_patients/".$personne->photo."' style='float:left; margin-right:40px; width:105px; height:105px;'/>";
	
	    //Gestion des AGES
	    //Gestion des AGES
	    if($personne->age && !$personne->date_naissance){
	        $html .="<div style=' left: 70px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$personne->age." ans </span></div>";
	    }else{
	        	
	        $aujourdhui = (new \DateTime() ) ->format('Y-m-d');
	        $age_jours = $this->nbJours($personne->date_naissance, $aujourdhui);
	
	        $age_annees = (int)($age_jours/365);
	
	        if($age_annees == 0){
	
	            if($age_jours < 31){
	                $html .="<div style=' left: 70px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_jours." jours </span></div>";
	            }else if($age_jours >= 31) {
	                 
	                $nb_mois = (int)($age_jours/31);
	                $nb_jours = $age_jours - ($nb_mois*31);
	                if($nb_jours == 0){
	                    $html .="<div style=' left: 70px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$nb_mois."m </span></div>";
	                }else{
	                    $html .="<div style=' left: 70px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$nb_mois."m ".$nb_jours."j </span></div>";
	                }
	
	            }
	
	        }else{
	            $age_jours = $age_jours - ($age_annees*365);
	
	            if($age_jours < 31){
	
	                if($age_annees == 1){
	                    if($age_jours == 0){
	                        $html .="<div style=' left: 60px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an </span></div>";
	                    }else{
	                        $html .="<div style=' left: 60px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$age_jours." j </span></div>";
	                    }
	                }else{
	                    if($age_jours == 0){
	                        $html .="<div style=' left: 60px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans </span></div>";
	                    }else{
	                        $html .="<div style=' left: 60px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$age_jours."j </span></div>";
	                    }
	                }
	                 
	            }else if($age_jours >= 31) {
	                 
	                $nb_mois = (int)($age_jours/31);
	                $nb_jours = $age_jours - ($nb_mois*31);
	
	                if($age_annees == 1){
	                    if($nb_jours == 0){
	                        $html .="<div style=' left: 50px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$nb_mois."m </span></div>";
	                    }else{
	                        $html .="<div style=' left: 50px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."an ".$nb_mois."m ".$nb_jours."j </span></div>";
	                    }
	
	                }else{
	                    if($nb_jours == 0){
	                        $html .="<div style=' left: 50px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$nb_mois."m </span></div>";
	                    }else{
	                        $html .="<div style=' left: 50px; top: 235px; font-family: time new romans; position: absolute; '> Age: <span style='font-size:19px; font-family: time new romans; color: green; font-weight: bold;'> ".$age_annees."ans ".$nb_mois."m ".$nb_jours."j </span></div>";
	                    }
	                }
	
	            }
	
	        }
	
	    }
	
	    //Fin gestion des ages
	    //Fin gestion des ages

	    $html .="<p>
         <img id='photo' src='../images/photos_patients/".$personne->photo."' style='float:right; margin-right:15px; width:95px; height:95px; color: white; opacity: 0.09;'/>
        </p>
       
        <table id='etat_civil'>
             <tr>
			   	<td style='width:27%; font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Pr&eacute;nom</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->prenom." </p></div>
			   	</td>
	
			   	<td style='width:35%; font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Origine g&eacute;ographique</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->origine_geographique."  </p></div>
			   	</td>
	
			    <td style='width:38%; font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>T&eacute;l&eacute;phone</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->telephone." </p></div>
			   	</td>
	
			 </tr>
	
			 <tr>
			    <td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Nom</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->nom." </p></div>
			   	</td>";
	
	    
	        $html .="<td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Statut matrimonial</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->statut_matrimonial." </p></div>
			   	</td>";
	
	    $html .="<td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Ethnie</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->ethnie." </p></div>
			   	</td>
	
			 </tr>
	
			 <tr>
			    <td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Date de naissance</a><br><p style='font-weight: bold;font-size: 19px;'> ".$date_naissance." </p></div>
			   	</td>
	
			    <td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>R&eacute;gime matrimonial</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->regime_matrimonial." </p></div>
			   	</td>
	
			   	<td style=' font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Race</a><br><p style='font-weight: bold;font-size: 19px;'> ".$patient->race." </p></div>
			   	</td>
	
			 </tr>
	
			  <tr>
			   	<td style='width: 27%; font-family: police1;font-size: 12px; vertical-align: top;'>
			 
			   		<div id='aa'><a style='text-decoration: underline; '>Sexe</a><br>
			   		  <p style='font-weight: bold;font-size: 19px;'>
			   		     ".$personne->sexe."
			   	
			   		  </p>
			   		</div>
	
			   	</td>
	
			    <td style='width: 195px; font-family: police1;font-size: 12px;'>
			   		<div id='aa'><a style='text-decoration: underline;'>Adresse</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->adresse." </p></div>
			   	</td>
	
			    <td  style='width: 195px; font-family: police1;font-size: 12px;'>
			       <div id='aa'><a style='text-decoration: underline;'>Profession</a><br><p style='font-weight: bold;font-size: 19px;'> ".$personne->profession." </p></div>
			   	</td>";
	     
	    $html .="
			  </tr>
			 
           </table>
	
           <div id='barre'></div>
	
           <div style='color: white; opacity: 1; width:95px; height:40px; float:right'>
             <img  src='../images_icons/fleur1.jpg' />
           </div>
	       <table id='numero' style=' padding-top:5px; width: 60%; '>
           <tr>
             <td style='padding-top:3px; padding-left:25px; padding-right:5px; font-size: 14px; width: 95px;'> Numero dossier: </td>
             <td style='font-weight: bold; '>".$patient->numero_dossier."</td>
             <td style='font-weight: bold;padding-left:20px;'>|</td>
             <td style='padding-top:5px; padding-left:10px; font-size: 14px;'> Date d'enregistrement: </td>
             <td style='font-weight: bold;'>". $control->convertDateTime( $patient->date_enregistrement ) ."</td>
           </tr>
           </table>
	
	    <div class='block' id='thoughtbot' style=' vertical-align: bottom; padding-left:60%; padding-top: 35px; font-size: 18px; font-weight: bold;'><button id='terminer'>Terminer</button></div>
        
        <div style=' height: 80px; width: 100px; '> </div>
   
        </div> ";
	
	
	    $this->getResponse ()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html; charset=utf-8' );
	    return $this->getResponse ()->setContent ( Json::encode ( $html ) );
	}
	
	public function modifierDossierAction() {
	    $this->layout ()->setTemplate ( 'layout/consultation' );
	     
	    $idpersonne = (int) $this->params()->fromRoute('val', 0);
	    $form = new PatientForm();
	
	    $listeProfessions = $this->getPersonneTable()->getListeProfessions();
	    $listeEthnies = $this->getPersonneTable()->getListeEthnies();
	    $listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
	    $listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
	
	    $form->get('PROFESSION')->setvalueOptions($listeProfessions);
	    $form->get('ETHNIE')->setvalueOptions($listeEthnies);
	    $form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
	    $form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
	
	   
	    $request = $this->getRequest();
	    if ($request->isPost()) {
	
	        $donnees = $this->getRequest()->getPost()->toArray();
	        
	        $idpersonne = $donnees['ID_PERSONNE'];
	        
	        $personne = array();
	
	        $fileBase64 = substr($this->params ()->fromPost ('fichier_tmp'), 23);
	        if($fileBase64){ $img = imagecreatefromstring(base64_decode($fileBase64)); } else { $img = false; }
	
	        if ($img != false) {
	            
	            $lepatient = $this->getPersonneTable()->getPersonne($idpersonne);
	            $ancienneImage = $lepatient->photo;
	            
	            if($ancienneImage) {
	                unlink ( $this->baseUrlFile().'public/images/photos_patients/' . $ancienneImage . '.jpg' );
	            }
	            
	            $photo = (new \DateTime ( 'now' )) ->format ( 'dmy_His' ).'.jpg';
	            imagejpeg ( $img, $this->baseUrlFile().'public/images/photos_patients/' . $photo );
	            $personne['PHOTO'] = $photo;
	        }
	
	        //Modifier données personne
	        $this->getPersonneTable() ->updatePersonne($idpersonne, $donnees, $personne);
	
	
	        //Modifier données patient
	        $patient = $this->getPatientTable()->getPatient($idpersonne);
	        

	        $idemploye = $this->layout()->user['id_employe'];
	        $this->getPatientTable()->updatePatient($donnees, $idpersonne, $idemploye, $patient);
	
	        
	        return $this->redirect()->toRoute('consultation' , array('action'=>'liste-dossiers-patients') );
	    }
	
	
	    $personne = $this->getPersonneTable()->getPersonne($idpersonne);
	    $patient = $this->getPatientTable()->getPatient($idpersonne);
	    
	    $data = array();
	    
	    $data['ID_PERSONNE'] = $idpersonne;
	    $data['NOM'] = $personne->nom;
	    $data['PRENOM'] = $personne->prenom;
	    $data['DATE_NAISSANCE'] = $personne->date_naissance;
	    $data['ADRESSE'] = $personne->adresse;
	    $data['SEXE'] = $personne->sexe;
	    $data['AGE'] = $personne->age;
	    $data['TELEPHONE'] = $personne->telephone;
	    $data['PROFESSION'] = $personne->profession;
	    $data['STATUT_MATRIMONIAL'] = $personne->statut_matrimonial;
	    $data['REGIME_MATRIMONIAL'] = $personne->regime_matrimonial;
	    $data['ETHNIE'] = $patient->ethnie;
	    $data['RACE'] = $patient->race;
	    $data['ORIGINE_GEOGRAPHIQUE'] = $patient->origine_geographique;
	    
	    $photo = $personne->photo ? $personne->photo : 'identite.jpg';
	    
	    if($personne->date_naissance){ $data['DATE_NAISSANCE'] = (new DateHelper())->convertDate( $personne->date_naissance ); }
	    $form->populateValues($data);

	    
	    return array (
	        'form' => $form,
	        'photo' => $photo,
	    );
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//GESTION DE L'ADMISSION DES PATIENTS --- GESTION DE L'ADMISSION DES PATIENTS
	//GESTION DE L'ADMISSION DES PATIENTS --- GESTION DE L'ADMISSION DES PATIENTS
	//GESTION DE L'ADMISSION DES PATIENTS --- GESTION DE L'ADMISSION DES PATIENTS
	
	public function listePatientsAdmettreAjaxAction() {
		$output = $this->getPatientTable()->getListePatientsAAdmettre();
		return $this->getResponse ()->setContent ( Json::encode ( $output, array ( 'enableJsonExprFinder' => true ) ) );
	}
	
	public function listePatientsAdmettreAction() {
		$this->layout ()->setTemplate ( 'layout/consultation' );
	}
	
	public function admettrePatientVueAction() {
		$idpatient = ( int ) $this->params ()->fromPost ( 'idpatient', 0 );
		
		$html = $this->etatCivilPatientAction($idpatient);
		
		$this->getResponse ()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html; charset=utf-8' );
		return $this->getResponse ()->setContent ( Json::encode ( $html ) );
		
	}
	
	public function admettrePatientAction() {
		$idpatient = (int) $this->params()->fromRoute('val', 0);
		$idemploye = $this->layout()->user['id_employe'];
		
		$this->getPatientTable()->admettrePatient($idpatient, $idemploye);
	
		return $this->redirect()->toRoute('consultation' , array('action'=>'liste-consultations') );
	}
	
	
	public function listePatientsAdmisAjaxAction() {
		$output = $this->getPatientTable()->getListePatientsAdmisAjax();
		return $this->getResponse ()->setContent ( Json::encode ( $output, array ( 'enableJsonExprFinder' => true ) ) );
	}
	
	
	public function listePatientsAdmisAction() {
		$this->layout ()->setTemplate ( 'layout/consultation' );
	}
	
	
	public function supprimerAdmissionPatientAction() {
		
		$idadmission = (int) $this->params()->fromRoute('val', 0);
		$this->getPatientTable()->supprimerAdmission($idadmission);
		
		return $this->redirect()->toRoute('consultation' , array('action'=>'liste-patients-admis') );
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS
	//GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS
	//GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS --- GESTION DES CONSULTATIONS
	
	public function listeConsultationsAjaxAction() {
	    
		$output = $this->getConsultationTable ()->getListeConsultations();
		return $this->getResponse ()->setContent ( Json::encode ( $output, array ( 'enableJsonExprFinder' => true ) ) );
	}
	
	
	public function listeConsultationsAction() {
		$this->layout ()->setTemplate ( 'layout/consultation' );
	}
	
	
	public function consulterAction() {

		$this->layout ()->setTemplate ( 'layout/consultation' );
		
		$user = $this->layout()->user;
		$idmedecin = $user['id_personne'];
		
		$idadmission = $this->params ()->fromQuery ( 'idadmission', 0 );
		$idpatient = $this->params ()->fromQuery ( 'idpatient', 0 );
		
		$liste = $this->getConsultationTable ()->getInfoPatient ( $idpatient );
		$patient = $this->getPatientTable()->getPatient( $idpatient );
		
		$form = new ConsultationForm ();
		$idcons = $form->get ( "idcons" )->getValue ();
		$date = $form->get ( "date" )->getValue ();
		$heure = $form->get ( "heure" )->getValue ();
		
		
		$listeProfessions = $this->getPersonneTable()->getListeProfessions();
		$listeEthnies = $this->getPersonneTable()->getListeEthnies();
		$listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
		$listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
		$listeSigne = $this->getPersonneTable()->getListeSigne();
		
		$form->get('PROFESSION')->setvalueOptions($listeProfessions);
		$form->get('ETHNIE')->setvalueOptions($listeEthnies);
		$form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
		$form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
		
		$form->get('motif_admission1')->setvalueOptions($listeSigne);
		$form->get('motif_admission2')->setvalueOptions($listeSigne);
		$form->get('motif_admission3')->setvalueOptions($listeSigne);
		$form->get('motif_admission4')->setvalueOptions($listeSigne);
		$form->get('motif_admission5')->setvalueOptions($listeSigne);
		
		
		
		$data = array ('idadmission' => $idadmission);
		
		$form->populateValues($data);
		
		
		
		//var_dump($patient->numero_dossier); exit();
		
		
		/*
		$listeMedicament = $this->getConsultationTable()->listeDeTousLesMedicaments();
		$listeForme = $this->getConsultationTable()->formesMedicaments();
		$listetypeQuantiteMedicament = $this->getConsultationTable()->typeQuantiteMedicaments();
		
		
		$image = $this->getConsultationTable ()->getPhoto ( $id_pat );
		*/
		//RECUPERER TOUS LES PATIENTS AYANT UN RV aujourd'hui
		/*
		$tabPatientRV = $this->getConsultationTable()->getPatientsRV($IdDuService);
		$resultRV = null;
		if(array_key_exists($id_pat, $tabPatientRV)){
			$resultRV = $tabPatientRV[ $id_pat ];
		}
		*/
		
		// instancier la consultation et rï¿½cupï¿½rer l'enregistrement
		//$consult = $this->getConsultationTable ()->getConsult ( $id );
		
		// POUR LES HISTORIQUES OU TERRAIN PARTICULIER
		// POUR LES HISTORIQUES OU TERRAIN PARTICULIER
		// POUR LES HISTORIQUES OU TERRAIN PARTICULIER
		//*** Liste des consultations
		//$listeConsultation = $this->getConsultationTable ()->getConsultationPatient($id_pat, $id);
		
		//Liste des examens biologiques
		//$listeDesExamensBiologiques = $this->demandeExamensTable()->getDemandeDesExamensBiologiques();
		//Liste des examens Morphologiques
		//$listeDesExamensMorphologiques = $this->demandeExamensTable()->getDemandeDesExamensMorphologiques();
		
		
		//*** Liste des Hospitalisations
		//$listeHospitalisation = $this->getDemandeHospitalisationTable()->getDemandeHospitalisationWithIdPatient($id_pat);
		
		// instancier le motif d'admission et recupï¿½rer l'enregistrement
		//$motif_admission = $this->getMotifAdmissionTable ()->getMotifAdmission ( $id );
		//$nbMotif = $this->getMotifAdmissionTable ()->nbMotifs ( $id );
		
		// rï¿½cupï¿½ration de la liste des hopitaux
		//$hopital = $this->getTransfererPatientServiceTable ()->fetchHopital ();
		//$form->get ( 'hopital_accueil' )->setValueOptions ( $hopital );
		// RECUPERATION DE L'HOPITAL DU SERVICE
		//$transfertPatientHopital = $this->getTransfererPatientServiceTable ()->getHopitalPatientTransfert($IdDuService);
		//$idHopital = $transfertPatientHopital['ID_HOPITAL'];
		
		// RECUPERATION DE LA LISTE DES SERVICES DE L'HOPITAL OU SE TROUVE LE SERVICE OU LE MEDECIN TRAVAILLE
		//$serviceHopital = $this->getTransfererPatientServiceTable ()->fetchServiceWithHopitalNotServiceActual($idHopital, $IdDuService);
		
		// LISTE DES SERVICES DE L'HOPITAL
		//$form->get ( 'service_accueil' )->setValueOptions ($serviceHopital);
		
		// liste des heures rv
		/*
		$heure_rv = array (
				'08:00' => '08:00',
				'09:00' => '09:00',
				'10:00' => '10:00',
				'15:00' => '15:00',
				'16:00' => '16:00'
		);
		
		$form->get ( 'heure_rv' )->setValueOptions ( $heure_rv );
		
		$data = array (
				'id_cons' => $consult->id_cons,
				'id_medecin' => $id_medecin,
				'id_patient' => $consult->id_patient,
				'date_cons' => $consult->date,
				'poids' => $consult->poids,
				'taille' => $consult->taille,
				'temperature' => $consult->temperature,
				'pouls' => $consult->pouls,
				'frequence_respiratoire' => $consult->frequence_respiratoire,
				'glycemie_capillaire' => $consult->glycemie_capillaire,
				'pressionarterielle' => $consult->pression_arterielle,
				'hopital_accueil' => $idHopital,
		);
		$k = 1;
		foreach ( $motif_admission as $Motifs ) {
			$data ['motif_admission' . $k] = $Motifs ['Libelle_motif'];
			$k ++;
		}
		*/
		
		// Pour recuper les bandelettes
		//$bandelettes = $this->getConsultationTable ()->getBandelette($id);
		
		//RECUPERATION DES ANTECEDENTS
		//RECUPERATION DES ANTECEDENTS
		//RECUPERATION DES ANTECEDENTS
		//$donneesAntecedentsPersonnels = $this->getAntecedantPersonnelTable()->getTableauAntecedentsPersonnels($id_pat);
		//$donneesAntecedentsFamiliaux  = $this->getAntecedantsFamiliauxTable()->getTableauAntecedentsFamiliaux($id_pat);
		
		//Recuperer les antecedents medicaux ajouter pour le patient
		//Recuperer les antecedents medicaux ajouter pour le patient
		//$antMedPat = $this->getConsultationTable()->getAntecedentMedicauxPersonneParIdPatient($id_pat);
		
		//Recuperer les antecedents medicaux
		//Recuperer les antecedents medicaux
		//$listeAntMed = $this->getConsultationTable()->getAntecedentsMedicaux();
		
		//FIN ANTECEDENTS --- FIN ANTECEDENTS --- FIN ANTECEDENTS
		//FIN ANTECEDENTS --- FIN ANTECEDENTS --- FIN ANTECEDENTS
		
		//Recuperer la liste des actes
		//Recuperer la liste des actes
		//$listeActes = $this->getConsultationTable()->getListeDesActes();
		
		//$form->populateValues ( array_merge($data,$bandelettes,$donneesAntecedentsPersonnels,$donneesAntecedentsFamiliaux) );
		
		return array (
		
				'form' => $form,
				'lesdetails' => $liste,
				'patient' => $patient,
				
				/*ETAT CIVIL --- ETAT CIVIL*/
				'listeProfessions' => $listeProfessions,
				'listeEthnies' => $listeEthnies,
				'listeStatutMatrimonial' => $listeStatutMatrimonial, 
				'listeRegimeMatrimonial' => $listeRegimeMatrimonial, 
				'idcons' => $idcons,
				'date' => $date,
				'heure' => $heure,
				
				/*MOTIF ADMISSION --- MOTIF ADMISSION*/
		        'nbMotifs' => 0,
				
				
				
				
				
				
				
				
				
				
				
				'image' => '',//$image,
				'heure_cons' => '',//$consult->heurecons,
				'dateonly' => '',//$consult->dateonly,
				'liste_med' => '',//$listeMedicament,
				'temoin' => '',//$bandelettes['temoin'],
				'listeForme' => '',//$listeForme,
				'listetypeQuantiteMedicament'  => array(),//$listetypeQuantiteMedicament,
				'donneesAntecedentsPersonnels' => array(),//$donneesAntecedentsPersonnels,
				'donneesAntecedentsFamiliaux'  => array(),//$donneesAntecedentsFamiliaux,
				'liste' => array(),//$listeConsultation,
				'resultRV' => '',//$resultRV,
				'listeHospitalisation' => array(),//$listeHospitalisation,
				'listeDesExamensBiologiques' => array(),//$listeDesExamensBiologiques,
				'listeDesExamensMorphologiques' => array(),//$listeDesExamensMorphologiques,
				'listeAntMed' => array(),//$listeAntMed,
				'antMedPat' => '',//$antMedPat,
				'nbAntMedPat' => 0,//$antMedPat->count(),
				'listeActes' => array(),//$listeActes,
		);
		
	}
	
	
	public function imageIconographieAction(){
	
		$idadmission = (int)$this->params()->fromPost( 'idadmission' );
		$ajout = (int)$this->params()->fromPost( 'ajout' );
		$position = (int)$this->params()->fromPost( 'position' );
		
		$idemploye = $this->layout()->user['id_personne'];
		 
		/***
		 * INSERTION DE LA NOUVELLE IMAGE
		*/
		$formatFichier = "";
		if($ajout == 1) {
			/***
			 * Enregistrement de l'image
			* Enregistrement de l'image
			* Enregistrement de l'image
			***/
			$today = new \DateTime ( 'now' );
			$nomimage = "iconographie_".$idadmission.'_'.$position.'_'.$today->format ( 'dmy_His' );
				
			$fileBase64 = $this->params ()->fromPost ( 'fichier_tmp' );
	
			$typeFichier = substr ( $fileBase64, 5, 5 );
			$formatFichier = substr ($fileBase64, 11, 4 );
			$fileBase64 = substr ( $fileBase64, 23 );
	
			if($fileBase64 && $typeFichier == 'image' && $formatFichier =='jpeg'){
				$img = imagecreatefromstring(base64_decode($fileBase64));
				if($img){
					$resultatAjout = $this->getConsultationTable()->addImagesIconographie($nomimage, $idadmission, $position, $idemploye);
				}
				if($resultatAjout){
					imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/iconographies/' . $nomimage . '.jpg' );
				}
			}
			 
		}
		 
		/**
		 * RECUPERATION DE TOUTES LES IMAGES
		 */
		$pickaChoose = "";
		
		$result = $this->getConsultationTable()->getImagesIconographie($idadmission, $position);
		 
		 
		if($result){
			foreach ($result as $resultat) {
				$pickaChoose .=" <li><a href='../images/imagerie/iconographies/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/iconographies/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
			}
		}
		
		$nbImgPika2 = ($position*2)+1;
		
		$pikame = ($position == 1) ? 'pikame' : 'pikame'.$position;
		$pika2  = ($position == 1) ? 'pika2'  : 'pika'.$nbImgPika2;
		
		
		
	
		if($ajout == 1){
			if($formatFichier == 'jpeg'){
				$html ="<div id='".$pika2."' align='center'>
					      <div class='pikachoose' style='height: 210px;'>
	                        <ul id='".$pikame."' class='jcarousel-skin-pika'>";
				$html .=$pickaChoose;
				$html .="   </ul>
	                      </div>
					 	</div>";
				
				if($position == 1){
					$html.="<script>
					         scriptExamenMorpho();
					        </script>";
				}else {
					$html.="<script>
					         scriptPikameChoose(".$position.");
					        </script>";
				}
				
			}else {
				$html ="";
			}
	
		}else {
			$html ="<div id='".$pika2."' align='center'>
				    <div class='pikachoose' style='height: 210px;'>
                      <ul id='".$pikame."' class='jcarousel-skin-pika'>";
			$html .=$pickaChoose;
			$html .="     </ul>
                    </div>
				 </div>";
			
			if($position == 1){
				$html.="<script>
					         scriptExamenMorpho();
					        </script>";
			}else {
				$html.="<script>
					         scriptPikameChoose(".$position.");
					        </script>";
			}
		}
	
		 
		$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
		return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function supprimerImageIconographieAction()
	{
		$id = $this->params()->fromPost('id');
		$idadmission = $this->params()->fromPost('idadmission');
		$position = (int)$this->params()->fromPost( 'position' );
		 
		$result = $this->getConsultationTable()->getImageIconographie($id, $idadmission, $position);
		
		if($result['idimage']){
			
			// SUPPRESSION PHYSIQUE DE L'IMAGE
			unlink ( $this->baseUrlFile().'public/images/imagerie/iconographies/' . $result['nomimage'] . '.jpg' );
			
			// SUPPRESSION DE L'IMAGE DANS LA BASE
			$this->getConsultationTable()->deleteImagesIconographie($result['idimage'], $idadmission);
		}
	
		$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
		return $this->getResponse ()->setContent(Json::encode ($result['idimage']));
	}
	
	
	public function imagesDifferentsExamensAction(){
	
		$idadmission = (int)$this->params()->fromPost( 'idadmission' );
		$ajout = (int)$this->params()->fromPost( 'ajout' );
		$examen = $this->params()->fromPost( 'examen' );
	
		$idemploye = $this->layout()->user['id_personne'];
			
		/***
		 * INSERTION DE LA NOUVELLE IMAGE
		*/
		$formatFichier = "";
		if($ajout == 1) {
			/***
			 * Enregistrement de l'image
			 * Enregistrement de l'image
			 * Enregistrement de l'image
			 ***/
			$today = new \DateTime ( 'now' );
			if($examen == 'Nfs'){
				$nomimage = "nfs_".$idadmission.'_'.$today->format ( 'dmy_His' );
			}else if($examen == 'Ecg'){
				$nomimage = "ecg_".$idadmission.'_'.$today->format ( 'dmy_His' );
			}else if($examen == 'Rsd'){
				$nomimage = "rsd_".$idadmission.'_'.$today->format ( 'dmy_His' );
			}else if($examen == 'Sca'){
				$nomimage = "sca_".$idadmission.'_'.$today->format ( 'dmy_His' );
			}else if($examen == 'Eco'){
				$nomimage = "eco_".$idadmission.'_'.$today->format ( 'dmy_His' );
			}else{
				
				$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
				return $this->getResponse ()->setContent(Json::encode ( "" ));
			}
	
			$fileBase64 = $this->params ()->fromPost ( 'fichier_tmp' );
	
			$typeFichier = substr ( $fileBase64, 5, 5 );
			$formatFichier = substr ($fileBase64, 11, 4 );
			$fileBase64 = substr ( $fileBase64, 23 );
	
			if($fileBase64 && $typeFichier == 'image' && $formatFichier =='jpeg'){
				$img = imagecreatefromstring(base64_decode($fileBase64));
				if($img){
					$resultatAjout = $this->getConsultationTable()->addImagesExamens($nomimage, $idadmission, $examen, $idemploye);
				}
				if($resultatAjout){
					if($examen == 'Nfs'){
						imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/hemogrammes/' . $nomimage . '.jpg' );
					}else if($examen == 'Ecg'){
						imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/electrocardiogrammes/' . $nomimage . '.jpg' );
					}else if($examen == 'Rsd'){
						imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/radiographies/' . $nomimage . '.jpg' );
					}else if($examen == 'Sca'){
						imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/scanners/' . $nomimage . '.jpg' );
					}else if($examen == 'Eco'){
						imagejpeg ( $img, $this->baseUrlFile().'public/images/imagerie/echographies/' . $nomimage . '.jpg' );
					}
					
					
				}
			}
	
		}
			
		/**
		 * RECUPERATION DE TOUTES LES IMAGES
		 */
		$pickaChoose = "";
	
		$result = $this->getConsultationTable()->getImagesExamens($idadmission, $examen);
			
			
		if($result){
			foreach ($result as $resultat) {
				if($examen == 'Nfs'){
					$pickaChoose .=" <li><a href='../images/imagerie/hemogrammes/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/hemogrammes/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
				}else if($examen == 'Ecg'){
					$pickaChoose .=" <li><a href='../images/imagerie/electrocardiogrammes/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/electrocardiogrammes/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
				}else if($examen == 'Rsd'){
					$pickaChoose .=" <li><a href='../images/imagerie/radiographies/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/radiographies/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
				}else if($examen == 'Sca'){
					$pickaChoose .=" <li><a href='../images/imagerie/scanners/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/scanners/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
				}else if($examen == 'Eco'){
					$pickaChoose .=" <li><a href='../images/imagerie/echographies/".$resultat['nomimage'].".jpg'><img src='../images/imagerie/echographies/".$resultat['nomimage'].".jpg'/></a><span></span></li>";
				}
			}
		}
	
		if($ajout == 1){
			if($formatFichier == 'jpeg'){
				$html ="<div id='pika2".$examen."' align='center'>
					      <div class='pikachoose' style='height: 210px;'>
	                        <ul id='pikame".$examen."' class='jcarousel-skin-pika'>";
				$html .=$pickaChoose;
				$html .="   </ul>
	                      </div>
					 	</div>";
	
				$html.="<script>
				         scriptPikameChooseOther('".$examen."');
				        </script>";
	
			}else {
				$html ="";
			}
	
		}else {
			$html ="<div id='pika2".$examen."' align='center'>
				    <div class='pikachoose' style='height: 210px;'>
                      <ul id='pikame".$examen."' class='jcarousel-skin-pika'>";
			$html .=$pickaChoose;
			$html .="     </ul>
                    </div>
				 </div>";
				
			$html.="<script>
			         scriptPikameChooseOther('".$examen."');
			        </script>";
		}
	
			
		$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
		return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function supprimerImagesDifferentsExamensAction()
	{
		$id = (int)$this->params()->fromPost('id');
		$idadmission = (int)$this->params()->fromPost('idadmission');
		$examen = $this->params()->fromPost( 'examen', '' );

		
		if(!$examen){
			$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
			return $this->getResponse ()->setContent(Json::encode ( "" ));
		}
		
		$result = $this->getConsultationTable()->getImageExamen($id, $idadmission, $examen);
		
		if( $result['idimage'] ){
			
			if($examen == 'Nfs'){
				unlink ( $this->baseUrlFile().'public/images/imagerie/hemogrammes/' . $result['nomimage'] . '.jpg' );
			}else if($examen == 'Ecg'){
				unlink ( $this->baseUrlFile().'public/images/imagerie/electrocardiogrammes/' . $result['nomimage'] . '.jpg' );
			}else if($examen == 'Rsd'){
				unlink ( $this->baseUrlFile().'public/images/imagerie/radiographies/' . $result['nomimage'] . '.jpg' );
			}else if($examen == 'Sca'){
				unlink ( $this->baseUrlFile().'public/images/imagerie/scanners/' . $result['nomimage'] . '.jpg' );
			}else if($examen == 'Eco'){
				unlink ( $this->baseUrlFile().'public/images/imagerie/echographies/' . $result['nomimage'] . '.jpg' );
			}
			
			$this->getConsultationTable()->deleteImageExamen($result['idimage'], $idadmission, $examen);
		}

		$this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
		return $this->getResponse ()->setContent(Json::encode ( $result['idimage'] ));
		
	}
	

}
