<?php

namespace Controller;


use Component\Request as ComponentRequest;
use Component\Session as ComponentSession;
use Component\Database\DataAccessLayer;
use Model\User;

class HomeController
{

    public function inscription() 
    {
        $request = new ComponentRequest;
        $session = new ComponentSession;
        
        if ($session->hasKey('user')) {
            header('Location: index.php');
        }
        
        if ($request->hasPostParam('username') && $request->hasPostParam('password')) {
            $user = new User();
            $user->setPassword(password_hash($request->_post('password'), PASSWORD_BCRYPT));
            $user->setUsername($request->_post('username'));
        
            $dal = new DataAccessLayer();
            $dal->insertUser($user);
        
            $session->setValue('user', $user);
            header('Location: index.php');
        }

        $page = 'View/home/inscription.php';
        require 'View/layout.php';
    }

    public function connexion() 
    {
        $request = new ComponentRequest;
        $session = new ComponentSession;
        
        if ($session->hasKey('user')) {
            header('Location: index.php');
        }
        
        if ($request->hasPostParam('username') && $request->hasPostParam('password')) {
            $dal = new DataAccessLayer();
            $user = $dal->getUserByUsername($request->_post('username'));
            if ($user instanceof User && password_verify($request->_post('password'), $user->getPassword())) {
                $session->setValue('user', $user);
                header('Location: index.php');
            } else {
                $error = "Identifiants incorrects";
            }
        }

        $page = 'View/home/connexion.php';
        require 'View/layout.php';


    }

 







}