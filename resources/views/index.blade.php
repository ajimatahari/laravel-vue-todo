<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content={{ csrf_token() }}>
  <title>Vue To Do</title>

  <link rel="stylesheet" href={{ asset('css/app.css') }}>
</head>
<body>
  <div id="app">
    <todo></todo>
  </div>
  <script src={{ asset('js/app.js') }}></script>
</body>
</html>