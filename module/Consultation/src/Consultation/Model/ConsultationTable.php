<?php
namespace Consultation\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Predicate\NotIn;
use Zend\Db\Sql\Predicate\In;
use Consultation\View\Helper\DateHelper;

class ConsultationTable {

	protected $tableGateway;
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	public function getConsultation($idcons){
		$rowset = $this->tableGateway->select ( array (
				'idcons' => $idcons
		) );
		$row =  $rowset->current ();
 		if (! $row) {
 			throw new \Exception ( "Could not find row $idcons" );
 		}
		return $row;
	}
	
	
	public function addConsultation($values, $idemploye){
		$this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
		
		$date = (new \DateTime())->format('Y-m-d');
		$heure = (new \DateTime())->format('H:i:s');
		try {
	
			$dataconsultation = array(
					'idcons'=> $values->get ( "idcons" )->getValue (),
					'idinfirmier'=> $values->get ( "idinfirmier" )->getValue (),
					'idpatient'=> $values->get ( "idpatient" )->getValue (),
					'date'=> $date,
					'heure' => $heure,
					'poids' => $values->get ( "poids" )->getValue (),
					'taille' => $values->get ( "taille" )->getValue (),
					'temperature' => $values->get ( "temperature" )->getValue (),
					'perimetre_cranien' => $values->get ( "perimetre_cranien" )->getValue (),
					'idfacturation' => $values->get ( "idfacturation" )->getValue (),
					'date_enreg_infirm' => $date.' '.$heure,
					'idemploye' => $idemploye
			);
				
			$this->tableGateway->insert($dataconsultation);
	
			$this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
		} catch (\Exception $e) {
			$this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
		}
	}
	
	public function updateConsultations($values, $idemploye){
		$this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
	
		try {
	
			$idcons = $values->get ( "idcons" )->getValue ();
			
			$dataconsultation = array(
					
					'poids' => $values->get ( "poids" )->getValue (),
					'taille' => $values->get ( "taille" )->getValue (),
					'temperature' => $values->get ( "temperature" )->getValue (),
					'perimetre_cranien' => $values->get ( "perimetre_cranien" )->getValue (),
					
					'idemploye' => $idemploye
			);
	
			$this->tableGateway->update($dataconsultation, array('idcons' => $idcons));
	
			$this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
		} catch (\Exception $e) {
			$this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
		}
	}
	
	
	
	
	//********** RECUPERER LA LISTE DES CONSULTATIONS DU MEDECIN *********
	//********** RECUPERER LA LISTE DES CONSULTATIONS DU MEDECIN *********
	public function getListeConsultations(){
	
		$db = $this->tableGateway->getAdapter();
		$date = (new \DateTime())->format('Y-m-d');
		
		$aColumns = array('numero_dossier', 'Nom','Prenom','Datenaissance','Sexe', 'Adresse', 'id', 'id2');
		
		//Liste des pateints admis aujourdhui et d�j� consult�s 
		$sql2 = new Sql ($db );
		$subselect = $sql2->select()->from(array('cons'=>'consultation'))->columns(array('idpatient'))->where(array('date' => $date));
		
		//Liste des patients admis aujourdhui et non encore consult�s 
		$sql = new Sql($db);
		$sQuery = $sql->select()
		->from(array('pat'   => 'patient'))->columns(array('*'))
		->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE' , array('Nom'=>'NOM','Prenom'=>'PRENOM','Datenaissance'=>'DATE_NAISSANCE','Sexe'=>'SEXE','Adresse'=>'ADRESSE','Nationalite'=>'NATIONALITE_ACTUELLE','Taille'=>'TAILLE','id'=>'ID_PERSONNE', 'id2'=>'ID_PERSONNE'))
		->join(array('admis' => 'admission'), 'admis.idpatient = pers.ID_PERSONNE' , array('dateadmission','idadmission'))
		->where(array('dateadmission' => $date, new NotIn ( 'pat.idpersonne', $subselect )))
		->order('admis.idadmission ASC');
		
		
		/* Data set length after filtering */
		$stat = $sql->prepareStatementForSqlObject($sQuery);
		$rResultFt = $stat->execute();
		$iFilteredTotal = count($rResultFt);
			
		$rResult = $rResultFt;
		
		
		$output = array(
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
		);
		
		
		/*
		 * $Control pour convertir la date en fran�ais
		*/
		$Control = new DateHelper();
			
		/*
		 * ADRESSE URL RELATIF
		*/
		$baseUrl = $_SERVER['REQUEST_URI'];
		$tabURI  = explode('public', $baseUrl);
			
		/*
		 * Pr�parer la liste
		*/
 		foreach ( $rResult as $aRow )
 		{
 			$row = array();
 			for ( $i=0 ; $i<count($aColumns) ; $i++ )
 			{
				if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					if ($aColumns[$i] == 'Nom'){
						$row[] = "<div>".$aRow[ $aColumns[$i]]."</div>";
					}
		
					else if ($aColumns[$i] == 'Prenom'){
						$row[] = "<div>".$aRow[ $aColumns[$i]]."</div>";
					}
		
					else if ($aColumns[$i] == 'Datenaissance') {
							
						$date_naissance = $aRow[ $aColumns[$i] ];
						if($date_naissance){ $row[] = $Control->convertDate($aRow[ $aColumns[$i] ]); }else{ $row[] = null;}
		
					}
		
					else if ($aColumns[$i] == 'Adresse') {
						$row[] = "<div>".$aRow[ $aColumns[$i] ]."</div>";
					}
		
					else if ($aColumns[$i] == 'id') {
						$html  ="<infoBulleVue> <a href='".$tabURI[0]."public/consultation/consulter?idadmission=".$aRow[ 'idadmission' ]."&idpatient=".$aRow[ 'id' ]."'>";
						$html .="<img style='display: inline; margin-right: 17%;' src='".$tabURI[0]."public/images_icons/doctor_16.png' title='Consulter'></a></infoBulleVue>";
							
						$html .="<infoBulleVue>";
						$html .="<img style='opacity:0.2; margin-right: 17%;' src='".$tabURI[0]."public/images_icons/11modif.png' ></a></infoBulleVue>";
						
						$row[] = $html;
					}
		
					else {
						$row[] = $aRow[ $aColumns[$i] ];
					}
		
				}
 			}
 			$output['aaData'][] = $row;
 		}
		
		
		/*
		 * SQL queries
		* Liste des patients admis deja consult�s aujourd'hui
		*/
		$sql2 = new Sql($db);
		$sQuery2 = $sql2->select()
		->from(array('pat' => 'patient'))->columns(array('*'))
		->join(array('pers'  => 'personne'), 'pat.idpersonne = pers.ID_PERSONNE' , array('Nom'=>'NOM','Prenom'=>'PRENOM','Datenaissance'=>'DATE_NAISSANCE','Sexe'=>'SEXE','Adresse'=>'ADRESSE','Nationalite'=>'NATIONALITE_ACTUELLE','Taille'=>'TAILLE','id'=>'ID_PERSONNE', 'id2'=>'ID_PERSONNE'))
		->join(array('cons' => 'consultation'), 'cons.idpatient = pat.idpersonne', array('Idcons' => 'idcons', 'Date' => 'date') )
		->where(array('cons.date' => $date) )
		->order('cons.idcons DESC');
			
