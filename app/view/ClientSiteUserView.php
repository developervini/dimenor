<?php
use \Slim\Slim as Slim;

function listClientSiteUserJson($id = int, $site = int)
{
	echo ClientSiteUserController::listClientSiteUserJson($id, $site);
}
