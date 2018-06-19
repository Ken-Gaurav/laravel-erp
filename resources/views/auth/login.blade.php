<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>SwissPac Pvt Ltd</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import "https://fonts.googleapis.com/css?family=Ubuntu:400,700italic";
@import "https://fonts.googleapis.com/css?family=Cabin:400";
* {
  box-sizing: border-box;
}

html {
  background: #555;
  background-size: cover;
  font-size: 10px;
  height: 100%;
  overflow: hidden;
  position: absolute;
  text-align: center; 
  width: 100%;
}

/* =========================================
Stark Industries Logo
========================================= */
#logo {
  animation: logo-entry 4s ease-in;
  width: 500px;
  margin: 0 auto;
  position: relative;
  z-index: 40;
}

h3 {
  
  font-family: 'Ubuntu', sans-serif;
  color: #00a4a2;
  
  font-size: 24px;
  font-weight: bold;
  position: absolute;
  text-shadow: 0 0 10px #000, 0 0 20px #000, 0 0 30px #000, 0 0 40px #000, 0 0 50px #000, 0 0 60px #000, 0 0 70px #000;
  top: 100px;
}
h4{
    font-family: 'Cabin', helvetica, arial, sans-serif;
    color: #fff;
     font-size: 13px;
}

/* =========================================
Log in form
========================================= */
#fade-box {
  animation: input-entry 3s ease-in;
  z-index: 4;
}

.stark-login form {
  animation: form-entry 3s ease-in-out;
  background: #111;
  background: linear-gradient(#004746, #111111);
  border: 6px solid #00a4a2;
  box-shadow: 0 0 15px #00fffd;
  border-radius: 5px;
  display: inline-block;
  height: 270px;
  margin: 160px auto 0;
  position: relative;
  z-index: 4;
  width: 500px;
  transition: 1s all;
}
.stark-login form:hover {
  border: 6px solid #00fffd;
  box-shadow: 0 0 25px #00fffd;
  transition: 1s all;
}
.stark-login #login {
  background: #222;
  background: linear-gradient(#333333, #222222);
  border: 1px solid #444;
  border-radius: 5px;
  box-shadow: 0 2px 0 #000;
  color: #888;
  display: block;
  font-family: 'Cabin', helvetica, arial, sans-serif;
  font-size: 13px;
  font-size: 1.3rem;
  height: 40px;
  margin: 20px auto 10px;
  padding: 0 10px;
  text-shadow: 0 -1px 0 #000;
  width: 400px;
}
.stark-login #login:focus {
  animation: box-glow 1s ease-out infinite alternate;
  background: #0B4252;
  background: linear-gradient(#333933, #222922);
  border-color: #00fffc;
  box-shadow: 0 0 5px rgba(0, 255, 253, 0.2), inset 0 0 5px rgba(0, 255, 253, 0.1), 0 2px 0 #000;
  color: #efe;
  outline: none;
}
.stark-login #login:invalid {
  border: 2px solid red;
  box-shadow: 0 0 5px rgba(255, 0, 0, 0.2), inset 0 0 5px rgba(255, 0, 0, 0.1), 0 2px 0 #000;
}
.stark-login button {
  animation: input-entry 3s ease-in;
  background: #222;
  background: linear-gradient(#333333, #222222);
  box-sizing: content-box;
  border: 1px solid #444;
  border-left-color: #000;
  border-radius: 5px;
  box-shadow: 0 2px 0 #000;
  color: #fff;
  display: block;
  font-family: 'Cabin', helvetica, arial, sans-serif;
  font-size: 13px;
  font-weight: 400;
  height: 40px;
  line-height: 40px;
  margin: 20px auto;
  padding: 0;
  position: relative;
  text-shadow: 0 -1px 0 #000;
  width: 400px;
  transition: 1s all;
}
.stark-login button:hover,
.stark-login button:focus {
  background: #0C6125;
  background: linear-gradient(#393939, #292929);
  color: #00fffc;
  outline: none;
  transition: 1s all;
}
.stark-login button:active {
  background: #292929;
  background: linear-gradient(#393939, #292929);
  box-shadow: 0 1px 0 #000, inset 1px 0 1px #222;
  top: 1px;
}



    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div id="logo"> 
  <h3><i>&nbsp;&nbsp;Swiss Pac Pvt Ltd</i></h3>
</div> 
<section class="stark-login">
    @if(Session::get('success_add'))
                    <div class="alert alert-success">
                        {{Session::get('success_add')}}
                    </div>
                @endif
                @if(Session::get('failure_add'))
                    <div class="alert alert-danger">
                        {{Session::get('failure_add')}}
                    </div>
                @endif
  
  <form class="m-t-20" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
    <div id="fade-box">
     
        <div class="form-group row {{ $errors->has('username') ? ' has-error' : '' }}"> 
            <div class="col-12">
                    <input id="login" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="User name">

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
            </div>            
        </div>

        <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-12">
                <input id="login" type="password" class="form-control" name="password" placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>           
        </div>

        <div class="form-group">
            <div class="col-8">
                <button type="submit">Log In</button>
             </div>
        </div>   
     
     <div class="">
      <div class="col-lg-6">
            <label><h4><input type="checkbox" name="remember">
               Remember me</h4></label>
                <a href="{{ url('/password/reset') }}"><h4><i class="fa fa-key"></i>Forgot your password ?</h4></a>
            
        </div></div>  

      </form>
        
            </section> 
            
           
            
            
            
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
