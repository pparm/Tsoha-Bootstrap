
<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
/*
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


 * 
 *  */


$routes->get('/asiakas/login', function() {
    // Kirjautumislomakkeen esittäminen
    
    AsiakasController::login();
});
$routes->post('/asiakas/login', function() {
    // Kirjautumisen käsittely
   // Kint::dump($_POST);
  AsiakasController::handle_login();
});



$routes->get('/', function() {
    NakymaController::etusivu();
});
$routes->get('/asiakkaat', function() {
    AsiakasController::index();
});

// Asiakkaan lisääminen tietokantaan
$routes->post('/asiakas', function() {
     $params = $_POST;
 //Kint::dump($params);
AsiakasController::store();
});


// Asiakkaan lisäyslomakkeen näyttäminen
$routes->get('/asiakas/new', function() {

    AsiakasController::create();
});

$routes->get('/asiakas/:a_id', function($a_id) {
    AsiakasController::find($a_id);
});


$routes->get('/asiakas/edit/:a_id', function($a_id) {
    // Asiakkaan muokkauslomakkeen esittäminen
    //Kint::dump($a_id);
    // Kint::dump($_SESSION);  
    AsiakasController::edit($a_id);
});





//Asiakkaan muokkaaminen tietokannassa
$routes->post('/asiakas/edit/:a_id', function($a_id) {



    AsiakasController::update($a_id);
});





$routes->get('/asiakas/edit/:a_id', function($a_id) {
    // Asiakkaan muokkauslomakkeen esittäminen
    //Kint::dump($a_id);
    // Kint::dump($_SESSION);  
    AsiakasController::edit($a_id);
});


$routes->post('/asiakas/:a_id/destroy', function($a_id) {
    // Asiakkaan poisto

    AsiakasController::destroy($a_id);
});


$routes->get('/laakari/new', function() {

    LaakariController::create();
});



$routes->get('/laakarit', function() {
    LaakariController::index();
});
$routes->get('/laakari/login', function() {
    // Kirjautumislomakkeen esittäminen
    LaakariController::login();
});
$routes->post('/laakari/login', function() {
    // Kirjautumisen käsittely
    LaakariController::handle_login();
});

$routes->get('/laakari/kaynti_lisaa', function() {
  echo 'haloo';
  LaakariController::kaynti_lisaa();
});



$routes->get('/laakari/:l_id', function($l_id) {
//  Kint::dump($l_id);
    LaakariController::find($l_id);
});




$routes->post('/laakari', function() {
    LaakariController::store();
});

$routes->post('/laakari/:l_id/destroy', function($l_id) {
    // Lääkärin poisto

    LaakariController::destroy($l_id);
});



$routes->post('/laakari/logout', function() {
    LaakariController::logout();
});







/*
$routes->get('/asiakas/tiedot', function($a_id) {
  AsiakasController::find($a_id);
});

*/

/*




$routes->get('/potilaan_historia_muokkaus', function() {
  KotiLaakariController::potilaanHistoriaMuokkaus();
});
$routes->get('/laakarin_ohjelma', function() {
  KotiLaakariController::laakarinOhjelma();
});
$routes->get('/', function() {
  KotiLaakariController::Etusivu();
});
 */

