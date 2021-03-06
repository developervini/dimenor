<?php
use \Slim\Slim as Slim;

function listBank()
{
	$app = Slim::getInstance();
	$app->render('bank/list.html', array('banks' => BankController::listBank(), 'totalSale' => PortionSaleController::getTotalPortionSaleTotal(), 'totalPurchase' => PortionPurchaseController::getTotalPortionPurchaseTotal(), 'totalOutlay' => OutlayController::getTotalOutlay(), 'user_logged' => $_SESSION['user_logged']));
}

function viewBank($id = int)
{
	$app = Slim::getInstance();
	$app->render('bank/view.html', array('bank' => BankController::findBank($id), 'sales' => PortionSaleController::listPortionSaleBank($id), 'purchases' => PortionPurchaseController::listPortionPurchaseBank($id), 'outlays' => OutlayController::listOutlayBank($id), 'totalSale' => PortionSaleController::getTotalPortionSaleBank($id), 'totalPurchase' => PortionPurchaseController::getTotalPortionPurchaseBank($id), 'totalOutlay' => OutlayController::getTotalOutlayBank($id), 'user_logged' => $_SESSION['user_logged']));
}

function newBank()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('bank/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = BankController::newBank($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function editBank($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('bank/edit.html', array('bank' => BankController::findBank($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = BankController::editBank($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function activeBank($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = BankController::activeBank($id);
		echo json_encode($response);
	}
}
