-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Asiakas(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  sukunimi varchar(50) NOT NULL,
  osoite varchar(200) NOT NULL,
  puhelinnumero varchar(50) NOT NULL,
  sahkoposti varchar(50)
 );

CREATE TABLE Laakari(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  etunimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  sukunimi varchar(50) NOT NULL,
  osoite varchar(200) NOT NULL,
  puhelinnumero varchar(50) NOT NULL,
  sahkoposti varchar(50) NOT NULL
 );

CREATE TABLE Tilaus(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  id_asiakasnumero INTEGER REFERENCE Asiakas(id),
  laakarinumero INTEGER REFERENCE laakari(id),
    oireet varchar(400)
);
 
CREATE TABLE Kaynti(
id SERIAL PRIMARY KEY,
id_tilausnumero INTEGER REFERENCE Tilaus(id),
asiakasnumero INTEGER REFERENCE Asiakas(id),
laakarinumero INTEGER REFERENCE Laakari(id)
);
CREATE TABLE Hoito-ohje(
id SERIAL PRIMARY KEY,
id_kayntinumero INTEGER REFERENCE Kaynti(id)
id_asiakasnumero INTEGER REFERENCE Asiakas(id),
id_laakarinumero INTEGER REFERENCE Laakari(id),
hoito-ohje varchar(400)
);

CREATE TABLE Raportti(
raporttinumero SERIAL PRIMARY KEY,
id_kayntinumero INTEGER REFERENCE Kaynti(id),
raportti varchar(800)
);
