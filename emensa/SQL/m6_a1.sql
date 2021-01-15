USE E_Mensa;

create table bewertung
(
    id           bigint       not null  AUTO_INCREMENT primary key,
    bemerkung    varchar(500) not null ,
    sterne       tinyint DEFAULT 0 not null,
    erstellt_am  datetime         not null,
    highlight    bool DEFAULT false,
    constraint bemerkung
        check (length(bemerkung) > 5),
    constraint sterne
        check (sterne < 4)
);

ALTER TABLE bewertung ALTER erstellt_am SET DEFAULT current_timestamp;

create table bewertung_gericht
(
    gericht_id     tinyint       not null,
    bewertungs_id  bigint   not null,
    constraint bewertung_gericht_gericht_id_fk
        foreign key (gericht_id) references gericht (id)
            on update cascade,
    constraint bewertung_gericht_bewertung_id_fk
        foreign key (bewertungs_id) references bewertung (id)
            on update cascade
);

ALTER TABLE bewertung_gericht
    DROP CONSTRAINT bewertung_gericht_gericht_id_fk,
    DROP CONSTRAINT bewertung_gericht_bewertung_id_fk;

ALTER TABLE bewertung_gericht
    ADD CONSTRAINT bewertung_gericht_gericht_id_fk
        FOREIGN KEY (gericht_id)
            REFERENCES gericht (id)
            ON DELETE CASCADE
                On UPDATE Cascade,
    ADD CONSTRAINT bewertung_gericht_bewertung_id_fk
        FOREIGN KEY (bewertungs_id)
            REFERENCES  bewertung (id)
            ON DELETE CASCADE
            On UPDATE Cascade;



create table benutzer_bewertung
(
    benutzer_id bigint       not null,
    bewertungs_id  bigint not null,
    constraint benutzer_bewertung_benutzer_id_fk
        foreign key (benutzer_id) references benutzer (id)
            on update cascade,
    constraint benutzer_bewertung_bewertung_id_fk
        foreign key (bewertungs_id) references bewertung (id)
            on update cascade
);

ALTER TABLE benutzer_bewertung
    DROP CONSTRAINT benutzer_bewertung_benutzer_id_fk,
    DROP CONSTRAINT benutzer_bewertung_bewertung_id_fk;

ALTER TABLE benutzer_bewertung
    ADD CONSTRAINT benutzer_bewertung_benutzer_id_fk
        FOREIGN KEY (benutzer_id)
            REFERENCES benutzer (id)
            ON DELETE CASCADE
            On UPDATE Cascade,
    ADD CONSTRAINT benutzer_bewertung_bewertung_id_fk
        FOREIGN KEY (bewertungs_id)
            REFERENCES  bewertung (id)
            ON DELETE CASCADE
            On UPDATE Cascade;

UPDATE bewertung SET highlight = !highlight
WHERE id = 6;

Select highlight From bewertung WHERE id = 6