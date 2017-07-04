<?php
use \Slim\Slim as Slim;

function listSale()
{
	$app = Slim::getInstance();
	$app->render('sale/list.html', array('sales' => SaleController::listSale(), 'user_logged' => $_SESSION['user_logged']));
}

function viewSale($id = int)
{
	$app = Slim::getInstance();
	$app->render('sale/view.html', array('sale' => SaleController::findSale($id), 'user_logged' => $_SESSION['user_logged']));
}

function newSale()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('sale/new.html', array('clients' => ClientController::listClient(), 'banks' => BankController::listBank(), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = SaleController::newSale($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editSale($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('sale/edit.html', array('clients' => ClientController::listClient(), 'banks' => BankController::listBank(), 'sale' => SaleController::findSale($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = SaleController::editSale($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeSale($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = SaleController::activeSale($id);
		echo json_encode($response);
	}	
}

function statusSale($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isPut()) {
		$response = SaleController::statusSale($id);
		echo json_encode($response);
	}	
}