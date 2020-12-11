USE E_Mensa;

ALTER TABLE gericht ADD bildname varchar(200) DEFAULT '00_image_missing.jpg' ;

UPDATE gericht Set gericht.bildname = '01_bratkartoffel.jpg' WHERE id=1;
UPDATE gericht Set gericht.bildname = '03_bratkartoffel.jpg' WHERE id=3;
UPDATE gericht Set gericht.bildname = '06_lasagne.jpg' WHERE id=6;
UPDATE gericht Set gericht.bildname = '10_forelle.jpg' WHERE id=10;
UPDATE gericht Set gericht.bildname = '11_soup.jpg' WHERE id=11;
UPDATE gericht Set gericht.bildname = '12_kassler.jpg' WHERE id=12;
UPDATE gericht Set gericht.bildname = '13_reibekuchen.jpg' WHERE id=13;
UPDATE gericht Set gericht.bildname = '15_pilze.jpg' WHERE id=15;
UPDATE gericht Set gericht.bildname = '17_broetchen.jpg' WHERE id=17;
UPDATE gericht Set gericht.bildname = '19_mousse.jpg' WHERE id=19;
UPDATE gericht Set gericht.bildname = '20_suppe.jpg' WHERE id=20;