<?php


  $routes->get('/hiekkalaatikko', function() {
      KotiLaakariController::sandbox();
  });

$routes->get('/game', function() {
  HelloWorldController::game_list();
});
$routes->get('/game/1', function() {
  HelloWorldController::game_show();
});

$routes->get('/login', function() {
  HelloWorldController::login();
});

$routes->get('/kirjautuminen', function() {
  KotiLaakariController::kirjautuminen();
});

$routes->get('/rekisteroituminen', function() {
  KotiLaakariController::rekisteroituminen();
});


// Pelin lisääminen tietokantaan


$routes->get('/asiakkaan_historia', function() {
  AsiakasController::asiakkaan_historia();
});

$routes->get('/asiakkaat', function() {
  AsiakasController::index();
});

// Pelin lisääminen tietokantaan
$routes->post('/asiakas', function(){
  AsiakasController::store();
});


// Pelin lisäyslomakkeen näyttäminen
$routes->get('/asiakas/new', function(){
    AsiakasController::store();
});


$routes->get('/asiakas/:a_id', function($a_id) {
  AsiakasController::find($a_id);
});









$routes->get('/potilaan_historia_muokkaus', function() {
  KotiLaakariController::potilaanHistoriaMuokkaus();
});
$routes->get('/laakarin_ohjelma', function() {
  KotiLaakariController::laakarinOhjelma();
});
$routes->get('/', function() {
  KotiLaakariController::Etusivu();
});