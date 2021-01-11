USE E_Mensa;

CREATE PROCEDURE anmeldungsZaehler (IN EMAIL varchar(100))
BEGIN
    Update benutzer Set anzahlanmeldungen=anzahlanmeldungen+1 where benutzer.email=EMAIL;
END;

CREATE PROCEDURE letzteAnmeldung (IN EMAIL varchar(100))
BEGIN
    Update benutzer Set letzteanmeldung=current_timestamp where benutzer.email=EMAIL;
END;

CREATE PROCEDURE letzterFehler (IN EMAIL varchar(100))
BEGIN
    Update benutzer Set letzterfehler=current_timestamp, anzahlfehler=anzahlfehler+1 where benutzer.email=EMAIL;
END;