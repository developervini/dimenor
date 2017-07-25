<?php
use \Slim\Slim as Slim;

function dashboard()
{
	$app = Slim::getInstance();
	$app->render('app/dashboard.html', array('sales' => SaleController::listSaleChartLine(), 'purchases' => PurchaseController::listPurchaseChartLine(), 'user_logged' => $_SESSION['user_logged']));
}
