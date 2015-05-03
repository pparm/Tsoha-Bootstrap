<?php

class Kaynti extends BaseModel {

    // Attribuutit
    public $a_id , $l_id, $k_id, $k_alku, $k_loppu, $k_oire, $k_raportti, $k_hoitoohje ,$a_etunimi, $a_sukunimi, $a_osoite, $a_puhelinnumero, $a_sahkoposti,$a_salasana,$l_etunimi,$l_sukunimi,$l_puhelinnumero,$l_sahkoposti;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
     //   $this->validators = array('validate_a_etunimi','validate_a_sukunimi');
        
        }
     public static function find($k_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kaynti WHERE k_id = :k_id LIMIT 1');
        $query->execute(array('k_id' => $k_id));
        $row = $query->fetch();
        //Kint::dump($row);
        if ($row) {
            $kaynti = new Kaynti(array(
                'k_id' => $row['k_id'],
                'a_id' => $row['a_id'],
                'l_id' => $row['l_id'],
                'k_alku' => $row['k_alku'],
                'k_loppu' => $row['k_loppu'],
                'k_oire' => $row['k_oire'],
                'k_raportti' => $row['k_raportti'],
                'k_hoitoohje' => $row['k_hoitoohje']));

        //   Kint::dump($kaynti);
            return $kaynti;
        }

        return null;       
        
        
}

    public function tilaus_paivita(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    
        
        $query = DB::connection()->prepare('UPDATE Kaynti SET l_id = :l_id, k_oire = :k_oire WHERE k_id = :k_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('l_id' => $this->l_id,'k_oire' => $this->k_oire,'k_id' => $this->k_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
// Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    
  }
    public function destroy($k_id){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
   // kint::dump($a_id);
        $query = DB::connection()->prepare('DELETE FROM Kaynti where k_id = :k_id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('k_id'=> $k_id));
    
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
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
     //   Kint::dump($rows);
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
                'l_sahkoposti' => $row['l_sahkoposti'],
                'l_sukunimi' => $row['l_sukunimi']
             ));
        
            
        }
   //     Kint::dump($asiakkaan_ohjelma);
       return $asiakkaan_ohjelma;
        }
    
        
        
        
}
        