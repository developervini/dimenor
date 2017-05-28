<?php
use \Slim\Slim as Slim;

function newAgreedSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('agreed-site/new.html', array('agreeds' => AgreedController::listAgreed(), 'sites' => SiteController::listSite(), 'id' => $id, 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = AgreedSiteController::newAgreedSite($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeAgreedSite($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = AgreedSiteController::activeAgreedSite($id);
		echo json_encode($response);
	}	
}