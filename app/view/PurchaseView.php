<?php
use \Slim\Slim as Slim;

function listPurchase($active = int)
{
	$app = Slim::getInstance();
	$app->render('purchase/list.html', array('purchases' => PurchaseController::listPurchase($active), 'user_logged' => $_SESSION['user_logged']));
}

function viewPurchase($id = int)
{
	$app = Slim::getInstance();
	$app->render('purchase/view.html', array('purchase' => PurchaseController::findPurchase($id), 'user_logged' => $_SESSION['user_logged']));
}

function newPurchase()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('purchase/new.html', array('clients' => ClientController::listClient(), 'banks' => BankController::listBank(), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = PurchaseController::newPurchase($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function editPurchase($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('purchase/edit.html', array('clients' => ClientController::listClient(), 'banks' => BankController::listBank(), 'purchase' => PurchaseController::findPurchase($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = PurchaseController::editPurchase($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function activePurchase($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = PurchaseController::activePurchase($id);
		echo json_encode($response);
	}
}

function statusPurchase($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isPut()) {
		$response = PurchaseController::statusPurchase($id);
		echo json_encode($response);
	}
}
