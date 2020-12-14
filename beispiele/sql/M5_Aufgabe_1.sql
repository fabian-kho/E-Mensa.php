USE E_Mensa;

create table benutzer
(
    id           bigint       not null AUTO_INCREMENT primary key,
    email        varchar(100)  not null UNIQUE ,
    passwort    varchar(200) not null,
    admin       boolean        DEFAULT false,

    anzahlfehler int  not null DEFAULT 0,
    anzahlanmeldungen int  not null DEFAULT 0,
    letzteanmeldung datetime,

    letzterfehler datetime
);

insert into benutzer (email,passwort,admin) values ('admin@emensa.example','8ae02ca5a70982b9564e64b2948c98c671492d9d',true);