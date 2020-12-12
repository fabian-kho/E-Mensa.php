USE E_Mensa;
create table benutzer
(
    id int8 AUTO_INCREMENT primary key,
    email varchar(100) not null unique,
    passwort varchar(200) not null,
    admin boolean,
    anzahlfehler int not null default 0,
    anzahlanmeldungen int not null default 0,
    letzeanmeldung datetime,
    letzterfehler datetime
);

INSERT INTO `benutzer` (`email`, `passwort`, `admin`) VALUES
('admin@emensa.example', '8ae02ca5a70982b9564e64b2948c98c671492d9d', true); /* Passwort: salt (emensa2020) + ichbineinadmin */