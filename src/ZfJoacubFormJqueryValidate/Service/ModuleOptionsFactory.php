<?php
/**
 * Description
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate\Options
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\Service;

use Zend\ServiceManager\FactoryInterface;
use ZfJoacubFormJqueryValidate\Options\ModuleOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$options = $serviceLocator->get('Config');
		$options = isset($options['zf_joacub_form_jquery_validate']) ? $options['zf_joacub_form_jquery_validate'] : null;

		if (null === $options) {
			throw new RuntimeException(sprintf(
				'Configuration with name "%s" could not be found in "doctrine.configuration".',
				$this->name
			));
		}

		return new ModuleOptions($options);
	}
}
