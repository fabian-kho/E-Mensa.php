<!DOCTYPE html>
<html lang="de">
<body>

<form method="get" action="/anmeldung_verifizieren">
    <label for="email">Email</label>
    <br>
    <input id="email" name="email" required>
    <br>
    <label for="password">Passwort</label>
    <br>
    <input id="password" name="password" required>
    <br>
    <br>
    <button type="submit">
        Anmelden
    </button>
    <br>
    {{$msg}}
</form>

</body>
</html>