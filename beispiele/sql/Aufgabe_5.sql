/*----1-----*/
SELECT * FROM gericht;

/*----2-----*/
SELECT erfasst_am FROM gericht ;

/*----3-----*/
SELECT erfasst_am ,name AS 'Gerichtname' FROM gericht ORDER BY name DESC ;

/*----4-----*/
SELECT  name, beschreibung FROM gericht ORDER BY name DESC LIMIT 5;

/*----5-----*/
SELECT  name, beschreibung FROM gericht ORDER BY name DESC LIMIT 10 OFFSET  5;

/*----6-----*/
SELECT DISTINCT typ FROM allergen;

/*----7-----*/
SELECT * FROM gericht WHERE name LIKE 'K%';

/*----8-----*/
SELECT id,name FROM gericht WHERE name LIKE '%suppe%';

/*----9-----*/
SELECT * FROM kategorie WHERE eltern_id IS NULL ;

/*----10-----*/
SELECT  gericht.name AS Gerichtname, a.name AS Allergen FROM gericht
JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
JOIN allergen a on a.code = gha.code;

/*----11-----*/
SELECT  gericht.name AS Gerichtname, a.name AS Allergen FROM gericht
Left JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
Left JOIN allergen a on a.code = gha.code;

/*----12-----*/
SELECT  gericht.name AS Gerichtname, a.name AS Allergen FROM gericht
Right JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
Right JOIN allergen a on a.code = gha.code;

/*----13-----*/
SELECT DISTINCT id AS ID,COUNT(Kategorie_id) AS Kategorie FROM kategorie
Left JOIN gericht_hat_kategorie ghk on kategorie.id = ghk.Kategorie_id
GROUP BY id
ORDER BY Kategorie ASC;

/*----14-----*/
SELECT DISTINCT id AS ID,COUNT(Kategorie_id) AS Kategorie FROM kategorie
Left JOIN gericht_hat_kategorie ghk on kategorie.id = ghk.Kategorie_id
GROUP BY id
HAVING Kategorie>2 ORDER BY Kategorie ASC;

/*----15-----*/
UPDATE allergen
SET name = 'Kamut'
WHERE code = 'a6';

SELECT * FROM allergen;

/*----16-----*/
INSERT INTO gericht
VALUES (2,'Currywurst mit Pommes', 'nichts','2020-08-25',0,0,4,2.3,'00_image_missing.jpg');

SELECT * FROM gericht;

INSERT INTO gericht_hat_kategorie
VALUES (2,3);

SELECT * FROM gericht_hat_kategorie ORDER BY gericht_id ASC ;


