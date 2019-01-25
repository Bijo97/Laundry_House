<?php
  session_start();
  // $_SESSION['priority'] == 0;
  // if($_SESSION['priority']==2){
  //      header('Location: http://localhost:8000/view/library_admin.php');  
  // }
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Laundry House</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Laundries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Check Order</a>
          </li>
        </ul>
        <?php if (isset($_SESSION['user'])){ ?>
          <ul class='navbar-nav ml-auto'>
            <li class="nav-item">
              <a class="nav-link" href="#">Hello, <?php echo $_SESSION['user']; ?>!</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="logout(<?php echo $_SESSION['id_user']; ?>)">Log Out</a>
            </li>
          </ul>
        <?php } else { ?>
          <ul class='navbar-nav ml-auto'>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#login-modal">Log In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#register-modal">Register</a>
            </li>
          </ul>
        <?php } ?>
      </div>
    </nav><br/>
    <div class="container">
      <div class="row">
        <h1>Laundry House</h1>
      </div><br/>
      <div class="row">
        <div class="col-sm-3">
          <h3>Our partners: </h3>
        </div>
        <div class="col-sm-3 offset-sm-6">
          <input type="text" id="search-box" name="search-box" class="form-control" onkeyup="search(this.value)" placeholder="Search" />
        </div>
        <!-- <div class="col-sm-1">
          <button type="button" id="search-button" name="search-button" class="btn btn-primary" onclick="search()">Search</button>
        </div> -->
        <div id="map"></div>
      </div><br/>
      <div class="row">
        <h3>Top Laundries: </h3>
        <div class="row" id="top"></div>
      </div><br/>
      <div class="row">
        <h3>Check Order</h3>
        <div class="row" id="order"></div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detail-laundry-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      $(document).ready(function(){
        $.ajax({
          type: 'GET',
          url: 'http://localhost:8000/public/laundry/top',
          success: function(data){
            $.each(data, function(index, row){
              var line = '<div class="col-sm-4"><center><img class="logo" src="http://localhost:8000/'+row.gambar+'"></center><center><h4>'+row.nama+'</h4></center><center>'+row.kota+'<br>';
              for (var i = 0; i < row.rating; i++){
                line += '<img class="rating" src="http://localhost:8000/img/red-star.png">';
              }
              for (var i = row.rating; i < 5; i++){
                line += '<img class="rating" src="http://localhost:8000/img/blank-star.png">';
              }
              line += '</center></div>';
              $('#top').append(line);
            });
          }
        });
      });

      function get_detail_laundry(id){
        $('#detail-laundry-modal').modal('show');
      }

      function register(){
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
              window.location.reload();
              // $("#username").val('');
              // $("#password").val('');
              // $("#login-modal").modal('hide');
            }
            else if(data['status'] == 2){
               window.location.href = 'http://localhost:8000/view/laundry_admin.php';
            }
          }
        });
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
                window.location.href = 'http://localhost:8000/view/index.php';
              // $("#username").val('');
              // $("#password").val('');
              // $("#login-modal").modal('hide');
            }
          }
        });
      }

      function search(query){
        if (query != ""){
          $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/public/laundry/location/' + query,
            success: function(data){
              var center = {lat: 34.052235, lng: -118.243683};
              var locations = [];

              $.each(data, function(index, row){
                locations[index] = [row.nama + "<br>" + row.alamat + "<br><a href='" + row.short_url + "' target='_blank'>Get Directions</a><br><a href='#' onclick='get_detail_laundry(" + row.id + ")'>View Detail</a>", row.latitude, row.longitude];
              });

              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: center
              });
              var infowindow =  new google.maps.InfoWindow({});
              var marker, count;
              for (count = 0; count < locations.length; count++) {
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    title: locations[count][0]
                  });
              google.maps.event.addListener(marker, 'click', (function (marker, count) {
                    return function () {
                      infowindow.setContent(locations[count][0]);
                      infowindow.open(map, marker);
                    }
                  })(marker, count));
              }
            }
          });
        } else {
          initMap();
        }
      }

      function initMap() {
        $.ajax({
          type: 'GET',
          url: 'http://localhost:8000/public/laundry/location',
          success: function(data){
            var center = {lat: 34.052235, lng: -118.243683};
            var locations = [];

            $.each(data, function(index, row){
              locations[index] = [row.nama + "<br>" + row.alamat + "<br><a href='" + row.short_url + "' target='_blank'>Get Directions</a><br><a href='#' onclick='get_detail_laundry(" + row.id + ")'>View Detail</a>", row.latitude, row.longitude];
            });

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 10,
              center: center
            });
            var infowindow =  new google.maps.InfoWindow({});
            var marker, count;
            for (count = 0; count < locations.length; count++) {
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                  map: map,
                  title: locations[count][0]
                });
            google.maps.event.addListener(marker, 'click', (function (marker, count) {
                  return function () {
                    infowindow.setContent(locations[count][0]);
                    infowindow.open(map, marker);
                  }
                })(marker, count));
            }
          }
        });
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRymiiOXxrP12HckjZdGHClW7lhbo7i7Q&callback=initMap">
    </script>
  </body>
</html>