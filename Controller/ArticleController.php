<?php

namespace Controller;

use Component\Request as ComponentRequest;
use Component\Session as ComponentSession;
use Component\Database\DataAccessLayer;
use Model\Items;


class ArticleController
{

    public function ArticleList() 
    {

        $request = new ComponentRequest();
        $session = new ComponentSession();

        // if (!$session->hasKey('user')) {
        //     header('Location: connexion.php');
        // }

        $dal = new DataAccessLayer();


        if ($request->hasPostParam('title') && 
            $request->hasPostParam('content')) {
   
            $item = new Items();
            $item->setTitle($request->_post('title'));
            $item->setContent($request->_post('content'));

           $dal->insertItem($item);

        }
        $page = 'View/items/listarticle.php';
        require 'View/layout.php';
        }
    
       
}

