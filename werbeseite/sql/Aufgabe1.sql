USE E_Mensa;

create table wunschgericht
(
    id           bigint       not null  AUTO_INCREMENT primary key,
    name         varchar(80)  not null,
    beschreibung varchar(800) not null,
    erstellt_am  date         not null
);

create table ersteller
(
    email VARCHAR(320) not null PRIMARY KEY ,
    name  varchar(80) DEFAULT 'anonym'
);

create table ersteller_wunschgericht
(
    wunschgericht_id bigint       not null,
    ersteller_email  VARCHAR(320) not null,
    constraint ersteller_wunschgericht_wunschgericht_id_fk
        foreign key (wunschgericht_id) references wunschgericht (id)
            on update cascade,
    constraint ersteller_wunschgericht_ersteller_email_fk
        foreign key (ersteller_email) references ersteller (email)
            on update cascade
);

ALTER TABLE kategorie
    ADD CONSTRAINT kategorie_kategorie_eltern_id_fk
        FOREIGN KEY (eltern_id) REFERENCES kategorie(id);