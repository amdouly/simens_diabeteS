<?php 

namespace Statistique\Form;

use Zend\Form\Form;

 class ExportForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('statistique');

         $this->add(array(
             'name' => 'Sexe',
             'type' => 'Text',
         ));
         $this->add(array(
             'name' => 'AGE',
             'type' => 'Text',
             'options' => array(
                 'label' => 'AGE',
             ),
         ));
         $this->add(array(
             'name' => 'COMMUNE',
             'type' => 'Text',
             'options' => array(
                 'label' => 'COMMUNE',
             ),
         ));
         $this->add(array(
             'name' => 'EXPORT',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }