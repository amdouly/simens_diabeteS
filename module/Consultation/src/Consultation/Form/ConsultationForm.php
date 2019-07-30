<?php

namespace Consultation\Form;

use Zend\Form\Form;

class ConsultationForm extends Form {
	public $decor = array (
			'ViewHelper'
	);
	public function __construct($name = null) {
		parent::__construct ();
		$codeConsultations = (new \DateTime ( 'now' ) )->format ( 'His-dmy' );
		$date = (new \DateTime ( 'now' ) )->format ( 'Y-m-d' );
		$heure = (new \DateTime ( 'now' ) )->format ( 'H:i:s' );

		
		$this->add ( array (
				'name' => 'idcons',
				'type' => 'hidden',
				'options' => array (
						'label' => 'Code consultation'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'value' => 'cons-'.$codeConsultations,
						'id' => 'idcons'
				)
		) );
		
		$this->add ( array (
				'name' => 'date',
				'type' => 'Hidden',
				'attributes' => array (
						'value' => $date
				)
		) );
		
		$this->add ( array (
				'name' => 'heure',
				'type' => 'Hidden',
				'attributes' => array (
						'value' => $heure
				)
		) );
		
		$this->add ( array (
				'name' => 'idmedecin',
				'type' => 'Hidden',
				'attributes' => array (
						'id' => 'idmedecin'
				)
		) );
		
		$this->add ( array (
				'name' => 'idinfirmier',
				'type' => 'Hidden',
				'attributes' => array (
						'id' => 'idinfirmier'
				)
		) );
		
		$this->add ( array (
				'name' => 'idpatient',
				'type' => 'Hidden',
				'attributes' => array (
						'id' => 'idpatient'
				)
		) );
		

		/*
		 * ETAT CIVIL DU PATIENT --- ETAT CIVIL DU PATIENT 
		 */
		$this->add ( array (
				'name' => 'PROFESSION',
				'type' => 'Select',
				'options' => array (
						'label' => 'Profession',
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'PROFESSION',
						'tabindex' => 8,
				)
		) );
		
		$this->add ( array (
				'name' => 'ORIGINE_GEOGRAPHIQUE',
				'type' => 'Text',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Origine géographique'),
				),
				'attributes' => array (
						'id' => 'ORIGINE_GEOGRAPHIQUE',
						'tabindex' => 13,
				)
		
		) );
		
