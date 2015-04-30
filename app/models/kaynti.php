<?php

class Kaynti extends BaseModel {

    // Attribuutit
    public $a_id , $l_id, $k_id, $k_alku, $k_loppu, $a_etunimi, $a_sukunimi, $a_osoite, $a_puhelinnumero, $a_sahkoposti,$a_salasana,$l_etunimi,$l_sukunimi;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
     //   $this->validators = array('validate_a_etunimi','validate_a_sukunimi');
        
        }
        
        public static function ohjelma($l_id) {
        $query = DB::connection()->prepare('SELECT kaynti.k_id, kaynti.l_id, kaynti.k_alku, kaynti.k_loppu,asiakas.a_id, asiakas.a_etunimi, asiakas.a_sukunimi,asiakas.a_osoite,asiakas.a_puhelinnumero,asiakas.a_sahkoposti FROM Kaynti FULL OUTER JOIN Laakari ON Laakari.l_id = Kaynti.l_id FULL OUTER JOIN Asiakas ON Asiakas.a_id = Kaynti.a_id WHERE Laakari.l_id = :l_id' );
       $query->execute(array('l_id' => $l_id));
        $rows = $query->fetchAll();
        $ohjelma = array();

        foreach ($rows as $row) {
            $ohjelma[] = new Kaynti(array(
                'l_id' => $row['l_id'],
                'k_id' => $row['k_id'],
                'k_alku' => $row['k_alku'],
                'k_loppu' => $row['k_loppu'],
                'a_id' => $row['a_id'],
                'a_etunimi' => $row['a_etunimi'],
                'a_sukunimi' => $row['a_sukunimi'],
                'a_osoite' => $row['a_osoite'],
                'a_puhelinnumero' => $row['a_puhelinnumero'],
                'a_sahkoposti' => $row['a_sahkoposti']
             ));
        }
            
        
            return $ohjelma;
            
        }
        
        public static function asiakkaan_ohjelma($a_id) {
        $query = DB::connection()->prepare('SELECT kaynti.k_id, kaynti.l_id, kaynti.k_alku, kaynti.k_loppu,asiakas.a_id, laakari.l_etunimi, laakari.l_sukunimi, laakari.l_puhelinnumero, laakari.l_sahkoposti FROM Kaynti FULL OUTER JOIN Laakari ON Laakari.l_id = Kaynti.l_id FULL OUTER JOIN Asiakas ON Asiakas.a_id = Kaynti.a_id WHERE Kaynti.a_id = :a_id' );
        $query->execute(array('a_id' => $a_id));
        $rows = $query->fetchAll();
        $ohjelma = array();
        Kint::dump($rows);
        foreach ($rows as $row) {
            $asiakkaan_ohjelma[] = new Kaynti(array(
                'a_id' => $row['a_id'],
                'k_id' => $row['k_id'],
                'k_alku' => $row['k_alku'],
                'k_loppu' => $row['k_loppu'],
                'l_id' => $row['l_id'],
                'l_etunimi' => $row['l_etunimi'],
                'l_sukunimi' => $row['l_sukunimi'],
                'l_puhelinnumero' => $row['l_puhelinnumero'],
                'l_sahkoposti' => $row['l_sahkoposti']
             ));
        
            
        }
        Kint::dump($asiakkaan_ohjelma);
      // return $asiakkaan_ohjelma;
        }
    
        
        
        
}
        