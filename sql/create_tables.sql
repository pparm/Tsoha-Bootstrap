-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Asiakas(
  a_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  a_etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  a_sukunimi varchar(50) NOT NULL,
  a_osoite varchar(200),
  a_puhelinnumero varchar(50),
  a_sahkoposti varchar(50),
  a_salasana varchar(50) NOT NULL
 );

CREATE TABLE Laakari(
  l_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  l_etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  l_sukunimi varchar(50) NOT NULL,
  l_osoite varchar(200),
  l_puhelinnumero varchar(50),
  l_sahkoposti varchar(50),
  l_salasana varchar(50) NOT NULL
);
/*
CREATE TABLE Tilaus(
  t_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  t_asiakas_id INTEGER REFERENCES Asiakas(a_id),
  t_laakari_id INTEGER REFERENCES Laakari(l_id),
  t_tilaus_alkaa TIMESTAMP,
  t_tilaus_loppuu TIMESTAMP,
  t_oireet varchar(400)
);
*/
 
CREATE TABLE Kaynti(
k_id SERIAL PRIMARY KEY,
a_id INTEGER REFERENCES Asiakas(a_id),
l_id INTEGER REFERENCES Laakari(l_id),
k_alku TIMESTAMP,
k_loppu TIMESTAMP,
k_oire varchar(400),
k_kayty varchar(400),
k_raportti varchar(400),
k_hoitoohje varchar(400)
);


/*
CREATE TABLE Hoitoohje(
h_id SERIAL PRIMARY KEY,
h_kaynti_id INTEGER REFERENCES Kaynti(k_id),
h_asiakas_id INTEGER REFERENCES Asiakas(a_id),
h_laakari_id INTEGER REFERENCES Laakari(l_id),
h_hoitoohje varchar(400)
);
*/
-->
-->CREATE TABLE Raportti(
-->r_id SERIAL PRIMARY KEY,
-->r_kaynti_id INTEGER REFERENCES Kaynti(k_id),
-->r_raportti varchar(800)
-->);