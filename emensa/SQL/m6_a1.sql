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

/*ALTER TABLE kategorie
    ADD CONSTRAINT kategorie_kategorie_eltern_id_fk
        FOREIGN KEY (eltern_id) REFERENCES kategorie(id);


Select * FROM wunschgericht LIMIT 5;*/