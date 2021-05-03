<?php

namespace Consultation\Form;

use Zend\Form\Form;

class PatientForm extends Form {
	public function __construct($name = null) {
		parent::__construct ();

		$this->add ( array (
				'name' => 'ID_PERSONNE',
				'type' => 'Hidden',
				'attributes' => array (
				)
		) );
		$this->add ( array (
				'name' => 'CIVILITE',
				'type' => 'Select',
				'options' => array (
						'label' => 'Civilite',
						'value_options' => array (
								'Mme' => 'Mme',
								'Mlle' => 'Mlle',
								'M' => 'M'
						)
				),
				'attributes' => array (
						'id' => 'CIVILITE',
						'value' => 'M',
				)
		) );

		
		$this->add ( array (
				'name' => 'NOM',
				'type' => 'Text',
				'options' => array (
						'label' => 'Nom'
				),
				'attributes' => array (
						'id' => 'NOM',
						'required' => true,
						'tabindex' => 2,
				)
		) );
		
		$this->add ( array (
				'name' => 'PRENOM',
				'type' => 'Text',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Prénom' )
				),
				'attributes' => array (
						'id' => 'PRENOM',
						'required' => true,
						'tabindex' => 3,
				)
		) );

		
		$this->add ( array (
				'name' => 'AGE',
				'type' => 'Number',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Âge' )
				),
				'attributes' => array (
						'id' => 'AGE',
						'tabindex' => 4,
						'required' => true,
						'min' => 0,
						'max' => 150,
				)
		) );
		

		$this->add ( array (
				'name' => 'DATE_NAISSANCE',
				'type' => 'Text',
				'options' => array (
						'label' => 'Date de naissance'
				),
				'attributes' => array (
						'id' => 'DATE_NAISSANCE',
						'tabindex' => 5,
				)
		) );

		$this->add ( array (
		    'name' => 'SEXE',
		    'type' => 'Select',
		    'options' => array (
		        'label' => 'Sexe',
		        'value_options' => array (
		            '' => '',
		            'Masculin' => 'Masculin',
		            iconv ( 'ISO-8859-1', 'UTF-8','Féminin') => iconv ( 'ISO-8859-1', 'UTF-8','Féminin')
		        )
		    ),
		    'attributes' => array (
		        'id' => 'SEXE',
		        'required' => true,
		        'tabindex' => 5,
		    )
		) );
		
		$this->add ( array (
				'name' => 'LIEU_NAISSANCE',
				'type' => 'Text',
				'options' => array (
						'label' => 'Lieu de naissance'
				),
				'attributes' => array (
						'id' => 'LIEU_NAISSANCE',
						'tabindex' => 26,
				)
		) );
		
		
		$this->add ( array (
				'name' => 'TELEPHONE',
				'type' => 'Text',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Téléphone personnel' )
				),
				'attributes' => array (
						'id' => 'TELEPHONE',
				        'required' => true,
						'tabindex' => 7,
				)
		) );
		
		
		$this->add ( array (
		    'name' => 'TELEPHONE_2',
		    'type' => 'Text',
		    'options' => array (
		        'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Téléphone secondaire' )
		    ),
		    'attributes' => array (
		        'id' => 'TELEPHONE_2',
		        'required' => true,
		        'tabindex' => 7,
		    )
		) );
		
		
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
				'name' => 'ADRESSE',
				'type' => 'Text',
				'options' => array (
						'label' => 'Adresse'
				),
				'attributes' => array (
						'id' => 'ADRESSE',
						'tabindex' => 7,
				)
		) );
		
		$this->add ( array (
				'type' => 'Email',
				'name' => 'EMAIL',
				'options' => array (
						'label' => 'Email'
				),
				'attributes' => array (
						'placeholder' => 'votre@domain.com',
						'id' => 'EMAIL',
						'tabindex' => 10,
				)
		) );
		
		$this->add ( array (
				'name' => 'NATIONALITE_ORIGINE',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Nationalité origine'),
				),
				'attributes' => array (
						'id' => 'NATIONALITE_ORIGINE',
						'tabindex' => 11,
				)
		) );
		
		$this->add ( array (
				'name' => 'NATIONALITE_ACTUELLE',
				'type' => 'Select',
				'options' => array (
						'label' => iconv ( 'ISO-8859-1', 'UTF-8','Nationalité actuelle'),
						'value_options' => array (
								'' => ''
						)
				),
				'attributes' => array (
						'id' => 'NATIONALITE_ACTUELLE',
						'tabindex' => 12,
				)
		
		) );
		
		
		
		$this->add ( array (
		    'name' => 'DEPARTEMENT',
		    'type' => 'Select',
		    'options' => array (
		        'label' => iconv ( 'ISO-8859-1', 'UTF-8','Département'),
		        'value_options' => array (
		            1 => 'DAKAR', 2 => 'GUEDIAWAYE', 3 => 'PIKINE', 4 => 'RUFISQUE', 5 => 'BAMBEY', 6 => 'DIOURBEL', 7 => 'MBACKE',
		            8 => 'FATICK',9 => 'FOUNDIOUCK', 10 => 'GOSSAS',11 => 'BIRKELANE', 12 => 'KAFFRINE',		            
                    13 => 'KOUNGHEUL', 14 => 'MALEM HODDAR' , 'GUINGUINEO', 16 =>'KAOLACK', 
		            17 => 'NIORO', 'KEDOUGOU', 19 => 'SALEMATA', 20 => 'SARAYA',
		            21 => 'KOLDA', 22 => 'MEDINA YORO FOULAH', 23 => 'VELINGARA', 
		            24 => 'KEBEMER', 25 => 'LINGUERE', 26 => 'LOUGA',
		            27 => 'KANEL', 28 => 'MATAM', 29 => 'RANEROU',
		            30 => 'DAGANA', 31 => 'PODOR', 32 => 'SAINT LOUIS',
		            33 => 'BOUNKILING', 34 => 'GOUDOMP', 35 => 'SEDHIOU',
		            36 => 'BAKEL', 37 => 'GOUDIRY', 38 => 'KOUPENTOUM', 39 => 'TAMBACOUNDA',
		            40 => 'MBOUR', 41 => 'THIES', 42 => 'TIVAOUANE',
		            43 => 'BIGNONA', 44 => 'OUSSOUYE', 45 => 'ZIGUINCHOR',
		            46 => 'AUTRE ..'
		        )
		    ),
		    'attributes' => array (
		        'id' => 'DEPARTEMENT',
		        'required' => true,
		        'tabindex' => 13,
		        'onchange' => "getListeAutreAAjouter(this.value);",
		    )
		
		) );
		
		$this->add ( array (
		    'name' => 'PAYS',
		    'type' => 'Select',
		    'options' => array (
		        'label' => iconv ( 'ISO-8859-1', 'UTF-8','Pays'),
		    ),
		    'attributes' => array (
		        'id' => 'PAYS',
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
		
		
		$this->add ( array (
		    'name' => 'COMMUNE_SAINTLOUIS',
		    'type' => 'Select',
		    'options' => array (
		        'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Commune de Saint-Louis' )
		    ),
		    'attributes' => array (
		        'id' => 'COMMUNE_SAINTLOUIS',
		        'required' => true,
		        'tabindex' => 7,
		        'onchange' => "getListeQuartierSaintLouis(this.value);",
		    )
		) );
		
		$this->add ( array (
		    'name' => 'QUARTIER_SAINTLOUIS',
		    'type' => 'Select',
		    'options' => array (
		        'label' => iconv ( 'ISO-8859-1', 'UTF-8', 'Quartier à Saint-Louis' )
		    ),
		    'attributes' => array (
		        'id' => 'QUARTIER_SAINTLOUIS',
		        'required' => true,
		        'tabindex' => 7,
		    )
		) );
		
		$this->add ( array (
		    'name' => 'QUARTIER_SAINTLOUIS_MEMO',
		    'type' => 'Hidden',
		    'attributes' => array (
		        'id' => 'QUARTIER_SAINTLOUIS_MEMO',
		    )
		) );
		
		
	}
}