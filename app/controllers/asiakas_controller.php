<?php

class AsiakasController extends BaseController {

    public static function login() {
        View::make('asiakas/login.html');
    }

    public static function handle_login() {

        $params = $_POST;
     
        $asiakas = Asiakas::authenticate($params['a_id'], $params['a_salasana']);
        if (!$asiakas) {
            View::make('asiakas/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'a_id' => $params['a_id']));
        } else {
            $_SESSION['asiakas'] = $asiakas->a_id;
        }

        Redirect::to('/asiakas/ohjelma/' . $asiakas->a_id, array('message' => 'Tervetuloa takaisin' . ' ' . $asiakas->a_etunimi . ' ' . $asiakas->a_sukunimi . '!'));
    }

    public static function logout() {
        $_SESSION['asiakas'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function find($a_id) {

          self::check_asiakas_or_laakari_logged_in(); 
        $asiakas = Asiakas::find($a_id);

        View::make('asiakas/show.html', array('asiakas' => $asiakas));
    }

    public static function index() {
          self::check_asiakas_or_laakari_logged_in(); 
        
        $asiakkaat = Asiakas::all();
        View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
    }

    public static function create() {
        View::make('asiakas/new.html');
    }

    public static function edit($a_id) {

         self::check_asiakas_or_laakari_logged_in();
        $asiakas = Asiakas::find($a_id);
        View::make('asiakas/edit.html', array('attributes' => $asiakas, 'message' => 'Tarkistaisitko ystävällisesti tietosi'));
    }

    //Asiakkaan muokkaaminen (lomakkeen käsittely)

    public static function update($a_id) {
          self::check_asiakas_or_laakari_logged_in();
        $params = $_POST;
        $attributes = array(
            'a_id' => $a_id,
            'a_etunimi' => $params['a_etunimi'],
            'a_sukunimi' => $params['a_sukunimi'],
            'a_osoite' => $params['a_osoite'],
            'a_puhelinnumero' => $params['a_puhelinnumero'],
            'a_sahkoposti' => $params['a_sahkoposti']
        );

        $asiakas = new Asiakas($attributes);
        $errors = $asiakas->errors();

        if (count($errors) > 0) {
            View::make('asiakas/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $asiakas->update();
            Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakasta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($a_id) {
        self::check_asiakas_or_laakari_logged_in();
   
        $asiakas = new Asiakas(array('a_id' => $a_id));
        $asiakas->destroy($a_id);
        Redirect::to('/asiakkaat', array('message' => 'Asiakas on poistettu onnistuneesti!'));
    }

    public static function store() {
             $params = $_POST;
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
            $asiakas->save();
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

    public static function tilaus() {
          self::check_asiakas_or_laakari_logged_in(); 
        $asiakas = Asiakas::find($_SESSION['asiakas']);
        $laakarit = Laakari::all();
        View::make('asiakas/tilaus.html', array('laakarit' => $laakarit, 'asiakas' => $asiakas));
    }

    public static function tilaus_tallenna() {
        self::check_asiakas_or_laakari_logged_in(); 
        $params = $_POST;
        $session = $_SESSION;
        $attributes = array('l_id' => $params['laakari'], 'a_id' => $session['asiakas'], 'k_oire' => $params['k_oire']);
        $asiakas = new Asiakas($attributes);
        $asiakas->tilaus_tallenna();
        Redirect::to('/asiakas/ohjelma/' . $asiakas->a_id, array('message' => 'Tilaus lisätty!'));

}

    public static function ohjelma($a_id) {
        self::check_asiakas_or_laakari_logged_in(); 
        $ohjelma = Kaynti::asiakkaan_ohjelma($a_id);
        $asiakas = Asiakas::find($a_id);
        View::make('asiakas/show.html', array('asiakas' => $asiakas, 'ohjelma' => $ohjelma));
 }

}
