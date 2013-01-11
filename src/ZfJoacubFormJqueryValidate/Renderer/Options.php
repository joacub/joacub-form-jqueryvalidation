<?php
/**
 * Options for renderers
 *
 * @category   ZfJoacubFormJqueryValidate
 * @package    ZfJoacubFormJqueryValidate\Renderer
 * @subpackage JqueryValidate
 * @copyright  2012 Bram Gerritsen
 * @version    SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidate\Renderer;

use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
	/**
	 * @var bool
	 */
	private $includeAssets = true;

	/**
	 * @return bool
	 */
	public function isIncludeAssets()
	{
		return $this->includeAssets;
	}

	/**
	 * @param bool $includeAssets
	 */
	public function setIncludeAssets($includeAssets)
	{
		$this->includeAssets = $includeAssets;
	}
}