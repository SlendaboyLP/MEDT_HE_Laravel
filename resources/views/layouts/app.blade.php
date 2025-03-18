<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemoLaravel - @yield('title')</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
        }
        .header {
            display: flex;
            align-items: center;
        }
        .image {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

</head>
<body>
    <script  src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    @section('sidebar')
    <div class="header">
        <img class="image" src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" alt="Laravel Logo">
        <h1>Invoice Editor</h1>
    </div>
    @show

    <div class="container">
        @yield('content')
        @yield('scripts')
    </div>

    <footer>
        <p><a href="/impressum">Impressum</a> - {{ date('d-m-Y') }}</p>
    </footer>



</body>
</html>