
@extends('index')
@section('title', 'Sign Up')

@section('content')
  <div class="card w-25">
    <div class="card-header"><strong>Sign Up</strong></div>
    <form action="{{ route("registerUser") }}" method="POST">
      @csrf
      <div class="card-body">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" required name="email">
        </div>
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" required name="name">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" required onfocusout="checkPass(this.value)" name="password">
          <small class="text-danger d-none" id="passwordValidation"></small>
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" required onfocusout="matchPassword()">
          <small class="text-danger d-none" id="passwordMatch">Password not matched</small>
        </div>
        <div class="mb-3 d-flex">
          <span>Already a member? <a href="{{ route("login") }}">Login</a></span>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-success" id="submit" disabled>Register</button>
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script >
    var checkLength = true;
    var checkLower = checkUpper = checkNumber = isMatchPassword = false;
    var errorMessage = []

    function checkPass(password) {  
      errorMessage = []
      if(password.length < 8){
        checkLength = false;
        errorMessage.push("minimum length 8")
      }
      
      password.split('').forEach(item => {
        if(item >= 'a' && item <= 'z'){
          checkLower = true;
        }
        if(item >= 'A' && item <= 'Z'){
          checkUpper = true;
        }

        if(parseInt(item) >= 0 && parseInt(item) <= 9){
          checkNumber = true;
        }
      });

      if(!checkLower){
        errorMessage.push("one lowercase")
      }
      if(!checkUpper){
        errorMessage.push("one uppercase")
      }
      if(!checkNumber){
        errorMessage.push("one number")
      }
      
      if(errorMessage.length == 0 ){
        if(isMatchPassword){
          $("#submit").removeAttr('disabled')
        }else{
          $("#submit").attr('disabled')
        }
        $('#passwordValidation').addClass('d-none')
      }else{
        $('#passwordValidation').removeClass('d-none')
        $('#passwordValidation').text("Password should contain "+ errorMessage.join(', '))
      }
    }

    function matchPassword(){
      var password = $("#password").val()
      var confirmPassword = $("#confirmPassword").val()
      if(password != confirmPassword){
        $('#passwordMatch').removeClass('d-none')
      }else{
        isMatchPassword = true;
        if(errorMessage.length == 0){
          $("#submit").removeAttr('disabled')
        }else{
          $("#submit").attr('disabled')
        }
        $('#passwordMatch').addClass('d-none')
      }
    }
  </script>
@endsection