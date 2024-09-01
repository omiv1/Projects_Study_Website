<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAI | Dodaj deal</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        .box {
            display: flex;
            justify-content: center;
        }
        .box-footer{
            float: right;
        }
    </style>
</head>
@include('layouts.navbar')
{{--<body>--}}
{{--<div class="table-container">--}}
{{--    <div class="title"> <h3>Dodaj nowy deal</h3> </div>--}}
{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <div class="box box-primary ">--}}
{{--        <!-- /.box-header -->--}}
{{--        <!-- form start -->--}}
{{--        <form role="form"  action="{{ route('deals.store') }}" id="deal-form"--}}
{{--              method="post" enctype="multipart/form-data" >--}}
{{--            {{ csrf_field() }}--}}
{{--            <div class="box">--}}
{{--                <div class="box-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Producent</b></label> <br>--}}
{{--                        <input type="text" name="manufacturer" id="manufacturer" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Link do oferty</b></label> <br>--}}
{{--                        <input type="text" name="deal_link" id="deal_link" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Link do obrazka</b></label> <br>--}}
{{--                        <input type="text" name="image_link" id="image_link" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Model</b></label> <br>--}}
{{--                        <input type="text" name="model" id="model" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Nazwa</b></label> <br>--}}
{{--                        <input type="text" name="name" id="name" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Kod produktu</b></label> <br>--}}
{{--                        <input type="text" name="product_code" id="product_code" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>ID kategorii</b></label> <br>--}}
{{--                        <input type="number" name="category_id" id="category_id" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>ID podkategorii</b></label> <br>--}}
{{--                        <input type="number" name="subcategory_id" id="subcategory_id" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Cena</b></label> <br>--}}
{{--                        <input type="number" name="price" id="price" step="0.01" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Data dodania</b></label> <br>--}}
{{--                        <input type="datetime-local" name="added_at" id="added_at" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label><b>Czy ukryty?</b></label> <br>--}}
{{--                        <input type="checkbox" name="shadow" id="shadow">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="box-footer"><button type="submit" class="btn btn-success">Dodaj deal</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--<body>--}}
{{--<div class="table-container">--}}
{{--    <div class="title"> <h3>Dodaj ofertę</h3> </div>--}}
{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <div class="box box-primary ">--}}
{{--        <!-- form start -->--}}
{{--        <form method="POST" action="{{ route('storeDeal') }}">--}}
{{--            @csrf--}}
{{--            <label for="manufacturer">Manufacturer:</label><br>--}}
{{--            <input type="text" id="manufacturer" name="manufacturer"><br>--}}
{{--            <label for="deal_link">Deal Link:</label><br>--}}
{{--            <input type="text" id="deal_link" name="deal_link"><br>--}}
{{--            <label for="image_link">Image Link:</label><br>--}}
{{--            <input type="text" id="image_link" name="image_link"><br>--}}
{{--            <label for="model">Model:</label><br>--}}
{{--            <input type="text" id="model" name="model"><br>--}}
{{--            <label for="name">Name:</label><br>--}}
{{--            <input type="text" id="name" name="name"><br>--}}
{{--            <label for="product_code">Product Code:</label><br>--}}
{{--            <input type="text" id="product_code" name="product_code"><br>--}}
{{--            <label for="category_id">Category ID:</label><br>--}}
{{--            <input type="text" id="category_id" name="category_id"><br>--}}
{{--            <label for="subcategory_id">Subcategory ID:</label><br>--}}
{{--            <input type="text" id="subcategory_id" name="subcategory_id"><br>--}}
{{--            <label for="price">Price:</label><br>--}}
{{--            <input type="text" id="price" name="price"><br>--}}
{{--            <label for="added_at">Added At:</label><br>--}}
{{--            <input type="datetime-local" id="added_at" name="added_at"><br>--}}
{{--            <label for="shadow">Shadow:</label><br>--}}
{{--            <input type="checkbox" id="shadow" name="shadow"><br>--}}
{{--            <input type="submit" value="Submit">--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>Dodaj ofertę</h3></div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="POST" action="{{ route('storeDeal') }}">
                            @csrf
                            <div class="form-group">
                                <label for="manufacturer">@lang('my_name.manufacturer'):</label>
                                <input type="text" id="manufacturer" name="manufacturer" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="deal_link">@lang('my_name.deal_link'):</label>
                                <input type="text" id="deal_link" name="deal_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image_link">@lang('my_name.image_link'):</label>
                                <input type="text" id="image_link" name="image_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="model">@lang('my_name.model'):</label>
                                <input type="text" id="model" name="model" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('my_name.name'):</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="product_code">@lang('my_name.product_code'):</label>
                                <input type="text" id="product_code" name="product_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">@lang('my_name.category'):</label>
                                <select id="category_id" name="category_id" class="form-control" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory_id">@lang('my_name.subcategory'):</label>
                                <select id="subcategory_id" name="subcategory_id" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">@lang('my_name.price'):</label>
                                <input type="text" id="price" name="price" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" value="@lang('my_name.submit')" class="btn btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('category_id').addEventListener('change', function() {
        var categoryId = this.value;
        fetch('/get-subcategories/' + categoryId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('subcategory_id').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>
