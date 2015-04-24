<?php
/**
 * Between
 *
 * @category  StrokerForm
 * @package   StrokerForm\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerForm\Renderer\JqueryValidate\Rule;

class Between extends AbstractRule
{
    /**
     * Get the validation rules
     *
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return array
     */
    public function getRules(\Zend\Validator\ValidatorInterface $validator)
    {
        return array('range' => array($this->getMin($validator), $this->getMax($validator)));
    }

    /**
     * Get the validation message
     *
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return string
     */
    public function getMessages(\Zend\Validator\ValidatorInterface $validator)
    {
        return array(
            'range' =>
            sprintf($this->translateMessage('The input is not between %s and %s'), $this->getMin($validator), $this->getMax($validator))
        );
    }

    /**
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return mixed
     */
    protected function getMin(\Zend\Validator\ValidatorInterface $validator)
    {
        return $validator->getInclusive() ? $validator->getMin() : $validator->getMin() + 1;
    }

    /**
     * @param  \Zend\Validator\ValidatorInterface $validator
     * @return mixed
     */
    protected function getMax(\Zend\Validator\ValidatorInterface $validator)
    {
        return $validator->getInclusive() ? $validator->getMax() : $validator->getMax() - 1;
    }
}
