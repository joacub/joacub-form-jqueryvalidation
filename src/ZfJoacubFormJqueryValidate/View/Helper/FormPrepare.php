<?php
/**
 * This view helper makes the view and form available in the renderers
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate\View
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\FormInterface;
use ZfJoacubFormJqueryValidate\Renderer\RendererInterface;
use Zend\Form\Form;

class FormPrepare extends AbstractHelper
{
	/**
	 * @var RendererInterface
	 */
	private $renderer;

	/**
	 * @param RendererInterface $renderer
	 */
	public function __construct(RendererInterface $renderer)
	{
		$this->renderer = $renderer;
	}

    /**
     * @param string $formAlias
     * @param \Zend\Form\FormInterface $form
     */
	public function __invoke($formAlias, FormInterface $form = null)
	{
		$this->renderer->preRenderForm($formAlias, $this->getView(), $form);
	}
}
