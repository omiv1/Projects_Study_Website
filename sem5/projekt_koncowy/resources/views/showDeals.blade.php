<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>TAI | Okazje</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include('layouts.navbar')
<div class="container">
    <h1>Wszystkie okazje</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Manufacturer</th>
            <th>Deal Link</th>
            <th>Image Link</th>
            <th>Model</th>
            <th>Name</th>
            <th>Product Code</th>
            <th>Category ID</th>
            <th>Subcategory ID</th>
            <th>Price</th>
            <th>Added At</th>
            <th>Shadow</th>
            <th>User ID</th>
            <th>Points</th>
        </tr>
        </thead>
        <tbody>
        @foreach($deals as $deal)
            <tr>
                <td>{{ $deal->manufacturer }}</td>
                <td>{{ $deal->deal_link }}</td>
                <td>{{ $deal->image_link }}</td>
                <td>{{ $deal->model }}</td>
                <td>{{ $deal->name }}</td>
                <td>{{ $deal->product_code }}</td>
                <td>{{ $deal->category_id }}</td>
                <td>{{ $deal->subcategory_id }}</td>
                <td>{{ $deal->price }}</td>
                <td>{{ $deal->added_at }}</td>
                <td>{{ $deal->shadow }}</td>
                <td>{{ $deal->user_id }}</td> <!-- Nazwa użytkownika -->
                <td>{{ $deal->points }}</td> <!-- Liczba punktów -->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
