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
		$listeRace = $this->getPersonneTable()->getListeRace();
		
		
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
						   		<div id='aa'><a style='text-decoration: underline;'>Race</a><br><p style='font-weight: bold;font-size: 19px;'> ".$listeRace[$patient->race]." </p></div>
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
		$listeCommuneSaintlouis = $this->getPersonneTable()->getListeCommuneSaintlouis();
		//$listeQuartierSaintlouis = $this->getPersonneTable()->getListeQuartierSaintlouis();
		$listeRace = $this->getPersonneTable()->getListeRace();
		
		
		$form->get('PROFESSION')->setvalueOptions($listeProfessions);
		$form->get('ETHNIE')->setvalueOptions($listeEthnies);
		$form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
		$form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
		$form->get('COMMUNE_SAINTLOUIS')->setvalueOptions($listeCommuneSaintlouis);
		//$form->get('QUARTIER_SAINTLOUIS')->setvalueOptions($listeQuartierSaintlouis);
		$form->get('RACE')->setvalueOptions($listeRace);
		
		
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
	    $listeRace = $this->getPersonneTable()->getListeRace();
	    
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
			   		<div id='aa'><a style='text-decoration: underline;'>Race</a><br><p style='font-weight: bold;font-size: 19px;'> ".$listeRace[$patient->race]." </p></div>
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
	    $listeCommuneSaintlouis = $this->getPersonneTable()->getListeCommuneSaintlouis();
	    //$listeQuartierSaintlouis = $this->getPersonneTable()->getListeQuartierSaintlouis();
	    $listeRace = $this->getPersonneTable()->getListeRace();
	    
	
	    $form->get('PROFESSION')->setvalueOptions($listeProfessions);
	    $form->get('ETHNIE')->setvalueOptions($listeEthnies);
	    $form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
	    $form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
	    $form->get('COMMUNE_SAINTLOUIS')->setvalueOptions($listeCommuneSaintlouis);
	    //$form->get('QUARTIER_SAINTLOUIS')->setvalueOptions($listeQuartierSaintlouis);
	    $form->get('RACE')->setvalueOptions($listeRace);
	    
	    
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
	    $data['TELEPHONE_2'] = $personne->telephone_2;
	    $data['PROFESSION'] = $personne->profession;
	    $data['STATUT_MATRIMONIAL'] = $personne->statut_matrimonial;
	    $data['REGIME_MATRIMONIAL'] = $personne->regime_matrimonial;
	    $data['ETHNIE'] = $patient->ethnie;
	    $data['RACE'] = $patient->race;
	    $data['ORIGINE_GEOGRAPHIQUE'] = $patient->origine_geographique;
	    $data['COMMUNE_SAINTLOUIS'] = $patient->commune_saintlouis;
	    $data['QUARTIER_SAINTLOUIS_MEMO'] = $patient->quartier_saintlouis;
	    
	    $photo = $personne->photo ? $personne->photo : 'identite.jpg';
	    
	    if($personne->date_naissance){ $data['DATE_NAISSANCE'] = (new DateHelper())->convertDate( $personne->date_naissance ); }
	    $form->populateValues($data);

	    //var_dump($data); exit();
	    
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
	
	public function getInfosConsultationGlobale($idcons){

	    $data = array ( );
	     
	    // Motifs admission --- Motifs admission
	    // Motifs admission --- Motifs admission
	    $motif_admission = $this->getConsultationTable()->getMotifAdmission( $idcons );
	    $nbMotif = $this->getConsultationTable ()->nbMotifs ( $idcons );
	    $data['nbMotifs'] = $nbMotif;
	    $k = 1;
	    foreach ( $motif_admission as $Motifs ) {
	        $data ['motif_admission' . $k++] = $Motifs ['idlistemotif'];
	    }
	     
	    // Signes --- Signes
	    // Signes --- Signes
	    $signes = $this->getConsultationTable()->getSignes( $idcons );
	    $data['duree_des_signes'] = $signes['duree'];
	    $data['gravite_des_signes'] = $signes['gravite'];
	     
	    // Résumé histoire de la maladie
	    // Résumé histoire de la maladie
	    $histoireMaladie = $this->getConsultationTable()->getResumeHistoireMaladie( $idcons );
	    $data['resume_histoire_maladie'] = $histoireMaladie['resume'];
	     
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $etatGeneral = $this->getConsultationTable()->getEtatGeneral( $idcons );
	    $etatGeneral = $etatGeneral ? $etatGeneral : array();
	     
	    $data = array_merge($data, $etatGeneral);
	     
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $examenPhysique = $this->getConsultationTable()->getExamenPhysique( $idcons );
	    $data['examenPhysique'] = $examenPhysique;
	    
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $glycemieAJeun = $this->getConsultationTable()->getGlycemieAJeun( $idcons );
	    $glycemieAJeun = $glycemieAJeun ? $glycemieAJeun : array();
	    
	    /*Hémoglobine glyquée*/
	    $hemoGlyquee = $this->getConsultationTable()->getHemoglobineGlyquee( $idcons );
	    $hemoGlyquee = $hemoGlyquee ? $hemoGlyquee : array();
	     
	    /*Créatininémie*/
	    $creatininemie = $this->getConsultationTable()->getInfosAnalyse("creatininemie", $idcons);
	    $creatininemie = $creatininemie ? $creatininemie : array();
	     
	    /*Groupage rhesus*/
	    $groupageRhesus = $this->getConsultationTable()->getInfosAnalyse("groupage_rhesus", $idcons);
	    $groupageRhesus = $groupageRhesus ? $groupageRhesus : array();
	     
	     
	    /*taux_prothrombine (TP)*/
	    $Tp = $this->getConsultationTable()->getInfosAnalyse("taux_prothrombine", $idcons);
	    $Tp = $Tp ? $Tp : array();
	     
	    /*temps_cephaline_active (TCA)*/
	    $Tca = $this->getConsultationTable()->getInfosAnalyse("temps_cephaline_active", $idcons);
	    $Tca = $Tca ? $Tca : array();
	     
	    /*cholesterol_hdl*/
	    $hdl = $this->getConsultationTable()->getInfosAnalyse("cholesterol_hdl", $idcons);
	    $hdl = $hdl ? $hdl : array();
	     
	    /*cholesterol_ldl*/
	    $ldl = $this->getConsultationTable()->getInfosAnalyse("cholesterol_ldl", $idcons);
	    $ldl = $ldl ? $ldl : array();
	     
	    /*uricemie*/
	    $uricemie = $this->getConsultationTable()->getInfosAnalyse("uricemie", $idcons);
	    $uricemie = $uricemie ? $uricemie : array();
	     
	    /*triglycerides*/
	    $triglycerides = $this->getConsultationTable()->getInfosAnalyse("triglycerides", $idcons);
	    $triglycerides = $triglycerides ? $triglycerides : array();
	     
	    /*Microalbuminurie*/
	    $microAlbuminurie = $this->getConsultationTable()->getInfosAnalyse("microalbuminurie", $idcons);
	    $microAlbuminurie = $microAlbuminurie ? $microAlbuminurie : array();
	     
	    $data = array_merge($data, $glycemieAJeun, $hemoGlyquee, $creatininemie, $groupageRhesus, $Tp, $Tca, $hdl, $ldl, $uricemie, $triglycerides, $microAlbuminurie);
	     
	    //Examens fonctionnels --- Examens fonctionnels
	    //Examens fonctionnels --- Examens fonctionnels
	    $ecg = $this->getConsultationTable()->getInfosAnalyse("ecg", $idcons);
	    $ecg = $ecg ? $ecg : array();
	     
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $radio = $this->getConsultationTable()->getInfosAnalyse("radio", $idcons);
	    $radio = $radio ? $radio : array();
	     
	    /*Scanner*/
	    $scanner = $this->getConsultationTable()->getInfosAnalyse("scanner", $idcons);
	    $scanner = $scanner ? $scanner : array();
	     
	    /*Echographie*/
	    $echographie = $this->getConsultationTable()->getInfosAnalyse("echographie", $idcons);
	    $echographie = $echographie ? $echographie : array();
	     
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    /*type de diabete*/
	    $typediabete = $this->getConsultationTable()->getInfosAnalyse("type_diabete", $idcons);
	    $typediabete = $typediabete ? $typediabete : array();
	     
	    $data = array_merge($data, $ecg, $radio, $scanner, $echographie, $typediabete);
	     
	    /*complication*/
	    $complicationDiagEntree = $this->getConsultationTable()->getComplicationDiagEntree( $idcons );
	    $data['complicationDiagEntree'] = $complicationDiagEntree;
	    
	    //Traitement --- Traitement --- Traitement
	    //Traitement --- Traitement --- Traitement
	    /*Hospitalisation*/
	    $hospitalisation = $this->getConsultationTable()->getInfosAnalyse("hospitalisation", $idcons);
	    $hospitalisation = $hospitalisation ? $hospitalisation : array();
	    
	    /*Traitement*/
	    $traitement = $this->getConsultationTable()->getInfosAnalyse("traitement", $idcons);
	    $traitement = $traitement ? $traitement : array();
	     
	    $data = array_merge($data, $hospitalisation, $traitement);

	    
	    return $data;
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
		$listeRace = $this->getPersonneTable()->getListeRace();
		
		$form->get('PROFESSION')->setvalueOptions($listeProfessions);
		$form->get('ETHNIE')->setvalueOptions($listeEthnies);
		$form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
		$form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
		
		$form->get('motif_admission1')->setvalueOptions($listeSigne);
		$form->get('motif_admission2')->setvalueOptions($listeSigne);
		$form->get('motif_admission3')->setvalueOptions($listeSigne);
		$form->get('motif_admission4')->setvalueOptions($listeSigne);
		$form->get('motif_admission5')->setvalueOptions($listeSigne);
		
		
		$data = array (
		    'idpatient' => $idpatient
		);
		
		
		/**
		 * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
		 * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
		 * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
		 */
		// Infos diabetique --- Infos diabetique
		// Infos diabetique --- Infos diabetique
		$infosDiabetique = $this->getConsultationTable()->getInfosDiabetique( $idpatient );
		$infosDiabetique = $infosDiabetique ? $infosDiabetique : array();
		 
		// Autre terrain connu --- Autre terrain connu
		// Autre terrain connu --- Autre terrain connu
		$autreTerrainConnu = $this->getConsultationTable()->getAutreTerrainConnu( $idpatient );
		$autreTerrainConnu = $autreTerrainConnu ? $autreTerrainConnu : array();
		
		// Les antécédents médicaux --- Les antécédents médicaux
		// Les antécédents médicaux --- Les antécédents médicaux
		$antMedicaux = $this->getConsultationTable()->getAntMedicaux( $idpatient );
		$antMedicaux = $antMedicaux ? $antMedicaux : array();
		
		// Les antécédents chirurgicaux --- Les antécédents chirurgicaux
		// Les antécédents chirurgicaux --- Les antécédents chirurgicaux
		$antChirurgicaux = $this->getConsultationTable()->getAntChirurgicaux( $idpatient );
		$antChirurgicaux = $antChirurgicaux ? $antChirurgicaux : array();
		
		$data = array_merge($data, $infosDiabetique, $autreTerrainConnu, $antMedicaux, $antChirurgicaux);
		/**
		 * =================================================
		 */
		
		
		
		/**============================================================
		 **============================================================
		 * Donnees d'entrée automatique -- Donnees d'entrée automatique
		 *_____________________________________________________________
		 *_____________________________________________________________
		 */
		$nbMotifs = 0;
		$examenPhysique = array();
		$nbExamenPhysique = 0;
		$complicationDiagEntree = array();
		$nbComplicationDiagEntree = 0;
		$idsuiv = 0;
		$datesuiv = '';
		$heuresuiv = '';
		/**----------------------------------------------------------*/
		
		
		
		
		/** 1=SUIVI ; 0=CONSULTATION*/
		$typeDeConsultation = 0;
		/**
		 * Récupérer la premiere consultation générale du patient différente des consultations de suivi
		 */
		$consultationGlobale = $this->getConsultationTable ()->getConsultationPatientDifferentDeSuivi( $idpatient );
		//var_dump($consultationGlobale); exit();
		
		/**
		 * Vérifier si le patient a déjà une consultation de suivi
		 */
		$consultationSuivi = $this->getConsultationTable ()->getConsultationDeSuivi( $idpatient );
		if(!$consultationSuivi){
		    /**
		     * S'il n y a pas de consultation de suivi
		     * Vérifier si c'est la première consultation ou s'il sagit d'un suivi
		     */
		    if ($consultationGlobale){
		        /** S'il y a déjà une consultation globale => c'est un suivi */
		        //echo 'un suivi'; exit();
		        
		        $typeDeConsultation = 1;
		        
		        $infosConsultationGlobale = $this->getInfosConsultationGlobale($consultationGlobale['idcons']);
		        $data = array_merge($data, $infosConsultationGlobale);
		        
		        $nbMotifs = $infosConsultationGlobale['nbMotifs'];
		        $examenPhysique = $infosConsultationGlobale['examenPhysique'];
		        $nbExamenPhysique = $examenPhysique->count();
		        $complicationDiagEntree = $infosConsultationGlobale['complicationDiagEntree'];
		        $nbComplicationDiagEntree = $complicationDiagEntree->count();
		        
		        /**Infos de suivi*/
		        $idsuiv = $form->get ( "idsuiv" )->getValue ();
		        $datesuiv = $form->get ( "date" )->getValue ();
		        $heuresuiv = $form->get ( "heure" )->getValue ();
		        $data['idadmissionsuiv'] = $idadmission;
		        $data['idsuiv'] = $idsuiv;
		        
		        /**Infos consultation globale*/
		        $data['idadmission'] = $consultationGlobale['idadmission'];
		        $data['idcons'] = $consultationGlobale['idcons'];
		        $idcons = $consultationGlobale['idcons'];
		        $date = $consultationGlobale['date'];
		        $heure = $consultationGlobale['heure'];
 		        
		    }else{
		        /** C'est une consultation globale*/
		        //echo 'une consultation globale'; exit();
		        
		        $typeDeConsultation = 0;
		        $data['idadmission'] = $idadmission;
		        $data['idadmissionsuiv'] = null;
		    }
		    
		}else {
		    //echo 'un suivi'; exit();

		    $typeDeConsultation = 1;
		        
	        $infosConsultationGlobale = $this->getInfosConsultationGlobale($consultationGlobale['idcons']);
	        $data = array_merge($data, $infosConsultationGlobale);
	        
	        $nbMotifs = $infosConsultationGlobale['nbMotifs'];
	        $examenPhysique = $infosConsultationGlobale['examenPhysique'];
	        $nbExamenPhysique = $examenPhysique->count();
	        $complicationDiagEntree = $infosConsultationGlobale['complicationDiagEntree'];
	        $nbComplicationDiagEntree = $complicationDiagEntree->count();
	        
	        /**Infos de suivi*/
	        $idsuiv = $form->get ( "idsuiv" )->getValue ();
	        $datesuiv = $form->get ( "date" )->getValue ();
	        $heuresuiv = $form->get ( "heure" )->getValue ();
	        $data['idadmissionsuiv'] = $idadmission;
	        $data['idsuiv'] = $idsuiv;
	        
	        /**Infos consultation globale*/
	        $data['idadmission'] = $consultationGlobale['idadmission'];
	        $data['idcons'] = $consultationGlobale['idcons'];
	        $idcons = $consultationGlobale['idcons'];
	        $date = $consultationGlobale['date'];
	        $heure = $consultationGlobale['heure'];
		}
		
		
		
		//var_dump($idsuiv); exit();
		
		//var_dump($typeDeConsultation); exit();
		
		
		
		$form->populateValues($data);
		
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
		    
		    'idsuiv' => $idsuiv,
		    'datesuiv' => $datesuiv,
		    'heuresuiv' => $heuresuiv,
			
			/*MOTIF ADMISSION --- MOTIF ADMISSION*/
	        'nbMotifs' => $nbMotifs,
				
		    'examenPhysique' => $examenPhysique,
		    'nbExamenPhysique' => $nbExamenPhysique,

		    'complicationDiagEntree' => $complicationDiagEntree,
		    'nbComplicationDiagEntree' => $nbComplicationDiagEntree,
		    
		    
	        'typeDeConsultation' => $typeDeConsultation,
		    'listeRace' => $listeRace,
				
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
	
	
	public function enregistrerConsultationAction()
	{
	    $idemploye = $this->layout()->user['id_employe'];
	    $tabDonnees = $this->params ()->fromPost();

	    // Consultation --- Consultation
	    // Consultation --- Consultation
	    $this->getConsultationTable()->addConsultation($tabDonnees, $idemploye);
	    
	    // Motifs admission --- Motifs admission
	    // Motifs admission --- Motifs admission
	    $this->getConsultationTable()->addMotifAdmission($tabDonnees, $idemploye);
	    
	    // Signes --- Signes
	    // Signes --- Signes
	    $this->getConsultationTable()->addSignes($tabDonnees, $idemploye);
	    
	    // Résumé histoire de la maladie
	    // Résumé histoire de la maladie
	    $this->getConsultationTable()->addResumeHistoireMaladie($tabDonnees, $idemploye);
	    
	    /**
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     */
	    // Infos diabetique --- Infos diabetique
	    // Infos diabetique --- Infos diabetique
	    $this->getConsultationTable()->addInfosDiabetique($tabDonnees, $idemploye);
	    
	    // Autre terrain connu --- Autre terrain connu
	    // Autre terrain connu --- Autre terrain connu
	    $this->getConsultationTable()->addAutreTerrainConnu($tabDonnees, $idemploye);
	    
	    // Les antécédents médicaux --- Les antécédents médicaux
	    // Les antécédents médicaux --- Les antécédents médicaux
	    $this->getConsultationTable()->addAntMedicaux($tabDonnees, $idemploye);
	    
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    $this->getConsultationTable()->addAntChirurgicaux($tabDonnees, $idemploye);
	    
	    /**
	     * =================================================
	     */
	    
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $this->getConsultationTable()->addEtatGeneral($tabDonnees, $idemploye);
	    
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $this->getConsultationTable()->addExamenPhysique($tabDonnees, $idemploye);
	    
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $this->getConsultationTable()->addGlycemieAJeun($tabDonnees, $idemploye);
	    
	    /*Hémoglobine glyquée*/
	    $this->getConsultationTable()->addHemoglobineGlyquee($tabDonnees, $idemploye);
	    
	    /*Créatininémie*/
	    $this->getConsultationTable()->addCreatininemie($tabDonnees, $idemploye);
	    
	    /*Groupage rhesus*/
	    $this->getConsultationTable()->addGroupageRhesus($tabDonnees, $idemploye);
	    
	    /*taux_prothrombine (TP)*/
	    $this->getConsultationTable()->addTauxProthrombine($tabDonnees, $idemploye);
	    
	    /*temps_cephaline_active (TCA)*/
	    $this->getConsultationTable()->addTempsCephalineActive($tabDonnees, $idemploye);
	    
	    /*cholesterol_hdl*/
	    $this->getConsultationTable()->addCholesterolHdl($tabDonnees, $idemploye);
	    
	    /*cholesterol_ldl*/
	    $this->getConsultationTable()->addCholesterolLdl($tabDonnees, $idemploye);
	     
	    /*uricemie*/
	    $this->getConsultationTable()->addUricemie($tabDonnees, $idemploye);
	    
	    /*triglycerides*/
	    $this->getConsultationTable()->addTriglycerides($tabDonnees, $idemploye);
	    
	    /*Microalbuminurie*/
	    $this->getConsultationTable()->addMicroalbuminurie($tabDonnees, $idemploye);
	    
	    //Examens fonctionnels --- Examens fonctionnels
	    //Examens fonctionnels --- Examens fonctionnels
	    $this->getConsultationTable()->addECG($tabDonnees, $idemploye);
	    
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $this->getConsultationTable()->addRadio($tabDonnees, $idemploye);
	    
	    /*Scanner*/
	    $this->getConsultationTable()->addScanner($tabDonnees, $idemploye);
	    
	    /*Echographie*/
	    $this->getConsultationTable()->addEchographie($tabDonnees, $idemploye);
	    
	    
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    /*type de diabete*/
	    $this->getConsultationTable()->addTypeDiabete($tabDonnees, $idemploye);
	    /*complication*/
	    $this->getConsultationTable()->addComplicationDiagEntree($tabDonnees, $idemploye);
	    
	    //Traitement --- Traitement --- Traitement
	    //Traitement --- Traitement --- Traitement
	    /*Hospitalisation*/
	    $this->getConsultationTable()->addHospitalisation($tabDonnees, $idemploye);
	    
	    /*Traitement*/
	    $this->getConsultationTable()->addTraitement($tabDonnees, $idemploye);
	    
	    
	    return $this->redirect()->toRoute('consultation' , array('action'=>'liste-consultations') );
	}
	
	
	public function enregistrerConsultationSuiviAction()
	{
	    
	    //var_dump('Consultation suivi'); exit();
	    
	    $idemploye = $this->layout()->user['id_employe'];
	    $tabDonnees = $this->params ()->fromPost();
	    //var_dump($tabDonnees); exit();
	    
	    // Consultation de suivi --- Consultation de suivi
	    // Consultation de suivi --- Consultation de suivi
	    $this->getConsultationTable()->addConsultationSuiv($tabDonnees, $idemploye);
	  
	    // Plaintes de Suivi --- Plaintes de Suivi
	    // Plaintes de Suivi --- Plaintes de Suivi
	    $this->getConsultationTable()->addPlaintesSuivi($tabDonnees, $idemploye);
	    
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $this->getConsultationTable()->addEtatGeneralSuiv($tabDonnees, $idemploye);
	    
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $this->getConsultationTable()->addExamenPhysiqueSuiv($tabDonnees, $idemploye);
	    
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $this->getConsultationTable()->addGlycemieAJeunSuiv($tabDonnees, $idemploye);
	    
	    /*Hémoglobine glyquée*/
	    $this->getConsultationTable()->addHemoglobineGlyqueeSuiv($tabDonnees, $idemploye);
	    
	    /*Créatininémie*/
	    $this->getConsultationTable()->addCreatininemieSuiv($tabDonnees, $idemploye);

	    /*Groupage rhesus*/
	    $this->getConsultationTable()->addGroupageRhesusSuiv($tabDonnees, $idemploye);
	    
	    /*taux_prothrombine (TP)*/
	    $this->getConsultationTable()->addTauxProthrombineSuiv($tabDonnees, $idemploye);
	    
	    /*temps_cephaline_active (TCA)*/
	    $this->getConsultationTable()->addTempsCephalineActiveSuiv($tabDonnees, $idemploye);
	    
	    /*cholesterol_hdl*/
	    $this->getConsultationTable()->addCholesterolHdlSuiv($tabDonnees, $idemploye);
	    
	    /*cholesterol_ldl*/
	    $this->getConsultationTable()->addCholesterolLdlSuiv($tabDonnees, $idemploye);
	     
	    /*uricemie*/
	    $this->getConsultationTable()->addUricemieSuiv($tabDonnees, $idemploye);
	    
	    /*triglycerides*/
	    $this->getConsultationTable()->addTriglyceridesSuiv($tabDonnees, $idemploye);
	    
	    /*Microalbuminurie*/
	    $this->getConsultationTable()->addMicroalbuminurieSuiv($tabDonnees, $idemploye);
	    
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $this->getConsultationTable()->addRadioSuiv($tabDonnees, $idemploye);
	    
	    /*Scanner*/
	    $this->getConsultationTable()->addScannerSuiv($tabDonnees, $idemploye);
	    
	    /*Echographie*/
	    $this->getConsultationTable()->addEchographieSuiv($tabDonnees, $idemploye);
	     
	    /*Consuite à suivre*/
	    $this->getConsultationTable()->addConduiteASuivre($tabDonnees, $idemploye);
	    
	    //echo "<pre>";
	    //var_dump($tabDonnees); exit();
	    //echo "</pre>";
	   
	    return $this->redirect()->toRoute('consultation' , array('action'=>'liste-consultations') );
	}
	
	
	public function modifierConsultationAction() {
	
	    $this->layout ()->setTemplate ( 'layout/consultation' );
	
	    $user = $this->layout()->user;
	    $idmedecin = $user['id_personne'];
	
	    $idpatient = $this->params ()->fromQuery ( 'idpatient', 0 );
	    $idcons = $this->params ()->fromQuery ( 'idcons' );
	
	    $liste = $this->getConsultationTable ()->getInfoPatient ( $idpatient );
	    $patient = $this->getPatientTable()->getPatient( $idpatient );
	    $consultation = $this->getConsultationTable()->getConsultation($idcons)->getArrayCopy();
	
	    $form = new ConsultationForm ();
	    $data = array (
	        'idadmission' => $consultation['idadmission'],
	        'idpatient' => $idpatient,
	        'idcons' => $idcons,
	    );
	
	    $listeProfessions = $this->getPersonneTable()->getListeProfessions();
	    $listeEthnies = $this->getPersonneTable()->getListeEthnies();
	    $listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
	    $listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
	    $listeSigne = $this->getPersonneTable()->getListeSigne();
	    $listeRace = $this->getPersonneTable()->getListeRace();
	
	    $form->get('PROFESSION')->setvalueOptions($listeProfessions);
	    $form->get('ETHNIE')->setvalueOptions($listeEthnies);
	    $form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
	    $form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
	
	    $form->get('motif_admission1')->setvalueOptions($listeSigne);
	    $form->get('motif_admission2')->setvalueOptions($listeSigne);
	    $form->get('motif_admission3')->setvalueOptions($listeSigne);
	    $form->get('motif_admission4')->setvalueOptions($listeSigne);
	    $form->get('motif_admission5')->setvalueOptions($listeSigne);
	
	
	    
	    // Motifs admission --- Motifs admission
	    // Motifs admission --- Motifs admission
	    $motif_admission = $this->getConsultationTable()->getMotifAdmission( $idcons );
	    $nbMotif = $this->getConsultationTable ()->nbMotifs ( $idcons );
	    $k = 1;
	    foreach ( $motif_admission as $Motifs ) {
	        $data ['motif_admission' . $k++] = $Motifs ['idlistemotif'];
	    }
	    
	    // Signes --- Signes
	    // Signes --- Signes
	    $signes = $this->getConsultationTable()->getSignes( $idcons );
	    $data['duree_des_signes'] = $signes['duree'];
	    $data['gravite_des_signes'] = $signes['gravite'];
	    
	    // Résumé histoire de la maladie
	    // Résumé histoire de la maladie
	    $histoireMaladie = $this->getConsultationTable()->getResumeHistoireMaladie( $idcons );
	    $data['resume_histoire_maladie'] = $histoireMaladie['resume'];
	    
	
	    /**
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     */
	    // Infos diabetique --- Infos diabetique
	    // Infos diabetique --- Infos diabetique
	    $infosDiabetique = $this->getConsultationTable()->getInfosDiabetique( $idpatient );
	    $infosDiabetique = $infosDiabetique ? $infosDiabetique : array();
	    
	    // Autre terrain connu --- Autre terrain connu
	    // Autre terrain connu --- Autre terrain connu
	    $autreTerrainConnu = $this->getConsultationTable()->getAutreTerrainConnu( $idpatient );
	    $autreTerrainConnu = $autreTerrainConnu ? $autreTerrainConnu : array();
	     
	    // Les antécédents médicaux --- Les antécédents médicaux
	    // Les antécédents médicaux --- Les antécédents médicaux
	    $antMedicaux = $this->getConsultationTable()->getAntMedicaux( $idpatient );
	    $antMedicaux = $antMedicaux ? $antMedicaux : array();
	     
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    $antChirurgicaux = $this->getConsultationTable()->getAntChirurgicaux( $idpatient );
	    $antChirurgicaux = $antChirurgicaux ? $antChirurgicaux : array();
	     
	    $data = array_merge($data, $infosDiabetique, $autreTerrainConnu, $antMedicaux, $antChirurgicaux);
	    /**
	     * =================================================
	     */
	    	  
	
	    
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $etatGeneral = $this->getConsultationTable()->getEtatGeneral( $idcons );
	    $etatGeneral = $etatGeneral ? $etatGeneral : array();
	    
	    $data = array_merge($data, $etatGeneral);
	    
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $examenPhysique = $this->getConsultationTable()->getExamenPhysique( $idcons );
	    
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $glycemieAJeun = $this->getConsultationTable()->getGlycemieAJeun( $idcons );
	    $glycemieAJeun = $glycemieAJeun ? $glycemieAJeun : array();

	    /*Hémoglobine glyquée*/
	    $hemoGlyquee = $this->getConsultationTable()->getHemoglobineGlyquee( $idcons );
	    $hemoGlyquee = $hemoGlyquee ? $hemoGlyquee : array(); 
	    
	    /*Créatininémie*/
	    $creatininemie = $this->getConsultationTable()->getInfosAnalyse("creatininemie", $idcons);
	    $creatininemie = $creatininemie ? $creatininemie : array();
	    
	    /*Groupage rhesus*/
	    $groupageRhesus = $this->getConsultationTable()->getInfosAnalyse("groupage_rhesus", $idcons);
	    $groupageRhesus = $groupageRhesus ? $groupageRhesus : array();
	    
	    
	    /*taux_prothrombine (TP)*/
	    $Tp = $this->getConsultationTable()->getInfosAnalyse("taux_prothrombine", $idcons);
	    $Tp = $Tp ? $Tp : array();
	    
	    /*temps_cephaline_active (TCA)*/
	    $Tca = $this->getConsultationTable()->getInfosAnalyse("temps_cephaline_active", $idcons);
	    $Tca = $Tca ? $Tca : array();
	    
	    /*cholesterol_hdl*/
	    $hdl = $this->getConsultationTable()->getInfosAnalyse("cholesterol_hdl", $idcons);
	    $hdl = $hdl ? $hdl : array();
	    
	    /*cholesterol_ldl*/
	    $ldl = $this->getConsultationTable()->getInfosAnalyse("cholesterol_ldl", $idcons);
	    $ldl = $ldl ? $ldl : array();
	    
	    /*uricemie*/
	    $uricemie = $this->getConsultationTable()->getInfosAnalyse("uricemie", $idcons);
	    $uricemie = $uricemie ? $uricemie : array();
	    
	    /*triglycerides*/
	    $triglycerides = $this->getConsultationTable()->getInfosAnalyse("triglycerides", $idcons);
	    $triglycerides = $triglycerides ? $triglycerides : array();
	    
	    /*Microalbuminurie*/
	    $microAlbuminurie = $this->getConsultationTable()->getInfosAnalyse("microalbuminurie", $idcons);
	    $microAlbuminurie = $microAlbuminurie ? $microAlbuminurie : array();
	    
	    $data = array_merge($data, $glycemieAJeun, $hemoGlyquee, $creatininemie, $groupageRhesus, $Tp, $Tca, $hdl, $ldl, $uricemie, $triglycerides, $microAlbuminurie);
	    
	    //Examens fonctionnels --- Examens fonctionnels
	    //Examens fonctionnels --- Examens fonctionnels
	    $ecg = $this->getConsultationTable()->getInfosAnalyse("ecg", $idcons);
	    $ecg = $ecg ? $ecg : array();
	    
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $radio = $this->getConsultationTable()->getInfosAnalyse("radio", $idcons);
	    $radio = $radio ? $radio : array();
	    
	    /*Scanner*/
	    $scanner = $this->getConsultationTable()->getInfosAnalyse("scanner", $idcons);
	    $scanner = $scanner ? $scanner : array();
	    
	    /*Echographie*/
	    $echographie = $this->getConsultationTable()->getInfosAnalyse("echographie", $idcons);
	    $echographie = $echographie ? $echographie : array();
	    
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    /*type de diabete*/
	    $typediabete = $this->getConsultationTable()->getInfosAnalyse("type_diabete", $idcons);
	    $typediabete = $typediabete ? $typediabete : array();
	    
	    $data = array_merge($data, $ecg, $radio, $scanner, $echographie, $typediabete);
	    
	    /*complication*/
	    $complicationDiagEntree = $this->getConsultationTable()->getComplicationDiagEntree( $idcons );
	     
	    //Traitement --- Traitement --- Traitement
	    //Traitement --- Traitement --- Traitement
	    /*Hospitalisation*/
	    $hospitalisation = $this->getConsultationTable()->getInfosAnalyse("hospitalisation", $idcons);
	    $hospitalisation = $hospitalisation ? $hospitalisation : array();
	     
	    /*Traitement*/
	    $traitement = $this->getConsultationTable()->getInfosAnalyse("traitement", $idcons);
	    $traitement = $traitement ? $traitement : array();
	    
	    $data = array_merge($data, $hospitalisation, $traitement);
	    
	    $form->populateValues($data);
	
	
	    //echo "<pre>";
	    //var_dump($consultation); exit();
	    //echo "</pre>";
	    
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
	        'date' => $consultation['date'],
	        'heure' => $consultation['heure'],
	
	        /*MOTIF ADMISSION --- MOTIF ADMISSION*/
	        'nbMotifs' => $nbMotif,
	
	        'examenPhysique' => $examenPhysique,
	        'nbExamenPhysique' => $examenPhysique->count(),
	        
	        'complicationDiagEntree' => $complicationDiagEntree,
	        'nbComplicationDiagEntree' => $complicationDiagEntree->count(),
	        
	        'listeRace' => $listeRace,
	    );
	
	}
	
	public function getInfosConsultationSuivi($idsuiv){
	
	    $data = array ( );
	    
	
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $etatGeneral = $this->getConsultationTable()->getEtatGeneralSuiv($idsuiv );
	    $etatGeneral = $etatGeneral ? $etatGeneral : array();
	
	    $data = array_merge($data, $etatGeneral);
	
	    //Plaintes de Suivi --- Plaintes de Suivi
	    //Plaintes de Suivi --- Plaintes de Suivi
	    $plaintesSuivi = $this->getConsultationTable()->getPlaintesSuivi($idsuiv);
	    $data['plaintesSuivi'] = $plaintesSuivi;
	    
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $examenPhysique = $this->getConsultationTable()->getExamenPhysiqueSuiv( $idsuiv );
	    $data['examenPhysiqueSuiv'] = $examenPhysique;
	     
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $glycemieAJeun = $this->getConsultationTable()->getInfosAnalyseSuiv("glycemie_a_jeun", $idsuiv );
	    $glycemieAJeun = $glycemieAJeun ? array("glycemie_jeun_suiv" => $glycemieAJeun['glycemie_jeun']) : array();
	    
	    //var_dump($glycemieAJeun); exit();
	     
	    /*Hémoglobine glyquée*/
	    $hemoGlyquee = $this->getConsultationTable()->getInfosAnalyseSuiv("hemoglobine_glyquee", $idsuiv );
	    $hemoGlyquee = $hemoGlyquee ? array("hemoglobine_glyquee_suiv" => $hemoGlyquee['hemoglobine_glyquee']) : array();
	
	    /*Créatininémie*/
	    $creatininemie = $this->getConsultationTable()->getInfosAnalyseSuiv("creatininemie", $idsuiv);
	    $creatininemie = $creatininemie ? array('creatininemie_suiv' => $creatininemie['creatininemie']) : array();
	
	    /*Groupage rhesus*/
	    $groupageRhesus = $this->getConsultationTable()->getInfosAnalyseSuiv("groupage_rhesus", $idsuiv);
	    $groupageRhesus = $groupageRhesus ? array('grsh_suiv' => $groupageRhesus['grsh']) : array();
	
	
	    /*taux_prothrombine (TP)*/
	    $Tp = $this->getConsultationTable()->getInfosAnalyseSuiv("taux_prothrombine", $idsuiv);
	    $Tp = $Tp ? array('tp_suiv' => $Tp['tp']) : array();
	
	    /*temps_cephaline_active (TCA)*/
	    $Tca = $this->getConsultationTable()->getInfosAnalyseSuiv("temps_cephaline_active", $idsuiv);
	    $Tca = $Tca ? array('tca_suiv' => $Tca['tca']) : array();
	
	    /*cholesterol_hdl*/
	    $hdl = $this->getConsultationTable()->getInfosAnalyseSuiv("cholesterol_hdl", $idsuiv);
	    $hdl = $hdl ? array('hdl_c_suiv' => $hdl['hdl_c']) : array();
	
	    /*cholesterol_ldl*/
	    $ldl = $this->getConsultationTable()->getInfosAnalyseSuiv("cholesterol_ldl", $idsuiv);
	    $ldl = $ldl ? array('ldl_c_suiv' => $ldl['ldl_c']) : array();
	
	    /*uricemie*/
	    $uricemie = $this->getConsultationTable()->getInfosAnalyseSuiv("uricemie", $idsuiv);
	    $uricemie = $uricemie ? array('uricemie_suiv' => $uricemie['uricemie']) : array();
	
	    /*triglycerides*/
	    $triglycerides = $this->getConsultationTable()->getInfosAnalyseSuiv("triglycerides", $idsuiv);
	    $triglycerides = $triglycerides ? array('triglycerides_suiv' => $triglycerides['triglycerides']) : array();
	
	    /*Microalbuminurie*/
	    $microAlbuminurie = $this->getConsultationTable()->getInfosAnalyseSuiv("microalbuminurie", $idsuiv);
	    $microAlbuminurie = $microAlbuminurie ? array('microalbuminurie_pu24h_suiv' => $microAlbuminurie['microalbuminurie_pu24h']) : array();
	
	    $data = array_merge($data, $glycemieAJeun, $hemoGlyquee, $creatininemie, $groupageRhesus, $Tp, $Tca, $hdl, $ldl, $uricemie, $triglycerides, $microAlbuminurie);
	
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $radio = $this->getConsultationTable()->getInfosAnalyseSuiv("radio", $idsuiv);
	    $radio = $radio ? array('rsd1_suiv' => $radio['rsd1'], 'rsd2_suiv' => $radio['rsd2']) : array();
	
	    /*Scanner*/
	    $scanner = $this->getConsultationTable()->getInfosAnalyseSuiv("scanner", $idsuiv);
	    $scanner = $scanner ? array('scanner_suiv' => $scanner['scanner'], 'echodoppler_suiv' => $scanner['echodoppler']) : array();
	
	    /*Echographie*/
	    $echographie = $this->getConsultationTable()->getInfosAnalyseSuiv("echographie", $idsuiv);
	    $echographie = $echographie ? array('echographie1_suiv' => $echographie['echographie1'], 'echographie2_suiv' => $echographie['echographie2']) : array();
	
	    $data = array_merge($data, $radio, $scanner, $echographie);
	
	    //Conduite à tenir --- Conduite à tenir
	    //Conduite à tenir --- Conduite à tenir
	    $conduiteASuivre = $this->getConsultationTable()->getConduiteASuivre($idsuiv);
	    $data['conduite_a_suivre_suivi'] = $conduiteASuivre['conduite_a_suivre'];
	    
	    
	    //var_dump($data); exit();
	     
	    return $data;
	}
	
	
	public function modifierConsultationSuiviAction(){

	    $this->layout ()->setTemplate ( 'layout/consultation' );
	    
	    $user = $this->layout()->user;
	    $idmedecin = $user['id_personne'];
	    
	    $idpatient = $this->params ()->fromQuery ( 'idpatient', 0 );
	    $idsuiv = $this->params ()->fromQuery ( 'idsuiv', 0 );
	    
	    $liste = $this->getConsultationTable ()->getInfoPatient ( $idpatient );
	    $patient = $this->getPatientTable()->getPatient( $idpatient );
	    
	    $form = new ConsultationForm ();
	    
	    $listeProfessions = $this->getPersonneTable()->getListeProfessions();
	    $listeEthnies = $this->getPersonneTable()->getListeEthnies();
	    $listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
	    $listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
	    $listeSigne = $this->getPersonneTable()->getListeSigne();
	    $listeRace = $this->getPersonneTable()->getListeRace();
	    
	    $form->get('PROFESSION')->setvalueOptions($listeProfessions);
	    $form->get('ETHNIE')->setvalueOptions($listeEthnies);
	    $form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
	    $form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
	    
	    $form->get('motif_admission1')->setvalueOptions($listeSigne);
	    $form->get('motif_admission2')->setvalueOptions($listeSigne);
	    $form->get('motif_admission3')->setvalueOptions($listeSigne);
	    $form->get('motif_admission4')->setvalueOptions($listeSigne);
	    $form->get('motif_admission5')->setvalueOptions($listeSigne);
	    
	    
	    $data = array (
	        'idpatient' => $idpatient
	    );
	    
	    
	    /**
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     */
	    // Infos diabetique --- Infos diabetique
	    // Infos diabetique --- Infos diabetique
	    $infosDiabetique = $this->getConsultationTable()->getInfosDiabetique( $idpatient );
	    $infosDiabetique = $infosDiabetique ? $infosDiabetique : array();
	    	
	    // Autre terrain connu --- Autre terrain connu
	    // Autre terrain connu --- Autre terrain connu
	    $autreTerrainConnu = $this->getConsultationTable()->getAutreTerrainConnu( $idpatient );
	    $autreTerrainConnu = $autreTerrainConnu ? $autreTerrainConnu : array();
	    
	    // Les antécédents médicaux --- Les antécédents médicaux
	    // Les antécédents médicaux --- Les antécédents médicaux
	    $antMedicaux = $this->getConsultationTable()->getAntMedicaux( $idpatient );
	    $antMedicaux = $antMedicaux ? $antMedicaux : array();
	    
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    $antChirurgicaux = $this->getConsultationTable()->getAntChirurgicaux( $idpatient );
	    $antChirurgicaux = $antChirurgicaux ? $antChirurgicaux : array();
	    
	    $data = array_merge($data, $infosDiabetique, $autreTerrainConnu, $antMedicaux, $antChirurgicaux);
	    /**
	     * =================================================
	     */
	    
	    
	    
	    /**============================================================
	     **============================================================
	     * Donnees d'entrée automatique -- Donnees d'entrée automatique
	     *_____________________________________________________________
	     *_____________________________________________________________
	     */
	    $nbMotifs = 0;
	    $examenPhysique = array();
	    $nbExamenPhysique = 0;
	    $complicationDiagEntree = array();
	    $nbComplicationDiagEntree = 0;
	    $datesuiv = '';
	    $heuresuiv = '';
	    /**----------------------------------------------------------*/
	    
	    
	    /**
	     * Récupérer la premiere consultation générale du patient différente des consultations de suivi
	     */
	    $consultationGlobale = $this->getConsultationTable ()->getConsultationPatientDifferentDeSuivi( $idpatient );
	    
	    /**
	     * Vérifier si le patient a déjà une consultation de suivi
	     */
	    $consultationSuivi = $this->getConsultationTable ()->getConsultationDeSuiviDuPatient( $idsuiv, $idpatient );
	    
	    if($consultationSuivi){
	        $infosConsultationGlobale = $this->getInfosConsultationGlobale($consultationGlobale['idcons']);
	        $data = array_merge($data, $infosConsultationGlobale);
	        
	        $nbMotifs = $infosConsultationGlobale['nbMotifs'];
	        $examenPhysique = $infosConsultationGlobale['examenPhysique'];
	        $nbExamenPhysique = $examenPhysique->count();
	        $complicationDiagEntree = $infosConsultationGlobale['complicationDiagEntree'];
	        $nbComplicationDiagEntree = $complicationDiagEntree->count();
	         
	        /**Infos de suivi*/
	        $idsuiv = $consultationSuivi["idsuiv"];
	        $datesuiv = $consultationSuivi["date"];
	        $heuresuiv = $consultationSuivi["heure"];
	        $data['idadmissionsuiv'] = $consultationSuivi["idadmission"];
	        $data['idsuiv'] = $idsuiv;
	        
	        /**Infos consultation globale*/
	        $idcons = $consultationGlobale['idcons'];
	        $date = $consultationGlobale['date'];
	        $heure = $consultationGlobale['heure'];
	        $data['idadmission'] = $consultationGlobale['idadmission'];
	        $data['idcons'] = $idcons;
	        
	        /**Informations du suivi*/
	        $infosConsultationSuivi = $this->getInfosConsultationSuivi($idsuiv);
	        $data = array_merge($data, $infosConsultationSuivi);
	        $plaintesSuivi = $infosConsultationSuivi['plaintesSuivi'];
	        $nbPlaintesSuivi = $plaintesSuivi->count();
	        $examenPhysiqueSuivi = $infosConsultationSuivi['examenPhysiqueSuiv'];
	        $nbExamenPhysiqueSuivi = $examenPhysiqueSuivi->count();
	    }
	    
	    $form->populateValues($data);
	    
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
	        
	        'idsuiv' => $idsuiv,
	        'datesuiv' => $datesuiv,
	        'heuresuiv' => $heuresuiv,
	        	
	        /*MOTIF ADMISSION --- MOTIF ADMISSION*/
	        'nbMotifs' => $nbMotifs,
	    
	        'examenPhysique' => $examenPhysique,
	        'nbExamenPhysique' => $nbExamenPhysique,
	    
	        'complicationDiagEntree' => $complicationDiagEntree,
	        'nbComplicationDiagEntree' => $nbComplicationDiagEntree,
	        
	        'plaintesSuivi' => $plaintesSuivi,
	        'nbPlaintesSuivi' => $nbPlaintesSuivi,
	        
	        'examenPhysiqueSuivi' => $examenPhysiqueSuivi,
	        'nbExamenPhysiqueSuivi' => $nbExamenPhysiqueSuivi,
	        
	        'listeRace' => $listeRace,
	    );
	    
	}
	
	
	
	public function enregistrerModificationConsultationAction()
	{
	    $idemploye = $this->layout()->user['id_employe'];
	    $tabDonnees = $this->params ()->fromPost();
	
	    //var_dump($tabDonnees); exit();
	    
	    $this->enregistrementModificationConsultationGlobale($tabDonnees, $idemploye);
	    
	    return $this->redirect()->toRoute('consultation' , array('action'=>'liste-consultations') );
	}
	
	
	/**
	 * Pour enregistrer les modifications liées à la consultation globale
	 */
	public function enregistrementModificationConsultationGlobale($tabDonnees, $idemploye){
	    
	    // Consultation --- Consultation
	    // Consultation --- Consultation
	    $this->getConsultationTable()->updateConsultations($tabDonnees, $idemploye);
	    
	    // Motifs admission --- Motifs admission
	    // Motifs admission --- Motifs admission
	    $this->getConsultationTable()->updateMotifAdmission($tabDonnees, $idemploye);
	    
	    // Signes --- Signes
	    // Signes --- Signes
	    $this->getConsultationTable()->updateSignes($tabDonnees, $idemploye);
	     
	    // Résumé histoire de la maladie
	    // Résumé histoire de la maladie
	    $this->getConsultationTable()->updateResumeHistoireMaladie($tabDonnees, $idemploye);
	     
	    /**
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     * ANTECEDENT PERSONNELS --- ANTECEDENTS PERSONNELS
	     */
	    // Infos diabetique --- Infos diabetique
	    // Infos diabetique --- Infos diabetique
	    $this->getConsultationTable()->addInfosDiabetique($tabDonnees, $idemploye);
	     
	    // Autre terrain connu --- Autre terrain connu
	    // Autre terrain connu --- Autre terrain connu
	    $this->getConsultationTable()->addAutreTerrainConnu($tabDonnees, $idemploye);
	    
	    // Les antécédents médicaux --- Les antécédents médicaux
	    // Les antécédents médicaux --- Les antécédents médicaux
	    $this->getConsultationTable()->addAntMedicaux($tabDonnees, $idemploye);
	     
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    // Les antécédents chirurgicaux --- Les antécédents chirurgicaux
	    $this->getConsultationTable()->addAntChirurgicaux($tabDonnees, $idemploye);
	     
	    /**
	     * =================================================
	     */
	    
	    
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $this->getConsultationTable()->updateEtatGeneral($tabDonnees, $idemploye);
	     
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $this->getConsultationTable()->addExamenPhysique($tabDonnees, $idemploye);
	    
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $this->getConsultationTable()->addGlycemieAJeun($tabDonnees, $idemploye);
	     
	    /*Hémoglobine glyquée*/
	    $this->getConsultationTable()->addHemoglobineGlyquee($tabDonnees, $idemploye);
	     
	    /*Créatininémie*/
	    $this->getConsultationTable()->addCreatininemie($tabDonnees, $idemploye);
	     
	    /*Groupage rhesus*/
	    $this->getConsultationTable()->addGroupageRhesus($tabDonnees, $idemploye);
	     
	    /*taux_prothrombine (TP)*/
	    $this->getConsultationTable()->addTauxProthrombine($tabDonnees, $idemploye);
	     
	    /*temps_cephaline_active (TCA)*/
	    $this->getConsultationTable()->addTempsCephalineActive($tabDonnees, $idemploye);
	     
	    /*cholesterol_hdl*/
	    $this->getConsultationTable()->addCholesterolHdl($tabDonnees, $idemploye);
	     
	    /*cholesterol_ldl*/
	    $this->getConsultationTable()->addCholesterolLdl($tabDonnees, $idemploye);
	     
	    /*uricemie*/
	    $this->getConsultationTable()->addUricemie($tabDonnees, $idemploye);
	     
	    /*triglycerides*/
	    $this->getConsultationTable()->addTriglycerides($tabDonnees, $idemploye);
	     
	    /*Microalbuminurie*/
	    $this->getConsultationTable()->addMicroalbuminurie($tabDonnees, $idemploye);
	    
	    //Examens fonctionnels --- Examens fonctionnels
	    //Examens fonctionnels --- Examens fonctionnels
	    $this->getConsultationTable()->addECG($tabDonnees, $idemploye);
	     
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $this->getConsultationTable()->addRadio($tabDonnees, $idemploye);
	     
	    /*Scanner*/
	    $this->getConsultationTable()->addScanner($tabDonnees, $idemploye);
	     
	    /*Echographie*/
	    $this->getConsultationTable()->addEchographie($tabDonnees, $idemploye);
	     
	     
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    //Diagnostic à l'entrée --- Diagnostic à l'entrée
	    /*type de diabete*/
	    $this->getConsultationTable()->addTypeDiabete($tabDonnees, $idemploye);
	    
	    /*complication*/
	    $this->getConsultationTable()->addComplicationDiagEntree($tabDonnees, $idemploye);
	     
	    //Traitement --- Traitement --- Traitement
	    //Traitement --- Traitement --- Traitement
	    /*Hospitalisation*/
	    $this->getConsultationTable()->addHospitalisation($tabDonnees, $idemploye);
	     
	    /*Traitement*/
	    $this->getConsultationTable()->addTraitement($tabDonnees, $idemploye);
	    
	}
	
	
	public function enregistrerModificationConsultationSuiviAction()
	{   
	    $idemploye = $this->layout()->user['id_employe'];
	    $tabDonnees = $this->params ()->fromPost();
	     
	    $this->enregistrementModificationConsultationGlobale($tabDonnees, $idemploye);
	    
	
	    /***
	     * =============================================================
	     * ------- CONCLUSION DE SUIVI --- CONSULTATION DE SUIVI -------
	     * =============================================================
	     */

	    // Plaintes de Suivi --- Plaintes de Suivi
	    // Plaintes de Suivi --- Plaintes de Suivi
	    $this->getConsultationTable()->addPlaintesSuivi($tabDonnees, $idemploye);
	     
	    //Examen général --- Examen général
	    //Examen général --- Examen général
	    $this->getConsultationTable()->updateEtatGeneralSuiv($tabDonnees, $idemploye);
	     
	    //Examen physique --- Examen physique
	    //Examen physique --- Examen physique
	    $this->getConsultationTable()->addExamenPhysiqueSuiv($tabDonnees, $idemploye);
	     
	    //Examens biologiques --- Examens biologiques
	    //Examens biologiques --- Examens biologiques
	    /* Glycémie à jeun*/
	    $this->getConsultationTable()->addGlycemieAJeunSuiv($tabDonnees, $idemploye);
	     
	    /*Hémoglobine glyquée*/
	    $this->getConsultationTable()->addHemoglobineGlyqueeSuiv($tabDonnees, $idemploye);
	     
	    /*Créatininémie*/
	    $this->getConsultationTable()->addCreatininemieSuiv($tabDonnees, $idemploye);
	    
	    /*Groupage rhesus*/
	    $this->getConsultationTable()->addGroupageRhesusSuiv($tabDonnees, $idemploye);
	     
	    /*taux_prothrombine (TP)*/
	    $this->getConsultationTable()->addTauxProthrombineSuiv($tabDonnees, $idemploye);
	     
	    /*temps_cephaline_active (TCA)*/
	    $this->getConsultationTable()->addTempsCephalineActiveSuiv($tabDonnees, $idemploye);
	     
	    /*cholesterol_hdl*/
	    $this->getConsultationTable()->addCholesterolHdlSuiv($tabDonnees, $idemploye);
	     
	    /*cholesterol_ldl*/
	    $this->getConsultationTable()->addCholesterolLdlSuiv($tabDonnees, $idemploye);
	    
	    /*uricemie*/
	    $this->getConsultationTable()->addUricemieSuiv($tabDonnees, $idemploye);
	     
	    /*triglycerides*/
	    $this->getConsultationTable()->addTriglyceridesSuiv($tabDonnees, $idemploye);
	     
	    /*Microalbuminurie*/
	    $this->getConsultationTable()->addMicroalbuminurieSuiv($tabDonnees, $idemploye);
	     
	    //Examens radiologiques --- Examens radiologiques
	    //Examens radiologiques --- Examens radiologiques
	    /*Radiologie*/
	    $this->getConsultationTable()->addRadioSuiv($tabDonnees, $idemploye);
	     
	    /*Scanner*/
	    $this->getConsultationTable()->addScannerSuiv($tabDonnees, $idemploye);
	     
	    /*Echographie*/
	    $this->getConsultationTable()->addEchographieSuiv($tabDonnees, $idemploye);
	    
	    /*Consuite à suivre*/
	    $this->getConsultationTable()->addConduiteASuivre($tabDonnees, $idemploye);
	    
	     
	   /**
	    * =======================================================
	    * -------------------------------------------------------
	    * =======================================================
	    */
	    
	    //echo "<pre>";
	    //var_dump($tabDonnees); exit();
	    //echo "</pre>";

	    return $this->redirect()->toRoute('consultation' , array('action'=>'liste-consultations') );
	}
	
	
	/**
	 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI
	 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI
	 * SCRIPT GESTION DES IMAGES POUR LES CONSULTATIONS DE SUIVI
	 * */
	
	
	public function imageIconographieSuiviAction(){
	
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
	
	    $pikame = 'pikameSuiv'.$position;
	    $pika2  = 'pikaSuiv'.$nbImgPika2;
	
	
	
	
	    if($ajout == 1){
	        if($formatFichier == 'jpeg'){
	            $html ="<div id='".$pika2."' align='center'>
					      <div class='pikachoose' style='height: 210px;'>
	                        <ul id='".$pikame."' class='jcarousel-skin-pika'>";
	            $html .=$pickaChoose;
	            $html .="   </ul>
	                      </div>
					 	</div>";
	
	                $html.="<script>
					         scriptPikameChooseSuiv(".$position.");
					        </script>";
	
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
	        	
	            $html.="<script>
					         scriptPikameChooseSuiv(".$position.");
					        </script>";
	    }
	
	    	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	public function supprimerImageIconographieSuiviAction()
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
	
	
	public function imagesDifferentsExamensSuiviAction(){
	
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
	            $html ="<div id='pikaSuiv2".$examen."' align='center'>
					      <div class='pikachoose' style='height: 210px;'>
	                        <ul id='pikameSuiv".$examen."' class='jcarousel-skin-pika'>";
	            $html .=$pickaChoose;
	            $html .="   </ul>
	                      </div>
					 	</div>";
	
	            $html.="<script>
				         scriptPikameChooseOtherSuiv('".$examen."');
				        </script>";
	
	        }else {
	            $html ="";
	        }
	
	    }else {
	        $html ="<div id='pikaSuiv2".$examen."' align='center'>
				    <div class='pikachoose' style='height: 210px;'>
                      <ul id='pikameSuiv".$examen."' class='jcarousel-skin-pika'>";
	        $html .=$pickaChoose;
	        $html .="     </ul>
                    </div>
				 </div>";
	
	        $html.="<script>
			         scriptPikameChooseOtherSuiv('".$examen."');
			        </script>";
	    }
	
	    	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function supprimerImagesDifferentsExamensSuiviAction()
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
	
	
	//GESTION DES HISTORIQUES --- GESTION DES HISTORIQUES
	//GESTION DES HISTORIQUES --- GESTION DES HISTORIQUES
	/**
	 * Afficher la liste des historiques consultations du patient
	 */
	public function historiquesConsultationsSuiviPatientAjaxAction() {
	    $idpatient = $this->params ()->fromRoute ( 'id', 0 );
	    $output = $this->getConsultationTable()->getListeHistoriquesConsultationsSuivis($idpatient);
	    return $this->getResponse ()->setContent ( Json::encode ( $output, array (
	        'enableJsonExprFinder' => true
	    ) ) );
	}
	
	
	public function visualiserConsultationSuiviAction() {

	    $this->layout ()->setTemplate ( 'layout/consultation' );
	     
	    $user = $this->layout()->user;
	    $idmedecin = $user['id_personne'];
	     
	    $idpatient = $this->params ()->fromQuery ( 'idpatient', 0 );
	    $idsuiv = $this->params ()->fromQuery ( 'idsuiv', 0 );
	    
	    $liste = $this->getConsultationTable ()->getInfoPatient ( $idpatient );
	    $patient = $this->getPatientTable()->getPatient( $idpatient );
	     
	    $listeProfessions = $this->getPersonneTable()->getListeProfessions();
	    $listeEthnies = $this->getPersonneTable()->getListeEthnies();
	    $listeStatutMatrimonial = $this->getPersonneTable()->getListeStatutMatrimonial();
	    $listeRegimeMatrimonial = $this->getPersonneTable()->getListeRegimeMatrimonial();
	    $listeRace = $this->getPersonneTable()->getListeRace();
	     
	    $form = new ConsultationForm ();
	    $form->get('PROFESSION')->setvalueOptions($listeProfessions);
	    $form->get('ETHNIE')->setvalueOptions($listeEthnies);
	    $form->get('STATUT_MATRIMONIAL')->setvalueOptions($listeStatutMatrimonial);
	    $form->get('REGIME_MATRIMONIAL')->setvalueOptions($listeRegimeMatrimonial);
	     
	    $data = array ( 'idpatient' => $idpatient );
	         
	    /**============================================================
	     **============================================================
	     * Donnees d'entrée automatique -- Donnees d'entrée automatique
	     *_____________________________________________________________
	     *_____________________________________________________________
	     */
	    $nbMotifs = 0;
	    $examenPhysique = array();
	    $nbExamenPhysique = 0;
	    $complicationDiagEntree = array();
	    $nbComplicationDiagEntree = 0;
	    $datesuiv = '';
	    $heuresuiv = '';
	    /**----------------------------------------------------------*/
	      
	        
	    /**
	     * Récupérer la premiere consultation générale du patient différente des consultations de suivi
	     */
	    $consultationGlobale = $this->getConsultationTable ()->getConsultationPatientDifferentDeSuivi( $idpatient );
	     
	    /**
	     * Vérifier si le patient a déjà une consultation de suivi
	     */
	    $consultationSuivi = $this->getConsultationTable ()->getConsultationDeSuiviDuPatient( $idsuiv, $idpatient );
	     
	    if($consultationSuivi){
	        $infosConsultationGlobale = $this->getInfosConsultationGlobale($consultationGlobale['idcons']);
	         
	        $nbMotifs = $infosConsultationGlobale['nbMotifs'];
	        $examenPhysique = $infosConsultationGlobale['examenPhysique'];
	        $nbExamenPhysique = $examenPhysique->count();
	        $complicationDiagEntree = $infosConsultationGlobale['complicationDiagEntree'];
	        $nbComplicationDiagEntree = $complicationDiagEntree->count();
	    
	        /**Infos de suivi*/
	        $idsuiv = $consultationSuivi["idsuiv"];
	        $datesuiv = $consultationSuivi["date"];
	        $heuresuiv = $consultationSuivi["heure"];
	        $data['idadmissionsuiv'] = $consultationSuivi["idadmission"];
	        $data['idsuiv'] = $idsuiv;
	         
	        /**Infos consultation globale*/
	        $idcons = $consultationGlobale['idcons'];
	        $date = $consultationGlobale['date'];
	        $heure = $consultationGlobale['heure'];
	        $data['idadmission'] = $consultationGlobale['idadmission'];
	        $data['idcons'] = $idcons;
	         
	        /**Informations du suivi*/
	        $infosConsultationSuivi = $this->getInfosConsultationSuivi($idsuiv);
	        $data = array_merge($data, $infosConsultationSuivi);
	        $plaintesSuivi = $infosConsultationSuivi['plaintesSuivi'];
	        $nbPlaintesSuivi = $plaintesSuivi->count();
	        $examenPhysiqueSuivi = $infosConsultationSuivi['examenPhysiqueSuiv'];
	        $nbExamenPhysiqueSuivi = $examenPhysiqueSuivi->count();
	    }
	    
	    $form->populateValues($data);
	     
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
	         
	        'idsuiv' => $idsuiv,
	        'datesuiv' => $datesuiv,
	        'heuresuiv' => $heuresuiv,
	    
	        /*MOTIF ADMISSION --- MOTIF ADMISSION*/
	        'nbMotifs' => $nbMotifs,
	         
	        'examenPhysique' => $examenPhysique,
	        'nbExamenPhysique' => $nbExamenPhysique,
	         
	        'complicationDiagEntree' => $complicationDiagEntree,
	        'nbComplicationDiagEntree' => $nbComplicationDiagEntree,
	         
	        'plaintesSuivi' => $plaintesSuivi,
	        'nbPlaintesSuivi' => $nbPlaintesSuivi,
	         
	        'examenPhysiqueSuivi' => $examenPhysiqueSuivi,
	        'nbExamenPhysiqueSuivi' => $nbExamenPhysiqueSuivi,
	        
	        'listeRace' => $listeRace,
	    );
	    
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function listeQuartierSelectAction()
	{
	    $idcommune = $this->params()->fromPost('idcommune');
	     
	    $html  = "";
	    $listeQuatiers = $this->getConsultationTable()->getListeQuatiers($idcommune);
	    for($i = 0 ; $i <  count($listeQuatiers); $i++){
	        $html .="<option  value='".$listeQuatiers[$i]['id']."'>".str_replace("'", "'", $listeQuatiers[$i]['libelle'])."</option>";
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	/**
	 * GESTION DES DONNEES PARAMETRABLES --- GESTION DES DONNEES PARAMETRABLES
	 * 
	 */
	public function listeTypesElementsSelectAction()
	{
	    $tabTypeElement = $this->params()->fromPost('tabTypeElemBD');
	    
	    $html  = "";
	    $listeTypesElements = $this->getConsultationTable()->getListeTypeElementsOrdreDecroissant($tabTypeElement);
	    for($i = 0 ; $i <  count($listeTypesElements); $i++){
	        $html .="<option  value='".$listeTypesElements[$i]['id']."'>".str_replace("'", "'", $listeTypesElements[$i]['libelle'])."</option>";
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function listeTypesElementsAction()
	{
	    $tabTypeElement = $this->params()->fromPost('tabTypeElemBD');
	    
	    $html  = "";
	    $listeTypesElements = $this->getConsultationTable()->getListeTypeElementsOrdreDecroissant($tabTypeElement);
	    for($i = 0 ; $i <  count($listeTypesElements); $i++){
	        if($i == 0){
	            $html .="<tr><td class='LTPE1  iconeIndicateurChoix_".$listeTypesElements[$i]['id']."'><a href='javascript:afficherListeElementDuType(".$listeTypesElements[$i]['id'].");'><img src='".$this->baseUrl()."public/images_icons/greenarrowright.png'></a></td> <td class='LTPE2  LTPE2_".$listeTypesElements[$i]['id']."' ><span>".str_replace("'", "'", $listeTypesElements[$i]['libelle'])."</span><img onclick='modifierInfosTypeElement(".$listeTypesElements[$i]['id'].");' class='imgLTPE2' src='".$this->baseUrl()."public/images_icons/light/pencil.png'> </td></tr>";
	        }else{
	            $html .="<tr><td class='LTPE1  iconeIndicateurChoix_".$listeTypesElements[$i]['id']."'><a href='javascript:afficherListeElementDuType(".$listeTypesElements[$i]['id'].");'><img src='".$this->baseUrl()."public/images_icons/light/triangle_right.png'></a></td> <td class='LTPE2  LTPE2_".$listeTypesElements[$i]['id']."' ><span>".str_replace("'", "'", $listeTypesElements[$i]['libelle'])."</span><img onclick='modifierInfosTypeElement(".$listeTypesElements[$i]['id'].");' class='imgLTPE2' src='".$this->baseUrl()."public/images_icons/light/pencil.png'> </td></tr>";
	        }
	
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function enregistrementElementAction()
	{
	    $user = $this->layout()->user;
	    $idemploye = $user['id_personne'];
	    
	    $tabTypeElement = $this->params ()->fromPost ( 'tabTypeElement', 0 );
	    $tabElement = $this->params ()->fromPost ( 'tabElement' );
	    $tableBdElementSelect = $this->params ()->fromPost ( 'tableBdElementSelect' );
	
	    $this->getConsultationTable()->addInfosElements($tabTypeElement, $tabElement, $tableBdElementSelect, $idemploye);
	    
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( 1 ));
	}
	
	
	/**
	 * Liste des éléments pour un type donné
	 */
	public function listeElementsPourInterfaceAjoutAction()
	{
	    $tableBdTypeElementSelect = $this->params ()->fromPost ( 'tableBdTypeElementSelect', "" );
	    $tableBdElementSelect = $this->params ()->fromPost ( 'tableBdElementSelect', "" );
	    $idTypeElement = ( int ) $this->params ()->fromPost ( 'id', 0 );
	
	    if($idTypeElement == 0){
	        $listeTypesElements = $this->getConsultationTable()->getListeTypeElementsOrdreDecroissant($tableBdTypeElementSelect);
	        $idTypeElement = ($listeTypesElements) ? $listeTypesElements[0]['id'] : 0;
	    }
	
	    $listeElements = $this->getConsultationTable()->getListeElementAvecType($tableBdElementSelect, $idTypeElement);
	
	    $html  = "";
	    for($i = 0 ; $i <  count($listeElements); $i++){
	        $html .="<tr><td class='LPE2 LPE2_".$listeElements[$i]['id']."'> <span>".str_replace("'", "'", $listeElements[$i]['libelle'])."</span><img onclick='modifierInfosElement(".$listeElements[$i]['id'].");' class='imgLPE2' src='".$this->baseUrl()."public/images_icons/light/pencil.png'> </td> </tr>";
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( array($html, $idTypeElement) ));
	}
	
	public function modifierElementAction()
	{
	    $user = $this->layout()->user;
	    $idemploye = $user['id_personne'];
	     
	    $idElement = $this->params ()->fromPost ( 'idElement', 0 );
	    $libelleElement = $this->params ()->fromPost ( 'libelleElement', 0 );
	    $tableBdElementSelect = $this->params ()->fromPost ( 'tableBdElementSelect' );
	    
	    $this->getConsultationTable()->updateInfosElements($tableBdElementSelect, $libelleElement, $idElement, $idemploye);
	     
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ());
	}
	
	
	
	/**
	 * Liste des éléments pour un volet
	 */
	public function listeElementsUvAction()
	{
	    $tableElementUV = $this->params ()->fromPost ( 'tableElementUV', "" );
	
	    $listeElements = $this->getConsultationTable()->getListeElementsUV($tableElementUV);
	
	    $html  = "";
	    for($i = 0 ; $i <  count($listeElements); $i++){
	        $html .="<tr><td class='LPE2 LPE2_".$listeElements[$i]['id']."'> <span>".str_replace("'", "'", $listeElements[$i]['libelle'])."</span><img onclick='modifierInfosElementUV(".$listeElements[$i]['id'].");' class='imgLPE2' src='".$this->baseUrl()."public/images_icons/light/pencil.png'> </td> </tr>";
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
	public function enregistrementElementUvAction(){

	    $user = $this->layout()->user;
	    $idemploye = $user['id_personne'];
	     
	    $tableElementUV = $this->params ()->fromPost ( 'tableElementUV', 0 );
	    $tabElement = $this->params ()->fromPost ( 'tabElement' );
	    
	    $this->getConsultationTable()->addInfosElementsUV($tabElement, $tableElementUV, $idemploye);
	     
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( 1 ));
	    
	}
	
	public function modifierElementUVAction()
	{
	    $user = $this->layout()->user;
	    $idemploye = $user['id_personne'];
	
	    $idElement = $this->params ()->fromPost ( 'idElement', 0 );
	    $libelleElement = $this->params ()->fromPost ( 'libelleElement', 0 );
	    $tableBdElementSelect = $this->params ()->fromPost ( 'tableElementUV' );
	     
	    $this->getConsultationTable()->updateInfosElements($tableBdElementSelect, $libelleElement, $idElement, $idemploye);
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ());
	}
	
	public function listeElementSelectAction()
	{
	    $tableElementUV = $this->params()->fromPost('tableElementUV');
	
	    $html  = "<option></option>";
	    $listeSelect = $this->getConsultationTable()->getListeElementsUV($tableElementUV);
	    for($i = 0 ; $i <  count($listeSelect); $i++){
	        $html .="<option  value='".$listeSelect[$i]['id']."'>".str_replace("'", "'", $listeSelect[$i]['libelle'])."</option>";
	    }
	
	    $this->getResponse()->getHeaders ()->addHeaderLine ( 'Content-Type', 'application/html' );
	    return $this->getResponse ()->setContent(Json::encode ( $html ));
	}
	
	
}
