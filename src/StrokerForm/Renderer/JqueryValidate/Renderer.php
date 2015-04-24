<?php
/**
 * Renderer for the jquery.validate plugin
 *
 * @category  StrokerForm
 * @package   StrokerForm\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Renderer\JqueryValidate;

use Zend\View\Renderer\PhpRenderer as View;
use Zend\Form\FormInterface;
use StrokerForm\Renderer\AbstractValidateRenderer;
use Zend\Validator\ValidatorInterface;
use Zend\Form\ElementInterface;
use Zend\Json\Json;

class Renderer extends AbstractValidateRenderer
{
    /**
     * @var array
     */
    private $rules = array();

    /**
     * @var array
     */
    private $messages = array();

    /**
     * @var array
     */
    protected $skipValidators = array(
        'InArray',
        'Explode'
    );

    /**
     * Executed before the ZF2 view helper renders the element
     *
     * @param string                          $formAlias
     * @param \Zend\View\Renderer\PhpRenderer $view
     * @param \Zend\Form\FormInterface        $form
     */
    public function preRenderForm($formAlias, View $view, FormInterface $form = null)
    {
        if ($form === null) {
            $form = $this->getFormManager()->get($formAlias);
        }

        parent::preRenderForm($formAlias, $view, $form);

        $inlineScript = $view->plugin('inlineScript');
        $url = $view->plugin('url');
        $inlineScript->appendScript($this->getInlineJavascript($form));

        if ($this->getOptions()->isIncludeAssets()) {
            $assetBaseUri = $url->__invoke('strokerform-asset');
            $inlineScript->appendFile($assetBaseUri . '/jquery_validate/js/jquery.validate.js');
            if ($this->getOptions()->isUseTwitterBootstrap() === true) {
                $inlineScript->appendFile($assetBaseUri . '/jquery_validate/js/jquery.validate.bootstrap.js');
            }
        }
    }

    /**
     * @param  \Zend\Form\FormInterface $form
     * @return string
     */
    protected function getInlineJavascript(FormInterface $form)
    {
        $validateOptions = $this->getOptions()->getValidateOptions();
        $validateOptions = array_merge_recursive($validateOptions,  array('rules' => $this->rules, 'messages' => $this->messages));
        $validateOptions = Json::encode($validateOptions);

        return 'jQuery(document).ready(function($){
        $(\'#' . $form->getName() . '\').validate(' . $validateOptions . '
        );
        });';
    }

    /**
     * @param string $formAlias
     * @param \Zend\Form\ElementInterface        $element
     * @param \Zend\Validator\ValidatorInterface $validator
     * @return mixed|void
     */
    protected function addValidationAttributesForElement($formAlias, ElementInterface $element, ValidatorInterface $validator = null)
    {
        if ($element instanceof \Zend\Form\Element\Email && $validator instanceof \Zend\Validator\Regex) {
            $validator = new \Zend\Validator\EmailAddress();
        }
        if (in_array($this->getValidatorClassName($validator), $this->skipValidators)) {
            return;
        }
        $rule = $this->getRule($validator);
        if ($rule !== null) {
            $rules = $rule->getRules($validator);
            $messages = $rule->getMessages($validator);
        } else {
            //fallback ajax
            $ajaxUri = $this->getView()->url('strokerform-ajax-validate', array('form' => $formAlias));
            $rules = array(
                'remote' => array(
                    'url' => $ajaxUri,
                    'type' => 'POST'
                )
            );
            $messages = array();
        }

        $elementName = $this->getElementName($element);

        if (!isset($this->rules[$elementName])) {
            $this->rules[$elementName] = array();
        }
        $this->rules[$elementName] = array_merge($this->rules[$elementName], $rules);
        if (!isset($this->messages[$elementName])) {
            $this->messages[$elementName] = array();
        }
        $this->messages[$elementName] = array_merge($this->messages[$elementName], $messages);
    }

    /**
     * Get the classname of the zend validator
     *
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return mixed
     */
    protected function getValidatorClassName(ValidatorInterface $validator = null)
    {
        $namespaces = explode('\\', get_class($validator));

        return end($namespaces);
    }

    /**
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return null|RuleInterface
     */
    protected function getRule(ValidatorInterface $validator = null)
    {
        $ruleClass = 'StrokerForm\\Renderer\\JqueryValidate\\Rule\\' . $this->getValidatorClassName($validator);
        if (class_exists($ruleClass)) {
            $rule = new $ruleClass;
            $rule->setTranslator($this->getTranslator());

            return $rule;
        }

        return null;
    }
}
