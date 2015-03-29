<?php

class AsiakasController extends BaseController{
 
    
    
    public static function find($a_id){
     $asiakas = Asiakas::find($a_id);
   //View::make('kotilaakari/asiakas/index.html',array('asiakas'=>$asiakas));
   Kint::dump($asiakas); 
              
              
              
            }
  public static function index(){
   $asiakkaat = Asiakas::all();
  View::make('kotilaakari/asiakkaat/index.html',array('asiakkaat'=> $asiakkaat));
            }
 
    
 public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
    $asiakas = new Asiakas(array(
      'a_etunimi' => $params['a_etunimi'],
      'a_sukunimi' => $params['a_sukunimi'],
      'a_osoite' => $params['a_osoite'],
      'a_puhelinnumero' => $params['a_puhelinnumero'],
      'a_sahkoposti' => $params['a_sahkoposti']
    ));
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    
   Kint::dump($params);
   $asiakas->save();
      // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    //Redirect::to('/laakariasema/asiakas/' . $asiakas->id, array('message' => 'Peli on lisätty kirjastoosi!'));
  //}
    
    
 }
}

 
 /*
  public static function store(){

      $params = $_POST;
      $asiakas = new Asiakas(array('a_etunimi'=>$params['a_etunimi'], 'a_sukunimi'=>$params['a_sukkunimi'],'a_osoite'=> $params['a_osoite'],'a_puhelinnumero'=>$params['a_puhelinnumero]','a_sahkoposti'=>$params['a_sahkoposti']));
      $asiakas-->save();
      
      
  }
   */
            
   