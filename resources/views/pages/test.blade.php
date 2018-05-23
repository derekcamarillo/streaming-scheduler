@extends('layouts.default')
@section('content')

@stop

@section('script')
    <script>
        $(function() {
           alert('{{ $customer }} {{ $project }} {{ $url }}');
        });
    </script>
@stop