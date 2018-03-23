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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/filterable.pack.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/jquery.simplyscroll.js"></script> -->
    <script src="js/wow.min.js"></script>
    <script src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
</body>
</html>