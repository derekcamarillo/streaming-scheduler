<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>

<body>
    @include('includes.header')

    <section class="contaneSection">
        <div class="container">
            @yield('content')
        </div>
    </section>

    @include('includes.footer')

    @yield('script')
</body>
</html>