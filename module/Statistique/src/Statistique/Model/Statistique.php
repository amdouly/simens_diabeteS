<?php
namespace Statistique\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Statistique implements InputFilterAwareInterface{
	public $ID_PERSONNE;
	public $PRENOM;
	public $NOM;
	public $DATE_NAISSANCE;
	public $AGE;
	public $LIEU_NAISSANCE;
	public $NATIONALITE_ORIGINE;
	public $NATIONALITE_ACTUELLE;
	public $STATUT_MATRIMONIAL;
	public $REGIME_MATRIMONIAL;
	public $ADRESSE;
	public $TELEPHONE;
	public $TELEPHONE_2;
	public $EMAIL;
	public $SEXE;
	public $PROFESSION;
	public $CIVILITE;
	public $PHOTO;
	public $DATE_ENREGISTREMENT;
	public $DATE_MODIFICATION;
	
	
	protected $inputFilter;

	public function exchangeArray($data) {
		$this->ID_PERSONNE = (! empty ( $data ['ID_PERSONNE'] )) ? $data ['ID_PERSONNE'] : null;
		$this->PRENOM = (! empty ( $data ['PRENOM'] )) ? $data ['PRENOM'] : null;
		$this->NOM = (! empty ( $data ['NOM'] )) ? $data ['NOM'] : null;
		$this->DATE_NAISSANCE = (! empty ( $data ['DATE_NAISSANCE'] )) ? $data ['DATE_NAISSANCE'] : null;
		$this->AGE = (! empty ( $data ['AGE'] )) ? $data ['AGE'] : null;
		$this->LIEU_NAISSANCE = (! empty ( $data ['LIEU_NAISSANCE'] )) ? $data ['LIEU_NAISSANCE'] : null;
		$this->NATIONALITE_ORIGINE = (! empty ( $data ['NATIONALITE_ORIGINE'] )) ? $data ['NATIONALITE_ORIGINE'] : null;
		$this->NATIONALITE_ACTUELLE = (! empty ( $data ['NATIONALITE_ACTUELLE'] )) ? $data ['NATIONALITE_ACTUELLE'] : null;
		$this->STATUT_MATRIMONIAL = (! empty ( $data ['STATUT_MATRIMONIAL'] )) ? $data ['STATUT_MATRIMONIAL'] : null;
		$this->REGIME_MATRIMONIAL = (! empty ( $data ['REGIME_MATRIMONIAL'] )) ? $data ['REGIME_MATRIMONIAL'] : null;
		$this->ADRESSE = (! empty ( $data ['ADRESSE'] )) ? $data ['ADRESSE'] : null;
		$this->TELEPHONE = (! empty ( $data ['TELEPHONE'] )) ? $data ['TELEPHONE'] : null;
		$this->TELEPHONE_2 = (! empty ( $data ['TELEPHONE_2'] )) ? $data ['TELEPHONE_2'] : null;
		$this->EMAIL = (! empty ( $data ['EMAIL'] )) ? $data ['EMAIL'] : null;
		$this->SEXE = (! empty ( $data ['SEXE'] )) ? $data ['SEXE'] : null;
		$this->PROFESSION = (! empty ( $data ['PROFESSION'] )) ? $data ['PROFESSION'] : null;
		$this->CIVILITE = (! empty ( $data ['CIVILITE'] )) ? $data ['CIVILITE'] : null;
		$this->PHOTO = (! empty ( $data ['PHOTO'] )) ? $data ['PHOTO'] : null;
		$this->DATE_ENREGISTREMENT = (! empty ( $data ['DATE_ENREGISTREMENT'] )) ? $data ['DATE_ENREGISTREMENT'] : null;
		$this->DATE_MODIFICATION = (! empty ( $data ['DATE_MODIFICATION'] )) ? $data ['DATE_MODIFICATION'] : null;

	}

	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception ( "Not used" );
	}
	public function getInputFilter() {
		if (! $this->inputFilter) {
			$inputFilter = new InputFilter ();
			$factory = new InputFactory ();

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}