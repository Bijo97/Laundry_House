<?php
  session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Laundry House</title>
    <style>
      #map {
        height: 400px;
        width: 100%;
        background-color: grey;
      }

      .logo{
        width: 70%;
        height: auto;
      }

      .rating{
        width: 30px;
        height: auto;
      }
    </style>  
  </head>
  <body>

    <?php if (isset($_SESSION['user'])){ 
      if ($_SESSION['priority'] == 1){ ?>
      <header id="fh5co-header">
        <div class="container">
          <nav>
            <ul >
              <li><a class="nav-link" onclick="home()" href="#"><span><font color="white">Home</font></span></a></li>
              <li><a class="nav-link" href="#about"><span><font color="white">About Us</font></span></a></li>
              <li><a class="nav-link" href="#service"><span><font color="white">Services</font></span></a></li>
              <li><a class="nav-link" href="#toplaundries"><span><font color="white">Top Laundries</font></span></a></li>
              <li><a class="nav-link" href="#checkorder"><span><font color="white">Check Order</font></span></a></li>
              <li><a class="nav-link" href="#" onclick="logout(<?php echo $_SESSION['id_user']; ?>)"><span><font color="white">Log Out (<?php echo $_SESSION['user']; ?>)</font></span></font></a></li>
            </ul>
          </nav>
        </div>
      </header>
    <?php
      } else {
    ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Laundry House</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" onclick="home()" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
         
        </ul>
      
          <ul class='navbar-nav ml-auto'>
            <li class="nav-item">
              <a class="nav-link" href="#">Hello, <?php echo $_SESSION['user']; ?>!</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="logout(<?php echo $_SESSION['id_user']; ?>)">Log Out</a>
            </li>
          </ul>
       
      </div>
    </nav>
    <?php
      }
     }else{
    ?>
    <header id="fh5co-header">
      <div class="container">
        <nav>
          <ul >
            <li><a class="nav-link" onclick="home()" href="#"><span><font color="white">Home</font></span></a></li>
            <li><a class="nav-link" href="#about"><span><font color="white">About Us</font></span></a></li>
            <li><a class="nav-link" href="#service"><span><font color="white">Services</font></span></a></li>
            <li><a class="nav-link" href="#toplaundries"><span><font color="white">Top Laundries</font></span></a></li>
            <li><a class="nav-link" href="#checkorder"><span><font color="white">Check Order</font></span></a></li>
            <li><a class="nav-link" href="#" data-toggle="modal" data-target="#login-modal"><span><font color="white">Login</font></span></font></a></li>
            <li><a class="nav-link" href="#" data-toggle="modal" data-target="#register-modal"><span><font color="white">Register</font></span></font></a></li>
          </ul>
        </nav>
      </div>
    </header>

    <?php
     }
     ?>



        <!-- Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="login()">Log In</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Name" />
            </div>
            <div class="form-group">
              <textarea name="alamat" id="alamat" class="form-control" placeholder="Address"></textarea>
            </div>
            <div class="form-group">
              <select id="kota" name="kota" class="form-control">
                <option value="-">Pilih Kota:</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Bandung">Bandung</option>
                <option value="Jakarta">Jakarta</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="telp" id="telp" class="form-control" placeholder="Phone Number" />
            </div>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail" />
            </div>
            <div class="form-group">
              <input type="text" name="reg-username" id="reg-username" class="form-control" placeholder="Username" />
            </div>
            <div class="form-group">
              <input type="password" name="reg-password" id="reg-password" class="form-control" placeholder="Password" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="register()">Register</button>
          </div>
        </div>
      </div>
    </div>


   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script>
      //url: 'http://localhost:8000/public/laundry/top',
		

        function register(){
       // alert('x');
        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        var kota = $('#kota').val();
        var telp = $('#telp').val();
        var email = $('#email').val();
        var user = $('#reg-username').val();
        var pass = $('#reg-password').val();

        $.ajax({
          type: 'POST',
          url: 'http://localhost:8000/public/register',
          data: {
            nama: nama,
            alamat: alamat,
            kota: kota,
            telp: telp,
            email: email,
            user: user,
            pass: pass
          },
          success: function(data){
            if(data['status'] == 1){
              alert("Register Success!");
              $("#nama").val('');
              $("#alamat").val('');
              $("#kota").val('-');
              $("#telp").val('');
              $("#email").val('');
              $("#reg-username").val('');
              $("#reg-password").val('');
              $("#register-modal").modal('hide');
            } else {
              alert("Register Fail: " + data['msg']);
            }
          }
        });
      }

      function login(){
            //alert('x');
            var user = $('#username').val();
            var pass = $('#password').val();

            $.ajax({
              type: 'POST',
              url: 'http://localhost:8000/public/login',
              data: {
                user: user,
                pass: pass
              },
              success: function(data){
                if(data['status'] == 1){
                  window.location.href = 'http://localhost:8000/view/index.php';
                  // $("#username").val('');
                  // $("#password").val('');
                  // $("#login-modal").modal('hide');
                }
                else if(data['status'] == 2){
                   window.location.href = 'http://localhost:8000/view/laundry_admin.php';
                } else if (data['status'] == 0){
                  alert("Wrong username or password!")
                }
              }
          });
        }

        function logout(id){
        $.ajax({
          type: 'GET',
          url: 'http://localhost:8000/public/logout',
          data: {
            id : id
          },
          success: function(data){
            if(data['status'] == 1){
                window.location.href = 'http://localhost:8000/view/index.php';
              // $("#username").val('');
              // $("#password").val('');
              // $("#login-modal").modal('hide');
            }
          }
        });
      }
      </script>



        <?php if(isset($_SESSION['priority'])==2){ 
        ?>
        <script>
        function logout(id){
	       $.get('http://localhost:8000/public/logoutadmin/' + id, {}, function(data){
		                if(data['status'] == 1){
		                     window.location.href = 'http://localhost:8000/view';
		                }
	           		 });
        }

        function home(){
        	window.location.href = 'laundry_admin.php';
        }
        </script>
      <?php }
       else if(isset($_SESSION['priority'])==1){
        ?>
          <script>
           function home(){
            window.location.href = 'home.php';
          }

           function logout(id){
          $.ajax({
            type: 'POST',
            url: 'http://localhost:8000/public/logout',
            data: {
              id : id
            },
            success: function(data){
              if(data['status'] == 1){
                window.location.reload();
                // $("#username").val('');
                // $("#password").val('');
                // $("#login-modal").modal('hide');
              }
            }
          });
      }
    }else{

         function home(){
            window.location.href = 'index.php';
          }      
        </script>
      <?php } ?>
  </body>
</html>