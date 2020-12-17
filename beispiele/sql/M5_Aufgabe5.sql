USE E_Mensa;

CREATE PROCEDURE anmeldungsZaehler (IN EMAIL varchar(100))
BEGIN
    Update benutzer Set anzahlanmeldungen=anzahlanmeldungen+1 where benutzer.email=EMAIL;
END;

/*CALL anmeldungsZaehler();*/