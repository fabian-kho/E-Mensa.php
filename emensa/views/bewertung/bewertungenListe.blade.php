@extends('e_mensa.layout')

@section('title','Bewertungen')

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
    <a href="/werbeseite"><button class="homebutton"><i class="fas fa-home"></i></button></a>
    <div class="main">
        <div class="card-container">

            @for($i=0;$i<$anzahlbewertungen['anzahl'];$i++)
                <div class="{{$bewertung[$i]['highlight']}}">
                    <form method="post">
                        <header class="article-header">
                            <div>
                                <div class="category-title">
                                    <span class="date" >{{$bewertung[$i]['date']}}</span>
                                    @if($admin['admin'])
                                        <input type="hidden" name="ID{{$i}}" value="{{$bewertung[$i]['ID']}}" />
                                    <button  class="nobutton" type="submit" name="highlight" style="color:{{$bewertung[$i]['highlight']}}"><i class="fas fa-highlighter"></i></button>
                                    @endif
                                </div>
                            </div>
                            <h2 class="article-title" name="gerichtName">{{$bewertung[$i]['Gericht']}}</h2>
                        </header>
                        <div>
                            <text class="bemerkung">{{$bewertung[$i]['bemerkung']}}</text>
                        </div>
                        <div class="author">
                            <div class="profile"></div>
                            <div class="info">
                                <div class="caption">Author</div>
                                <div class="name">{{$bewertung[$i]['email']}}</div>
                            </div>
                        </div>
                        <div id="stars">
                            <div>
                                <select id="example{{$i}}">
                                    <option value="0">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            @endfor
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script src="node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>

                <script type="text/javascript">
                    @for($i=0;$i<$anzahlbewertungen['anzahl'];$i++)
                    $(function() {
                        $('#example{{$i}}').barrating('show', {
                            theme: 'fontawesome-stars',
                            initialRating: '{{$bewertung[$i]['sterne']}}',
                            readonly: 'true',
                        });
                    });
                @endfor
                    $.fn.attachDragger = function(){
                    var attachment = false, lastPosition, position, difference;
                    $( $(this)).on("mousedown mouseup mousemove",function(e){
                        if( e.type == "mousedown" ) attachment = true, lastPosition = [e.clientX, e.clientY];
                        if( e.type == "mouseup" ) attachment = false;
                        if( e.type == "mousemove" && attachment == true ){
                            position = [e.clientX, e.clientY];
                            difference = [ (position[0]-lastPosition[0]), (position[1]-lastPosition[1]) ];
                            $(this).scrollLeft( $(this).scrollLeft() - difference[0] );
                            $(this).scrollTop( $(this).scrollTop() - difference[1] );
                            lastPosition = [e.clientX, e.clientY];
                        }
                    });
                    $(window).on("mouseup", function(){
                        attachment = false;
                    });
                }
                    $(document).ready(function(){
                        $(".card-container").attachDragger();
                    });
                </script>
        </div>
    </div>
    </body>
</html>
@endsection