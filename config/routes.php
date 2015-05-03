
<?php

$routes->get('/kaynti/muokkaus/:k_id', function($k_id) {
    KayntiController::kayntimuokkaa($k_id);
});

$routes->post('/kaynti/muokkaus/', function() {
    KayntiController::kayntimuokkaa_tallenna();
});

$routes->get('/kaynti/:k_id', function($k_id) {
    KayntiController::kaynti($k_id);
});

$routes->post('/kaynti/', function() {
    KayntiController::kaynti_tallenna();
});

$routes->post('/kaynti/:k_id/destroy', function($k_id) {
    KayntiController::destroy($k_id);
});



$routes->get('/asiakas/tilaus', function() {
    AsiakasController::tilaus();
});

$routes->post('/asiakas/tilaus', function() {
    AsiakasController::tilaus_tallenna();
});

$routes->get('/asiakas/login', function() {
    AsiakasController::login();
});
$routes->post('/asiakas/login', function() {
    AsiakasController::handle_login();
});
$routes->get('/', function() {
    NakymaController::etusivu();
});
$routes->get('/asiakkaat', function() {
    AsiakasController::index();
});

$routes->post('/logout', function() {
    SessioController::logout();
});
$routes->post('/asiakas', function() {
    $params = $_POST;
    AsiakasController::store();
});
$routes->get('/asiakas/new', function() {
    AsiakasController::create();
});

$routes->get('/asiakas/:a_id', function($a_id) {
    AsiakasController::find($a_id);
});

$routes->get('/asiakas/ohjelma/:a_id', function($a_id) {
    AsiakasController::ohjelma($a_id);
});
$routes->get('/asiakas/edit/:a_id', function($a_id) {
    AsiakasController::edit($a_id);
});
$routes->post('/asiakas/edit/:a_id', function($a_id) {
    AsiakasController::update($a_id);
});
$routes->post('/asiakas/:a_id/destroy', function($a_id) {
    AsiakasController::destroy($a_id);
});





$routes->get('/laakari/ohjelma/:l_id', function($l_id) {
    LaakariController::ohjelma($l_id);
});

$routes->get('/laakari/new', function() {
    LaakariController::create();
});
$routes->get('/laakarit', function() {
    LaakariController::index();
});
$routes->get('/laakari/login', function() {
    LaakariController::login();
});
$routes->post('/laakari/login', function() {
    LaakariController::handle_login();
});

$routes->get('/laakari/etusivu', function() {
    LaakariController::etusivu();
});
$routes->get('/laakari/:l_id', function($l_id) {
    LaakariController::find($l_id);
});
$routes->post('/laakari', function() {
    LaakariController::store();
});

$routes->post('/laakari/:l_id/destroy', function($l_id) {
    LaakariController::destroy($l_id);
});
$routes->post('/laakari/logout', function() {
    LaakariController::logout();
});
