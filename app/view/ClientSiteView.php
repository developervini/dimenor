<?php
use \Slim\Slim as Slim;

function newClientSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('client-site/new.html', array('clients' => ClientController::listClient(), 'sites' => SiteController::listSite(), 'id' => $id, 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = ClientSiteController::newClientSite($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeClientSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = ClientSiteController::activeClientSite($id);
		echo json_encode($response);
	}	
}