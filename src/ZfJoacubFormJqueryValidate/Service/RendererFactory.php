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

use Zend\ServiceManager\FactoryInterface;
use ZfJoacubFormJqueryValidate\Renderer\RendererCollection;
use Zend\ServiceManager\ServiceLocatorInterface;

class RendererFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return \ZfJoacubFormJqueryValidate\Renderer\RendererInterface
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		/** @var $options \ZfJoacubFormJqueryValidate\Options\ModuleOptions */
		$options = $serviceLocator->get('ZfJoacubFormJqueryValidate\Options\ModuleOptions');
		$rendererCollection = new RendererCollection();
		foreach($options->getActiveRenderers() as $rendererAlias)
		{
			/** @var $renderer \ZfJoacubFormJqueryValidate\Renderer\RendererInterface */
			$renderer = $serviceLocator->get($rendererAlias);
			$renderer->setOptions($options->getRendererOptions($rendererAlias));
            $renderer->setFormManager($serviceLocator->get('ZfJoacubFormJqueryValidate\FormManager'));
            $renderer->setParams($serviceLocator->get('controllerpluginmanager')->get('params'));
			if ($serviceLocator->has('translator'))
			{
				$renderer->setTranslator($serviceLocator->get('translator'));
			}
			$renderer->setRouter($serviceLocator->get('router'));
			$rendererCollection->addRenderer($renderer);
		}
		return $rendererCollection;
	}
}
