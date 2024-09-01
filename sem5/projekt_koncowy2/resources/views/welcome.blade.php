<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>TAI | Komentarze</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <style>
        body{
            background-color: #e8e8e8;
        }
        .title{
            text-align: center;
            background-color: transparent
        }
        .table-container{
            background-color: white;
            max-width: 900px;
            margin: 0 auto;
        }
        .footer-button{
            background-color: transparent;
            float: right;
            margin-top: 3%;
        }
        table{
            max-width: 800px;
            margin: 0 auto;
        }
        .points-badge {
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(230, 230, 230, 0.9); /* Lekko przezroczysty szary */
            padding: 5px 10px;
            border-bottom-right-radius: 50%; /* Półokrągły narożnik */
            width: 75px; /* Szerokość narożnika */
            height: 75px; /* Wysokość narożnika */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em; /* Powiększ czcionkę */
            font-weight: bold; /* Pogrub czcionkę */
        }
        .card {
            height: 390px; /* Adjust this value according to your needs */
            overflow: auto; /* Add a scrollbar if the content exceeds the height */
        }
        .bd-placeholder-img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
@include('layouts.navbar')
<body>
<div class="container">
    @foreach($categories as $category)
        @if($category->deals->count() > 0)
            <div class="category text-center">
                <h2>{{ $category->name }}</h2>
                <div class="row">
                    @foreach($category->deals as $deal)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ $deal->image_link }}" alt="{{ $deal->name }}" class="bd-placeholder-img card-img-top" style="max-height: 200px; width: auto; object-fit: contain;">
                                    <div class="points-badge" data-points="{{ $deal->points }}">{{ $deal->points }}</div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Producent: {{ $deal->manufacturer }}<br>
                                        Model: {{ $deal->model }}<br>
                                        Nazwa: {{ $deal->name }}<br>
                                        Cena: {{ $deal->price }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('deals.show', $deal->id) }}" class="btn btn-sm btn-outline-secondary">Zobacz więcej</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
<script>
    window.onload = function() {
        var badges = document.querySelectorAll('.points-badge');
        badges.forEach(function(badge) {
            var points = badge.getAttribute('data-points');
            if (points > 0) {
                badge.style.color = 'red';
            } else if (points < 0) {
                badge.style.color = 'blue';
            } else {
                badge.style.color = 'black';
            }
        });
    };
</script>
</body>
</html>
