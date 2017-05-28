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

$app->group('/client', 'auth', function() use ($app){
	$app->get('-list', 'listClient');
	$app->get('-new', 'newClient');
	$app->post('-new', 'newClient');
	$app->get('-edit/:id', 'editClient');
	$app->put('-edit/:id', 'editClient');
	$app->get('-view/:id', 'viewClient');
	$app->delete('-active/:id', 'activeClient');
});

$app->group('/client-site', 'auth', function() use ($app){
	$app->get('-new/:id', 'newClientSite');
	$app->post('-new/:id', 'newClientSite');
	$app->delete('-active/:id', 'activeClientSite');
});

$app->group('/agreed-site', 'auth', function() use ($app){
	$app->get('-new/:id', 'newAgreedSite');
	$app->post('-new/:id', 'newAgreedSite');
	$app->delete('-active/:id', 'activeAgreedSite');
});

$app->group('/agreed', 'auth', function() use ($app){
	$app->get('-list', 'listAgreed');
	$app->get('-new', 'newAgreed');
	$app->post('-new', 'newAgreed');
	$app->get('-edit/:id', 'editAgreed');
	$app->put('-edit/:id', 'editAgreed');
	$app->get('-view/:id', 'viewAgreed');
	$app->delete('-active/:id', 'activeAgreed');
});

$app->group('/bank', 'auth', function() use ($app){
	$app->get('-list', 'listBank');
	$app->get('-new', 'newBank');
	$app->post('-new', 'newBank');
	$app->get('-edit/:id', 'editBank');
	$app->put('-edit/:id', 'editBank');
	$app->get('-view/:id', 'viewBank');
	$app->delete('-active/:id', 'activeBank');
});

$app->group('/coin', 'auth', function() use ($app){
	$app->get('-list', 'listCoin');
	$app->get('-new', 'newCoin');
	$app->post('-new', 'newCoin');
	$app->get('-edit/:id', 'editCoin');
	$app->put('-edit/:id', 'editCoin');
	$app->get('-view/:id', 'viewCoin');
	$app->delete('-active/:id', 'activeCoin');
});

$app->group('/sale', 'auth', function() use ($app){
	$app->get('-list', 'listSale');
	$app->get('-new', 'newSale');
	$app->post('-new', 'newSale');
	$app->get('-edit/:id', 'editSale');
	$app->put('-edit/:id', 'editSale');
	$app->get('-view/:id', 'viewSale');
	$app->delete('-active/:id', 'activeSale');
});