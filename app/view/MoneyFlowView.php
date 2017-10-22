<?php
use \Slim\Slim as Slim;

function newMoneyFlow()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$response = MoneyFlowController::newMoneyFlow($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}