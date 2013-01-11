<?php
/**
 * Factory for the formPrepare view helper
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate\Service
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\Service;

use Zend\ServiceManager\FactoryInterface;
use ZfJoacubFormJqueryValidate\View\Helper\FormPrepare;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormPrepareFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$renderer = $serviceLocator->getServiceLocator()->get('zf_joacub_form_jquery_validate.renderer');
		return new FormPrepare($renderer);
	}
}
