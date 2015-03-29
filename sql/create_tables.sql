-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Asiakas(
  a_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  a_etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  a_sukunimi varchar(50) NOT NULL,
  a_osoite varchar(200) NOT NULL,
  a_puhelinnumero varchar(50) NOT NULL,
  a_sahkoposti varchar(50)
 );

CREATE TABLE Laakari(
  l_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  l_etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  l_sukunimi varchar(50) NOT NULL,
  l_osoite varchar(200) NOT NULL,
  l_puhelinnumero varchar(50) NOT NULL,
  l_sahkoposti varchar(50) NOT NULL
 );

CREATE TABLE Tilaus(
  t_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  t_asiakas_id INTEGER REFERENCES Asiakas(a_id),
  t_laakari_id INTEGER REFERENCES Laakari(l_id),
  t_tilaus_alkaa TIMESTAMP,
  t_tilaus_loppuu TIMESTAMP,
  t_oireet varchar(400)
);
 
CREATE TABLE Kaynti(
k_id SERIAL PRIMARY KEY,
k_tilaus_id INTEGER REFERENCES Tilaus(t_id),
k_asiakas_id INTEGER REFERENCES Asiakas(a_id),
k_laakari_id INTEGER REFERENCES Laakari(l_id),
k_kayntiaika TIMESTAMP,
k_raportti varchar(400)
);
CREATE TABLE Hoitoohje(
h_id SERIAL PRIMARY KEY,
h_kaynti_id INTEGER REFERENCES Kaynti(k_id),
h_asiakas_id INTEGER REFERENCES Asiakas(a_id),
h_laakari_id INTEGER REFERENCES Laakari(l_id),
h_hoitoohje varchar(400)
);

-->
-->CREATE TABLE Raportti(
-->r_id SERIAL PRIMARY KEY,
-->r_kaynti_id INTEGER REFERENCES Kaynti(k_id),
-->r_raportti varchar(800)
-->);