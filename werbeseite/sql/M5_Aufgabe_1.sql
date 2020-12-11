USE E_Mensa;

create table benutzer
(
    id           bigint       not null AUTO_INCREMENT primary key,
    email        varchar(100)  not null UNIQUE ,
    passwort    varchar(200) not null,
    admin       boolean        DEFAULT false,

    anzahlfehler int  not null DEFAULT 0,
    anzahlanmeldungen int  not null,
    letzteanmeldung datetime,

    letzterfehler datetime
);