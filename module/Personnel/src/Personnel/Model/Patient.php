<?php

namespace Personnel\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Patient implements InputFilterAwareInterface {
	public $idpersonne;
	public $ethnie;
	public $race;
	public $origine_geographique;
	public $commune_saintlouis;
	public $quartier_saintlouis;
	public $date_enregistrement;
	public $numero_dossier;
	protected $inputFilter;
	
	public function exchangeArray($data) {
		$this->idpersonne = (! empty ( $data ['idpersonne'] )) ? $data ['idpersonne'] : null;
		$this->ethnie = (! empty ( $data ['ethnie'] )) ? $data ['ethnie'] : null;
		$this->race = (! empty ( $data ['race'] )) ? $data ['race'] : null;
		$this->origine_geographique = (! empty ( $data ['origine_geographique'] )) ? $data ['origine_geographique'] : null;
		$this->commune_saintlouis = (! empty ( $data ['commune_saintlouis'] )) ? $data ['commune_saintlouis'] : null;
		$this->quartier_saintlouis = (! empty ( $data ['$quartier_saintlouis'] )) ? $data ['$quartier_saintlouis'] : null;
		$this->numero_dossier = (! empty ( $data ['numero_dossier'] )) ? $data ['numero_dossier'] : null;
		$this->date_enregistrement = (! empty ( $data ['date_enregistrement'] )) ? $data ['date_enregistrement'] : null;
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