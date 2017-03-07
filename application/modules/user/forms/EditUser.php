<?php

class User_Form_EditUser extends Zend_Form
{

    public function init()
    {
        $username = new Zend_Form_Element_Text('username', array('label'=>'User Name ', 'disabled'=>'disabled'));
       
        $firstname = new Zend_Form_Element_Text('firstname', array('label'=>'First Name ', 'placeholder'=>'Enter Your First Name'));
        
        $lastname = new Zend_Form_Element_Text('lastname', array('label'=>'Last Name ', 'placeholder'=>'Enter Your Last Name'));
        
        $email = new Zend_Form_Element('email', array('label'=>'Email-Id ', 'placeholder'=>'Enter Your Email-Id'));
        
        $this->setMethod("post");
        $this->setAction("/MissionSmiles/public/user/user/edit");
        $this->setAttrib('onsubmit', 'return validateForm()');
        $this->addElements(array($username, $firstname, $lastname, $email));
        $this->addElement('submit', 'submit', array('ignore'=> true, 'label'=> 'Update Profile'));
      //  $this->addElement('cancel', 'cancel', array('ignore'=> true, 'label'=> 'Cancle'));
    }
}