		/* Data set length after filtering */
		$rResult = $sql2->prepareStatementForSqlObject($sQuery2)->execute();

		/*
		 * ADRESSE URL RELATIF
		*/
		$baseUrl = $_SERVER['REQUEST_URI'];
		$tabURI  = explode('public', $baseUrl);
			
		/*
		 * Pr�parer la liste
		*/
		foreach ( $rResult as $aRow )
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					if ($aColumns[$i] == 'Nom'){
						$row[] = "<div>".$aRow[ $aColumns[$i]]."</div>";
					}
	
					else if ($aColumns[$i] == 'Prenom'){
						$row[] = "<div>".$aRow[ $aColumns[$i]]."</div>";
					}
	
					else if ($aColumns[$i] == 'Datenaissance') {
							
						$date_naissance = $aRow[ $aColumns[$i] ];
						if($date_naissance){ $row[] = $Control->convertDate($aRow[ $aColumns[$i] ]); }else{ $row[] = null;}
	
					}
	
					else if ($aColumns[$i] == 'Adresse') {
						$row[] = "<div>".$aRow[ $aColumns[$i] ]."</div>";
					}
	
					else if ($aColumns[$i] == 'Date') {
						$row[] = $Control->convertDateTimeHm($aRow[ 'date_enregistrement' ]);
					}
					
					else if ($aColumns[$i] == 'id') {
						$html  ="<infoBulleVue>";
						$html .="<img style='opacity: 0.2; margin-right: 12%;' src='".$tabURI[0]."public/images_icons/doctor_16.png'></infoBulleVue>";
							
						$html .="<infoBulleVue> <a href='".$tabURI[0]."public/consultation/modifier-consultation?idpatient=".$aRow[ 'id' ]."&idcons=".$aRow[ 'Idcons' ]."'>";
						$html .="<img style='display: inline; margin-right: 17%;' src='".$tabURI[0]."public/images_icons/11modif.png' title='Modifier'></a></infoBulleVue>";
						
 						$html .="<infoBulleVue>";
 						$html .="<img style='display: inline; margin-left: 5%; margin-right: 5%;' src='".$tabURI[0]."public/images_icons/tick_16.png' ></infoBulleVue>";
							
						$row[] = $html;
					}
	
