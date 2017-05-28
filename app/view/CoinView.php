<?php
use \Slim\Slim as Slim;

function listCoin()
{
	$app = Slim::getInstance();
	$app->render('coin/list.html', array('coins' => CoinController::listCoin(), 'user_logged' => $_SESSION['user_logged']));
}

function viewCoin($id = int)
{
	$app = Slim::getInstance();
	$app->render('coin/view.html', array('coin' => CoinController::findCoin($id), 'user_logged' => $_SESSION['user_logged']));
}

function newCoin()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('coin/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = CoinController::newCoin($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editCoin($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('coin/edit.html', array('coin' => CoinController::findCoin($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = CoinController::editCoin($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeCoin($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = CoinController::activeCoin($id);
		echo json_encode($response);
	}	
}