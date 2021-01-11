USE E_Mensa;

/*Suppe**/
CREATE VIEW view_suppe AS SELECT *
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
    k.name as Kategorie,
    gericht.id   as ID,
    gericht.name AS Gericht,
    gericht.vegetarisch

FROM gericht
         Left JOIN  gericht_hat_kategorie ghk on gericht.id = ghk.gericht_id
        LEFT JOIN kategorie k on k.id = ghk.Kategorie_id
WHERE vegetarisch=true
;

select * FROM gericht where vegetarisch;