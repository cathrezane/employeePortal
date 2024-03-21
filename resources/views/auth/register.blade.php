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
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <section class="vh-100" style="background-color: #eee;">
                <div class="container h-100 col-md-7">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-12 col-xl-11">
                            <div class="d-flex">
                                <a href="/" style="text-decoration: none; color: black;" ><span type="button" class="pb-2 mb-0 align-middle"><i class="bi bi-arrow-left-square fa-2x m-0"></i> Back to Homepage</span></a>
                              </div>
                            <div class="card text-black" style="border-radius: 25px; ">
                                <div class="card-body p-md-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-6 col-xl-5 order-2 order-lg-1">
                                            <div class="p-2" style="border-radius: 10px; box-shadow: 5px 5px 15px #c9c9c9, -5px -5px 15px #ffffff;">
                                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                                <form class="mx-1 mx-md-4">
                                                    <div class="d-flex flex-row align-items-center mb-4 ">
                                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                        <div class="input-container flex-fill mb-0">
                                                            <input type="text" id="form3Example1c" class="form-control input-form @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label>Name</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                        <div class="input-container flex-fill mb-0">
                                                            <input type="text" id="form3Example3c" class="form-control input-form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label>Email</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                        <div class="input-container flex-fill mb-0">
                                                            <input type="password" id="form3Example4c" class="form-control input-form @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label>Password</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                        <div class="input-container  flex-fill mb-0">
                                                            <input type="password" id="form3Example4cd" class="form-control input-form" name="password_confirmation" required autocomplete="new-password" />
                                                            <label>Repeat your password</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-check d-flex justify-content-center mb-5">
                                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                                        <p class="form-check-label" for="form2Example3">
                                                            I agree all statements in <a href="#!">Terms of service</a>
                                                        </p>
                                                    </div>

                                                    <div class="d-block justify-content-center text-center mx-5 mb-3 mb-lg-4">
                                                        <button type="submit" class="btn btn-primary btn-md px-5 mb-2">{{ __('Register') }}</button>
                                                        <br>
                                                    </div>
                                                    <div class="text-center" style="font-size: 13px;">
                                                        <a href="/login">Already signed up?</a>
                                                    </div>
                                                </form>
                                            </div>

              </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-block align-items-center text-center pt-5 order-1 order-lg-2">
                    <div class="p-4">
                        <img src="{{ asset('images/six-eleven-logo.png') }}" height="180">
                    </div>
                    <div>
                        <h1 class="display-4 ls-tight" style="color: #09D500;">
                            Six Eleven <br />
                            <span  style="color:#31559D;">Global Services <span class="text-black">Portal</span></span>
                          </h1>
                    </div>
                </div>
            </div>
          </div>
</section>
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
