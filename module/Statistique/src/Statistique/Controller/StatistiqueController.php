<?php
namespace Statistique\Controller;
use Statistique\Model\StatistiqueTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Http\Client;
use Zend\Http\Request;
use Statistique\Model\Statistique;          // <-- Add this import
use Statistique\Form\ExportForm;       // <-- Add this import


 class StatistiqueController extends AbstractActionController
 {
    protected $statistiqueTable;
     
     
     public function getStatitiqueTable() {
         if (! $this->statistiqueTable) {
             $sm = $this->getServiceLocator ();
             $this->statistiqueTable = $sm->get ( 'Statistique\Model\StatistiqueTable' );
         }
         return $this->statistiqueTable;
     }
     
     
     public function indexAction()
     {
      
        //   $view = new ViewModel();
         $result1 = $this->getStatitiqueTable()->nbPersonneSex();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
        
           //  echo "<pre>";
          // var_dump($result4); exit();
        
           // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );
       
     }
    

     public function statAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
          //$view = new ViewModel();
         $result1 = $this->getStatitiqueTable()->nbPersonneSex();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
        
           //  echo "<pre>";
          // var_dump($result4); exit();
        
           // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );   
     }

     public function statsAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
          //$view = new ViewModel();
         $result1 = $this->getStatitiqueTable()->nbPersonneSex();
         $resultSF = $this->getStatitiqueTable()->nbPatientSexF();
         $resultSM = $this->getStatitiqueTable()->nbPatientSexM();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
        
           //  echo "<pre>";
          // var_dump($result4); exit();
        
           // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'resultSF' => $resultSF,
                'resultSM' => $resultSM,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );   
     }
     
     
     function item_percentage($item, $total){
    
        if($total){
            return number_format(($item * 100 / $total), 2,',', ' ');
        }else{
            return 0;
        }
    
    }

     function pourcentage_element_tab($tableau, $total){
        $resultat = array();
    
        foreach ($tableau as $tab){
            $resultat [] = $this->item_percentage($tab, $total);
        }
    
        return $resultat;
    }

     public function accAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );

           //$view = new ViewModel();

           //$view = new ViewModel();
         $result1 = $this->getStatitiqueTable()->nbPersonneSex();
         //Pour calculer la pourcentage Par Sexe
         $totalPatientSexe = array_sum($result1[1]);
         $tableauPatientParSexe = array_values($result1[1]);
         $pourcentagePatientSexe = $this->pourcentage_element_tab($tableauPatientParSexe, $totalPatientSexe);
         $resultSF = $this->getStatitiqueTable()->nbPatientSexF();
         $resultSM = $this->getStatitiqueTable()->nbPatientSexM();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         // Pour calculer la pourcentage Par Commune
         $totalPatientCom = array_sum($result2[1]);
         $tableauPatientParCom = array_values($result2[1]);
         $pourcentagePatientCom = $this->pourcentage_element_tab($tableauPatientParCom, $totalPatientCom);
         // Pour calculer la pourcentage Par Quartier
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $totalPatientQua = array_sum($result3[1]);
         $tableauPatientParQua = array_values($result3[1]);
         $pourcentagePatientQua = $this->pourcentage_element_tab($tableauPatientParQua, $totalPatientQua);
         //
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $totalPatientSm = array_sum($result4[1]);
         $tableauPatientParSm = array_values($result4[1]);
         $pourcentagePatientSm = $this->pourcentage_element_tab($tableauPatientParSm, $totalPatientSm);
         //
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $totalPatientPr = array_sum($result5[1]);
         $tableauPatientParPr = array_values($result5[1]);
         $pourcentagePatientPr = $this->pourcentage_element_tab($tableauPatientParPr, $totalPatientPr);
         //
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $totalPatientTd = array_sum($result6[1]);
         $tableauPatientParTd = array_values($result6[1]);
         $pourcentagePatientTd = $this->pourcentage_element_tab($tableauPatientParTd, $totalPatientTd);
         //
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $totalPatientComp = array_sum($result7[1]);
         $tableauPatientParComp = array_values($result7[1]);
         $pourcentagePatientComp = $this->pourcentage_element_tab($tableauPatientParComp, $totalPatientComp);
         //
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $totalPatientTrai = array_sum($result8[1]);
         $tableauPatientParTrai = array_values($result8[1]);
         $pourcentagePatientTrai = $this->pourcentage_element_tab($tableauPatientParTrai, $totalPatientTrai);
         //
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
         $totalPatientCatAge = array_sum($result9[1]);
         $tableauPatientParCatAge = array_values($result9[1]);
         $pourcentagePatientCatAge = $this->pourcentage_element_tab($tableauPatientParCatAge, $totalPatientCatAge);
            
         $result10 = $this->getStatitiqueTable()->evoPatint();
         $totalPatientParEvo = array_sum($result10[1]);
         $tableauPatientParEvo = array_values($result10[1]);
         $pourcentagePatientEvo = $this->pourcentage_element_tab($tableauPatientParEvo, $totalPatientParEvo);

          //echo "<pre>";
          // var_dump($result10); exit();
        
         // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'pourcentagePatientSexe' =>$pourcentagePatientSexe,
                'pourcentagePatientCom' =>$pourcentagePatientCom,
                'pourcentagePatientQua' =>$pourcentagePatientQua,
                'pourcentagePatientSm' =>$pourcentagePatientSm,
                'pourcentagePatientPr' =>$pourcentagePatientPr,
                'pourcentagePatientTd' =>$pourcentagePatientTd,
                'pourcentagePatientComp' =>$pourcentagePatientComp,
                'pourcentagePatientTrai' =>$pourcentagePatientTrai,
                'pourcentagePatientCatAge' =>$pourcentagePatientCatAge,
                'pourcentagePatientEvo' =>$pourcentagePatientEvo,
                'resultSF' => $resultSF,
                'resultSM' => $resultSM,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,
                'result10' => $result10,

                );

     }

     public function tabAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
           //$view = new ViewModel();
        $result1 = $this->getStatitiqueTable()->nbPersonneSex();
        $resultSF = $this->getStatitiqueTable()->nbPatientSexF();
         $resultSM = $this->getStatitiqueTable()->nbPatientSexM();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $resulttdu = $this->getStatitiqueTable()->nbPatintTdu();
         $resulttdd = $this->getStatitiqueTable()->nbPatintTdd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
        
           //  echo "<pre>";
          // var_dump($result4); exit();
        
           // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'resultSF' => $resultSF,
                'resultSM' => $resultSM,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'resulttdu' => $resulttdu,
                'resulttdd' => $resulttdd,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );
     }






     public function exportAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
           //$view = new ViewModel();
        

         $result1 = $this->getStatitiqueTable()->nbPersonneSex();
        $resultSF = $this->getStatitiqueTable()->nbPatientSexF();
         $resultSM = $this->getStatitiqueTable()->nbPatientSexM();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $resulttdu = $this->getStatitiqueTable()->nbPatintTdu();
         $resulttdd = $this->getStatitiqueTable()->nbPatintTdd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();

           //  echo "<pre>";
          // var_dump($result4); exit();
        
           // echo "</pre>";

         return array (
                
                'result1' => $result1,
                'resultSF' => $resultSF,
                'resultSM' => $resultSM,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'resulttdu' => $resulttdu,
                'resulttdd' => $resulttdd,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );
     }



     public function exportpAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
           //$view = new ViewModel();
    
        $form = new ExportForm();
        $this -> view-> form = $form;

        $result1 = $this->getStatitiqueTable()->nbPersonneSex();
        $resultSF = $this->getStatitiqueTable()->nbPatientSexF();
         $resultSM = $this->getStatitiqueTable()->nbPatientSexM();
         $result2 = $this->getStatitiqueTable()->nbPatintCom();
         $result3 = $this->getStatitiqueTable()->nbPatintQua();
         $result4 = $this->getStatitiqueTable()->nbPatintSm();
         $result5 = $this->getStatitiqueTable()->nbPatintPr();
         $result6 = $this->getStatitiqueTable()->nbPatintTd();
         $resulttdu = $this->getStatitiqueTable()->nbPatintTdu();
         $resulttdd = $this->getStatitiqueTable()->nbPatintTdd();
         $result7 = $this->getStatitiqueTable()->nbPatintcomp();
         $result8 = $this->getStatitiqueTable()->nbPatintTrai();
         $result9 = $this->getStatitiqueTable()->nbPatintAge();
         $result10 = $this->getStatitiqueTable()->exportData();

           // echo "<pre>";
          // var_dump($result10); exit();
        
           //    echo "</pre>";

         return array (
                
                'result1' => $result1,
                'resultSF' => $resultSF,
                'resultSM' => $resultSM,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
                'result5' => $result5,
                'result6' => $result6,
                'resulttdu' => $resulttdu,
                'resulttdd' => $resulttdd,
                'result7' => $result7,
                'result8' => $result8,
                'result9' => $result9,

                );
     }


public function predAction()
     {
        $this->layout ()->setTemplate ( 'layout/consultation' );
           //$view = new ViewModel();


        $client = new Client();
        $client->setUri('http://127.0.0.1:8000/predict');
        $client->setMethod('POST');
        $client->setParameterPost(array(
            "AGE"=>69, "SEXE"=>1, "deshydratation"=>2, "tension_arterielle_max"=>8,
       "tension_arterielle_min"=>15, "sucre"=>2, "taille"=>64, "poids"=>150, "poulsBatMin"=>69,
       "corps_cetonique"=>2
        ));
        
        $response = $client->send();
        
        if ($response->isSuccess()) {
            // the POST was successful
            $donnees = json_decode($response->getBody());

            echo "<pre>";
           var_dump($donnees); exit();
            echo "</pre>";
        }


     }




 }