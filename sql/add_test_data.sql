-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Asiakas (a_etunimi, a_sukunimi,a_osoite,a_puhelinnumero) VALUES ('Atte', 'Asiakas','alkokuja','0501234');
INSERT INTO Asiakas (a_etunimi, a_sukunimi,a_osoite,a_puhelinnumero,a_sahkoposti) VALUES ('Pipari', 'Piiras','piirakkavuori','0504321','pulu.piirakka(at)kello.fi');

INSERT INTO Laakari (l_etunimi, l_sukunimi,l_osoite,l_puhelinnumero,l_sahkoposti) VALUES ('Urpo', 'Lääkäri','piirakkajärvi','0504321','urpo.laakari(at)kotilaakari.fi');
INSERT INTO Laakari (l_etunimi, l_sukunimi,l_osoite,l_puhelinnumero,l_sahkoposti) VALUES ('Jurpo', 'Lääkäri','pamitie','05066666','urpo.laakari(at)kotilaakari.fi');


INSERT INTO Tilaus (t_asiakas_id,t_laakari_id,t_tilaus_alkaa,t_tilaus_loppuu,t_oireet) VALUES ('1','1', '1998-11-13 HH18:30:00','1998-11-13 HH19:30:00', 'vatsa kipeä');
INSERT INTO Tilaus (t_asiakas_id,t_laakari_id,t_tilaus_alkaa,t_tilaus_loppuu,t_oireet) VALUES ('2','2', '1998-12-13 HH18:30:00','1998-11-13 HH20:30:00', 'selkeä kipeä');


INSERT INTO Kaynti (k_tilaus_id,k_asiakas_id,k_laakari_id,k_kayntiaika,k_raportti) VALUES ('1','1','1', '1999-11-13 HH18:30:00','kaikki ok');
INSERT INTO Kaynti (k_tilaus_id,k_asiakas_id,k_laakari_id,k_kayntiaika,k_raportti) VALUES ('2','2','2', '1999-06-16 HH16:00:00','kaikki huonosti');

INSERT INTO Hoitoohje (h_kaynti_id,h_asiakas_id,h_laakari_id,h_hoitoohje) VALUES ('1','1','1', 'Älä tee mitään');
INSERT INTO Hoitoohje (h_kaynti_id,h_asiakas_id,h_laakari_id,h_hoitoohje) VALUES ('2','2','2', 'Sauno hyvin');
