<?php

namespace Controller;

use Component\Request as ComponentRequest;
use Component\Session as ComponentSession;
use Component\Database\DataAccessLayer;
use Model\Message;


class ForumController
{

    public function Forum() 
    {

        $request = new ComponentRequest();
        $session = new ComponentSession();

        // if (!$session->hasKey('user')) {
        //     header('Location: connexion.php');
        // }

        $dal = new DataAccessLayer();


        if ($request->hasPostParam('pseudo') 
            && $request->hasPostParam('message')) {
          
            $message = new Message();
            $message->setPseudo($request->_post('pseudo'));
            $message->setMessage($request->_post('message'));

            $dal->insertMessage($message);

        }
        $page = 'View/items/forum.php';
        require 'View/layout.php';
        }
    
       
}

