<!DOCTYPE html>
<html lang="de">
<style type="text/css">
li:nth-child(even) { font-weight: bold; }
</style>

@forelse($data as $a)
    <li>{{$a['name']}}</li>
@empty
    <li>Keine Daten vorhanden.</li>
@endforelse

</html>