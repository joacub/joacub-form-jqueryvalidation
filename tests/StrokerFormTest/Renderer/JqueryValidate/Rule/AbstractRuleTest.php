<?php
/**
 * Description
 *
 * @category  ZfJoacubFormJqueryValidateTest
 * @package   ZfJoacubFormJqueryValidateTest\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace ZfJoacubFormJqueryValidateTest\Renderer\JqueryValidate\Rule;

use ZfJoacubFormJqueryValidate\Renderer\JqueryValidate\Rule\RuleInterface;
use Zend\Validator\ValidatorInterface;

abstract class AbstractRuleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var RuleInterface
	 */
	protected $rule;

	/**
	 * @var ValidatorInterface
	 */
	protected $validator;

	/**
	 * @var
	 */
	protected $translatorMock;

	/**
	 * @return RuleInterface
	 */
	protected abstract function createRule();

	/**
	 * @return ValidatorInterface
	 */
	protected abstract function createValidator();

	/**
	 * Setup test
	 */
	public function setUp()
	{
		$this->rule = $this->createRule();
		$this->translatorMock = $this->getMock('Zend\I18n\Translator\Translator', array('translate'));
		$this->rule->setTranslator($this->translatorMock);
		$this->validator = $this->createValidator();
	}

	/**
	 * @return array
	 */
	protected function getRules()
	{
		return $this->getRule()->getRules($this->getValidator());
	}

	/**
	 * @return array
	 */
	protected function getMessages()
	{
		return $this->getRule()->getMessages($this->getValidator());
	}

	/**
	 * @return RuleInterface
	 */
	protected function getRule()
	{
		return $this->rule;
	}

	/**
	 * @return ValidatorInterface
	 */
	protected function getValidator()
	{
		return $this->validator;
	}

	/**
	 * @return mixed
	 */
	protected function getTranslatorMock()
	{
		return $this->translatorMock;
	}

	/**
	 *
	 */
	public function testGetRulesReturnsArray()
	{
		$this->assertTrue(is_array($this->getRule()->getRules($this->getValidator())));
	}
}