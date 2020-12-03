/* 8.1 */
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_hat_kategorie UNIQUE(gericht_id, kategorie_id);
/* 8.2 */
ALTER TABLE gericht
    ADD INDEX idx_name (name);
/* 8.3 */
/* 1 */
ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT delete_from_allergen
        FOREIGN KEY (gericht_id)
            REFERENCES gericht (id)
            ON DELETE CASCADE;
/* 2 */
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT delete_from_kategorie
        FOREIGN KEY (gericht_id)
    REF
    ERENCES gericht (id)
    ON DELETE CASCADE;
/* 8.4 */
/* 1 */
ALTER TABLE gericht_hat_kategorie
    add CONSTRAINT kategorie_in_verwendung FOREIGN KEY(Kategorie_id) REFERENCES kategorie(id)
        ON DELETE RESTRICT;
/* 2 */
ALTER TABLE kategorie
    ADD CONSTRAINT kategorie_kategorie_eltern_id_fk
        FOREIGN KEY (eltern_id) REFERENCES kategorie(id);
/* 8.5 */
ALTER TABLE gericht_hat_allergen
    add CONSTRAINT change_allergen FOREIGN KEY(code) REFERENCES allergen(code)
        ON UPDATE CASCADE;
/* 8.6 */
ALTER TABLE gericht_hat_kategorie
    ADD PRIMARY KEY (gericht_id,Kategorie_id);