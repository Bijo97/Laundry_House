<?php
 
  include "header.php";
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
    
    <div class="container">
		 <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>

                            <th width="10%">Kode</th>
                            <th width="15%">Pemesan</th>
                            <th width="10%">Berat</th>
                            <th width="10%">Tgl Masuk</th>
                            <th width="10%">Tgl Keluar</th>
                            <th width="10%">Status</th>
                            <th width="10%">Harga</th>
                            <th width="10%">Action</th>
                            <th width="10%">Delete</th>

                        </tr>
                    </thead>
                    <tbody id="laundry-table">
                        
                    </tbody>
                </table>
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
		 $.delete = function(url, data, callback, type){
			if ( $.isFunction(data) ){
			type = type || callback,
				callback = data,
				data = {}
			}
			return $.ajax({
				url: url,
				type: 'DELETE',
				success: callback,
				data: data,
				contentType: type
			});
		}
		$.put = function(url, data, callback, type){
			if ( $.isFunction(data) ){
				type = type || callback,
				callback = data,
				data = {}
			}
			return $.ajax({
				url: url,
				type: 'PUT',
				success: callback,
				data: data,
				contentType: type
			});
		}
       function load_data(id){
            $("#laundry-table").html('');
           // alert($id);
            $.get('http://localhost:8000/public/getpesanan/' + id, {}, function(data){
                $.each(data, function(index, value){


                	$.get('http://localhost:8000/public/getalamatpemesan/' + value['id_user'], {}, function(data1){
		                $.each(data1, function(index1, value1){
		                			//alert(value1['alamat']);
		                			$alamat = value1['alamat'];
		                			
                	if(value['status']==0){
                    	var line = '<tr><td>' + (value['kode']) + '</td><td id="idalamat">' +  $alamat + '</td><td>' +  '<input type="text" id="kilo'+value["id"]+'" value="0" /></td><td>' + value['tgl_masuk'] + '</td><td>' + value['tgl_keluar'] + '</td><td>' + 'Waiting' + '</td><td>'  + 'Rp ' + value['harga'] +'</td><td><button class="btn btn-success btn-sm" onclick="konfirmasi(' + value['id'] + ',' + value['id'] + ')">Konfirmasi</button> </td> <td><button class="btn btn-danger btn-sm" onclick="delete_pesanan(' + value['id'] + ')">Delete</button></td></tr>';
                	}
                	else if(value['status']==1){
                		var line = '<tr><td>' + (value['kode']) + '</td><td>' +  $alamat + '</td><td>' +  value['berat'] + ' kg' + '</td><td>' + value['tgl_masuk'] + '</td><td>' + value['tgl_keluar'] + '</td><td>' + 'In Progress' + '</td><td>'  + 'Rp ' + value['harga'] +'</td><td><button class="btn btn-primary btn-sm" onclick="selesai(' + value['id'] + ')">Finsih</button></td> <td><button class="btn btn-danger btn-sm" onclick="delete_pesanan(' + value['id'] + ')">Delete</button></td></tr>';
                	}
                	else{
                		var line = '<tr><td>' + (value['kode']) + '</td><td>' +  $alamat + '</td><td>' +  value['berat'] + ' kg' + '</td><td>' + value['tgl_masuk'] + '</td><td>' + value['tgl_keluar'] + '</td><td>' + 'Done' + '</td><td>'  + 'Rp ' + value['harga'] +'</td><td>No Action</td> <td><button class="btn btn-danger btn-sm" onclick="delete_pesanan(' + value['id'] + ')">Delete</button></td></tr>';
                	}



                    $("#laundry-table").append(line);

                      	  });
		            });

                });
            });

            
 
            

        }

        function delete_pesanan(id){
        	var txt;
				var r = confirm("Anda yakin ingin menghapus data pesanan ini?");
				if (r == true) {
				    $.delete('http://localhost:8000/public/deletepesanan/' + id, {"_METHOD": "DELETE"}, function(data){
		                if(data['status'] == 0){
		                    alert(data['msg']);
		                }else{
                        $id = <?php echo $_SESSION['id_user']; ?>;
                        load_data($id);
		                
		                }
                      
	           		 });
				} else {
				    txt = "Batal!";
				}
				 document.getElementById("demo").innerHTML = txt;
            
        }

        function konfirmasi(id,id2){
        	// alert(id);
        	// alert(harga);
        	var txt;
            var kg = $('#kilo'+id2).val();
			var r = confirm("Anda yakin ingin menyetujui pesanan ini?");
			if (r == true) {
				$path = 'http://localhost:8000/public/konfirmasi/' + id + '+' + kg;
			    $.put('http://localhost:8000/public/konfirmasi/' + id + '+' + kg, {}, function(data){
	                if(data['status'] == 0){
	                    alert(data['msg']);
	                }else{
	                	$id = <?php echo $_SESSION['id_user']; ?>;
	                    load_data($id);
	                }
           		 });
			} else {
			    txt = "Batal!";
			}
			 document.getElementById("demo").innerHTML = txt;
            
        }

        function selesai(id){
        	//alert(id);
        	var txt;
			var r = confirm("Anda yakin ingin pesanan ini dibuat selesai?");
			if (r == true) {
			    $.put('http://localhost:8000/public/selesai/' + id, {}, function(data){
	                if(data['status'] == 0){
	                    alert(data['msg']);
	                }else{
	                	$id = <?php echo $_SESSION['id_user']; ?>;
	                    load_data($id);
	                }
           		 });
			} else {
			    txt = "Batal!";
			}
			 document.getElementById("demo").innerHTML = txt;
            
        }

      

        $(document).ready(function(){
        	$id = <?php echo $_SESSION['id_user']; ?>;
            load_data($id);

        });
      
    </script>
  </body>
</html>