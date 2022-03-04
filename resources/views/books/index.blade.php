<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head></head>
<body>

<h1>Book store</h1>

<ul>
    @foreach ($books as $book)
        <li>
            <a href="books/{{$book->id}}">
            {{$book->isbn}}<br />{{$book->title}}
            </a>
        </li>
    @endforeach
</ul>

</body>
</html>
