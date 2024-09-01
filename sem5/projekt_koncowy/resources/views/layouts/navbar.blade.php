<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <!-- Language Links -->
        <div class="mr-auto">
            <a href="{{ route('lang.switch', 'en') }}" class="mr-3" > EN </a>
            <a href="{{ route('lang.switch', 'pl') }}" class="mr-3" > PL </a>
        </div>

        <!-- Authentication Links -->
        <div class="ml-auto">
            <!-- Authentication Links -->
            @guest
                <a href="{{ route('login') }}" class="mr-3" > @lang('my_name.login') </a>
                <a href="{{ route('register') }}" > @lang('my_name.register') </a>
            @endguest
            @auth
                <a href="{{ route('profile.edit') }}" class="mr-3" > {{ Auth::user()->name }} </a>
                <a href="{{ route('logout') }}" > @lang('my_name.logout') </a>

{{--                //<a href="{{ route('profile.edit') }}" > @lang('my_name.profile') </a>--}}
            @endauth
        </div>
    </div>
</nav>
@auth
    @if(Auth::user()->role == 'moderator')
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">

        <!-- Authentication Links -->
            <a href="{{ route('addCategory') }}" class="btn btn-primary"> @lang('my_name.addCategory') </a>
            <a href="{{ route('addSubCategory') }}" class="btn btn-primary"> @lang('my_name.addSubCategory') </a>
        <a href="{{ route('categoriesWithSubcategories') }}" class="btn btn-primary"> @lang('my_name.category') </a>

    </div>
</nav>
@endif
@endauth
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
{{--        <a href="{{ url('/') }}" class="btn btn-primary"> @lang('my_name.home') </a>--}}
        <a href="{{ url('/') }}">
            <img src="{{ asset('imgs/logo.png') }}" style="height: 80px; width: auto;" alt="@lang('my_name.home')">
        </a>
        @auth
{{--        <a href="{{ route('comments') }}" class="btn btn-primary"> @lang('my_name.comments') </a>--}}
        <a href="{{ route('addDeal') }}" class="btn btn-primary"> @lang('my_name.addDeal') </a>
        @endauth
        <a href="{{ route('deals') }}" class="btn btn-primary"> @lang('my_name.deals') </a>

        <!-- Authentication Links -->
        {{--        @guest--}}
        {{--            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>--}}
        {{--        @endguest--}}

    </div>
</nav>
