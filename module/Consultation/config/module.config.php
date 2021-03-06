<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'Consultation\Controller\Consultation' => 'Consultation\Controller\ConsultationController'
				)
		),
		'router' => array (
				'routes' => array (
						'consultation' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/consultation[/][:action][/:id][/:val]',
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'idpatient' => '[0-9]+'
										),
										'defaults' => array (
												'controller' => 'Consultation\Controller\Consultation',
												'action' => 'liste-consultations'
										)
								)
						)
				)
		),
		'view_manager' => array (
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
		)
);