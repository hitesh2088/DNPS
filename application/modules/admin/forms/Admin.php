<?php

class Admin_Form_Admin extends Zend_Form
{
    public function init()
    {
        $this->setMethod("post");
        $this->setAction("/MissionSmiles/public/admin/admin/index");
        
        $username = new Zend_Form_Element_Text('currentuser', array('label'=>'User Name ', 'placeholder'=>'Enter Your User Name'));
        $this->addElement($username);
        
        $password = new Zend_Form_Element_Password('password', array('label'=>'Password ', 'placeholder'=>'Enter Your Password'));
        $this->addElement($password);
        
        $submit = new Zend_Form_Element_Submit('login', array('label'=>'Login'));
        $this->addElement($submit);  
    }
}

