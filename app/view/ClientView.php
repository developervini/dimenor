<?php
use \Slim\Slim as Slim;

function listClient()
{
	$app = Slim::getInstance();
	$app->render('client/list.html', array('clients' => ClientController::listClient(), 'user_logged' => $_SESSION['user_logged']));
}

function viewClient($id = int)
{
	$app = Slim::getInstance();
	
	$app->render('client/view.html', array('client' => ClientController::findClient($id),
												'sites' => ClientSiteController::listClientSite($id),
													'users_sites' => ClientSiteUserController::listClientSiteUser($id),
														'sales' => SaleController::listSaleClient($id),
															'purchases' => PurchaseController::listPurchaseClient($id),
																'totalSale' => SaleController::getTotalSaleClient($id),
																	'totalPurchase' => PurchaseController::getTotalPurchaseClient($id),
																		'chipSale' => SaleController::chipSaleClient($id),
																			'chipPurchase' => PurchaseController::chipPurchaseClient($id),
																				'clients' => ClientController::listClient(),
																					'chipFlows' => ChipFlowController::listChipFlow($id),
																						'moneyFlows' => MoneyFlowController::listMoneyFlow($id),
																							'banks' => BankController::listBank(),
																								'user_logged' => $_SESSION['user_logged']));
}

function newClient()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('client/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = ClientController::newClient($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function editClient($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('client/edit.html', array('client' => ClientController::findClient($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = ClientController::editClient($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}

function activeClient($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = ClientController::activeClient($id);
		echo json_encode($response);
	}
}
