<?php

class BaseController {

    public static function get_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän
        if (isset($_SESSION['laakari'])) {
            $laakari_id = $_SESSION['laakari'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $laakari = Laakari::find($laakari_id);

            return $laakari;
        }
        return null;
    }
   public static function check_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

        if (!isset($_SESSION['laakari'])) {
            Redirect::to('/laakari/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

    
    
    public static function get_asiakas_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän
        if (isset($_SESSION['asiakas'])) {
            $asiakas_id = $_SESSION['asiakas'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $asiakas = Asiakas::find($laakari_id);

            return $asiakas;
        }
        return null;
    }

    public static function check_asiakas_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

        if (!isset($_SESSION['asiakas'])) {
            Redirect::to('/asiakas/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }
 
}
