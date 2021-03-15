<?php

ini_set('error_reporting', E_ALL);


require 'autoload.php';

$request = new \Component\Request();



//index.php?controller=home&view=inscription

$controller = $request->_get('controller');
$view = $request->_get('view');

if ($controller == 'home') {
    $homeController = new \Controller\HomeController();
    if($view == 'inscription') {
        $homeController->inscription();
    } elseif ($view == 'connexion') {
        $homeController->connexion();
    }
} elseif ($controller == 'items') {
    $ForumController = new \Controller\ForumController();
    if ($view == 'forum') {
        $ForumController-> Forum();
    } elseif ($controller== 'items') {
    $ForumController = new \Controller\ArticleController();    
    if ($view == 'listarticle')
        $ForumController-> ArticleList(); 
    }

} 
