<?php

class Asiakas extends BaseModel {

    // Attribuutit
    public $a_id, $l_id, $k_id, $a_etunimi, $a_sukunimi, $a_osoite, $a_puhelinnumero, $a_sahkoposti,$a_salasana;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_a_etunimi','validate_a_sukunimi');
        
        }
        
        
        
        
        
            public static function signup($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_a_etunimi','validate_a_sukunimi');
        
        }

        

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Asiakas');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();

        foreach ($rows as $row) {
            $asiakkaat[] = new Asiakas(array(
                'a_id' => $row['a_id'],
                'a_etunimi' => $row['a_etunimi'],
                'a_sukunimi' => $row['a_sukunimi'],
                'a_osoite' => $row['a_osoite'],
                'a_puhelinnumero' => $row['a_puhelinnumero'],
                'a_sahkoposti' => $row['a_sahkoposti'],
            ));
        }

        return $asiakkaat;
    }

    public static function find($a_id) {
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE a_id = :a_id LIMIT 1');
        $query->execute(array('a_id' => $a_id));
        $row = $query->fetch();

        if ($row) {
            $asiakas = new Asiakas(array(
                'a_id' => $row['a_id'],
                'a_etunimi' => $row['a_etunimi'],
                'a_sukunimi' => $row['a_sukunimi'],
                'a_osoite' => $row['a_osoite'],
                'a_puhelinnumero' => $row['a_puhelinnumero'],
                'a_sahkoposti' => $row['a_sahkoposti']));

            return $asiakas;
        }

        return null;
    }
 
    public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Asiakas (a_etunimi, a_sukunimi, a_osoite, a_puhelinnumero, a_sahkoposti, a_salasana) VALUES (:a_etunimi, :a_sukunimi, :a_osoite, :a_puhelinnumero,:a_sahkoposti,:a_salasana) RETURNING a_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('a_etunimi' => $this->a_etunimi,'a_sukunimi' => $this->a_sukunimi, 'a_osoite' => $this->a_osoite, 'a_puhelinnumero' => $this->a_puhelinnumero,'a_sahkoposti' => $this->a_sahkoposti,'a_salasana' => $this->a_salasana));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
// Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->a_id = $row['a_id'];
  }
    public function tilaus_tallenna(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Kaynti (a_id, l_id) VALUES (:a_id, :l_id) RETURNING k_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('a_id' => $this->a_id,'l_id' => $this->l_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
// Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->k_id = $row['k_id'];
  }
  
    public function update(){
    
// Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('UPDATE Asiakas SET a_etunimi = :a_etunimi, a_sukunimi = :a_sukunimi, a_osoite = :a_osoite, a_puhelinnumero = :a_puhelinnumero, a_sahkoposti = :a_sahkoposti WHERE a_id = :a_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('a_etunimi' => $this->a_etunimi,'a_sukunimi' => $this->a_sukunimi, 'a_osoite' => $this->a_osoite, 'a_puhelinnumero' => $this->a_puhelinnumero,'a_sahkoposti' => $this->a_sahkoposti,'a_id' => $this->a_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    Kint::dump($row);
// Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    //$this->a_id = $row['a_id'];
  }
    public function destroy($a_id){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
   // kint::dump($a_id);
        $query = DB::connection()->prepare('DELETE FROM Asiakas where a_id = :a_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('a_id'=> $a_id));
    
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
  }

  public function validate_a_etunimi(){
      
      $errors = array();
        if($this->a_etunimi =='' || $this ->a_etunimi == null){
            $errors[] = 'Etuniminimi ei saa olla tyhjä!';
            
            
        }
      if(strlen($this->a_etunimi)<3){
          $errors[] = 'Etunimen pituuden tulee olla vähintään kolme merkkiä!';
          
      }
      return $errors;
  }
  public function validate_a_sukunimi(){
      
      $errors = array();
        if($this->a_sukunimi =='' || $this ->a_sukunimi == null){
            $errors[] = 'Sukunimi ei saa olla tyhjä!';
            
            
        }
      if(strlen($this->a_sukunimi)<3){
          $errors[] = 'Sukunimen pituuden tulee olla vähintään kolme merkkiä!';
          
      }
      return $errors;
  }
  
      public static function authenticate($a_id,$a_salasana) {
        
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE a_id = :a_id AND a_salasana = :a_salasana  LIMIT 1', array('a_id'=>$a_id, 'a_salasana' => $a_salasana));
        $query->execute(array('a_id' => $a_id,'a_salasana' => $a_salasana));
        $row = $query->fetch();
        Kint::dump($row);
        if ($row) {
            $asiakas = new Asiakas(array(
                'a_id' => $row['a_id'],
                'a_etunimi' => $row['a_etunimi'],
                'a_sukunimi' => $row['a_sukunimi'],
                'a_osoite' => $row['a_osoite'],
                'a_puhelinnumero' => $row['a_puhelinnumero'],
                'a_sahkoposti' => $row['a_sahkoposti'],
                'a_salasana' => $row['a_salasana']));
            return $asiakas;
        }

        return null;
    }
}
  


