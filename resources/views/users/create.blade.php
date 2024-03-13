@extends('users.layouts')

@section('content')
<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
      <p class="text-center small">Enter your personal details to create account</p>
    </div>

    <form class="row g-3 needs-validation" action="{{route('create.user')}}" method="post" enctype="multipart/form-data">
      <div class="col-12">
        <label for="yourName" class="form-label"> Name</label>
        <input type="text"  name="name" value="{{old('name')}}" class="form-control  @error('name') is-invalid @enderror" id="yourName" required>
        @error('name') <p class="alert alert-danger">{{$message}}</p> @enderror
        <div class="invalid-feedback">Please, enter your name!</div>
      </div>

      <div class="col-12">
        <label for="yourEmail" class="form-label">Your Email</label>
        <div class="input-group has-validation">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="yourEmail" required>
        @error('email') <p class="alert alert-danger">{{$message}}</p> @enderror
        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
        </div>
      </div>

      <div class="col-12">
        <label for="yourUsername" class="form-label">Phone Number</label>
        <div class="input-group has-validation">
          <input type="text" name="username" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" id="yourUsername" required>
          @error('phone') <p class="alert alert-danger">{{$message}}</p> @enderror
          <div class="invalid-feedback">Please enter phone number.</div>
        </div>
      </div>

      <div class="col-12">
        <label for="yourUsername" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="yourUsername" required>
          <div class="invalid-feedback">Please choose a username.</div>
      </div>

      <div class="col-12">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>
        @error('password') <p class="alert alert-danger">{{$message}}</p> @enderror
        <div class="invalid-feedback">Please enter your password!</div>
      </div>

      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
          <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
          <div class="invalid-feedback">You must agree before submitting.</div>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Create Account</button>
      </div>
      <div class="col-12">
        <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Log in</a></p>
      </div>
    </form>

  </div>
</div>
@endsection