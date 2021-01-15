@extends('e_mensa.layout')

@section('title','Meine Bewertungen')

@section('head')
        <!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="css/liste.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css">


    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bewertung</title>
</head>
@endsection

@section('main')
    <body>
    <div class="main">
        <div class="card-container">

            @for($i=0;$i<$anzahl_user_bewertungen['anzahl'];$i++)
                <div class="card">
                    <form method="post">
                    <header class="article-header">
                        <div>
                            <div class="category-title">
                                <input type="hidden" name="ID{{$i}}" value="{{$mybewertung[$i]['ID']}}" />
                                <span class="date" >{{$mybewertung[$i]['date']}}</span>
                                    <button id="nobutton" type="submit" name="delete"><i class="far fa-trash-alt"></i></button>

                            </div>
                        </div>
                        <h2 class="article-title" name="gerichtName">{{$mybewertung[$i]['Gericht']}}</h2>
                    </header>
                    <div>
                        <text>{{$mybewertung[$i]['bemerkung']}}</text>
                    </div>
                    <div class="author">
                        <div class="profile"></div>
                        <div class="info">
                            <div class="caption">Author</div>
                            <div class="name">{{$mybewertung[$i]['email']}}</div>
                        </div>
                    </div>
                    <div style="margin: 1rem 0 1rem;">
                        <div>
                            <select id="example{{$i}}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </form>
                </div>
                @endfor
                @if($anzahl_user_bewertungen['anzahl']==null)
                    <div class="card">
                        <form method="post">
                            <div class="leer">
                                <text>Sie haben noch keine Bewertung geschrieben.</text>
                            </div>
                        </form>
                    </div>
                @endif
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script src="node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>

                <script type="text/javascript">
                @for($i=0;$i<$anzahl_user_bewertungen['anzahl'];$i++)
                $(function() {
                    $('#example{{$i}}').barrating('show', {
                        theme: 'fontawesome-stars',
                        initialRating: '{{$mybewertung[$i]['sterne']}}',
                        readonly: 'true',
                    });
                });
                @endfor
            </script>
        </div>
    </div>
    </body>
</html>
@endsection