<!DOCTYPE html>
<html lang="de">

@forelse($data as $a)
    <li>
        {{$a['name']}}
        {{$a['preis_intern']}}
    </li>
@empty
    <li>Es sind keine Gerichte vorhanden.</li>
@endforelse

</html>