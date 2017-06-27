<?php
use \Slim\Slim as Slim;

function listOutlay()
{
	$app = Slim::getInstance();
	$app->render('outlay/list.html', array('outlays' => OutlayController::listOutlay(), 'user_logged' => $_SESSION['user_logged']));
}

function viewOutlay($id = int)
{
	$app = Slim::getInstance();
	$app->render('outlay/view.html', array('outlay' => OutlayController::findOutlay($id), 'user_logged' => $_SESSION['user_logged']));
}

function newOutlay()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('outlay/new.html', array('plans' => PlanController::listPlan(), 'banks' => BankController::listBank(), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = OutlayController::newOutlay($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editOutlay($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('outlay/edit.html', array('outlay' => OutlayController::findOutlay($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = OutlayController::editOutlay($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeOutlay($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = OutlayController::activeOutlay($id);
		echo json_encode($response);
	}	
}