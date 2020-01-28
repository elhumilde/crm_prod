<?php

header('Access-Control-Allow-Origin: *');
class TTSFormField {
	
	private $__form,
			$__obj_form;
	
	public function __construct($form){
		$this->__form = $form;
	}
	
	public function setForm($obj_form){
		$this->__obj_form = $obj_form;
	}
	
	public function __toString(){
		$this->__obj_form->__num_id++;
		return str_replace("::id::",$this->__obj_form->__num_id,$this->__form);
	}
	
}
?>