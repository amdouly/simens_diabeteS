<?php
namespace Statistique\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;



class StatistiqueTable {

	protected $tableGateway;
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
		
		
		
	}

	

// Code Pour recupere nombre de patients par sexe

public function nbPersonneSex(){
    
    
	    $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE',array('SEXE'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabSexe = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab[] = $value['SEXE'];
	    	 if(!in_array($value['SEXE'], $tabSexe)){
	    	 $tabSexe[] = $value['SEXE']; }
	    }

	    return array($tabSexe, array_count_values($tab));
	    
		}


public function nbPatientSexF(){

	$sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE')
	    ->where(array('SEXE'=>'Féminin'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute()->count();
	    return $resultat;

}
public function nbPatientSexM(){

	$sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE')
	    ->where(array('SEXE'=>'Masculin'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute()->count();
	    return $resultat;

}


	 public function nbPatintCom(){
    
    
	    $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('p' => 'patient'))
	     ->join(array('co'  => 'commune_saint_louis'), 'p.commune_saintlouis = co.id',array('libelle'));


 		 $resultat = $sql->prepareStatementForSqlObject($select)->execute();

         $tab1 = array();
         $tabCom = array();
	    foreach ($resultat as $value) {
	    	# code...

	    	 $tab1[] = $value['libelle'];
	    	  $tab=array_replace($tab1, array_fill_keys(array_keys($tab1,NULL), 'COM. SAINT-LOUIS'));
	    	
	    	 if(!in_array($value['libelle'], $tabCom)){
	    	 $tabCom[] = $value['libelle']; }
	    	
	    	
	    }

	     return array($tabCom, array_count_values($tab));
	    }




	    public function nbPatintQua(){
   

 		 $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('p' => 'patient'))
	    ->join(array('qa'  => 'quartier_saint_louis'), 'p.quartier_saintlouis = qa.id',array('libelle'));



 		 $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab2 = array();
        $tabQuart = array();
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab2[] = $value['libelle'];
	    	 $tab=array_replace($tab2, array_fill_keys(array_keys($tab2,NULL),'Ngallèle'));
	    	 if(!in_array($value['libelle'], $tabQuart)){
	    	 $tabQuart[] = $value['libelle']; }
	    	
	    }

	    return array($tabQuart, array_count_values($tab));
	    }

	    
	    public function nbPatintSm(){
    


	    $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE')
        ->join(array('ls'  => 'liste_statut_matrimonial'),'pers.STATUT_MATRIMONIAL=ls.id',array('libelle'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabSat = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab2[] = $value['libelle'];
	    	 $tab=array_replace($tab2, array_fill_keys(array_keys($tab2,'NULL'),'NON_RENSEIGNER'));
	    	 //$tab = array_map(function($tab2){ return (is_null($tab2))? 'NON_RENSEIGNER' :$tab2; },$tab);
	    	 //if ($value['libelle']='NULL') {
	    	 	# code...
	    	 //	array_push($tabSat,"NON_RENSEIGNER");
	    	 //}
	    	 if(!in_array($value['libelle'], $tabSat)){
	    	 $tabSat[] = $value['libelle']; }
	    }

	    return array($tabSat, array_count_values($tab));
    
	    }


	    public function nbPatintPr(){

    	$sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE')
        ->join(array('ls'  => 'liste_profession'),'pers.PROFESSION=ls.id',array('libelle'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabPro = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab2[] = $value['libelle'];
	    	 $tab=array_replace($tab2, array_fill_keys(array_keys($tab2,NULL),'NON_RENSEIGNER'));
	    	 if(!in_array($value['libelle'], $tabPro)){
	    	 $tabPro[] = $value['libelle']; }
	    }

	    return array($tabPro, array_count_values($tab));
    	
	    }


	    
	     public function nbPatintTd(){

    	  $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
	    ->join(array('t'  => 'type_diabete'),'con.idcons=t.idcons',array('type_diabete'));
	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabdia = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab[] = $value['type_diabete'];
	    	 if(!in_array($value['type_diabete'], $tabdia)){
	    	 $tabdia[] = $value['type_diabete']; }
	    }

	    return array($tabdia, array_count_values($tab));
	    }


	     public function nbPatintcomp(){
    	
    	$sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
	    ->join(array('com'  => 'complication_cons'), 'con.idcons = com.idcons')
        ->join(array('ls'  => 'liste_complication'),'com.idcomplication=ls.id',array('libelle'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabcomp = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab[] = $value['libelle'];
	    	 //$tab=array_replace($tab2, array_fill_keys(array_keys($tab2,NULL),''));
	    	 if(!in_array($value['libelle'], $tabcomp)){
	    	 $tabcomp[] = $value['libelle']; }
	    }

	    return array($tabcomp, array_count_values($tab));
    	
	    }

	     public function nbPatintTdu(){

    	  $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
	    ->join(array('t'  => 'type_diabete'),'con.idcons=t.idcons')
	    ->where(array('type_diabete'=> 1));
	    $resultat = $sql->prepareStatementForSqlObject($select)->execute()->count();
	    return $resultat;
}

public function nbPatintTdd(){

    	  $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
	    ->join(array('t'  => 'type_diabete'),'con.idcons=t.idcons')
	    ->where(array('type_diabete'=> 2));
	    $resultat = $sql->prepareStatementForSqlObject($select)->execute()->count();
	    return $resultat;
}

	     public function nbPatintTrai(){
    	
    	$sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
        ->join(array('tr'  => 'traitement'),'con.idcons = tr.idcons',array('traitement_chirurgical'));

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabtr = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab[] = $value['traitement_chirurgical'];
	    	 //$tab=array_replace($tab2, array_fill_keys(array_keys($tab2,NULL),''));
	    	 if(!in_array($value['traitement_chirurgical'], $tabtr)){
	    	 $tabtr[] = $value['traitement_chirurgical']; }
	    }

	    return array($tabtr, array_count_values($tab));
    	
	    }




	     public function nbPatintAge(){
    
 		
	    $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE',array('AGE'))->order('AGE ASC');

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();


	   

          $tab = array();
          $tabAge = array();
          $tabAgeInterval = array();
	      foreach ($resultat as $value) {
	    	# code...
	    	 //$tab=$value['AGE'];
	    	 if ($value['AGE']<= 30) {
	    	  	 array_push($tabAge,"15-30");
	    	  }
	    	  elseif ($value['AGE'] <= 45) {
	    	  	array_push($tabAge,"31-45");
	    	  }
	    	  elseif ($value['AGE'] <= 60) {
	    	  	array_push($tabAge,"46-60"); 
	    	  }
	    	  elseif ($value['AGE'] <= 75) {
	    	  	array_push($tabAge,"61-75");
	    	  }
	    	  elseif ($value['AGE'] <= 90) {
	    	  	array_push($tabAge,"76-90");
	    	  }

	    	  $tab = $tabAge;

		    }
	    	

//var_dump(array_values(array_flip( array_count_values($tab)))); exit();
	     return array(array_values(array_flip( array_count_values($tab))), array_count_values($tab));
	    }


	    public function evoPatint(){

    	  $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient',array('date'))->order('date ASC');;
	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();

        $tab = array();
        $tabdev = array( );
	    foreach ($resultat as $value) {
	    	# code...
	    	 $tab[] = $value['date'];
	    	 if(!in_array($value['date'], $tabdev)){
	    	 $tabdev[] = $value['date']; }
	    }

	    return array($tabdev, array_count_values($tab));
	    }

 public function exportData(){
    
 		
	    $sql = new Sql ($this->tableGateway->getAdapter());
	    
	    $select=$sql->select();
	    $select->from(array('pat'   => 'patient'))
	    ->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE')
	    ->join(array('co'  => 'commune_saint_louis'), 'pat.commune_saintlouis = co.id')
	    ->join(array('qa'  => 'quartier_saint_louis'), 'pat.quartier_saintlouis = qa.id')
	    ->join(array('con'  => 'consultation'), 'pat.idpersonne = con.idpatient')
        ->join(array('com'  => 'complication_cons'), 'con.idcons = com.idcons')
        ->join(array('tr'  => 'traitement'),'con.idcons = tr.idcons')
	    ->join(array('t'  => 'type_diabete'),'con.idcons=t.idcons')
	      ->join(array('ls'  => 'liste_statut_matrimonial'),'pers.STATUT_MATRIMONIAL=ls.id')
          ->join(array('lp'  => 'liste_profession'),'pers.PROFESSION=lp.id')
          ->join(array('lc'  => 'liste_complication'),'com.idcomplication=lc.id');
        
      
       
	    
	   

	    $resultat = $sql->prepareStatementForSqlObject($select)->execute();
	    return  $resultat;

	}






}