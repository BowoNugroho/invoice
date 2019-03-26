<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
</head>
<body>
    <header>
        <nav>
            <a href = "/home">Home</a> 
            <a href = "/fromInvoice">Transaction</a> 
            <a href = "/listTransaksi">List Transaksi</a> 
        </nav>
    </header>
<br>

@yield('content')

<br>
    <footer>
        <p style="text-align:center">
        &copy:latihan invoice 2019
        </p>
    </footer>
<script src="{{asset('/js/jquery-3.3.1.min.js')}}"></script>
</body>
</html>