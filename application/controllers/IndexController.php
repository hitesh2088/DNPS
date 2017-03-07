<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
//        $em = Zend_Registry::get('em');
//        $em->getConfiguration()->setMetadataDriverImpl( new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
//        $em->getConnection()->getSchemaManager()));
//        $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
//        $cmf->setEntityManager($em);
//        $metadata = $cmf->getAllMetadata();
//        $generator = new \Doctrine\ORM\Tools\EntityGenerator();
//        $generator->setUpdateEntityIfExists(true);
//        $generator->setGenerateStubMethods(true);
//        $generator->setGenerateAnnotations(true);
//        $generator->generate($metadata, 'D:\wamp 2.5\www\MissionSmiles\application\Entities'); exit;
    }

    public function indexAction()
    {
        // action body
    }

    public function contactsAction()
    {
        
    }
}

