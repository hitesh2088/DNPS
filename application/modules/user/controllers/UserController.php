<?php
use Doctrine\ORM\Mapping\Entity;
    $loggedUser;

class User_UserController extends Zend_Controller_Action
{

    public function init()
    {
        $messages = $this->_helper->flashMessenger->getMessages();
        if (!empty($messages)) {
           $this->_helper->layout->getView()->message = $messages[0];
        }
    }

    public function indexAction()
    {
        $this->view->form = new User_Form_Register();
     
        $request  = $this->getRequest();
        $form = new User_Form_Register();
        //Entity Manager
        $em = Zend_Registry::get('em');
       
        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())) {
          
            $user = new Entities/User();
            $user->setUsername($form->getValue('username'));
            $user->setFirstname($form->getValue('firstname'));
            $user->setLastname($form->getValue('lastname'));
            $user->setEmail($form->getValue('email'));
            $user->setPassword(md5($form->getValue('password')));
            try {
                $uname = $em->getRepository('Entities\User')
                           ->findOneBy(array('username'=>$form->getValue('username')));
                if($uname){
                    $this->view->errormsg = "*Sorry, User Name Already Exists!";
                }else{
                    $umail = $em->getRepository('Entities\User')
                                ->findOneBy(array('email'=>$form->getValue('email')));
                    if($umail){
                        $this->view->errormsg = "*Sorry, Email-Id Already Exists!";
                    }else{
                        $em->persist($user);
                        $em->flush();
                        $this->view->msg = "You Have Registered, Succesfully!";
                    }
                } 
            }catch (Exception $e){
                echo "Error : ".$e->getMessage();
            }
        }
    }

    public function loginAction()
    {
        $this->view->form = new User_Form_User();  
        
        $request  = $this->getRequest();
        $form = new User_Form_User();
        //Entity Manager
        $em = Zend_Registry::get('em');
        
        if ($this->getRequest()->isPost() && $form->isValid($request->getPost()) ){
                
            $username = $form->getValue('currentuser');
            $password = md5($form->getValue('password'));
            $GLOBALS['loggedUser'] = $username;
            try{
                $test = new Entities\User();
                $test = $em->getRepository('Entities\User')
                           ->findAll();

                foreach ($test as $user) {
                    $name = $user->getUsername();
                    $pwd = $user->getPassword();
                    if( $name == $username && $pwd == $password ){
                        $this->startSession();
                        $this->_redirect('/user/user/test/');
                    } else {
                        $this->view->errormessage = "You Have Entered Wrong User Name Or Password!";
                    }
                }    
            }catch (Exception $e){
                echo "Error : ".$e->getMessage();
            }
        }
    }

    public function testAction()
    {
        $this->loginSession();
        
        $user = new Zend_Session_Namespace();
        $this->view->result = $user->username;
        //Entity Manager
        $em = Zend_Registry::get('em');
        $users = new Entities\User();
        try{
            $users = $em->getRepository('Entities\User')
                        ->findOneBy(array('username'=> $user->username));
            $this->view->id = $users->getId();
            $this->view->uname = $users->getUsername();
            $this->view->fname = $users->getFirstname();
            $this->view->lname = $users->getLastname();
            $this->view->email = $users->getEmail();
        }catch (Exception $e){
            echo "Error : ".$e->getMessage();
        }
    }

    public function previewAction()
    {
        $this->loginSession();
        
        $this->view->form = new User_Form_EditUser();  
        $user = new Zend_Session_Namespace();
        $this->view->result = $user->username;
        
        $id = $this->getRequest()->getParam('id');
        //Entity Manager
        $em = Zend_Registry::get('em');
        $user = new Entities\User();
        $user = $em->getRepository('Entities\User')
                   ->findOneBy(array('id'=>$id));
        $this->view->data = array();
        $this->view->data['username'] = $user->getUsername();
        $this->view->data['firstname'] = $user->getFirstname();
        $this->view->data['lastname'] = $user->getLastname();
        $this->view->data['email'] = $user->getEmail();
    }

    public function editAction()
    {
        $this->loginSession();
        
        $user = new Zend_Session_Namespace();
        $request  = $this->getRequest();
        $form = new User_Form_EditUser();
        
        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())) {
                
            $firstname = $form->getValue('firstname');
            $lastname = $form->getValue('lastname');
            $email = $form->getValue('email');
            //Entity Manager
            $em = Zend_Registry::get('em');
            $test = new Entities\User();
            $test = $em->getRepository('Entities\User')
                       ->findOneBy(array('username'=>$user->username));
            $test->setFirstname($firstname);
            $test->setLastname($lastname);
            $test->setEmail($email);
            try{
                $umail = new Entities\User();
                $umail = $em->getRepository('Entities\User')
                            ->findOneBy(array('email'=>$form->getValue('email')));
                if($umail){
                    $this->_helper->flashMessenger(" Sorry,This ".$email." Email-Id Already Exists!!");
                    $this->_helper->redirector('test');
                }else{
                    $em->persist($test);
                    $em->flush();
                    $this->_helper->flashMessenger(" Record Updated!!");
                    $this->_helper->redirector('test');
                }
            }catch (Exception $e){
                echo "Error : ".$e->getMessage();
            }
        }
    }

    public function startSession()
    {
        $limit = new Zend_Session_Namespace();
        $limit->username = $GLOBALS['loggedUser']; 
    }

    public function loginSession()
    {
        $limit = new Zend_Session_Namespace();
        if (!isset($limit->username)) {
            $this->_redirect('/user/user/login/');
        } 
    }

    public function logoutAction()
    {
        Zend_Session::destroy(true);
        $this->_redirect('');
    }

    public function changePasswordAction()
    {
        $this->loginSession();
        $user = new Zend_Session_Namespace();
        $this->view->result = $user->username;
        
        $this->view->form = new User_Form_Password();
    }


}