					else {
						$row[] = $aRow[ $aColumns[$i] ];
					}
	
				}
			}
			$output['aaData'][] = $row;
		}
		
		return $output;
	}
	
	
	
	public function addImagesIconographie($nomimage, $idadmission, $position, $idemploye){
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->insert()->into('iconographie_image')
		->values(array('nomimage' => $nomimage, 'idadmission' => $idadmission, 'position' => $position, 'idemploye' => $idemploye));
		return $sql->prepareStatementForSqlObject($sQuery)->execute();
	}
	
	public function getImagesIconographie($idadmission, $position) {
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select('iconographie_image')->order('idimage DESC')
		->where(array('idadmission' => $idadmission, 'position' => $position));
		 
		return $sql->prepareStatementForSqlObject($sQuery)->execute();
	}
	
	public function getImageIconographie($id, $idadmission, $position) {
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select('iconographie_image')->order('idimage DESC')
		->where(array('position' => $position, 'idadmission' => $idadmission));
			
		$Result = $sql->prepareStatementForSqlObject($sQuery)->execute();
		
		$i = 1;
		$tabIdImage  = array( $id => 0 );
		$tabNomImage = array( $id => 0 );
		 
		foreach ($Result as $resultat){
			$tabIdImage[$i] = $resultat['idimage'];
			$tabNomImage[$i++] = $resultat['nomimage'];
		}
		
		return  array('idimage' => $tabIdImage[$id], 'nomimage'=> $tabNomImage[$id]);
	}
	
	public function deleteImagesIconographie($idimage, $idadmission){
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->delete()->from('iconographie_image')->where(array('idimage' => $idimage, 'idadmission' => $idadmission));
		$sql->prepareStatementForSqlObject($sQuery)->execute();
	}	
	
	
	
	
	public function addImagesExamens($nomimage, $idadmission, $examen, $idemploye){
		$table = 'image';
		if($examen == 'Nfs'){$table = $table.'_nfs'; }
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->insert()->into($table)
		->values(array('nomimage' => $nomimage, 'idadmission' => $idadmission, 'idemploye' => $idemploye));
		return $sql->prepareStatementForSqlObject($sQuery)->execute();
	}
	
	public function getImagesExamens($idadmission, $examen) {
		$table = 'image';
		if($examen == 'Nfs'){$table = $table.'_nfs'; }
		
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select($table)->order('idimage DESC')
		->where(array('idadmission' => $idadmission));
			
		return $sql->prepareStatementForSqlObject($sQuery)->execute();
	}
	
	
	
	public function getImageExamen($id, $idadmission, $examen) {
		$table = 'image';
		if($examen == 'Nfs'){ $table = $table.'_nfs'; }
		
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select($table)->order('idimage DESC')->where(array('idadmission' => $idadmission));
			
		$Result = $sql->prepareStatementForSqlObject($sQuery)->execute();
	
		$i = 1;
		$tabIdImage  = array( $id => 0 );
		$tabNomImage = array( $id => 0 );
			
		foreach ($Result as $resultat){
			$tabIdImage[$i] = $resultat['idimage'];
			$tabNomImage[$i++] = $resultat['nomimage'];
		}
	
		return  array('idimage' => $tabIdImage[$id], 'nomimage'=> $tabNomImage[$id]);
	}
	
	public function deleteImageExamen($idimage, $idadmission, $examen){
		$table = 'image';
		if($examen == 'Nfs'){ $table = $table.'_nfs'; }
		
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->delete()->from($table)->where(array('idimage' => $idimage, 'idadmission' => $idadmission));
		$sql->prepareStatementForSqlObject($sQuery)->execute();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getConsultationPatient($id_pat, $id_cons){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array( '*' ));
		$select->from( array( 'c' => 'consultation' ));
		$select->join( array('e1' => 'employe'), 'e1.id_personne = c.ID_MEDECIN' , array());
		$select->join( array('e2' => 'employe'), 'e2.id_personne = c.ID_SURVEILLANT' , array());
		$select->join( array('p1' => 'personne'), 'e1.id_personne = p1.ID_PERSONNE' , array('*'));
		$select->join( array('p2' => 'personne'), 'e2.id_personne = p2.ID_PERSONNE' , array('NomSurveillant' => 'NOM', 'PrenomSurveillant' => 'PRENOM'));
		$select->join( array('s' => 'service'), 's.ID_SERVICE = c.ID_SERVICE' , array('nomService' => 'NOM', 'domaineService' => 'DOMAINE'));

		//On affiche toutes les consultations sauf celle ouverte
		$where = new Where();
		$where->equalTo('c.ID_PATIENT', $id_pat);
		$where->notEqualTo('c.idcons', $id_cons);
		$select->where($where);
		$select->order('DATEONLY DESC');
		
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
		
		return $result;
	}
	
	public function getConsultationDuJour(){
		$today = (new \DateTime())->format('Y-m-d');
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->from( array( 'c' => 'consultation' ));
		$select->where(array('DATEONLY' => $today));
		return $sql->prepareStatementForSqlObject ( $select )->execute()->current();
	}
	/** --------------=============================------------------------------ */
	public function getConsultationPatientSaufActu($id_pat, $id_cons){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array( '*' ));
		$select->from( array( 'c' => 'consultation' ));
		$select->join( array('e1' => 'employe'), 'e1.id_personne = c.ID_MEDECIN' , array('*'));
		$select->join( array('p1' => 'personne'), 'e1.id_personne = p1.ID_PERSONNE' , array('*'));
		$select->join( array('s' => 'service'), 's.ID_SERVICE = c.ID_SERVICE' , array('nomService' => 'NOM', 'domaineService' => 'DOMAINE'));
	
		//La consultation du jour -- pour �viter d'afficher la consultation du jour
		$id_cons_du_jour = $this->getConsultationDuJour()['idcons'];
		
		//On affiche toutes les consultations sauf celle ouverte
		$where = new Where();
		$where->equalTo('c.ID_PATIENT', $id_pat);
		$where->notEqualTo('c.idcons', $id_cons);
		$where->notEqualTo('c.idcons', $id_cons_du_jour);
		$select->where($where);
		$select->order('DATEONLY DESC');
	
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
	
		return $result;
	}
	
	public function getInfosSurveillant($id_personne){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array( '*' ));
		$select->from( array('e1' => 'employe'));
		$select->join( array('p1' => 'personne'), 'e1.id_personne = p1.ID_PERSONNE' , array('*'));
	
		$where = new Where();
		$where->equalTo('e1.id_personne', $id_personne);
		$select->where($where);
	
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
	
		return $result->current();
	}
	/** --------------=============================-------------------------------*/
	
	public function updateConsultation($values)
	{
		
		$donnees = array(
				'POIDS' => $values->get ( "poids" )->getValue (), 
				'TAILLE' => $values->get ( "taille" )->getValue (), 
				'TEMPERATURE' => $values->get ( "temperature" )->getValue (), 
				'PRESSION_ARTERIELLE' => $values->get ( "tensionmaximale" )->getValue ().'/'.$values->get ( "tensionminimale" )->getValue (),
				'POULS' => $values->get ( "pouls" )->getValue (), 
				'FREQUENCE_RESPIRATOIRE' => $values->get ( "frequence_respiratoire" )->getValue (), 
				'GLYCEMIE_CAPILLAIRE' => $values->get ( "glycemie_capillaire" )->getValue (), 
		);
		$this->tableGateway->update( $donnees, array('idcons'=> $values->get ( "id_cons" )->getValue ()) );
	}
	
	public function validerConsultation($values){
		$donnees = array(
				'CONSPRISE' => $values['VALIDER'],
				'ID_MEDECIN' => $values['ID_MEDECIN']
		);
		$this->tableGateway->update($donnees, array('idcons'=> $values['idcons']));
	}
	
	public function addConsultationEffective($id_cons){
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->insert()
		->into('consultation_effective')
		->values(array('idcons' => $id_cons));
		$requete = $sql->prepareStatementForSqlObject($sQuery);
		$requete->execute();
	}
	
	public function getInfoPatientMedecin($idcons){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array( '*' ));
		$select->from( array( 'c' => 'consultation' ));
		$select->join( array('s' => 'service'), 's.ID_SERVICE = c.ID_SERVICE' , array (
				'NomService' => 'NOM',
				'DomaineService' => 'DOMAINE'
		) );
		$select->join( array('p' => 'patient' ), 'p.ID_PERSONNE = c.ID_PATIENT' , array('*'));
		$select->join( array('pers' => 'personne'), 'pers.ID_PERSONNE = p.ID_PERSONNE' , array('*'));
		$select->join( array('m' => 'personne'), 'm.ID_PERSONNE = c.ID_MEDECIN' , array(
				'NomMedecin' => 'NOM', 
				'PrenomMedecin' => 'PRENOM', 
				'AdresseMedecin' => 'ADRESSE',
				'TelephoneMedecin' => 'TELEPHONE'
		));
		$select->where ( array( 'c.idcons' => $idcons));
		
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
		
		return $result;
	}
	
	public function addBandelette($bandelettes){
		$values = array();
		if($bandelettes['albumine'] == 1){
			$values[] = array('idtypebandelette'=>1, 'idcons'=>$bandelettes['idcons'], 'croix_bandelette'=>(int)$bandelettes['croixalbumine']);
		}
		if($bandelettes['sucre'] == 1){
			$values[] = array('idtypebandelette'=>2, 'idcons'=>$bandelettes['idcons'], 'croix_bandelette'=>(int)$bandelettes['croixsucre']);
		}
		if($bandelettes['corpscetonique'] == 1){
			$values[] = array('idtypebandelette'=>3, 'idcons'=>$bandelettes['idcons'], 'croix_bandelette'=>(int)$bandelettes['croixcorpscetonique']);
		}
		
		for($i = 0 ; $i < count($values) ; $i++ ){
			$db = $this->tableGateway->getAdapter();
			$sql = new Sql($db);
			$sQuery = $sql->insert()
			->into('bandelette')
			->columns(array('idtypebandelette', 'idcons', 'croix_bandelette'))
			->values($values[$i]);
			$stat = $sql->prepareStatementForSqlObject($sQuery);
			$stat->execute();
		}
	}
	
	public function getBandelette($id_cons){
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select()
		->from('bandelette')
		->columns(array('*'))
		->where(array('id_cons' => $id_cons));
		$stat = $sql->prepareStatementForSqlObject($sQuery);
		$result = $stat->execute();
		
		$donnees = array();
		$donnees['temoin'] = 0;
		foreach ($result as $resultat){
			if($resultat['idtypebandelette'] == 1){
				$donnees['albumine'] = 1; //C'est � coch�
				$donnees['croixalbumine'] = $resultat['croix_bandelette'];
			}
			if($resultat['idtypebandelette'] == 2){
				$donnees['sucre'] = 1; //C'est � coch�
				$donnees['croixsucre'] = $resultat['croix_bandelette'];
			}
			if($resultat['idtypebandelette'] == 3){
				$donnees['corpscetonique'] = 1; //C'est � coch�
				$donnees['croixcorpscetonique'] = $resultat['croix_bandelette'];
			}
			
			//temoin
			$donnees['temoin'] = 1;
		}
		
		return $donnees;
	}
	
	public function deleteBandelette($id_cons){
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->delete()
		->from('bandelette')
		->where(array('id_cons' => $id_cons));
		$stat = $sql->prepareStatementForSqlObject($sQuery);
		$result = $stat->execute();
	}
	
	//Tous les patients consultes sauf ceux du jour
	public function tousPatientsCons($idService){
		$today = new \DateTime();
		$date = $today->format('Y-m-d');
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->from ( array (
				'p' => 'patient'
		) );
		$select->columns(array () );
		$select->join(array('pers' => 'personne'), 'pers.ID_PERSONNE = p.ID_PERSONNE', array(
				'Nom' => 'NOM',
				'Prenom' => 'PRENOM',
				'Datenaissance' => 'DATE_NAISSANCE',
				'Sexe' => 'SEXE',
				'Adresse' => 'ADRESSE',
				'Nationalite' => 'NATIONALITE_ACTUELLE',
				'Id' => 'ID_PERSONNE'
		));
		
		$select->join(array('c' => 'consultation'), 'p.ID_PERSONNE = c.ID_PATIENT', array('Id_cons' => 'idcons', 'Dateonly' => 'DATEONLY', 'Consprise' => 'CONSPRISE'));
		$select->join(array('s' => 'service'), 'c.ID_SERVICE = s.ID_SERVICE', array('Nomservice' => 'NOM'));
		$select->join(array('cons_eff' => 'consultation_effective'), 'cons_eff.idcons = c.idcons' , array('*'));
		$where = new Where();
		$where->equalTo('s.ID_SERVICE', $idService);
		$where->notEqualTo('DATEONLY', $date);
		$select->order('c.DATE DESC');
		$select->group('c.ID_PATIENT');
		$select->where($where);
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		return $result;
	}
	
	//liste des patients à consulter par le medecin dans le service de ce dernier
	public function listePatientsConsParMedecin($idService){
		$today = new \DateTime();
		$date = $today->format('Y-m-d');
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->from ( array (
				'p' => 'patient'
		) );
		$select->columns(array () );
		$select->join(array('pers'=>'personne'), 'pers.ID_PERSONNE = p.ID_PERSONNE', array(
				'Nom' => 'NOM',
				'Prenom' => 'PRENOM',
				'Datenaissance' => 'DATE_NAISSANCE',
				'Sexe' => 'SEXE',
				'Adresse' => 'ADRESSE',
				'Nationalite' => 'NATIONALITE_ACTUELLE',
				'Id' => 'ID_PERSONNE'
		));
		$select->join(array('c' => 'consultation'), 'p.ID_PERSONNE = c.ID_PATIENT', array('Id_cons' => 'idcons', 'dateonly' => 'DATEONLY', 'Consprise' => 'CONSPRISE', 'date' => 'DATE'));
		$select->join(array('cons_eff' => 'consultation_effective'), 'cons_eff.idcons = c.idcons' , array('*'));
		$select->join(array('a' => 'admission'), 'c.ID_PATIENT = a.id_patient', array('Id_admission' => 'id_admission'));
		$select->where(array('c.ID_SERVICE' => $idService, 'DATEONLY' => $date, 'a.date_cons' => $date, 'c.ARCHIVAGE' => 0));
		$select->order('id_admission ASC');
	
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		return $result;
	}
	
	public function getPatientsRV($id_service){
		$today = new \DateTime();
		$date = $today->format('Y-m-d');
	
		$adapter = $this->tableGateway->getAdapter();
		$sql = new Sql( $adapter );
		$select = $sql->select();
		$select->from( array(
				'rec' =>  'rendezvous_consultation'
		));
		$select->join(array('cons' => 'consultation'), 'cons.idcons = rec.idcons ', array('*'));
		$select->where( array(
				'rec.DATE' => $date,
				'cons.ID_SERVICE' => $id_service,
		) );
	
		$statement = $sql->prepareStatementForSqlObject( $select );
		$resultat = $statement->execute();
	
		$tab = array();
		foreach ($resultat as $result) {
			$tab[$result['ID_PATIENT']] = $result['HEURE'];
		}
	
		return $tab;
	}
	
	/**
	 * Recuperation de la liste des medicaments
	 */
	public function listeDeTousLesMedicaments(){
		$adapter = $this->tableGateway->getAdapter();
		$sql = new Sql ( $adapter );
		$select = $sql->select('consommable');
		$select->columns(array('ID_MATERIEL','INTITULE'));
		$stat = $sql->prepareStatementForSqlObject($select);
		$result = $stat->execute();
	
		return $result;
	}
	
	/**
	 * RECUPERER LA FORME DES MEDICAMENTS
	 */
	
	public function formesMedicaments(){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array('*'));
		$select->from( array( 'forme' => 'forme_medicament' ));
	
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
	
		return $result;
	}
	
	/**
	 * RECUPERER LES TYPES DE QUANTITE DES MEDICAMENTS
	 */
	
	public function typeQuantiteMedicaments(){
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->columns( array('*'));
		$select->from( array( 'typeQuantite' => 'quantite_medicament' ));
	
		$stat = $sql->prepareStatementForSqlObject ( $select );
		$result = $stat->execute ();
	
		return $result;
	}
	
	public function getInfoPatient($id_personne) {
		$db = $this->tableGateway->getAdapter();
		$sql = new Sql($db);
		$sQuery = $sql->select()
		->from(array('pat' => 'patient'))
		->columns( array( '*' ))
		->join(array('pers' => 'personne'), 'pers.ID_PERSONNE = pat.idpersonne' , array('*'))
		->where(array('pat.idpersonne' => $id_personne));
	
		$stat = $sql->prepareStatementForSqlObject($sQuery);
		$resultat = $stat->execute()->current();
	
		return $resultat;
	}
	
	public function getPhoto($id) {
		$donneesPatient =  $this->getInfoPatient( $id );
	
		$nom = null;
		if($donneesPatient){$nom = $donneesPatient['PHOTO'];}
		if ($nom) {
			return $nom . '.jpg';
		} else {
			return 'identite.jpg';
		}
	}
	
	//liste des patients deja consultés par le medecin pour l'espace recherche
	public function listePatientsConsMedecin($idService){
		$today = new \DateTime();
		$date = $today->format('Y-m-d');
		$adapter = $this->tableGateway->getAdapter ();
		$sql = new Sql ( $adapter );
		$select = $sql->select ();
		$select->from ( array (
				'p' => 'patient'
		) );
		$select->columns(array () );
		$select->join(array('pers' => 'personne'), 'pers.ID_PERSONNE = p.ID_PERSONNE', array(
				'Nom' => 'NOM',
				'Prenom' => 'PRENOM',
				'Datenaissance' => 'DATE_NAISSANCE',
				'Sexe' => 'SEXE',
				'Adresse' => 'ADRESSE',
				'Nationalite' => 'NATIONALITE_ACTUELLE',
				'Id' => 'ID_PERSONNE'
		));
		$select->join(array('c' => 'consultation'), 'p.ID_PERSONNE = c.ID_PATIENT', array('Id_cons' => 'idcons', 'Dateonly' => 'DATEONLY', 'Consprise' => 'CONSPRISE', 'date' => 'DATE'));
		$select->join(array('cons_eff' => 'consultation_effective'), 'cons_eff.idcons = c.idcons' , array('*'));
		$select->join( array('e1' => 'employe'), 'e1.id_personne = c.ID_MEDECIN' , array('*'));
		$select->join(array('s' => 'service'), 'c.ID_SERVICE = s.ID_SERVICE', array('Nomservice' => 'NOM'));
		$where = new Where();
		$where->equalTo('s.ID_SERVICE', $idService);
		$where->notEqualTo('DATEONLY', $date);
		$select->where($where);
		$select->order('c.DATE DESC');
		//$select->group('c.ID_PATIENT');
	
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		
		//Recuperation des donnees 
		$tableauDonnees = array();
		$tableauCles = array();
		foreach ($result as $resultat){
 			if(!in_array($resultat['Id'], $tableauCles)){
 				$tableauCles[] = $resultat['Id']; 
 				$tableauDonnees[] = $resultat;
 			}
		}
		
		return $tableauDonnees;
	
	}
	
 	public function addTraitementsInstrumentaux($traitement_instrumental){

 		
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->delete()
 		->from('traitement_instrumental')
 		->where(array('id_cons' => $traitement_instrumental['id_cons']));
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute();
 		
		if($traitement_instrumental['endoscopie_interventionnelle'] || $traitement_instrumental['radiologie_interventionnelle'] ||
		 $traitement_instrumental['cardiologie_interventionnelle'] || $traitement_instrumental['autres_interventions']){
			$db = $this->tableGateway->getAdapter();
			$sql = new Sql($db);
			$sQuery = $sql->insert()
			->into('traitement_instrumental')
			->columns(array('id_cons', 'endoscopie_interventionnelle', 'radiologie_interventionnelle', 'cardiologie_interventionnelle', 'autres_interventions'))
			->values($traitement_instrumental);
			$stat = $sql->prepareStatementForSqlObject($sQuery);
			$stat->execute();
		}
 	}
 	
 	public function getTraitementsInstrumentaux($id_cons){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from('traitement_instrumental')
 		->where(array('id_cons' => $id_cons));
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute()->current();
 		return $result;
 	}
 	
 	
 	public function fetchConsommable(){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql ( $adapter );
 		$select = $sql->select('consommable');
 		$select->columns(array('ID_MATERIEL','INTITULE'));
 		$stat = $sql->prepareStatementForSqlObject($select);
 		$result = $stat->execute();
 		foreach ($result as $data) {
 			$options[$data['ID_MATERIEL']] = $data['INTITULE'];
 		}
 		return $options;
 	}
 	
 	
 	//GESTION DES FICHIER MP3
 	//GESTION DES FICHIER MP3
 	//GESTION DES FICHIER MP3
 	public function insererMp3($titre , $nom, $id_cons, $type){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->insert()
 		->into('fichier_mp3')
 		->columns(array('titre', 'nom', 'id_cons', 'type'))
 		->values(array('titre' => $titre , 'nom' => $nom, 'id_cons'=>$id_cons, 'type'=>$type));
 	
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		return $stat->execute();
 	}
 	
 	public function getMp3($id_cons, $type){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('f' => 'fichier_mp3'))->columns(array('*'))
 		->where(array('id_cons' => $id_cons, 'type' => $type))
 		->order('id DESC');
 	
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute();
 		return $result;
 	}
 	
 	public function supprimerMp3($idLigne, $id_cons, $type){
 		$liste = $this->getMp3($id_cons, $type);
 	
 		$i=1;
 		foreach ($liste as $list){
 			if($i == $idLigne){
 				unlink('C:\wamp\www\simens\public\audios\\'.$list['nom']);
 	
 				$db = $this->tableGateway->getAdapter();
 				$sql = new Sql($db);
 				$sQuery = $sql->delete()
 				->from('fichier_mp3')
 				->where(array('id' => $list['id']));
 	
 				$stat = $sql->prepareStatementForSqlObject($sQuery);
 				$stat->execute();
 	
 				return true;
 			}
 			$i++;
 		}
 		return false;
 	}
 	
 	
 	//GESTION DES FICHIERS VIDEOS
 	//GESTION DES FICHIERS VIDEOS
 	//GESTION DES FICHIERS VIDEOS
 	public function insererVideo($titre , $nom, $format, $id_cons){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->insert()
 		->into('fichier_video')
 		->columns(array('titre', 'nom', 'format', 'id_cons'))
 		->values(array('titre' => $titre , 'nom' => $nom, 'format' => $format, 'id_cons'=>$id_cons));
 	
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		return $stat->execute();
 	}
 	
 	public function getVideos($id_cons){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('f' => 'fichier_video'))->columns(array('*'))
 		->where(array('id_cons' => $id_cons))
 		->order('id DESC');
 	
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute();
 		return $result;
 	}
 	
 	public function getVideoWithId($id){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('f' => 'fichier_video'))->columns(array('*'))
 		->where(array('id' => $id));
 	
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute()->current();
 		return $result;
 	}
 	
 	public function supprimerVideo($id){

 		$laVideo = $this->getVideoWithId($id);
 		$result = unlink('C:\wamp\www\simens\public\videos\\'.$laVideo['nom']);
 		
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->delete()->from('fichier_video')->where(array('id' => $id));

 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$stat->execute();
 		
 		return $result;
 	}
 	
 	//COMPTE RENDU OPERATOIRE
 	//COMPTE RENDU OPERATOIRE
 	public function deleteCompteRenduOperatoire($id_cons, $type){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->delete()
 		->from('compte_rendu_operatoire')
 		->where(array('id_cons' => $id_cons, 'type' => $type));
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute();
 	}
 	
 	public function addCompteRenduOperatoire($note, $type, $id_cons){
 		$this->deleteCompteRenduOperatoire($id_cons, $type);
 		if($note) {
 			$db = $this->tableGateway->getAdapter();
 			$sql = new Sql($db);
 			$sQuery = $sql->insert()
 			->into('compte_rendu_operatoire')
 			->values(array('note' => $note , 'type' => $type, 'id_cons'=>$id_cons));
 				
 			$stat = $sql->prepareStatementForSqlObject($sQuery);
 			return $stat->execute();
 		}
 	}
 	
 	public function getCompteRenduOperatoire($type, $id_cons){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('c' => 'compte_rendu_operatoire'))->columns(array('*'))
 		->where(array('id_cons' => $id_cons, 'type' => $type));
 		
 		$stat = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $stat->execute()->current();
 		return $result;
 	}
 	
 	
 	
 	//GESTION DES EXAMENS DU JOUR LORS D'UNE HOSPITALISATION
 	//GESTION DES EXAMENS DU JOUR LORS D'UNE HOSPITALISATION
 	public function addConsultationExamenDuJour($codeExamen, $values , $IdDuService , $idMedecin){
 		$this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
 		$date = new \DateTime();
 		$aujourdhui = $date->format('Y-m-d H:i:s');
 		$dateonly = $date->format('Y-m-d');
 		
 		try {
 			$dataconsultation = array(
					'idcons'=> $codeExamen,
 					'ID_MEDECIN'=> $idMedecin,
 					'ID_PATIENT'=> $values->id_personne,
 					'DATE'=> $aujourdhui,
 					'POIDS' => $values->poids,
 					'TAILLE' => $values->taille,
  					'TEMPERATURE' => $values->temperature,
  					'PRESSION_ARTERIELLE' => $values->pressionarterielle,
 					'POULS' => $values->pouls,
 					'FREQUENCE_RESPIRATOIRE' => $values->frequence_respiratoire,
 					'GLYCEMIE_CAPILLAIRE' => $values->glycemie_capillaire,
  					'DATEONLY' => $dateonly,
  					'ID_SERVICE' => $IdDuService
 			);
 			
 			$this->tableGateway->insert($dataconsultation);
 	
 			$this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
 		} catch (\Exception $e) {
 			$this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
 		}
 	}
 	
 	public function addExamenDuJour($id_cons, $id_hosp){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->insert()
 		->into('examen_du_jour')
 		->values(array('idcons' => $id_cons, 'ID_HOSP' => $id_hosp));
 		$requete = $sql->prepareStatementForSqlObject($sQuery);
 		$requete->execute();
 	}
 	
 	public function getExamenDuJour($id_hosp){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('e' => 'examen_du_jour'))
 		->join(array('c' => 'consultation'), 'c.idcons = e.idcons' , array('*'))
 		->join(array('p' => 'personne'), 'p.ID_PERSONNE = c.ID_MEDECIN' , array('NomMedecin' => 'NOM', 'PrenomMedecin' => 'PRENOM'))
 		->where(array('ID_HOSP' => $id_hosp))
 		->order('DATE DESC');
 		$requete = $sql->prepareStatementForSqlObject($sQuery);
 		return $requete->execute();
 	}
 	
 	public function supprimerExamenDuJour($id_examen_jour){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('e' => 'examen_du_jour'))
 		->where(array('ID_EXAMEN_JOUR' => $id_examen_jour));
 		
 		$requete = $sql->prepareStatementForSqlObject($sQuery);
 		$result = $requete->execute()->current();
 		
 		$db2 = $this->tableGateway->getAdapter();
 		$sql2 = new Sql($db2);
 		$sQuery2 = $sql2->delete()
 		->from('consultation')
 		->where(array('idcons' => $result['idcons']));
 			
 		$requete2 = $sql2->prepareStatementForSqlObject($sQuery2);
 		$requete2->execute();
 		
 		return $result['ID_HOSP'];
 	}
 	
 	public function getExamenDuJourParIdExamenJour($id_examen_jour){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('e' => 'examen_du_jour'))
 		->join(array('c' => 'consultation'), 'c.idcons = e.idcons' , array('*'))
 		->join(array('p' => 'personne'), 'p.ID_PERSONNE = c.ID_MEDECIN' , array('NomMedecin' => 'NOM', 'PrenomMedecin' => 'PRENOM'))
 		->where(array('ID_EXAMEN_JOUR' => $id_examen_jour));
 		$requete = $sql->prepareStatementForSqlObject($sQuery);
 		return $requete->execute()->current();
 	}
 	
 	public function getConsultationExamenJour($id_cons){
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		$sQuery = $sql->select()
 		->from(array('c' => 'consultation'))
 		->where(array('idcons' => $id_cons));
 		$requete = $sql->prepareStatementForSqlObject($sQuery);
 		return $requete->execute()->current();
 	}
 	
 	public function getTarifDeLacte($idActe){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->from(array('s'=>'actes'));
 		$select->columns(array('*'));
 		$select->where(array('id' => $idActe));
 		$stat = $sql->prepareStatementForSqlObject($select);
 		$result = $stat->execute()->current();
 		return $result;
 	}
 	
 	//Recupere les antecedents m�dicaux
 	//Recupere les antecedents m�dicaux
 	public function getAntecedentMedicauxParLibelle($libelle){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->from(array('am'=>'ant_medicaux'));
 		$select->columns(array('*'));
 		$select->where(array('libelle' => $libelle));
 		return $sql->prepareStatementForSqlObject($select)->execute()->current();
 	}
 	
 	//Ajout des ant�c�dents m�dicaux
 	//Ajout des ant�c�dents m�dicaux
 	public function addAntecedentMedicaux($data){
 		$date = (new \DateTime())->format('Y-m-d H:i:s');
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 		
 		for($i = 0; $i<$data->nbCheckboxAM; $i++){
 			$champ = "champTitreLabel_".$i;
 			$libelle =  $data->$champ;
 			
 			if(!$this->getAntecedentMedicauxParLibelle($libelle)){
 				$sQuery = $sql->insert()
 				->into('ant_medicaux')
 				->values(array('libelle' => $libelle, 'date_enregistrement' => $date, 'id_medecin' => $data->med_id_personne));
 				$sql->prepareStatementForSqlObject($sQuery)->execute();
 			}
 			
 		}
 		
 	}
 	
 	
 	//Recupere l'antecedent m�dical de la personne
 	//Recupere l'antecedent m�dical de la personne
 	public function getAntecedentMedicauxPersonneParId($id, $id_patient){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->from(array('amp'=>'ant_medicaux_personne'));
 		$select->columns(array('*'));
 		$select->where(array('id_ant_medicaux' => $id, 'id_patient' => $id_patient));
 		return $sql->prepareStatementForSqlObject($select)->execute()->current();
 	}
 	
 	
 	//Recuperer les antecedents m�dicaux du patient
 	//Recuperer les antecedents m�dicaux du patient
 	public function getAntecedentsMedicauxPatient($id_patient){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->columns(array('*'));
 		$select->from(array('amp'=>'ant_medicaux_personne'));
 		$select->join( array('am' => 'ant_medicaux'), 'am.id = amp.id_ant_medicaux' , array('*'));
 		$select->where(array('amp.id_patient' => $id_patient));
 		$result = $sql->prepareStatementForSqlObject($select)->execute();
 		
 		$tableau = array();
 		
 		foreach ($result as $resul){
 			$tableau[] = $resul['libelle'];
 		}
 		
 		return $tableau;
 	}
 	
 	
 	//Ajout des ant�c�dents m�dicaux de la personne
 	//Ajout des ant�c�dents m�dicaux de la personne
 	public function addAntecedentMedicauxPersonne($data){
 		$date = (new \DateTime())->format('Y-m-d H:i:s');
 		$db = $this->tableGateway->getAdapter();
 		$sql = new Sql($db);
 			
 		//Tableau des nouveaux antecedents ajouter
 		$tableau = array();
 		
 		for($i = 0; $i<$data->nbCheckboxAM; $i++){
 			$champ = "champTitreLabel_".$i;
 			$libelle =  $data->$champ;
 			
 			//Ajout des nouveaux libelles dans le tableau
 			$tableau[] = $libelle;
 			
 			$antecedent = $this->getAntecedentMedicauxParLibelle($libelle);
 			if($antecedent){
 				if(!$this->getAntecedentMedicauxPersonneParId($antecedent['id'], $data->id_patient)){
 					$sQuery = $sql->insert()
 					->into('ant_medicaux_personne')
 					->values(array('id_ant_medicaux' => $antecedent['id'], 'id_patient' => $data->id_patient, 'date_enregistrement' => $date, 'id_medecin' => $data->med_id_personne));
 					$sql->prepareStatementForSqlObject($sQuery)->execute();
 				}
 			}
 		}
 		
 		//Tableau de tous les antecedents medicaux du patient avant la mise � jour
 		$tableau2 = $this->getAntecedentsMedicauxPatient($data->id_patient);
 		
 		//var_dump($data->nbCheckboxAM); exit();
 		//Suppression des antecedents non s�lectionn�s
 		for($i=0; $i<count($tableau2); $i++){
 			if(!in_array($tableau2[$i], $tableau)){
 				$id_ant_medicaux = $this->getAntecedentMedicauxParLibelle($tableau2[$i])['id'];
 				$sQuery = $sql->delete()
 				->from('ant_medicaux_personne')
 				->where(array('id_ant_medicaux' => $id_ant_medicaux, 'id_patient' => $data->id_patient));
 				$sql->prepareStatementForSqlObject($sQuery)->execute();
 			}
 		}
 			
 	}
 	
 	
 	//Recupere les antecedents m�dicaux de la personne
 	//Recupere les antecedents m�dicaux de la personne
 	public function getAntecedentMedicauxPersonneParIdPatient($id_patient){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->columns(array('*'));
 		$select->from(array('amp'=>'ant_medicaux_personne'));
 		$select->join( array('am' => 'ant_medicaux'), 'am.id = amp.id_ant_medicaux' , array('*'));
 		$select->where(array('amp.id_patient' => $id_patient));
 		return $sql->prepareStatementForSqlObject($select)->execute();
 	}
 	
 	
 	//Recupere les antecedents m�dicaux 
 	//Recupere les antecedents m�dicaux 
 	public function getAntecedentsMedicaux(){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->columns(array('*'));
 		$select->from(array('am'=>'ant_medicaux'));
 		return $sql->prepareStatementForSqlObject($select)->execute();
 	}
 	
 	
 	//Recupere la liste des actes
 	//Recupere la liste des actes
 	public function getListeDesActes(){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->columns(array('*'));
 		$select->from(array('a'=>'acte'));
 		return $sql->prepareStatementForSqlObject($select)->execute();
 	}
 	
 	
 	//Recupere la laiste des voie_administration selectionn�e
 	public function getVoieAdministration($idcons){
 		$adapter = $this->tableGateway->getAdapter();
 		$sql = new Sql($adapter);
 		$select = $sql->select();
 		$select->from(array('voie'=>'voie_administration'));
 		$select->columns(array('*'));
 		$select->where(array('idcons' => $idcons));
 		return $sql->prepareStatementForSqlObject($select)->execute()->current();
 	}
 	
 	//Verifier si un tableau est vide ou pas
 	function array_empty($array) {
 		$is_empty = true;
 		foreach($array as $k) {
 			$is_empty = $is_empty && empty($k);
 		}
 		return $is_empty;
 	}
 	
 	public function addVoieAdministration($data){
 		$idcons = $data['idcons'];
 		if($this->getVoieAdministration($idcons)){
 			$db = $this->tableGateway->getAdapter();
 			$sql = new Sql($db);
 			$sQuery = $sql->delete()->from('voie_administration')
 			->where(array('idcons' => $idcons));
 			$sql->prepareStatementForSqlObject($sQuery)->execute();
 		}
 		
 		$donnees = array();
 		
 		//S'il y a une intensite sup�rieur � 3 alors il y a des donn�es de prise en charge 
 		if( $data['intensite'] > 3 ){
 			$donnees['m1'] = $data['voie_med_1'];
 		    $donnees['m2'] = $data['voie_med_2'];
 			$donnees['m3'] = $data['voie_med_3'];
 			$donnees['m4'] = $data['voie_med_4'];
 			$donnees['m5'] = $data['voie_med_5'];
 		}
 		
 		//S'il y a un motif 'Fi�vre' alors il y a des donn�es de prise en charge 
 		if( $data['motif_admission1'] == 1 || $data['motif_admission2'] == 1 ||
 		    $data['motif_admission3'] == 1 || $data['motif_admission4'] == 1 ||
 			$data['motif_admission5'] == 1){
 			
 			$donnees['m6'] = $data['voie_med_6'];
 		}
 		
 		//S'il y a des infos de prise en charge on ins�re
 		if(!$this->array_empty($donnees)){
 			$donnees['idcons'] = $idcons;
 			
 			$db = $this->tableGateway->getAdapter();
 			$sql = new Sql($db);
 			$sQuery = $sql->insert()->into('voie_administration')->values($donnees);
 			$sql->prepareStatementForSqlObject($sQuery)->execute();
 		}

 	}
 	
 	
}