<?php
/**
 * Extends the default zf2 forminput view helper
 *
 * @category  ZfJoacubFormJqueryValidate
 * @package   ZfJoacubFormJqueryValidate\View
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\View\Helper;

use ZfJoacubFormJqueryValidate\Renderer\RendererInterface;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormElement extends \Zend\Form\View\Helper\FormElement
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
	 * Render a form <input> element from the provided $element
	 *
	 * @param  ElementInterface $element
	 * @throws Exception\DomainException
	 * @return string
	 */
	public function render(ElementInterface $element)
	{
		$this->renderer->preRenderInputField($element);
		return parent::render($element);
	}
}
