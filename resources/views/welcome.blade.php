@extends('layout.app')
@section('title','Login Page')
@section('content')


<div class="card-center">

    <div class="col s6 m4 ">
        <div class="card-panel">
            <h4 class="center">Login Page</h4>
            <br>
            <form action="">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>

                <p>
                    <label>
                      <input type="checkbox" />
                      <span>Remember Me</span>
                    </label>
                  </p>
            
            <div class="card-action">
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                  </button>
                  <button class="btn waves-effect waves-teal" type="submit" name="action">Forgot password
                    <i class="material-icons right">vpn_key</i>
                  </button>
              </div>
            </form>
       
        
    </div>
</div>
</div>


@endsection
