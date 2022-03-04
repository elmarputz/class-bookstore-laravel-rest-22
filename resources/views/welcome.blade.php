<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head></head>
    <body>

        <h1>Book store</h1>

        <ul>
        @foreach ($books as $book)
            <li>{{$book->isbn}}<br />{{$book->title}}</li>
        @endforeach
        </ul>

    </body>
</html>
