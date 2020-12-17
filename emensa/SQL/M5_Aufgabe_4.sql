USE E_Mensa;

/*Suppe**/
SELECT *
FROM gericht
WHERE name LIKE '%suppe%';

/*view_anmeldung**/
CREATE VIEW view_anmeldung AS
SELECT anzahlanmeldungen
From benutzer b
ORDER BY anzahlanmeldungen DESC;
/*view_kategoriegerichte_vegetarisch**/
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT
    ghk.gericht_id as gerichtID,
    gericht.id   as ID,
    gericht.name AS Gericht,
    gericht.beschreibung,
    gericht.vegetarisch,
    gericht.preis_extern,
    gericht.preis_intern
FROM gericht
         Left JOIN  gericht_hat_kategorie ghk on gericht.id = ghk.gericht_id
WHERE vegetarisch=true
;