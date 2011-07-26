<?php

class Application_Form_Robots extends Zend_Form {

	protected $_content = '';

	public function init() {
		$this->setMethod(Zend_Form::METHOD_POST)
			 ->setAttrib('class', '_fajax')
			 ->setAttrib('id', 'frm-robots');

		$this->addElement(new Zend_Form_Element_Textarea(array(
			'name'     => 'content',
			'id'       => 'robots-content',
			'cols'     => '45',
			'rows'     => '7',
			'label'    => 'Robots txt',
			'class'    => 'h490',
			'value'    => $this->_content,
			'filters'  => array('StringTrim')
		)));

		$this->addElement(new Zend_Form_Element_Submit(array(
			'name'  => 'updateRobots',
			'id'    => 'update-robots',
			'label'  => 'Save robots.txt',
			'class'  => 'formsubmit',
		)));
	}

	public function getContent() {
		return $this->_content;
	}

	public function setContent($content) {
		$this->_content = $content;
		$this->getElement('content')->setValue($content);
	}

}