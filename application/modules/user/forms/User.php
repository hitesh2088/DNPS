<?php

class User_Form_User extends Zend_Form
{

    public function init()
    {
        $username=new Zend_Form_Element_Text('currentuser', array('label'=>'User Name  ','placeholder'=>'Enter Your User Name'));
        $this->addElement($username);
        
        $password=new Zend_Form_Element_Password('password', array('label'=>'Password  ','placeholder'=>'Enter Your Password'));
        $this->addElement($password);
        
        $submit=new Zend_Form_Element_Submit('login',array('label'=>'Login'));
        $this->addElement($submit); 
        
        $this->setMethod("post");
        $this->setAction("/MissionSmiles/public/user/user/login");
    }   
}

