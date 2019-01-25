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
            <a class="nav-link" href="checkorder.php">Check Order</a>
          </li>
        </ul>
        <?php if (isset($_SESSION['user'])){ ?>
          <ul class='navbar-nav ml-auto'>
            <li class="nav-item">
              <a class="nav-link" href="#">Hello, <?php echo $_SESSION['user']; ?>!</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Log Out</a>
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
		<form>
			  
			  <div class="form-group">
				<label for="pwd">Check Order:</label>
				<input type="text" class="form-control" id="checkorder">
			  </div>
			  <button type="button" id="btnCheck" class="btn btn-default">Check Order</button>
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
				</table>
				<h3 style="width:100%;margin-top:15px">Detail Pesanan</h3>
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
		</form>
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
	  $(document).ready(function(){
        //alert("ready");
		$("#btnCheck").click(function()
		{
			//alert("button check click");
			var noorder=$("#checkorder").val();
			$.ajax({
			  type: 'GET',
			  url: 'http://localhost:8000/public/getorder/'+noorder,
			  success: function(data){
				console.log(data);
				if (data.found=="ok")
				{
			      var head=data.head;	
				  var detail=data.detail;
				  $("#noorder").html(head.kode);
				  $("#tmasuk").html(head.tmasuk);
				  $("#tkeluar").html(head.tkeluar);
				  var status=head.status;
				  if (status=="0")
				  {
					  $("#status").html("Menimbang");
				  }
				  else if (status=="1")
				  {
					   $("#status").html("Siap");
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