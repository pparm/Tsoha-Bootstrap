<?php

class Asiakas extends BaseModel {

    // Attribuutit
    public $a_id, $a_etunimi, $a_sukunimi, $a_osoite, $a_puhelinnumero, $a_sahkoposti;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);

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



            return $asiakkaat;
        }
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
    $query = DB::connection()->prepare('INSERT INTO Asiakas (a_etunimi, a_sukunimi, a_osoite, a_puhelinnumero, a_sahkoposti) VALUES (:a_etunimi, :a_sukunimi, :a_osoite, :a_puhelinnumero,:a_sahkoposti) RETURNING a_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('a_etunimi' => $this->a_etunimi,'a_sukunimi' => $this->a_sukunimi, 'a_osoite' => $this->a_osoite, 'a_puhelinnumero' => $this->a_puhelinnumero,'a_sahkoposti' => $this->a_sahkoposti));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->a_id = $row['a_id'];
  }


}
