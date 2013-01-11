<?php
/**
 * Description
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate\Service
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\Service;

use Zend\ServiceManager\FactoryInterface;
use ZfJoacubFormJqueryValidate\View\Helper\FormElement;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormElementFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$renderer = $serviceLocator->getServiceLocator()->get('stroker_form.renderer');
		return new FormElement($renderer);
	}
}
