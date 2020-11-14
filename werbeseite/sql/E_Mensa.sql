CREATE DATABASE E_Mensa;
ALTER DATABASE test CHARACTER SET='utf8mb4'  COLLATE='utf8mb4_unicode_ci';

USE E_Mensa;

create table allergen
(
    code char(4)      not null
        primary key,
    name varchar(300) not null,
    typ  varchar(20)  not null
);

create table gericht
(
    id           tinyint      not null
        primary key,
    name         varchar(80)  not null,
    beschreibung varchar(800) not null,
    erfasst_am   date         not null,
    vegetarisch  tinyint(1)   not null,
    vegan        tinyint(1)   not null,
    preis_extern double       not null,
    preis_intern double       not null,
    constraint name
        unique (name),
    constraint preis_extern
        check (`preis_extern` > 0),
    constraint preis_intern
        check (`preis_intern` <= `preis_extern`)
);

create table gericht_hat_allergen
(
    code       char(4) null,
    gericht_id tinyint not null,
    constraint gericht_hat_allergen_allergen_allergencode_fk
        foreign key (code) references allergen (code)
            on update cascade,
    constraint gericht_hat_allergen_gericht_gerichtid_fk
        foreign key (gericht_id) references gericht (id)
            on update cascade
);

create table kategorie
(
    id        tinyint     not null
        primary key,
    name      varchar(80) not null,
    eltern_id tinyint     null,
    bildname  varchar(80) null
);

create table gericht_hat_kategorie
(
    gericht_id   tinyint not null,
    Kategorie_id tinyint not null,
    constraint gericht_hat_kategorie_gericht_gerichtid_fk
        foreign key (gericht_id) references gericht (id)
            on update cascade,
    constraint gericht_hat_kategorie_kategorie_kategorieid_fk
        foreign key (Kategorie_id) references kategorie (id)
            on update cascade
);


