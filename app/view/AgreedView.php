<?php
use \Slim\Slim as Slim;

function listAgreed()
{
	$app = Slim::getInstance();
	$app->render('agreed/list.html', array('agreeds' => AgreedController::listAgreed(), 'user_logged' => $_SESSION['user_logged']));
}

function viewAgreed($id = int)
{
	$app = Slim::getInstance();
	$app->render('agreed/view.html', array('agreed' => AgreedController::findAgreed($id), 'sites' => AgreedSiteController::listAgreedSite($id), 'sales' => SaleController::listSaleAgreed($id),'totalSale' => SaleController::getTotalSaleAgreed($id), 'purchases' => PurchaseController::listPurchaseAgreed($id),'totalPurchase' => PurchaseController::getTotalPurchaseAgreed($id), 'user_logged' => $_SESSION['user_logged']));
}

function newAgreed()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('agreed/new.html', array('coins' => CoinController::listCoin(), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = AgreedController::newAgreed($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function editAgreed($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('agreed/edit.html', array('agreed' => AgreedController::findAgreed($id), 'coins' => CoinController::listCoin(), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = AgreedController::editAgreed($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function activeAgreed($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = AgreedController::activeAgreed($id);
		echo json_encode($response);
	}
}
