<?php

  class KotiLaakariController extends BaseController{

     public static function sandbox(){
    $asiakkaat = Asiakas::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($asiakkaat);
    $asiakas = Asiakas::find(1);
    Kint::dump($asiakas);
    
     }
      
      
      
      public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	//  View::make('home.html');
    echo 'Tämä on etusivu!';
        
        
    }

    public static function kirjautuminen(){
      // Testaa koodiasi täällä
     // echo 'Hello World!';
   View::make('kotilaakari/kirjautuminen.html');
    }
        public static function rekisteroituminen(){
   View::make('kotilaakari/rekisteroituminen.html');
    }
    
  
  
          public static function potilaanHistoriaMuokkaus(){
  
              View::make('kotilaakari/potilaan_historia_muokkaus.html');
    }
    
          public static function LaakarinOhjelma(){
  
              View::make('kotilaakari/laakarin_ohjelma.html');
    }
  
          public static function Etusivu(){
  
              View::make('kotilaakari/etusivu.html');
    }
  }
    
    
    
