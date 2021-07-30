<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MPESA Integration</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">


</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-8 mx-auto">

            <div class="card">
                <div class="card-header">STK Transactions</div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                        </div>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" class="form-control" id="account">
                        </div>
                        <button id="stkpush" class="btn btn-primary">STK Push</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
