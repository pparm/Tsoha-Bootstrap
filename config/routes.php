<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
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

$routes->get('/potilaan_historia', function() {
  KotiLaakariController::potilaanHistoria();
});
$routes->get('/potilaan_historia_muokkaus', function() {
  KotiLaakariController::potilaanHistoriaMuokkaus();
});
$routes->get('/laakarin_ohjelma', function() {
  KotiLaakariController::laakarinOhjelma();
});