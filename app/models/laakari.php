<?php

Class Laakari extends BaseModel{
       public $l_id, $l_etunimi, $l_sukunimi, $l_osoite, $l_puhelinnumero, $l_sahkoposti, $l_salasana;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_l_etunimi','validate_l_sukunimi');
        
        }
        
            public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Laakari');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();

        foreach ($rows as $row) {
            $laakarit[] = new Laakari(array(
                'l_id' => $row['l_id'],
                'l_etunimi' => $row['l_etunimi'],
                'l_sukunimi' => $row['l_sukunimi'],
                'l_osoite' => $row['l_osoite'],
                'l_puhelinnumero' => $row['l_puhelinnumero'],
                'l_sahkoposti' => $row['l_sahkoposti'],
            ));
        }

        return $laakarit;
    }

        
        
        
        
        
           public static function find($l_id) {
        $query = DB::connection()->prepare('SELECT * FROM Laakari WHERE l_id = :l_id LIMIT 1');
        $query->execute(array('l_id' => $l_id));
        $row = $query->fetch();

        if ($row) {
            $laakari = new Laakari(array(
                'l_id' => $row['l_id'],
                'l_etunimi' => $row['l_etunimi'],
                'l_sukunimi' => $row['l_sukunimi'],
                'l_osoite' => $row['l_osoite'],
                'l_puhelinnumero' => $row['l_puhelinnumero'],
                'l_sahkoposti' => $row['l_sahkoposti'],
                'l_salasana' => $row['l_salasana']));

            return $laakari;
        }

        return null;
    }
        
        
        
           public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Laakari (l_etunimi, l_sukunimi, l_osoite, l_puhelinnumero, l_sahkoposti, l_salasana) VALUES (:l_etunimi, :l_sukunimi, :l_osoite, :l_puhelinnumero,:l_sahkoposti,:l_salasana) RETURNING l_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('l_etunimi' => $this->l_etunimi,'l_sukunimi' => $this->l_sukunimi, 'l_osoite' => $this->l_osoite, 'l_puhelinnumero' => $this->l_puhelinnumero,'l_sahkoposti' => $this->l_sahkoposti,'l_salasana' => $this->l_salasana));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->l_id = $row['l_id'];
  }
      public function destroy($l_id){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
   // kint::dump($a_id);
        $query = DB::connection()->prepare('DELETE FROM Asiakas where l_id = :l_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('l_id'=> $l_id));
    
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
  }
  
  
  
  
    public function validate_l_etunimi(){
      
      $errors = array();
        if($this->l_etunimi =='' || $this ->l_etunimi == null){
            $errors[] = 'Etuniminimi ei saa olla tyhjä!';
            
            
        }
      if(strlen($this->l_etunimi)<3){
          $errors[] = 'Etunimen pituuden tulee olla vähintään kolme merkkiä!';
          
      }
      return $errors;
  }
  public function validate_l_sukunimi(){
      
      $errors = array();
        if($this->l_sukunimi =='' || $this ->l_sukunimi == null){
            $errors[] = 'Sukunimi ei saa olla tyhjä!';
            
            
        }
      if(strlen($this->l_sukunimi)<3){
          $errors[] = 'Sukunimen pituuden tulee olla vähintään kolme merkkiä!';
          
      }
      return $errors;
  }

    public static function authenticate($l_id,$l_salasana) {
        
        $query = DB::connection()->prepare('SELECT * FROM Laakari WHERE l_id = :l_id AND l_salasana = :l_salasana  LIMIT 1', array('l_id'=>$l_id, 'l_salasana' => $l_salasana));
        $query->execute(array('l_id' => $l_id,'l_salasana' => $l_salasana));
        $row = $query->fetch();
        if ($row) {
            $laakari = new Laakari(array(
                'l_id' => $row['l_id'],
                'l_etunimi' => $row['l_etunimi'],
                'l_sukunimi' => $row['l_sukunimi'],
                'l_osoite' => $row['l_osoite'],
                'l_puhelinnumero' => $row['l_puhelinnumero'],
                'l_sahkoposti' => $row['l_sahkoposti'],
                'l_salasana' => $row['l_salasana']));
            return $laakari;
        }

        return null;
    }

    
                public static function ohjelma($l_id) {
        $query = DB::connection()->prepare('SELECT kaynti.k_id, kaynti.k_alku, kaynti.k_loppu,asiakas.a_id, asiakas.a_etunimi, asiakas.a_sukunimi FROM KayntiFULL OUTER JOIN Laakari ON Laakari.l_id = Kaynti.l_id FULL OUTER JOIN Asiakas ON Asiakas.a_id = Kaynti.a_id');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();

        foreach ($rows as $row) {
            $kaynnit[] = new Laakari(array(
                'l_id' => $row['l_id'],
                'l_etunimi' => $row['l_etunimi'],
                'l_sukunimi' => $row['l_sukunimi'],
                'l_osoite' => $row['l_osoite'],
                'l_puhelinnumero' => $row['l_puhelinnumero'],
                'l_sahkoposti' => $row['l_sahkoposti'],
            ));
        }

        return $laakarit;
    }
    
    
    
    
        }