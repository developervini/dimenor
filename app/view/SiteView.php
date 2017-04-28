<?php
use \Slim\Slim as Slim;

function listSite()
{
	$app = Slim::getInstance();
	$app->render('site/list.html', array('sites' => SiteController::listSite(), 'user_logged' => $_SESSION['user_logged']));
}

function viewSite($id = int)
{
	$app = Slim::getInstance();
	$app->render('site/view.html', array('site' => SiteController::findSite($id), 'user_logged' => $_SESSION['user_logged']));
}

function newSite()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('site/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = SiteController::newSite($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('site/edit.html', array('site' => SiteController::findSite($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = SiteController::editSite($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = SiteController::activeSite($id);
		echo json_encode($response);
	}	
}