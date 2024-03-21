@extends('layouts.blank')

@section('content')
<style>
  .input-container {
    position: relative;
    margin-bottom: 1rem;
  }
  .input-form {
    padding: 5px;
    width: 100%;
    border: none;
      outline: none; 
  }
  label {
    position: absolute;
    top: 6px;
    left: 10px;
    transition: 0.2s;
    pointer-events: none;
  }
  .input-form:focus + label, .input-form:valid + label {
    top: -20px;
    font-size: 12px;
    color: #666;
  }
</style>  
  <div class="card-body" style="background-color: #eee;">
    <form method="POST" action="/login">
      @csrf
      <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100 col-md-7">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="d-flex">
                <a href="/" style="text-decoration: none; color: black;" ><span type="button" class="pb-2 mb-0 align-middle"><i class="bi bi-arrow-left-square fa-2x m-0"></i> Back to Homepage</span></a>
              </div>
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-6 col-xl-5 order-2 order-lg-1">
                      <div class="p-3" style="border-radius: 10px; box-shadow: 5px 5px 15px #c9c9c9, -5px -5px 15px #ffffff;">
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="input-container flex-fill mb-0">
                            <input type="text" id="email" class="form-control input-form" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            <label for="email">Email</label>
                            @error('email')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @if ($errors->any())
                          <div class="alert alert-danger" style="">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="input-container flex-fill mb-0">
                            <input type="password" id="password" class="form-control input-form @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            <label for="password">Password</label>
                            @error('password')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input class="form-check-input" type="checkbox" value="" id="remember" />
                          <p class="form-check-label" for="remember">
                            Remember me
                          </p>
                        </div>
                        <div class="d-block justify-content-center text-center  mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-primary btn-md px-5 mb-2">{{ __('Login') }}</button>
                          <br>
                          @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                              {{ __('Forgot Your Password?') }}
                            </a>
                          @endif
                        </div>
                        <div class="text-center" style="font-size: 13px;">
                          <a href="/register">Don't have an account yet?</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-block align-items-center text-center order-1 order-lg-2 p-4 mt-3">
                      <div>
                        <img src="{{ asset('images/six-eleven-logo.png') }}">
                      </div>
                      <div>
                        <h1 class="display-3 fw-bold ls-tight" style="color: #09D500;">
                          Six Eleven <br />
                          <span style="color:#31559D;">Global Services <span style="color: black;">Portal</span></span>
                        </h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
  </div>
<script>
    const inputs = document.querySelectorAll('input');
inputs.forEach(input => {
  input.addEventListener('input', () => {
    if ((input.value.trim() !== '') || (input.type === 'email' && input.validity.valid)) {
      input.classList.add('valid');
    } else {
      input.classList.remove('valid');
    }
  });
});
const emailInput = document.querySelector('input[type="email"]');
emailInput.addEventListener('input', () => {
  if (emailInput.validity.valid) {
    emailInput.classList.add('valid');
  } else {
    emailInput.classList.remove('valid');
  }
});
  </script>
@endsection
