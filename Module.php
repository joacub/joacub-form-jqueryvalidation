<?php
/**
 * ZfJoacubFormJqueryValidate module
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */
namespace ZfJoacubFormJqueryValidate;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements
	AutoloaderProviderInterface,
	ServiceProviderInterface,
	ConfigProviderInterface,
	ControllerProviderInterface,
	ViewHelperProviderInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				),
			),
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'ZfJoacubFormJqueryValidate\Options\ModuleOptions' => 'ZfJoacubFormJqueryValidate\Service\ModuleOptionsFactory',
				'ZfJoacubFormJqueryValidate\FormManager' => 'ZfJoacubFormJqueryValidate\Service\FormManagerFactory',
				'zf_joacub_form_jquery_validate.renderer' => 'ZfJoacubFormJqueryValidate\Service\RendererFactory',
				'forminput' => 'ZfJoacubFormJqueryValidate\Service\FormInputFactory',
			),
			'invokables' => array (
				'zf_joacub_form_jquery_validate.renderer.jqueryvalidate' => 'ZfJoacubFormJqueryValidate\Renderer\JqueryValidate\Renderer',
			),
		);
	}

	/**
	 * Returns configuration to merge with application configuration
	 *
	 * @return array|\Traversable
	 */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to seed
	 * such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getControllerConfig()
	{
		return array(
			'factories' => array(
				'ZfJoacubFormJqueryValidate\Controller\Ajax' => 'ZfJoacubFormJqueryValidate\Service\AjaxControllerFactory'
			),
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'form_element' => 'ZfJoacubFormJqueryValidate\Service\FormElementFactory',
				'ZfJoacubFormJqueryValidatePrepare' => 'ZfJoacubFormJqueryValidate\Service\FormPrepareFactory'
			)
		);
	}
}