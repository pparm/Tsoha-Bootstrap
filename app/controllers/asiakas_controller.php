<?php

class AsiakasController extends BaseController {

    public static function find($a_id) {
        $asiakas = Asiakas::find($a_id);
        View::make('asiakas/show.html', array('asiakas' => $asiakas));
        //Kint::dump($asiakas); 
    }

    public static function index() {
        $asiakkaat = Asiakas::all();
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
    }

    public static function create() {
        View::make('asiakas/new.html');
    }

    public static function xtore() {
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
        //Kint::dump($params);
        $asiakas->save();
        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty kirjastoosi!'));
    }

    public static function xxstore() {
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
        //Kint::dump($params);

        if ($params['a_etunimi'] != '' && strlen($params['a_etunimi']) >= 3) {
            $asiakas->save();
            Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty kirjastoosi!'));
        } else {
            View::make('asiakas/new.html', array('error' => 'Nimessä oli virhe!'));
        }
    }
    public static function store() {
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
        //Kint::dump($params);
        
        
        if ($params['a_etunimi'] != '' && strlen($params['a_etunimi']) >= 3) {
            $asiakas->save();
            Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty kirjastoosi!'));
        } else {
            View::make('asiakas/new.html', array('error' => 'Nimessä oli virhe!'));
        }
    }
    
   /*
    *  public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla


        $attributes = array(
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
           // 'a_osoite' => $params['a_osoite'],
          //  'a_puhelinnumero' => $params['a_puhelinnumero'],
          //  'a_sahkoposti' => $params['a_sahkoposti']
        );
        $asiakas = new Asiakas($attributes);
       // $errors = $game -> errors();
        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        //Kint::dump($params);
        
        
       // if (count($errors) == 0) {
            $asiakas->save();
            Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty kirjastoosi!'));
      //  } 
       
     //   else {
      //      View::make('asiakas/new.html', array('error' => $errors, 'attributes' => $attributes));
       // }
    }

    */
    
    /*
      public static function store(){

      $params = $_POST;
      $asiakas = new Asiakas(array('a_etunimi'=>$params['a_etunimi'], 'a_sukunimi'=>$params['a_sukkunimi'],'a_osoite'=> $params['a_osoite'],'a_puhelinnumero'=>$params['a_puhelinnumero]','a_sahkoposti'=>$params['a_sahkoposti']));
      $asiakas-->save();


      }
     */

}