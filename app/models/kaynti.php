<?php

class Kaynti extends BaseModel {

    // Attribuutit
    public $a_id , $l_id, $k_id, $k_alku, $k_loppu, $a_etunimi, $a_sukunimi, $a_osoite, $a_puhelinnumero, $a_sahkoposti,$a_salasana;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
     //   $this->validators = array('validate_a_etunimi','validate_a_sukunimi');
        
        }
        
        public static function ohjelma($l_id) {
        $query = DB::connection()->prepare('SELECT kaynti.k_id, kaynti.l_id, kaynti.k_alku, kaynti.k_loppu,asiakas.a_id, asiakas.a_etunimi, asiakas.a_sukunimi FROM Kaynti FULL OUTER JOIN Laakari ON Laakari.l_id = Kaynti.l_id FULL OUTER JOIN Asiakas ON Asiakas.a_id = Kaynti.a_id WHERE Kaynti.l_id = :l_id' );
        $query->execute(array('l_id' => $l_id));
        $rows = $query->fetchAll();
        Kint::dump($rows);
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
             ));
        
            
        }

        return $ohjelma;
    }
    
        
        
        
}
        