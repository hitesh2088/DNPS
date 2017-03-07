<?php

class User_Form_Register extends Zend_Form
{
    public function init()
    {
        $username = new Zend_Form_Element_Text('username', array('label'=>'User Name ', 'placeholder'=>'Create Your User Name'));
       
        $firstname = new Zend_Form_Element_Text('firstname', array('label'=>'First Name ', 'placeholder'=>'Enter Your First Name'));
        
        $lastname = new Zend_Form_Element_Text('lastname', array('label'=>'Last Name ', 'placeholder'=>'Enter Your Last Name'));
        
//        $gender = new Zend_Form_Element_Radio('yes');
//        $gender->setLabel('Gender');
//        $gender->addMultiOptions(array('Male','Female','Other'));
//    
//        $category = new Zend_Form_Element_MultiCheckbox('category');
//        $category->setLabel('Category');
//        $category->addMultiOptions(array('0'=>' OBC', '1'=>' SC', '2'=>' ST', '3'=>' GENERAL', '4'=>' OTHER'));
//        
//        $city = $this->createElement('select','cities');
//        $city ->setLabel('Current City')->addMultiOptions(array('Jabalpur', 'Mumbai', 'Indore', 'Banglore'));
//        
        $email = new Zend_Form_Element('email', array('label'=>'Email-Id ', 'placeholder'=>'Enter Your Email-Id'));
        
        $password = new Zend_Form_Element_Password('password', array('label'=>'Password ', 'placeholder'=>'Create Your Password'));
        
        $rpassword = new Zend_Form_Element_Password('rpassword', array('label'=>'Retype-Password ', 'placeholder'=>'Re-type Your Password'));
       
        $this->setMethod("post");
        $this->setAction("/MissionSmiles/public/user/user/index");
        $this->setAttrib('onsubmit', 'return validateForm()');
        $this->addElements(array($username, $firstname, $lastname, $email, $password, $rpassword));
        $this->addElement('submit', 'submit', array('ignore'=> true, 'label'=> 'Sign Up'));
    }
}

