<?php
use \Slim\Slim as Slim;

function listPlan()
{
	$app = Slim::getInstance();
	$app->render('plan/list.html', array('plans' => PlanController::listPlan(), 'user_logged' => $_SESSION['user_logged']));
}

function viewPlan($id = int)
{
	$app = Slim::getInstance();
	$app->render('plan/view.html', array('plan' => PlanController::findPlan($id), 'user_logged' => $_SESSION['user_logged']));
}

function newPlan()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('plan/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = PlanController::newPlan($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editPlan($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('plan/edit.html', array('plan' => PlanController::findPlan($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = PlanController::editPlan($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activePlan($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = PlanController::activePlan($id);
		echo json_encode($response);
	}	
}