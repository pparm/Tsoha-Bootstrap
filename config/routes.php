
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


$routes->get('/kaynti/muokkaus/:k_id', function($k_id) {
 KayntiController::kayntimuokkaa($k_id);
});

$routes->post('/kaynti/muokkaus/', function() {
Kint::dump($_SESSION);
Kint::dump($_POST);
KayntiController::kayntimuokkaa_tallenna();

 
 
});




$routes->get('/kaynti/:k_id', function($k_id) {
 KayntiController::kaynti($k_id);
});

$routes->post('/kaynti/k:id', function($k_id) {
//Kint::dump($_SESSION);
//Kint::dump($_POST);
AsiakasController::kaynti_tallenna(k_id);

 
 
});

$routes->post('/kaynti/:k_id/destroy', function($k_id) {
 KayntiController::destroy($k_id);
});









$routes->get('/asiakas/tilaus', function() {
 AsiakasController::tilaus();
});

$routes->post('/asiakas/tilaus', function() {
//Kint::dump($_SESSION);
//Kint::dump($_POST);
AsiakasController::tilaus_tallenna();

 
 
});

$routes->get('/asiakas/login', function() {
    // Kirjautumislomakkeen esittäminen
    
    AsiakasController::login();
});
$routes->post('/asiakas/login', function() {
    // Kirjautumisen käsittely
  AsiakasController::handle_login();
});



$routes->get('/', function() {
    NakymaController::etusivu();
});
$routes->get('/asiakkaat', function() {
    AsiakasController::index();
});

$routes->post('/logout', function(){
    SessioController::logout();
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

$routes->get('/asiakas/ohjelma/:a_id', function($a_id) {
//  Kint::dump($l_id);
  AsiakasController::ohjelma($a_id);
});



$routes->get('/asiakas/edit/:a_id', function($a_id) {
    // Asiakkaan muokkauslomakkeen esittäminen
    Kint::dump($a_id);
     Kint::dump($_SESSION);  
     Kint::dump($_POST);  
    AsiakasController::edit($a_id);
});





//Asiakkaan muokkaaminen tietokannassa
$routes->post('/asiakas/edit/:a_id', function($a_id) {


//   Kint::dump($_SESSION);  

    AsiakasController::update($a_id);
});



/*

$routes->get('/asiakas/edit/:a_id', function($a_id) {
    // Asiakkaan muokkauslomakkeen esittäminen
    //Kint::dump($a_id);
    // Kint::dump($_SESSION);  
    AsiakasController::edit($a_id);
});

*/
$routes->post('/asiakas/:a_id/destroy', function($a_id) {
    // Asiakkaan poisto

    AsiakasController::destroy($a_id);
});





$routes->get('/laakari/ohjelma/:l_id', function($l_id) {
//  Kint::dump($l_id);
  LaakariController::ohjelma($l_id);
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

