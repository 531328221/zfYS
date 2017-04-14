<?php

namespace User\FormUserValidate;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class FormUserValidate
{
	private $inputFilter   = null;
	private $inputFactory  = null;
	private $YSlang;

	public function __construct($langTranslate) {
		$this->inputFactory = new InputFactory();
		$this->inputFilter  = new InputFilter();

		$this->YSlang       = $langTranslate; 
	}

	public function checkUserForm($data, $functionNamePre) {
		$functionName = $functionNamePre . "UserValidate";
		$this->$functionName();/////////
	}
}