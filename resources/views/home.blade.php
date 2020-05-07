<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    </head>

    <body>
    @foreach($product as $p)
        <span>{{p.name}}</span>

    </body>
</html>
