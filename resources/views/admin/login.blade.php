<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Add custom styles here if needed */
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row mt-5 mb-2">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm p-4">
                     <div class="card-header bg-white text-center">
                        <h3 class="mt-2">Admin Login</h3>
                    </div>
                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger mt-2 mb-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->has('email') && !$errors->has('password'))
                             <div class="alert alert-danger mt-2 mb-2">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.auth') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                <label for="email">Email address <span class="text-danger">*</span></label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password <span class="text-danger">*</span></label>
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid mb-2">  {{-- Use d-grid for full-width button --}}
                                <button class="btn btn-lg btn-dark" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> 