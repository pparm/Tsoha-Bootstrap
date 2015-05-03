<?php

class KayntiController extends BaseController {

    public static function kaynti($k_id) {
        self::check_asiakas_or_laakari_logged_in();
        
        $kaynti = Kaynti::find($k_id);
        $asiakas = Asiakas::find($kaynti->a_id);
        $laakari = Laakari::find($kaynti->l_id);
        $laakarit = Laakari::all();

        View::make('kaynti/kaynti.html', array('laakari' => $laakari, 'laakarit' => $laakarit, 'asiakas' => $asiakas, 'kaynti' => $kaynti));
    }

    public static function kaynti_tallenna() {
        self::check_asiakas_or_laakari_logged_in();
        $params = $_POST;
        $session = $_SESSION;
        $attributes = array('l_id' => $params['laakari'], 'a_id' => $session['asiakas'], 'k_oire' => $params['k_oire'], 'k_hoitoohje' => $params['k_hoitoohje'], 'k_raportti' => $params['k_raportti'], 'k_id' => $params['k_id']);
        $kaynti = new Kaynti($attributes);
        $kaynti->tilaus_paivita();
        Redirect::to('/asiakas/ohjelma/' . $params['a_id'], array('message' => 'Käyntiä ' . $params['k_id'] . ' muokattu'));
    }

    public static function destroy($k_id) {
        self::check_asiakas_or_laakari_logged_in();
        $kaynti = new Kaynti(array('k_id' => $k_id));
        $params = $_POST;
        $kaynti->destroy($k_id);
        Redirect::to('/asiakas/ohjelma/' . $params['a_id'], array('message' => 'Käynti numero ' . $params['k_id'] . ' on poistettu onnistuneesti!'));
 }

    public static function kayntimuokkaa($k_id) {
       self::check_asiakas_or_laakari_logged_in();
        $kaynti = Kaynti::find($k_id);
        Kint::dump($kaynti);
        $asiakas = Asiakas::find($kaynti->a_id);
        $laakari = Laakari::find($kaynti->l_id);
        $laakarit = Laakari::all();
        
        View::make('kaynti/kaynti_muokkaa.html', array('laakari' => $laakari, 'laakarit' => $laakarit, 'asiakas' => $asiakas, 'kaynti' => $kaynti));
    }

    public static function kayntimuokkaa_tallenna() {
        self::check_asiakas_or_laakari_logged_in();
        $params = $_POST;
        $session = $_SESSION;
        $attributes = array('l_id' => $params['laakari'], 'a_id' => $session['asiakas'], 'k_oire' => $params['k_oire'], 'k_id' => $params['k_id']);
        $kaynti = new Kaynti($attributes);
        $kaynti->tilaus_paivita();
        Redirect::to('/asiakas/ohjelma/' . $kaynti->a_id, array('message' => 'Käyntiä muokattu'));
    }

}
