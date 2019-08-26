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
		
		$this->add ( array (
				'name' => 'idadmission',
				'type' => 'Hidden',
				'attributes' => array (
						'id' => 'idadmission'
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
								0 => '',
								1 => '+',
								2 => '++',
								3 => '+++'
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
								0 => '',
								1 => 'Oui',
								2 => 'Non',
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 1'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 2'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Diabète gestationnel'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'Diabète secondaire'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Métformine (Glucophage®)'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Sulfamide  (Diamicron®, Amarel®, Daonil®)'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Glinide (Novonorm®)'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'IPPD-4 (Januvia®, Galvus®)'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Insuline rapide (ordinaire)'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Insuline Mixte'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Insuline semi-lente'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'Insuline lente'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Diabétique'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Hyposodé'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'IEC/ARA2'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Inhibiteur calcique'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Diurétique'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'Béta-bloquant'),
								5 => iconv('ISO-8859-1', 'UTF-8', 'Non traitée'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Statine'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Fibrate'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Non traitée'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
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
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'alcool',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'antecedents_medicaux_notable',
				'type' => 'Text',
				'attributes' => array (
						'id' => 'antecedents_medicaux_notable',
						'style' => 'float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'anciennes_hospitalisations',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'anciennes_hospitalisations',
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'traitements_en_cours',
				'type' => 'Text',
				'attributes' => array (
						'id' => 'traitements_en_cours',
						'style' => 'float:right; width: 65%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'antecedents_chirurgicaux',
				'type' => 'Text',
				'attributes' => array (
						'id' => 'antecedents_chirurgicaux',
						'style' => 'float:right; width: 75%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'chirurgie_rapport_avec_diabete',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Chirurgie des membres'),
						)
				),
				'attributes' => array (
						'id' => 'chirurgie_rapport_avec_diabete',
						'onchange' => 'getChirurgieRapportAvecDiabete(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'liste_chirurgie_des_membres',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Amputation ou désarticulation'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Mise à plat (Abcès et Phlegmons)'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Nécrosectomie et assimilés'),
						)
				),
				'attributes' => array (
						'id' => 'liste_chirurgie_des_membres',
						'style' => 'float:right; width: 90%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'chirurgie_sans_rapport_avec_diabete',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Chirurgie abdominale'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Chirurgie pariétale'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Chirurgie thoracique'),
						)
				),
				'attributes' => array (
						'id' => 'chirurgie_sans_rapport_avec_diabete',
						'onchange' => 'getChirurgieSansRapportAvecDiabete(this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'etat_general',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Asymptomatique').' (Score = 0)',
								2 => iconv('ISO-8859-1', 'UTF-8', 'Activité physique diminué mais autonome').' (Score = 1)',
								3 => iconv('ISO-8859-1', 'UTF-8', 'Incapacité de mener une activité normale ou travailler, mais alité moins de 50% du temps').' (Score = 2)',
								4 => iconv('ISO-8859-1', 'UTF-8', 'Incapacité de mener une activité normale et alité plus de 50% du temps').' (Score = 3)',
								5 => iconv('ISO-8859-1', 'UTF-8', 'Grabattaire (incapable de quitter le lit)').' (Score = 4)',
						)
				),
				'attributes' => array (
						'id' => 'etat_general',
						'style' => 'float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'muqueuses',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Normocolorées'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Pâles'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Ictériques'),
						)
				),
				'attributes' => array (
						'id' => 'muqueuses',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'deshydratation',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'deshydratation',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'oedeme_membres_inferieurs',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								 0 => '',
								 1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								 2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'oedeme_membres_inferieurs',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		

		$this->add ( array (
				'name' => 'tension_arterielle_min',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tension_arterielle_min',
						'min' => 1,
						'max' => 300,
						'tabindex' => 10,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tension_arterielle_max',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tension_arterielle_max',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'coucheTA',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'coucheTA',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'deboutTA',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'deboutTA',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );

		
		$this->add ( array (
				'name' => 'ipsTA',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'ipsTA',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'piedgaucheTA',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'piedgaucheTA',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		$this->add ( array (
				'name' => 'pieddroitTA',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'pieddroitTA',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'poulsBatMin',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'poulsBatMin',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'frequence_respiratoire_cycles_min',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'frequence_respiratoire_cycles_min',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'diurese_horaire',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'diurese_horaire',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );

		
		$this->add ( array (
				'name' => 'poids',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'poids',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'taille',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'taille',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tour_taille',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tour_taille',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'imc_constante',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'imc_constante',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'glycemie_capillaire',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'glycemie_capillaire',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'sucre',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'sucre',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'corps_cetonique',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'corps_cetonique',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'proteines',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'proteines',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'hematies',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'hematies',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'appareil_appel_systeme_1',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								 0 => '',
								 1 => iconv('ISO-8859-1', 'UTF-8', 'Appareil cardio-circulatoire'),
								 2 => iconv('ISO-8859-1', 'UTF-8', 'Appareil respiratoire'),
								 3 => iconv('ISO-8859-1', 'UTF-8', 'Appareil digestif'),
								 4 => iconv('ISO-8859-1', 'UTF-8', 'Appareil uro-génital'),
								 5 => iconv('ISO-8859-1', 'UTF-8', 'Appareil musculo-squelettique'),
								 6 => iconv('ISO-8859-1', 'UTF-8', 'Appareil cutanéo-tégumentaire'),
								 7 => iconv('ISO-8859-1', 'UTF-8', 'Appareil hématopoïétique et glandulaire'),
								 8 => iconv('ISO-8859-1', 'UTF-8', 'Système nerveux'),
						)
				),
				'attributes' => array (
						'id' => 'appareil_appel_systeme_1',
						'onchange' => 'getInfosAppareilAppelSysteme(1, this.value)',
						'style' => 'float:right; height: 28px; font-family: time new roman; font-size: 17px; padding-left: 3px; margin-top: 2px;',
				)
		) );

		
		$this->add ( array (
				'name' => 'glycemie_jeun',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'glycemie_jeun',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'hemoglobine_glyquee',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'hemoglobine_glyquee',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		 
		$this->add ( array (
				'name' => 'creatininemie',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'creatininemie',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'grsh',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'A-'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'B-'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'AB-'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'O-'),
								5 => iconv('ISO-8859-1', 'UTF-8', 'A+'),
								6 => iconv('ISO-8859-1', 'UTF-8', 'B+'),
								7 => iconv('ISO-8859-1', 'UTF-8', 'AB+'),
								8 => iconv('ISO-8859-1', 'UTF-8', 'O+'),
						)
				),
				'attributes' => array (
						'id' => 'grsh',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 70px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tp',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tp',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'tca',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'tca',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'hdl_c',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'hdl_c',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'ldl_c',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'ldl_c',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'uricemie',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'uricemie',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		 
		$this->add ( array (
				'name' => 'triglycerides',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'triglycerides',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'microalbuminurie_pu24h',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'microalbuminurie_pu24h',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 50px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'ecg',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'ecg',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; height: 150px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'indice_pression_systolique',
				'type' => 'Number',
				'attributes' => array (
						'id' => 'indice_pression_systolique',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 60px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'rsd1',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'rsd1',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'rsd2',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'rsd2',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'scanner',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'scanner',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		 
		$this->add ( array (
				'name' => 'echodoppler',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'echodoppler',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'echographie1',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'echographie1',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		$this->add ( array (
				'name' => 'echographie2',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'echographie2',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 500px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		$this->add ( array (
				'name' => 'type_diabete',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 1'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Diabète de type 2'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Diabète gestationnel'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'MODY'),
						)
				),
				'attributes' => array (
						'id' => 'type_diabete',
						'style' => 'float:right; width: 60%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		$this->add ( array (
				'name' => 'complication',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Acido-cétose'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Coma hyperosmolaire'),
								3 => iconv('ISO-8859-1', 'UTF-8', 'Néphropathie diabètique'),
								4 => iconv('ISO-8859-1', 'UTF-8', 'Rétinopathie diabètique'),
								5 => iconv('ISO-8859-1', 'UTF-8', 'Neuropathie périphérique'),
								6 => iconv('ISO-8859-1', 'UTF-8', 'ACOMI'),
								7 => iconv('ISO-8859-1', 'UTF-8', 'AVC'),
								8 => iconv('ISO-8859-1', 'UTF-8', 'IDM'),
								9 => iconv('ISO-8859-1', 'UTF-8', 'Pied diabètique'),
						)
				),
				'attributes' => array (
						'id' => 'complication',
						'style' => 'float:right; width: 60%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		$this->add ( array (
				'name' => 'hospitalisation',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'hospitalisation',
						'onchange' => 'getHospitalisationInfos(this.value)',
						'style' => 'float:right; width: 35%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'evolution',
				'type' => 'Textarea',
				'attributes' => array (
						'id' => 'evolution',
						'min' => 1,
						'max' => 300,
						'tabindex' => 11,
						'style' => 'float:right; width: 85%; max-width: 380px; min-width: 350px; max-height: 80px; min-height: 80px; text-align: right; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px; text-align: left;',
				)
		) );
		
		
		$this->add ( array (
				'name' => 'exeat',
				'type' => 'Text',
				'attributes' => array (
						'id' => 'exeat',
						'style' => 'float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		$this->add ( array (
				'name' => 'deces',
				'type' => 'Select',
				'options' => array (
						'value_options' => array (
								0 => '',
								1 => iconv('ISO-8859-1', 'UTF-8', 'Oui'),
								2 => iconv('ISO-8859-1', 'UTF-8', 'Non'),
						)
				),
				'attributes' => array (
						'id' => 'deces',
						'style' => 'float:right; width: 80%; height: 28px; font-family: time new roman; font-size: 19px; padding-left: 3px; margin-top: 2px;',
				)
		) );
		
		
	}
}