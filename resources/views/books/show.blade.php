<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head></head>
<body>

<h1>{{$book->title}}</h1>

<p>{{$book->subtitle}}</p>
<p>{{$book->isbn}}</p>

<hr />
<a href="/">Zurück zur Übersicht</a>



</body>
</html>
