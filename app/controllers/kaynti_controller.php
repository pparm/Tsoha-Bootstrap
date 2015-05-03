<?php

class KayntiController extends BaseController {

    public static function kaynti($k_id) {

        //$asiakas = Asiakas::find($_SESSION['asiakas']);

        $kaynti = Kaynti::find($k_id);
        $asiakas = Asiakas::find($kaynti->a_id);
        $laakari = Laakari::find($kaynti->l_id);
        $laakarit = Laakari::all();
        /*
          <div class="form-group">
          <label>Raportti</label>
          <input name="k_raportti" class="form-control" value = "{{kaynti.k_raportti}}" type = "text">
          </div>
          Kint::dump($asiakas);
          Kint::dump($laakari);
          Kint::dump($laakarit);
         */

        View::make('kaynti/kaynti.html', array('laakari' => $laakari, 'laakarit' => $laakarit, 'asiakas' => $asiakas, 'kaynti' => $kaynti));
    }

    public static function kaynti_tallenna() {

        $params = $_POST;
        $session = $_SESSION;
        Kint::dump($params);
        $attributes = array('l_id' => $params['laakari'], 'a_id' => $session['asiakas'], 'k_oire' => $params['k_oire'], 'k_hoitoohje' => $params['k_hoitoohje'], 'k_raportti' => $params['k_raportti'], 'k_id' => $params['k_id']);

        $kaynti = new Kaynti($attributes);

        Kint::dump($kaynti);

        $kaynti->tilaus_paivita();

        Redirect::to('/asiakas/ohjelma/' . $params['a_id'], array('message' => 'Käyntiä ' . $params['k_id'] . ' muokattu'));
    }

    public static function destroy($k_id) {
        //    self::check_asiakas_or_laakari_logged_in();
        //Alustetaan Asiakas-olio annetulla a_id:llä.



        $kaynti = new Kaynti(array('k_id' => $k_id));
        $params = $_POST;
        Kint::dump($params);
        Kint::dump($params['a_id']);
        $kaynti->destroy($k_id);

        //    Ohjataan asiakas käyntien listaussivulle ilmpituksen kera
        Redirect::to('/asiakas/ohjelma/' . $params['a_id'], array('message' => 'Käynti numero ' . $params['k_id'] . ' on poistettu onnistuneesti!'));


        /*
          if ($_SESSION['laakari'] = null) {
          View::make('asiakas/edit.html', array('errors' => $errors, 'attributes' => $attributes));
          } else {
          //Lutsutaan alustetun metodin olion update-metodia, joka päivittää pelin tiedot tietokannassa
          //
          $asiakas->update();
          Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakasta on muokattu onnistuneesti!'));
          }
          if (count($errors) > 0) {
          View::make('asiakas/edit.html', array('errors' => $errors, 'attributes' => $attributes));
          } else {
          //Lutsutaan alustetun metodin olion update-metodia, joka päivittää pelin tiedot tietokannassa
          //
          $asiakas->update();
          Redirect::to('/asiakas/' . $asiakas->a_id, array('message' => 'Asiakasta on muokattu onnistuneesti!'));
          }
         */
    }

    public static function kayntimuokkaa($k_id) {
        //$asiakas = Asiakas::find($_SESSION['asiakas']);
        Kint::dump($k_id);
        $kaynti = Kaynti::find($k_id);
        Kint::dump($kaynti);
        $asiakas = Asiakas::find($kaynti->a_id);
        $laakari = Laakari::find($kaynti->l_id);
        $laakarit = Laakari::all();
        /*

          Kint::dump($asiakas);
          Kint::dump($laakari);
         */

        View::make('kaynti/kaynti_muokkaa.html', array('laakari' => $laakari, 'laakarit' => $laakarit, 'asiakas' => $asiakas, 'kaynti' => $kaynti));
    }

    public static function kayntimuokkaa_tallenna() {

        $params = $_POST;
        $session = $_SESSION;
        Kint::dump($params);
        Kint::dump($_POST);
        $attributes = array('l_id' => $params['laakari'], 'a_id' => $session['asiakas'], 'k_oire' => $params['k_oire'], 'k_id' => $params['k_id']);

        $kaynti = new Kaynti($attributes);

        Kint::dump($kaynti);

        $kaynti->tilaus_paivita();
        Redirect::to('/asiakas/ohjelma/' . $kaynti->a_id, array('message' => 'Käyntiä muokattu'));
    }

}
