<?php

class AsiakasController extends BaseController {

    public static function login() {
        View::make('asiakas/login.html');
    }

    public static function handle_login() {

        $params = $_POST;
      //  Kint::dump($params);
        
        $asiakas = Asiakas::authenticate($params['a_id'], $params['a_salasana']);
       // Kint::dump($asiakas);
        if (!$asiakas) {
            View::make('asiakas/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'a_id' => $params['a_id']));
        } else {
            $_SESSION['asiakas'] = $asiakas->a_id;
        }

       // Kint::dump($_SESSION);
       //  Redirect::to('/asiakas/edit/'. $asiakas->a_id);
        Redirect::to('/asiakas/ohjelma/'.$asiakas->a_id,array('message'=>'Tervetuloa takaisin'.' '.$asiakas->a_etunimi.' '.$asiakas->a_sukunimi.'!'));
   
        }
      

    public static function logout() {
        $_SESSION['asiakas'] = null;
       Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function find($a_id) {

    //   self::check_asiakas_or_laakari_logged_in(); 
        $asiakas = Asiakas::find($a_id);

        View::make('asiakas/show.html', array('asiakas' => $asiakas));
        //Kint::dump($asiakas); 
    }

    public static function index() {
       $asiakkaat = Asiakas::all();
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
    }

    public static function create() {
     //   self::check_asiakas_or_laakari_logged_in();
        View::make('asiakas/new.html');
    }

    // Asiakkaan muokkaaminen (lomakkeeen esittäminen
    public static function edit($a_id) {
        
      //  self::check_asiakas_or_laakari_logged_in();
       Kint::dump($_SESSION);
        $asiakas = Asiakas::find($a_id);
        View::make('asiakas/edit.html', array('attributes' => $asiakas,'message' => 'Tarkistaisitko ystävällisesti tietosi'));
    }

    //Asiakkaan muokkaaminen (lomakkeen käsittely)

    public static function update($a_id) {
        //  Kint::dump($a_id)i;
    //  self::check_asiakas_or_laakari_logged_in();
        $params = $_POST;
        Kint::dump($params);
     //  Kint::dump($_POST);
        $attributes = array(
            'a_id' => $a_id,
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
            'a_osoite' => $params['a_osoite'],
            'a_puhelinnumero' => $params['a_puhelinnumero'],
            'a_sahkoposti' => $params['a_sahkoposti']
        );

        //Kint::dump($params);
        //Alustetaan Asiakas-olio käyttäjän syöttämillä tiedoilla
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();

        if (count($errors) > 0) {
            View::make('asiakas/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            //Lutsutaan alustetun metodin olion update-metodia, joka päivittää pelin tiedot tietokannassa
            // 
            $asiakas->update();
         Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakasta on muokattu onnistuneesti!'));
        }
    }

    //  Pelin poistaminen
    public static function destroy($a_id) {
  //    self::check_asiakas_or_laakari_logged_in();
        //Alustetaan Asiakas-olio annetulla a_id:llä.



        $asiakas = new Asiakas(array('a_id' => $a_id));

//Kutsutaan Asiakas-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $asiakas->destroy($a_id);

        // Ohjataan käyttäjä pelien listaussivulle ilmpituksen kera
        Redirect::to('/asiakkaat', array('message' => 'Asiakas on poistettu onnistuneesti!'));
    }

    public static function store() {
       
  //     self::check_asiakas_or_laakari_logged_in();         

//   self::check_logged_in();
// POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        ///Alustetaan uusi Asiakas-luokan olion käyttäjän syöttämillä arvoilla

        
        //Kint::dump($params);
        $attributes = array(
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
            'a_osoite' => $params['a_osoite'],
            'a_puhelinnumero' => $params['a_puhelinnumero'],
            'a_sahkoposti' => $params['a_sahkoposti'],
            'a_salasana' => $params['a_salasana']
        );
        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();


        if (count($errors) == 0) {
            //    Kint::dump($asiakas);
            // echo "validi";
            $asiakas->save();
          //  Kint::dump($asiakas);
            if (isset($_SESSION['asiakas'])) {
                Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakas on lisätty!'));
            } else {
                $str = $asiakas->a_id;

                Redirect::to('/asiakas/login', array('message' => 'Asiakasnumerosi on ! ' . $str));
            }
        } else {
            View::make('asiakas/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
        public static function tilaus(){
           $asiakas = Asiakas::find($_SESSION['asiakas']);
           $laakarit = Laakari::all();
           View::make('asiakas/tilaus.html',array('laakarit' => $laakarit,'asiakas' => $asiakas));
        }        
        public static function tilaus_tallenna(){
                $params = $_POST;
                $session = $_SESSION;
                $attributes = array('l_id'=>$params['laakari'],'a_id' => $session['asiakas'],'k_oire' => $params['k_oire']);
                $asiakas = new Asiakas($attributes);
                $asiakas ->tilaus_tallenna();
         Redirect::to('/asiakas/ohjelma/' . $asiakas->a_id, array('message' => 'Tilaus lisätty!'));
                    
// Kint::dump($attributes);
            
            
            /*     $asiakas = Asiakas::find($_SESSION['asiakas']);
           $laakarit = Laakari::all();
           View::make('asiakas/tilaus.html',array('laakarit' => $laakarit,'asiakas' => $asiakas));
       */ 
       }        
   public static function ohjelma($a_id){
   
$ohjelma = Kaynti::asiakkaan_ohjelma($a_id);
//Kint::dump($ohjelma);
$asiakas = Asiakas::find($a_id);
//Kint::dump($asiakas);
 //  Kint::dump($a_id);
  //Kint::dump($ohjelma);   
 View::make('asiakas/show.html', array('asiakas' => $asiakas,'ohjelma' => $ohjelma));  
     
     
// Kint::dump($ohjelma);
    //    $_SESSION['laakari'] = null;
   // Redirect::to('/laakari/login', array('message' => 'Olet kirjautunut ulos!'));
  }       
    
    
}


