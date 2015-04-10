<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   
        
// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	//  View::make('home.html');
    echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
  
        
            
        $kipee = new Asiakas(array(
            'a_etunimi' => 'aaa',
            'a_sukunimi' => 'aaa'));
        $errors = $kipee -> errors();
        kint::dump($errors);
    }
            
            
            
        /*    
            ));
        $errors = $kipee-> validate_a_etunimi();
        if(count($errors)>0){
          //  echo 'asiakas on virheellinen';
      echo $errors[0];
      */ 
      

// Testaa koodiasi täällä
      
      //  echo 'Hello World!';
   //View::make('helloworld.html');
    

  public static function game_list(){
    View::make('suunnitelmat/game_list.html');
  }

  public static function game_show(){
    View::make('suunnitelmat/game_show.html');
  }

  public static function login(){
    View::make('suunnitelmat/login.html');
  }
  
  
}
  
