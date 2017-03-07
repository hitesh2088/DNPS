<?php

class User_Form_Password extends Zend_Form
{

    public function init()
    {
        $opassword = new Zend_Form_Element_Password('opassword', array('label'=>'Old Password ', 'placeholder'=>'Enter Your Old Password'));
        
        $password = new Zend_Form_Element_Password('password', array('label'=>'New Password ', 'placeholder'=>'Create Your Password'));
        
        $rpassword = new Zend_Form_Element_Password('rpassword', array('label'=>'Retype-Password ', 'placeholder'=>'Re-type Your Password'));
        
        $this->setMethod("post");
        $this->setAction("");
        $this->setAttrib('onsubmit', '');
        $this->addElements(array($opassword, $password, $rpassword));
        $this->addElement('submit', 'submit', array('ignore'=> true, 'label'=> 'Change Password'));
    }


}

