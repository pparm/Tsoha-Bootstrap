<?php

class LaakariController extends BaseController{
    public static function login(){
        View::make('laakari/login.html');
    }
    
    
    
      public static function find($l_id) {
        $laakari = Laakari::find($l_id);
        View::make('laakari/show.html', array('laakari' => $laakari));
    }
    
        public static function index() {
        
            $laakarit = Laakari::all();
      // Kint::dump($laakarit);
        View::make('laakarit', array('laakarit' => $laakarit));
    }
    
    
    
    public static function handle_login(){
    
        $params = $_POST;
      
        $laakari = Laakari::authenticate($params['l_id'],$params['l_salasana']);
        if(!$laakari){
           View::make('laakari/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'l_id' => $params['l_id']));
           
       }
       $_SESSION['laakari'] = $laakari->l_id; 
       // Kint::dump($_SESSION);
    //   echo $_SESSION['laakari'];
      // Redirect::to('/asiakaat', array('message' => 'Tervetuloa takaisin     '.$laakari->l_etunimi.'!'));
        Redirect::to('/asiakkaat',array('message'=>'Tervetuloa takaisin'.' '.$laakari->l_etunimi.' '.$laakari->l_sukunimi.'!'));
       }
       
   
       public static function create() {
        View::make('laakari/new.html');
    }

       
       
            public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla


        $attributes = array(
            'l_etunimi' => $params['l_etunimi'],
            'l_sukunimi' => $params['l_sukunimi'],
           'l_osoite' => $params['l_osoite'],
          'l_puhelinnumero' => $params['l_puhelinnumero'],
           'l_sahkoposti' => $params['l_sahkoposti'],
           'l_salasana' => $params['l_salasana']
        );
        $laakari = new Laakari($attributes);
      $errors = $laakari -> errors();

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
     //   Kint::dump($errors);
      //  Kint::dump($asiakas);
        
        
        if (count($errors) == 0) {
            $laakari->save();
        Redirect::to('/laakari/' . $laakari->l_id, array('message' => 'Lääkäri on lisätty kirjastoosi!'));
        } 
       
        else {
        // kint::dump($errors);
            
      View::make('laakari/new.html', array('errors' => $errors, 'attributes' => $attributes));
        
    }
     }
         //  Pelin poistaminen
    public static function destroy($l_id){
        //Alustetaan Asiakas-olio annetulla l_id:llä.
          

        
        $laakari = new Laakari(array('l_id'=>$l_id));

//Kutsutaan Asiakas-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $laakari->destroy($l_id);
    
        // Ohjataan käyttäjä pelien listaussivulle ilmpituksen kera
        Redirect::to('/laakarit',array('message'=>'Lääkäri on poistettu onnistuneesti!'));
        
    }
  
    public static function kaynti_lisaa(){
   // $_SESSION['laakari'] = null;
        //, array('errors' => $errors, 'attributes' => $attributes)
         $laakarit = Laakari::all();
   
          Kint::dump($laakarit);
   
//   View::make('laakari/kaynti_lisaa.html)
   //     View::make('laakari/kaynti.html',array('laakarit' => $laakarit));
        
    }
   
    
   /* public static function logout(){
    $_SESSION['laakari'] = null;
    Redirect::to('/laakari/login', array('message' => 'Olet kirjautunut ulos!'));
  }
    * */
    public static function logout(){
    $_SESSION['laakari'] = null;
    Redirect::to('/laakari/login', array('message' => 'Olet kirjautunut ulos!'));
  }
    
    
     
     
       
       
}
    
    
    
    
    
    
    
    
    
    
   
