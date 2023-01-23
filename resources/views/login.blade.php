<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/pages/auth.css">
</head>

<body class="bg-primary">
    <div class="d-flex justify-content-center m-3">

        <form action="" class="bg-white p-5 rounded m-5 col-12 col-md-4">
            <h4 class="text-center"> Login Aplikasi</h4>

        <form action="/login" method="POST" class="bg-white p-5 rounded m-5 col-12 col-md-4">
            @csrf
            <h4 class="text-center"> Login Aplikasi</h4>
            
            @if($errors->any())
                    @foreach($errors->all() as $err)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> {{ $err }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                @endif

            <hr>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-primary"> Login</button>
            </div>
        </form>
    </div>
</body>

</html>