<?php
/**
 * Options for renderers
 *
 * @category   StrokerForm
 * @package    StrokerForm\Renderer
 * @subpackage JqueryValidate
 * @copyright  2012 Bram Gerritsen
 * @version    SVN: $Id$
 */

namespace StrokerForm\Renderer;

use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    /**
     * @var bool
     */
    private $includeAssets = true;
    
    /**
     * @var string
     */
    private $strokerformAsset;

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
    
    public function setStrokerformAsset($strokerformAsset)
    {
        $this->strokerformAsset = $strokerformAsset;
    }
    
    public function getStrokerformAsset()
    {
        return $this->strokerformAsset;
    }
}
