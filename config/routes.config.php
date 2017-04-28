<?php

$app->get('/', function() use ($app){
	$app->redirect('/login');
});
$app->get('/login', 'loginUser');
$app->post('/login', 'loginUser');
$app->get('/logout', 'logoutUser');

$app->get('/dashboard', 'auth', 'listUser');

$app->group('/user', 'auth', function() use ($app){
	$app->get('-list', 'listUser');
	$app->get('-new', 'newUser');
	$app->post('-new', 'newUser');
	$app->get('-edit/:id', 'editUser');
	$app->put('-edit/:id', 'editUser');
	$app->get('-view/:id', 'viewUser');
	$app->delete('-active/:id', 'activeUser');
});

$app->group('/site', 'auth', function() use ($app){
	$app->get('-list', 'listSite');
	$app->get('-new', 'newSite');
	$app->post('-new', 'newSite');
	$app->get('-edit/:id', 'editSite');
	$app->put('-edit/:id', 'editSite');
	$app->get('-view/:id', 'viewSite');
	$app->delete('-active/:id', 'activeSite');
});