<?php
/**
 * Description
 *
 * @category  Acsi
 * @package   Acsi\
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use ZfJoacubFormJqueryValidate\FormManager;

class FormManagerFactory implements \Zend\ServiceManager\FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		/** @var $moduleOptions \ZfJoacubFormJqueryValidate\Options\ModuleOptions  */
		$moduleOptions = $serviceLocator->get('ZfJoacubFormJqueryValidate\Options\ModuleOptions');
		return new FormManager($moduleOptions->getForms());
	}
}
