<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'Statistique\Controller\Statistique' => 'Statistique\Controller\StatistiqueController',
				),
		),
		'router' => array (
				'routes' => array (
						'statistique' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/statistique[/][:action][/:id][/:val]',
										'defaults' => array (
												'controller' => 'Statistique\Controller\Statistique',
												'action' => 'index'
										),
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'idpatient' => '[0-9]+'
										),
										
								)
						)
				)
		),
        
        'view_manager' => array ('template_path_stack' => array ('statistique' => __DIR__ .'/../view' ),),
		/*'view_manager' => array (
				'template_map' => array (
						'layout/consultation' => __DIR__ .'/../view/layout/consultation.phtml',
						'layout/menugauche_consult' => __DIR__ .'/../view/layout/menugauche_consult.phtml',
						'layout/piedpage_consult' => __DIR__ .'/../view/layout/piedpage_consult.phtml'
				),
				'template_path_stack' => array (
						'consultation' => __DIR__ .'/../view'
				),
				'strategies' => array(
						'ViewJsonStrategy',
				),
		)*/
);