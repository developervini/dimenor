<?php
use \Slim\Slim as Slim;

function newChipFlow()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$response = ChipFlowController::newChipFlow($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}
}