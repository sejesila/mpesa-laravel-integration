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
                <div class="card-header">Obtain Access Token</div>

                <div class="card-body">
                    <button id="getAccessToken" class="btn btn-primary">Request Access token</button>
                    <h4 id="access_token"></h4>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Register URLs</div>
                <div class="card-body">
                    <button id="registerURLS" class="btn btn-primary">Register URLs</button>
                    <h4 id="response"></h4>
                </div>
            </div>


            <div class="card">
                <div class="card-header">Simulate Transactions</div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                        </div>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" class="form-control" id="account">
                        </div>
                        <button id="simulatec2b" class="btn btn-primary">Simulate</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
