<?php
return array(
	'zf_joacub_form_jquery_validate' => array(
		'activeRenderers' => array(
			'zf_joacub_form_jquery_validate.renderer.jqueryvalidate',
		),
		'renderer_options' => array(
			'zf_joacub_form_jquery_validate.renderer.jqueryvalidate' => array(
				'options_class' => 'ZfJoacubFormJqueryValidate\Renderer\JqueryValidate\Options',
				'include_assets' => true,
				'use_twitter_bootstrap' => true,
				'validateOptions' => array(
					//'onsubmit : false',
					'onkeyup : false',
				)
			)
		),
	),
	'router' => array(
		'routes' => array(
			'ZfJoacubFormJqueryValidate-ajax-validate' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/form/validate-ajax/:form',
					'defaults' => array(
						'controller' => 'ZfJoacubFormJqueryValidate\Controller\Ajax',
						'action' => 'validate',
					),
				)
			),
			'ZfJoacubFormJqueryValidate-asset' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/assets',
				)
			),
		)
	),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../assets',
            )
        ),
    ),
);