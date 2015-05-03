<?php

class LaakariController extends BaseController {

    public static function login() {
        View::make('laakari/login.html');
    }

    public static function etusivu() {
        View::make('laakari/laakari_etusivu.html');
    }

    public static function find($l_id) {
        self::check_asiakas_or_laakari_logged_in(); 
        $laakari = Laakari::find($l_id);
        View::make('laakari/show.html', array('laakari' => $laakari));
    }

    public static function index() {
        self::check_asiakas_or_laakari_logged_in(); 
        $laakarit = Laakari::all();
        View::make('laakarit', array('laakarit' => $laakarit));
    }

    public static function handle_login() {
        
        $params = $_POST;

        $laakari = Laakari::authenticate($params['l_id'], $params['l_salasana']);
        if (!$laakari) {
            View::make('laakari/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'l_id' => $params['l_id']));
        }
        $_SESSION['laakari'] = $laakari->l_id;
        Redirect::to('/laakari/etusivu');
    }

    public static function create() {
        self::check_logged_in(); 
        View::make('laakari/new.html');
    }

    public static function store() {
       self::check_logged_in(); 
        $params = $_POST;
        $attributes = array(
            'l_etunimi' => $params['l_etunimi'],
            'l_sukunimi' => $params['l_sukunimi'],
            'l_osoite' => $params['l_osoite'],
            'l_puhelinnumero' => $params['l_puhelinnumero'],
            'l_sahkoposti' => $params['l_sahkoposti'],
            'l_salasana' => $params['l_salasana']
        );
        $laakari = new Laakari($attributes);
        $errors = $laakari->errors();

        if (count($errors) == 0) {
            $laakari->save();
            Redirect::to('/laakari/' . $laakari->l_id, array('message' => 'Lääkäri on lisätty!'));
        } else {

            View::make('laakari/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($l_id) {
        self::check_logged_in(); 
        
        $laakari = new Laakari(array('l_id' => $l_id));
        $laakari->destroy($l_id);
        Redirect::to('/laakarit', array('message' => 'Lääkäri on poistettu onnistuneesti!'));
    }
/*
    
    public static function kaynti_lisaa() {
        // $_SESSION['laakari'] = null;
        //, array('errors' => $errors, 'attributes' => $attributes)
        $laakarit = Laakari::all();

        Kint::dump($laakarit);

//   View::make('laakari/kaynti_lisaa.html)
        //     View::make('laakari/kaynti.html',array('laakarit' => $laakarit));
    }
*/

    /* public static function logout(){
      $_SESSION['laakari'] = null;
      Redirect::to('/laakari/login', array('message' => 'Olet kirjautunut ulos!'));
      }
     * */

    
    
    public static function logout() {
        $_SESSION['laakari'] = null;
        Redirect::to('/laakari/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function ohjelma($l_id) {
        self::check_logged_in(); 
        $ohjelma = Kaynti::ohjelma($l_id);
        View::make('laakari/ohjelma.html', array('ohjelma' => $ohjelma));

        Kint::dump($ohjelma);
    }

}