		$this->add ( array (
				'name' => 'ETHNIE',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Ethnie'),
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'ETHNIE',
						'tabindex' => 13,
				)
		
		) );
		
		$this->add ( array (
				'name' => 'RACE',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Race'),
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'RACE',
						'tabindex' => 13,
				)
		
		) );
		
		$this->add ( array (
				'name' => 'STATUT_MATRIMONIAL',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Statut matrimonial'),
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'STATUT_MATRIMONIAL',
						'tabindex' => 13,
				)
		
		) );
		
		$this->add ( array (
				'name' => 'REGIME_MATRIMONIAL',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','régime matrimonial'),
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'REGIME_MATRIMONIAL',
						'tabindex' => 13,
				)
		
		) );
		
		
		/**
		 * ********* LES MOTIFS D ADMISSION *************
		 */
		/**
		 * ********* LES MOTIFS D ADMISSION *************
		 */
		$this->add ( array (
				'name' => 'motif_admission1',
				'type' => 'Select',
				'options' => array (
						'label' => 'motif 1'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'id' => 'motif_admission1',
						'class' => 'motif_admission_liste_fixe',
						'onchange' => 'getMotifAdmissionDouleurFievre(this.value)',
				)
		) );
		$this->add ( array (
				'name' => 'motif_admission2',
				'type' => 'Select',
				'options' => array (
						'label' => 'motif 2'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'id' => 'motif_admission2',
						'class' => 'motif_admission_liste_fixe',
						'onchange' => 'getMotifAdmissionDouleurFievre(this.value)',
				)
		) );
		$this->add ( array (
				'name' => 'motif_admission3',
				'type' => 'Select',
				'options' => array (
						'label' => 'motif 3'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'id' => 'motif_admission3',
						'class' => 'motif_admission_liste_fixe',
						'onchange' => 'getMotifAdmissionDouleurFievre(this.value)',
				)
		) );
		$this->add ( array (
				'name' => 'motif_admission4',
				'type' => 'Select',
				'options' => array (
						'label' => 'motif 4'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'id' => 'motif_admission4',
						'class' => 'motif_admission_liste_fixe',
						'onchange' => 'getMotifAdmissionDouleurFievre(this.value)',
				)
		) );
		$this->add ( array (
				'name' => 'motif_admission5',
				'type' => 'Select',
				'options' => array (
						'label' => 'motif 5'
				),
				'attributes' => array (
						'readonly' => 'readonly',
						'id' => 'motif_admission5',
						'class' => 'motif_admission_liste_fixe',
						'onchange' => 'getMotifAdmissionDouleurFievre(this.value)',
				)
		) );
		
		$this->add ( array (
				'name' => 'duree_des_signes',
				'type' => 'number',
				
				'attributes' => array (
						'id' => 'duree_des_signes',
						'class' => 'intensiteClassStyle',
						'max' => 10,
						'min' => 1,
						'step' => 'any',
						'style' => 'text-align: right; width: 45px;',
				)
		) );
		
		$this->add ( array (
				'name' => 'gravite_des_signes',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => '+',
								'2' => '++',
								'3' => '+++'
						)
				),
				'attributes' => array (
						'id' => 'gravite_des_signes'
				)
		) );
		
		$this->add ( array (
				'name' => 'siege',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Siège')
				),
				'attributes' => array (
						'id' => 'siege'
				)
		) );
		
		$this->add ( array (
				'name' => 'intensite',
				'type' => 'number',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Intensité échelle (EVA)'),
				),
				'attributes' => array (
						'id' => 'intensite',
						'class' => 'intensiteClassStyle',
						'max' => 10,
						'min' => 1,
						'step' => 'any',
						'style' => 'text-align: right',
				)
		) );
		
		/**
		 * ************************* RESUMES HISTOIRE DE LA MALADIE ***********************
		 */
		/**
		 * ************************* RESUMES HISTOIRE DE LA MALADIE ***********************
		 */
		
		$this->add ( array (
				'name' => 'resume_histoire_maladie',
				'type' => 'Textarea',
				'options' => array (
						'label' =>  iconv ( 'ISO-8859-1', 'UTF-8', "Résumé de l'histoire de la maladie"),
				),
				'attributes' => array (
						'max' => 100,
						'min' => 1,
						'id' => 'resume_histoire_maladie',
						'step' => 'any',
						'style' => 'float:left; max-height: 180px; min-height: 180px; max-width: 600px; min-width: 600px; font-family: time new roman; font-size: 18px; padding-left: 3px;',
				)
		) );
		
		
		/**
		 * ************************* CONSTANTES *****************************************************
		 */
		/**
		 * ************************* CONSTANTES *****************************************************
		 */
		/**
		 * ************************* CONSTANTES *****************************************************
		 */
		$this->add ( array (
				'name' => 'poids',
				'type' => 'number',
				'options' => array (
						'label' => 'Poids (kg)'
				),
				'attributes' => array (
						'max' => 100,
						'min' => 1,
						'id' => 'poids',
				        'step' => 'any',
						'class' => 'poids',
						'required' => true,
				)
		) );
		$this->add ( array (
				'name' => 'taille',
				'type' => 'number',
				'options' => array (
						'label' => 'Taille (cm)'
				),
				'attributes' => array (
						'max' => 200,
						'min' => 45,
						'id' => 'taille',
    				    'step' => 'any',
						'required' => true,
				)
		) );
		$this->add ( array (
				'name' => 'temperature',
				'type' => 'number',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Température (°C)' )
				),
				'attributes' => array (
						'max' => 45,
						'min' => 34,
						'id' => 'temperature',
						'step' => 'any',
						'required' => true,
				)
		) );
		
		$this->add ( array (
				'name' => 'perimetre_cranien',
				'type' => 'number',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Perimètre cranien (cm)'),
				),
				'attributes' => array (
						'min' => 30,
						'max' => 55,
						'id' => 'perimetre_cranien',
	    			    'step' => 'any',
				)
		) );
		
		$this->add ( array (
				'name' => 'tensionmaximale',
				'type' => 'Text',
				'attributes' => array (
						'class' => 'tension_only_numeric',
						'id' => 'tensionmaximale',
    				    'step' => 'any',
				)
		) );
		
		$this->add ( array (
				'name' => 'tensionminimale',
				'type' => 'Text',
				'attributes' => array (
						'class' => 'tension_only_numeric',
						'id' => 'tensionminimale',
				        'step' => 'any',
				)
		) );
		
		$this->add ( array (
				'name' => 'pouls',
				'type' => 'Text',
				'options' => array (
						'label' => 'Pouls (bat/min)'
				),
				'attributes' => array (
						'class' => 'pouls_only_numeric',
						'readonly' => 'readonly',
						'id' => 'pouls',
				        'step' => 'any',
				)
		) );
		$this->add ( array (
				'name' => 'frequence_respiratoire',
				'type' => 'Text',
				'options' => array (
						'label' => iconv('ISO-8859-1', 'UTF-8','Fréquence respiratoire')
				),
				'attributes' => array (
						'class' => 'frequence_only_numeric',
						'readonly' => 'readonly',
						'id' => 'frequence_respiratoire'
				)
		) );
		$this->add ( array (
				'name' => 'glycemie_capillaire',
				'type' => 'Text',
				'options' => array (
						'label' => iconv('ISO-8859-1', 'UTF-8', 'Glycémie capillaire (g/l)')
				),
				'attributes' => array (
						'class' => 'glycemie_only_numeric',
						'readonly' => 'readonly',
						'id' => 'glycemie_capillaire'
				)
		) );
		
		$this->add ( array (
				'name' => 'perimetre_brachial',
				'type' => 'Text',
				'options' => array (
						'label' => 'Perimetre brachial'
				),
				'attributes' => array (
						'id' => 'perimetre_brachial'
				)
		) );

		
		$this->add ( array (
				'name' => 'perimetre_thoracique',
				'type' => 'Text',
				'options' => array (
						'label' => 'Perimetre thoracique'
				),
				'attributes' => array (
						'id' => 'perimetre_thoracique'
				)
		) );
		
		
		$this->add ( array (
				'name' => 'voie_med_1',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_1'
				)
		) );
		$this->add ( array (
				'name' => 'voie_med_2',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_2'
				)
		) );
		$this->add ( array (
				'name' => 'voie_med_3',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_3'
				)
		) );
		$this->add ( array (
				'name' => 'voie_med_4',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_4'
				)
		) );
		$this->add ( array (
				'name' => 'voie_med_5',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_5'
				)
		) );
		$this->add ( array (
				'name' => 'voie_med_6',
				'type' => 'hidden',
				'attributes' => array (
						'id' => 'voie_med_6'
				)
		) );
		
		
		
		
		//********************Antécédents ou Terrain particulier ******************
        //********************Antécédents ou Terrain particulier ******************
        //********************Antécédents ou Terrain particulier ****************** 

		//****** ================== ANTECEDENTS PERSONNELS ================== 
		//****** ================== ANTECEDENTS PERSONNELS ================== 
		$this->add ( array (
				'name' => 'diabetique_connu',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => 'Oui',
								'2' => 'Non',
						)
				),
				'attributes' => array (
						'id' => 'diabetique_connu',
						'onchange' => 'getContenuDiabeteConnu(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'type_diabetique',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 1'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 2'),
								'3' => iconv('ISO-8859-1', 'UTF-8', 'Diabète gestationnel'),
								'4' => iconv('ISO-8859-1', 'UTF-8', 'Diabète secondaire'),
						)
				),
				'attributes' => array (
						'id' => 'type_diabetique',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'annee_decouverte',
				'type' => 'Date',
				'attributes' => array (
						'id' => 'annee_decouverte',
						'max' => 0,
						'style' => 'float:right; height: 28px; width: 160px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'antidiabetique_oraux',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Métformine (Glucophage®)'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Sulfamide  (Diamicron®, Amarel®, Daonil®)'),
								'3' => iconv('ISO-8859-1', 'UTF-8', 'Glinide (Novonorm®)'),
								'4' => iconv('ISO-8859-1', 'UTF-8', 'IPPD-4 (Januvia®, Galvus®)'),
						)
				),
				'attributes' => array (
						'id' => 'antidiabetique_oraux',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'insulinotherapie',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Insuline rapide (ordinaire)'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Insuline Mixte'),
								'3' => iconv('ISO-8859-1', 'UTF-8', 'Insuline semi-lente'),
								'4' => iconv('ISO-8859-1', 'UTF-8', 'Insuline lente'),
						)
				),
				'attributes' => array (
						'id' => 'insulinotherapie',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'regime_alimentaire',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Diabétique'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Hyposodé'),
						)
				),
				'attributes' => array (
						'id' => 'regime_alimentaire',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'antecedent_diabete_dans_famille',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'antecedent_diabete_dans_famille',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'autre_terrain_connu',
				'type' => 'Text',
				'attributes' => array (
						'id' => 'autre_terrain_connu',
						'style' => 'float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'autres_terrain_connu_hta',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'autres_terrain_connu_hta',
						'onchange' => 'getAutresTerrainConnuHtaSiOui(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'hta_traitement',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'IEC/ARA2'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Inhibiteur calcique'),
								'3' => iconv('ISO-8859-1', 'UTF-8', 'Diurétique'),
								'4' => iconv('ISO-8859-1', 'UTF-8', 'Béta-bloquant'),
								'5' => iconv('ISO-8859-1', 'UTF-8', 'Non traitée'),
						)
				),
				'attributes' => array (
						'id' => 'hta_traitement',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'dyslipidemie',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'dyslipidemie',
						'onchange' => 'getDyslipidemieSiOui(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'dyslipidemie_traitement',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Statine'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Fibrate'),
								'3' => iconv('ISO-8859-1', 'UTF-8', 'Non traitée'),
						)
				),
				'attributes' => array (
						'id' => 'dyslipidemie_traitement',
						'style' => 'float:right; width: 70%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'obesite',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'obesite',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tabagisme',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'tabagisme',
						'onchange' => 'getTabagismeSiOui(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tabagisme_nb_paquet',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tabagisme_nb_paquet',
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'alcool',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								'' => '',
								'1' => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								'2' => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'alcool',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
	}
}