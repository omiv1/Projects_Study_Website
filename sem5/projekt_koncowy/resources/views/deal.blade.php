<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>TAI | Szczegóły okazji</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
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
        .deal-points-container {
            display: inline-block;
            border: 2px solid #b6b6b6;
            border-radius: 50%;
            padding: 10px;
            background-color: #575757;
        }

        .deal-points {
            font-size: 24px;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .clicked {
            background-color: #ffce09 !important;
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container">
    <h1>Szczegóły okazji</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $deal->image_link }}" alt="{{ $deal->name }}" class="bd-placeholder-img card-img-top" style="max-height: 350px; width: auto; object-fit: contain;">
            <div id="deal-points" class="points-badge" data-points="{{ $deal->points }}">{{ $deal->points }}</div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
{{--                <div class="deal-points-container">--}}
{{--                    <span id="deal-points" class="deal-points">{{ $deal->points }}</span>--}}
{{--                </div>--}}
                @if(Auth::check())
                    <button id="upvote-button" class="btn btn-success {{ $user_vote == 1 ? 'clicked' : '' }}" onclick="rateDeal({{ $deal->id }}, 1)">
                        <i class="fas fa-thumbs-up"></i>
                    </button>
                    <button id="downvote-button" class="btn btn-danger {{ $user_vote == -1 ? 'clicked' : '' }}" onclick="rateDeal({{ $deal->id }}, -1)">
                        <i class="fas fa-thumbs-down"></i>
                    </button>
                @endif
                <h5 class="card-title">{{ $deal->name }}</h5>
                <p class="card-text">
                    Producent: {{ $deal->manufacturer }}<br>
                    Model: {{ $deal->model }}<br>
                    Kod produktu: {{ $deal->product_code }}<br>
                    Cena: {{ $deal->price }}<br>
                    Dodano: {{ $deal->added_at }}<br>
                    <a href="{{ $deal->deal_link }}" class="btn btn-primary" target="_blank">Przejdź do strony</a>
                </p>
            </div>
        </div>
    </div>
</div>
{{--<div class="container">--}}
{{--    <h2>Komentarze</h2>--}}
{{--    @if($deal->comments)--}}
{{--        @foreach($deal->comments as $comment)--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <p>{{ $comment->content }}</p>--}}
{{--                    <p>Added at: {{ $comment->added_at }}</p>--}}
{{--                    @if(auth()->check() && auth()->user()->id === $comment->user_id)--}}
{{--                        <a href="{{ route('comments.edit', $comment) }}">Edit</a>--}}
{{--                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit">Delete</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                    @if(auth()->check())--}}
{{--                        <form method="POST" action="{{ route('comments.report', $comment) }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit">Report</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    @endif--}}
{{--    @if(auth()->check())--}}
{{--        <form method="POST" action="{{ route('comments.store') }}">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="deal_id" value="{{ $deal->id }}">--}}
{{--            <textarea name="content"></textarea>--}}
{{--            <button type="submit">Add Comment</button>--}}
{{--        </form>--}}
{{--    @endif--}}
{{--</div>--}}

<script>
    function rateDeal(dealId, points) {
        fetch('/deals/rate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                deal_id: dealId,
                points: points
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                let dealPointsElement = document.getElementById('deal-points');
                if (dealPointsElement) {
                    dealPointsElement.textContent = json.points;
                } else {
                    console.error("Element 'deal-points' does not exist in the DOM.");
                }

                let upvoteButton = document.getElementById('upvote-button');
                let downvoteButton = document.getElementById('downvote-button');

                if (points == 1) {
                    if (upvoteButton && downvoteButton) {
                        if (upvoteButton.classList.contains('clicked')) {
                            upvoteButton.classList.remove('clicked');
                        } else {
                            upvoteButton.classList.add('clicked');
                            downvoteButton.classList.remove('clicked');
                        }
                    }
                } else {
                    if (upvoteButton && downvoteButton) {
                        if (downvoteButton.classList.contains('clicked')) {
                            downvoteButton.classList.remove('clicked');
                        } else {
                            downvoteButton.classList.add('clicked');
                            upvoteButton.classList.remove('clicked');
                        }
                    }
                }
            })
            .catch(function(error) {
                console.error("Fetch request failed: ", error);
            });
    }

    window.onload = function() {
        var badges = document.querySelectorAll('.points');
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
