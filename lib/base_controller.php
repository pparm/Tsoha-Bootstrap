<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
     if(isset($_SESSION['laakari'])){
      $laakari_id = $_SESSION['laakari'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
      $laakari = Laakari::find($laakari_id);
      
      return $laakari;
     }
        return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
