<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></head>
<body class="bg-dark-subtle">
    <div class="container pb-5 d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
            <h1 class="display-1 fw-bold text-black">403</h1>
            <h2 class="h1"><span class="text-danger">Oops!</span> This Page is Forbidden</h2>
            <p class="fw-semibold fs-5">This Means That Your <span class="text-danger">Not Authorized!</span></p>
            <a href="/dashboard" class="btn btn-dark bg-gradient">Go To Home</a>
        </div>
    </div>
</body>
</html>
