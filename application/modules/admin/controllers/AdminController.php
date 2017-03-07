<?php
    $loggedUser;
    
class Admin_AdminController extends Zend_Controller_Action
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
        $this->view->form = new Admin_Form_Admin();
        
        $request = $this->getRequest();
        $form = new  Admin_Form_Admin();
        //Entity Manager
        $em = Zend_Registry::get('em');
        
        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())){
                
            $username = $form->getValue('currentuser');
            $password = md5($form->getValue('password'));
            $GLOBALS['loggedUser'] = $username;
            
            try{
                $test = new entities/Admin();
                $test = $em->getRepository('Entities/Admin')
                           ->findAll();

                foreach ($test as $user) {
                    $name = $user->getUsername();
                    $pwd = $user->getPassword();
                    if( $name == $username && $pwd == $password ){
                        $this->startSession();
                        $this->_redirect('/admin/admin/test/');
                    } else {
                        $this->view->errormessage = "You Have Entered Wrong User Name, Password!";
                    }
                }    
            }catch (Exception $e){
                echo "Error : ".$e->getMessage();
            }
        }
    }

    public function viewAction()
    {
        $this->loginSession();
        
        $admin = new Zend_Session_Namespace();
        $this->view->result = $admin->username;
        //Entity Manager
        $em = Zend_Registry::get('em');
        try{
            $test = new entities\Admin();
            $test = $em->getRepository('Entities\Admin')
                        ->findOneBy(array('username'=> $admin->username));
            $this->view->id = $test->getId();
            $this->view->uname = $test->getUsername();
        }catch (Exception $e){
            echo "Error : ".$e->getMessage();
        }
    }

    public function testAction()
    {
        $this->loginSession();
       
        $user = new Zend_Session_Namespace();
        $this->view->user = $user->username;
        //Entity Manager
        $em = Zend_Registry::get('em');
        $users = new entities\User();
        $users = $em->getRepository('Entities\User')
                    ->findAll();
        $this->view->userinfo = array();
        $i =0;
        foreach ($users as $user) {
            $this->view->userinfo[$i]['id'] = $user->getId();
            $this->view->userinfo[$i]['name'] = $user->getUsername();
            $this->view->userinfo[$i]['fname'] = $user->getFirstname();
            $this->view->userinfo[$i]['lname'] = $user->getLastname();
            $this->view->userinfo[$i]['email'] = $user->getEmail();
            $this->view->userinfo[$i]['pwd'] = $user->getPassword();
            $i++;
        }
        $this->view->limit = $i;
    }

    public function deleteAction()
    {
        $this->loginSession();
        $id = $this->getRequest()->getParam('id');
        
        //Entity Manager
        $em = Zend_Registry::get('em');
        
        $user = new Entities\User();
        $user = $em->getRepository('Entities\User')
                   ->find(array('id'=> $id ));
        $name = $user->getFirstname();
        // schedule for deletion
        $em->remove($user);
        $em->flush(); // issues delete
        // print the flash error on the same page
        $this->_helper->flashMessenger(" Record Of ".$name." Has Been Deleted!");
        $this->_helper->redirector('test');
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
            $this->_redirect('/admin/admin/index/');
        } 
    }

    public function logoutAction()
    {
        Zend_Session::destroy(true);
        $this->_redirect('');
    }

    public function contactAction()
    {
        $this->loginSession();
        $user = new Zend_Session_Namespace();
        $this->view->user = $user->username;
    }
}
