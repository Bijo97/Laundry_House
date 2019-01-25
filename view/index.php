<?php
  // $_SESSION['priority'] == 0;
  // if($_SESSION['priority']==2){
  //      header('Location: http://localhost:8000/view/library_admin.php');  
  // }

  include "header.php";

  if (isset($_SESSION['user'])){
    echo "<input type='hidden' id='logincheck' value='".$_SESSION['id_user']."'>";
  } else {
    echo "<input type='hidden' id='logincheck' value='0'>";
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">



  <!-- batas copy -->
  <link rel="shortcut icon" href="favicon.ico">

  <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="../css/animate.css">
  
  <!-- Magnific Popup -->
  <link rel="stylesheet" href="../css/magnific-popup.css">

  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="../css/icomoon.css">

  <!-- Theme style  -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- Modernizr JS -->
  <script src="../js/modernizr-2.6.2.min.js"></script>

    <style>
      body{
        overflow-x: hidden;
      }

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
      <div  class="fh5co-hero"  style="background-image: url(../img/L2.png);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container" >
        <div class="row">
          <div class="col-md-12 fh5co-table">
            <div class="fh5co-intro fh5co-table-cell">
             <div class="row">
              <div class="col-md-3">
                <h3 style="color:white">Our partners: </h3>
              </div>
              <div class="col-md-3 offset-md-6">
                <input type="text" id="search-box" name="search-box" class="form-control" onkeyup="search(this.value)" placeholder="Search" style="background-color:white" />
              </div>
            </div>
              <!-- <div class="col-sm-1">
                <button type="button" id="search-button" name="search-button" class="btn btn-primary" onclick="search()">Search</button>
              </div> -->
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div id="about" class="fh5co-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <h2>Online Laundry</h2>
            <p>We hope this webiste can improve and increase laundry home profit and customers can easily got laundry place if they need it.</p>
          </div>
          <div class="col-md-7">
            <img src="../img/logox.png"  class="img-responsive">
          </div>
        </div>
      </div>
    </div>

      <div id="service" class="fh5co-parallax" style="background-image: url(../img/person4.jpg);margin-bottom:  20px;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      
        <div class="row" >
          <div class="container-fluid "> 
      <div class="container container-spacing" style="margin-bottom:2%;margin-top:5%">
        <div  class="row">
          <center>
          <div id="#service" class="align-center" >

              <h2 class="h2-small" style="color:white">OUR SERVICES</h2>
    
              <img src="../img/steplaundry.png" height="480" width="1142" style="margin-bottom: 50px">
            </div>
        </center>
     
      </div>
    </div>
        
      </div>
    </div>
  </div>

  <div id="toplaundries" class="fh5co-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <center><h3>Top Laundries</h3></center>
          <div class="row" id="top"></div>
        </div>
      </div>  
    </div>
  </div>

  <div id="checkorder" class="fh5co-section" style="color: white; background-color:#273746;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <center><h2 style="color:white">Check Order</h2>
            <p>Please insert your order code here: </p>
              <form>       
                  <div class="row form-group">
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="checkorderbox" placeholder="Order Code" style="background-color:white">
                    </div>
                    <div class="col-md-2">
                      <button type="button" id="btnCheck" class="btn btn-default">Check</button>
                    </div>
                  </div>
                  <div class="form-group" id="containerResult" style="padding-top:15px;display:none">
                  <table style="width:100%;" class="table table-bordered">
                    <tr>
                       <th>
                       No Order
                     </th>
                     <td id="noorder">
                       
                     </td>
                    </tr>
                    <tr>
                       <th>
                       Status
                     </th>
                     <td id="status">
                       
                     </td>
                    </tr>
                    <tr>
                       <th>
                       Tanggal Masuk
                     </th>
                     <td id="tmasuk">
                       
                     </td>
                    </tr>
                    <tr>
                       <th>
                       Tanggal Keluar
                     </th>
                     <td id="tkeluar">
                       
                     </td>
                    </tr>
                    <tr>
                       <th>
                       Berat
                     </th>
                     <td id="berat">
                       
                     </td>
                    </tr>
                    <tr>
                       <th>
                       Harga
                     </th>
                     <td id="price">
                       
                     </td>
                    </tr>
                  </table>
                  <h3 style="width:100%;margin-top:15px;color:white">Detail Pesanan</h3>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                         Detail
                        </th>
                      </tr>
                    </thead>
                    <tbody id="dp">
                    </tbody>
                  </table>
                  </div>
              </form></center>
            </div>
        </div>
      </div>
    </div>


       <div id="contact" class="fh5co-section" >
      <div class="container">
          <div  class="container">
            <center>
        <div class="row">
          <div class="col-md-4">
            <h3>About Us</h3>
            <p>We hope this webiste can improve and increase laundry home profit and customers can easily got laundry place if they need it.</p>
          </div>
          <div class="col-md-3 col-md-push-1">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Products</a></li>
              <li><a href="#">Services</a></li>
              
            </ul>
          </div>
          <div class="col-md-3 col-md-push-1">
            <h3>Follow Us</h3>
            <ul class="fh5co-social">
              <li><a href="#"><i class="icon-twitter"></i> <span>Twitter</span></a></li>
              <li><a href="#"><i class="icon-facebook"></i> <span>Facebook</span></a></li>
              <li><a href="#"><i class="icon-instagram"></i> <span>Instagram</span></a></li>
              <li><a href="#"><i class="icon-google"></i> <span>Google Plus</span></a></li>
            </ul>
          </div>
        </div>
        </center>
      </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detail-laundry-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y:scroll">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detail-laundry-header">Detail Laundry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="detail-laundry-body" class="row" style="margin: 1% 1% 1% 1%"></div><br/>
            <div id="order-form" class="row" style="margin: 1% 1% 1% 1%"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearmodal()">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $.ajax({
          type: 'GET',
          url: 'http://localhost:8000/public/laundry/top',
          success: function(data){
            $.each(data, function(index, row){
              var line = '<div class="col-sm-4"><center><img class="logo" src="http://localhost:8000/'+row.gambar+'"></center><center><a href="#/" onclick="get_detail_laundry(' + row.id + ')"><h4 style="margin-bottom: 0 !important;">'+row.nama+'</h4></a></center><center>'+row.kota+'<br>';
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
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/public/laundry/' + id,
            success: function(data){
              $('#detail-laundry-header').html(data.nama);
              var line = '<center><img src="../'+data.gambar+'" style="width:50%;height:auto;"><br/><h3 style="margin-bottom:0 !important;">'+data.nama+'</h3>';
              for (var i = 0; i < data.rating; i++){
                line += '<img class="rating" src="http://localhost:8000/img/red-star.png">';
              }
              for (var i = data.rating; i < 5; i++){
                line += '<img class="rating" src="http://localhost:8000/img/blank-star.png">';
              }
              line = line + '<br/>'+data.alamat+'<br/>'+data.kota+'<br/>'+data.telp+'<br/>';
              line = line + '<button type"button" id="pesanlaundry" class="btn btn-primary" onclick="showorder('+id+')">Order Laundry</button></center>';
              $('#detail-laundry-body').html(line);
              $('#detail-laundry-modal').modal('show'); 
            }
          });
      }

      function showorder(id){
        if ($('#logincheck').val() != 0){
          $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/public/pesanan/code',
            success: function(data){
              var kode = parseInt(data.code) + 1;
              var line = '<div class="col-md-12"><form><center><input type="hidden" id="kodeunik" value="'+kode+'"><div class="form-group"><h4 style="margin-bottom: 0 !important">Order Code: '+kode+'</h4></div>Pilih pakaian:<br/><div class="form-group"><select class="pakaian" class="form-control"><option value="-">Please Choose: </option><option value="Kemeja">Kemeja</option><option value="Kaos">Kaos</option><option value="Polo">Polo</option><option value="Celana Pendek">Celana Pendek</option><option value="Celana Panjang">Celana Panjang</option><option value="Celana Jeans">Celana Jeans</option><option value="Kaos Kaki">Kaos Kaki</option><option value="Other">Other</option></select></div><div class="form-group"><select class="pakaian" class="form-control"><option value="-">Please Choose: </option><option value="Kemeja">Kemeja</option><option value="Kaos">Kaos</option><option value="Polo">Polo</option><option value="Celana Pendek">Celana Pendek</option><option value="Celana Panjang">Celana Panjang</option><option value="Celana Jeans">Celana Jeans</option><option value="Kaos Kaki">Kaos Kaki</option><option value="Other">Other</option></select></div><div class="form-group"><select class="pakaian" class="form-control"><option value="-">Please Choose: </option><option value="Kemeja">Kemeja</option><option value="Kaos">Kaos</option><option value="Polo">Polo</option><option value="Celana Pendek">Celana Pendek</option><option value="Celana Panjang">Celana Panjang</option><option value="Celana Jeans">Celana Jeans</option><option value="Kaos Kaki">Kaos Kaki</option><option value="Other">Other</option></select></div><div class="form-group"><select class="pakaian" class="form-control"><option value="-">Please Choose: </option><option value="Kemeja">Kemeja</option><option value="Kaos">Kaos</option><option value="Polo">Polo</option><option value="Celana Pendek">Celana Pendek</option><option value="Celana Panjang">Celana Panjang</option><option value="Celana Jeans">Celana Jeans</option><option value="Kaos Kaki">Kaos Kaki</option><option value="Other">Other</option></select></div><div class="form-group"><button type="button" id="pesan" class="btn btn-success" onclick="order('+id+')">Order Now</button></div></center></form></div>';
              $('#order-form').html(line);
            }
          });
        } else {
          alert("You have to login first!");
        }
      }

      function order(id){
        var kode = $('#kodeunik').val();
        var id_laundry = id;
        var id_user = $('#logincheck').val();
        var pakaian = [];
        var listpakaian = document.getElementsByClassName('pakaian');
        for (var i = 0; i < listpakaian.length; i++) {
          pakaian.push(listpakaian[i].value);
        }
        $.ajax({
          type: 'POST',
          url: 'http://localhost:8000/public/pesanan/insert',
          data: {
            kode: kode,
            id_user: id_user,
            id_laundry: id_laundry,
            pakaian: pakaian
          },
          success: function(data){
            if (data.status == 1){
              $('#detail-laundry-body').html("");
              $('#order-form').html("");
              $('#detail-laundry-modal').modal('hide');
            } else {
              alert("Order fail");
            }
          }
        });
      }

      function clearmodal(){
        $('#detail-laundry-body').html("");
        $('#order-form').html("");
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

    <script>
      //url: 'http://localhost:8000/public/laundry/top',
      $(document).ready(function(){
          //alert("ready");
      $("#btnCheck").click(function()
      {
        //alert("button check click");
        var noorder=$("#checkorderbox").val();
        $.ajax({
          type: 'GET',
          url: 'http://localhost:8000/public/getorder/'+noorder,
          success: function(data){
          console.log(data);
          if (data.found=="ok")
          {
              var head=data.head; 
              var detail=data.detail;
              var status=head.status;
              $("#noorder").html(head.kode);
              $("#tmasuk").html(head.tmasuk);
              if (status=="0"){
                $("#tkeluar").html("-");
              } else {
                $("#tkeluar").html(head.tkeluar);
              }
              if (status=="0"){
                $("#berat").html("0");
              } else {
                $("#berat").html(head.berat);
              }
              if (status=="0")
              {
                $("#status").html("Belum Diproses");
              }
              else if (status=="1")
              {
                 $("#status").html("Sedang Dicuci");
              }
              else if (status=="2")
              {
                 $("#status").html("Selesai");
              }
              var ihtml="";
              for (var i=0;i<detail.length;i++)
              {
                ihtml=ihtml+"<tr><td>"+detail[i].pakaian+"</td></tr>";
              }
              $("#dp").html(ihtml);
              $("#containerResult").show();
              if (status=="0")
              {
                $("#price").html("Belum Diproses");
              }
              else if (status=="1" || status=="2")
              {
                $("#price").html(head.harga);
              }
            }
            else {
              $("#containerResult").hide();
              alert("Nomor pesanan tidak ditemukan");
            }
            
            }
          });
        });
      
        });

        
      </script>

  </body>
</html>