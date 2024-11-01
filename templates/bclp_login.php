<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCLP System</title>
    <link href="static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
<!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--> 

<style>

body {
    margin: 0;
    background-image: url('static/img/bglogin.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
}

h2  {
    font-size: 2em;
    color: #fff;
    text-align: center;
}

.mb-3 {
    color: #fff;
}

.card {
    margin-top: 120px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background: transparent;
    border: 3px solid rgba(255,255,255,0.5);
    border-radius: 30px;
    backdrop-filter: blur(10px);
}

.card-body {
    padding: 20px;
}

.form-label {
    font-weight: bold;
}

.form-control {
    height: 40px;
    padding: 10px;
    font-size: 16px;
}

.btn-primary {
    background-color: #337ab7;
    border-color: #337ab7;
    color: #ffffff;
}

.btn-primary:hover {
    background-color: #23527c;
    border-color: #23527c;
}

i{
      cursor: pointer;
    }

    img{
      width: 100px;
      height: 100px;
      border-radius: 50%
    }
    #back{
        color: #ffffff ;
    }
</style>

</head>
<body>                
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="container">
                        <div class="col mt-3">
                          <a href="/index">
                            <i id="back" class="fas fa-arrow-alt-circle-left fa-2x"></i>
                          </a>
                          <img src="static/webimg/logo.png" class="rounded mx-auto d-block" alt="...">
                        </div>
                    </div>
                        <div class="card-body">
                            <h2 class="text-center">BCLP System Login</h2>
                            <form action="/login" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="form-group input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                                    <div class="input-group-text" onclick="password_show_hide();">
                                        <i class="fa fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </div>
                                </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </form>
                            
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
    <script> 
  function password_show_hide() {
  var x = document.getElementById("password");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
</script>

</body>
<script src="static/js/bootstrap.bundle.js"></script>
</html>