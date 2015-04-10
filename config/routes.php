
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

$routes->get('/asiakkaat', function() {
  AsiakasController::index();
});
*/
// Pelin lisääminen tietokantaan
$routes->post('/asiakas', function(){
  AsiakasController::store();
});


// Pelin lisäyslomakkeen näyttäminen
$routes->get('/asiakas/new', function(){
    AsiakasController::create();
});
 
 
// Pelin lisäyslomakkeen näyttäminen
$routes->get('/asiakas/testi', function(){
    AsiakasController::viestikoe();
});


$routes->get('/asiakas/:a_id', function($a_id) {
  AsiakasController::find($a_id);
});

$routes->get('/asiakas/:a_id/edit', function($a_id){
  // Pelin muokkauslomakkeen esittäminen
  AsiakasController::edit($a_id);
});
$routes->post('/asiakas/:a_id/edit', function($a_id){
  // Pelin muokkaaminen
  AsiakasController::update($a_id);
});

$routes->post('/asiakas/:a_id/destroy', function($a_id){
  // Pelin poisto

AsiakasController::destroy($a_id);
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

