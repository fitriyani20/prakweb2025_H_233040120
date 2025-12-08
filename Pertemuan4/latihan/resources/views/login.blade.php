@extends('components.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf {{-- Token CSRF wajib untuk form Laravel --}}

                        {{-- Input Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection\