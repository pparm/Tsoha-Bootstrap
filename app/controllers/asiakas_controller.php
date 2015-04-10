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

   // Asiakkaan muokkaaminen (lomakkeeen esittäminen
    public static function edit($a_id){
        $asiakas = Asiakas::find($a_id);
          View::make('asiakas/edit.html',array('attributes'=>$asiakas)) ;     
        
    }
    //Pelin muokkaaminen (lomakkeen käsittely)
    
    public static function update($a_id){
        $params = $_POST;
        $attributes = array(
            'a_id' => $a_id,
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
           'a_osoite' => $params['a_osoite'],
          'a_puhelinnumero' => $params['a_puhelinnumero'],
           'a_sahkoposti' => $params['a_sahkoposti']
        );
        //Alustetaan Asiakas-olio käyttäjän syöttämillä tiedoilla
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();
        if(count($errors)>0){
            View::make('asiakas/edit.html',array('errors'=>$errors, 'attributes'=>attributes));
        }else {
             //Lutsutaan alustetun metodin olion update-metodia, joka päivittää pelin tiedot tietokannassa
             $asiakas->update();
             Redirect::to('/asiakas/'. $asiakas->a_id,array('message' => 'Asiakasta on muokattu onnistuneesti!'));
             }   
        }
        

    //  Pelin poistaminen
    public static function destroy($a_id){
        //Alustetaan Asiakas-olio annetulla a_id:llä.
          

        
        $asiakas = new Asiakas(array('a_id'=>$a_id));

//Kutsutaan Asiakas-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $asiakas->destroy($a_id);
    
        // Ohjataan käyttäjä pelien listaussivulle ilmpituksen kera
       // Redirect::to('/asiakas',array('message'=>'Asiakas on poistettu onnistuneesti!'));
        
    }
    
    
     public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla


        $attributes = array(
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
           'a_osoite' => $params['a_osoite'],
          'a_puhelinnumero' => $params['a_puhelinnumero'],
           'a_sahkoposti' => $params['a_sahkoposti']
        );
        $asiakas = new Asiakas($attributes);
      $errors = $asiakas -> errors();

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        //Kint::dump($errors);
      //  Kint::dump($asiakas);
        
        
        if (count($errors) == 0) {
            $asiakas->save();
         Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty kirjastoosi!'));
        } 
       
        else {
        // kint::dump($errors);
            
      View::make('asiakas/new.html', array('errors' => $errors, 'attributes' => $attributes));
        
    }
     }
    
    /*
      public static function store(){

      $params = $_POST;
      $asiakas = new Asiakas(array('a_etunimi'=>$params['a_etunimi'], 'a_sukunimi'=>$params['a_sukkunimi'],'a_osoite'=> $params['a_osoite'],'a_puhelinnumero'=>$params['a_puhelinnumero]','a_sahkoposti'=>$params['a_sahkoposti']));
      $asiakas-->save();


      }
     */

}