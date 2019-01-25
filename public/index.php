<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'database.php';
require 'models/laundry.php';
require 'models/user.php';
require 'models/pesanan.php';
require 'models/detailpesanan.php';

$db = new Database();
$app = new \Slim\App;

$app->get('/laundry/location', function (Request $request, Response $response, array $args) {
    global $db;
    $laundry_model = new Laundry($db);
    $body = $laundry_model->get_location();
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});
$app->get('/laundry/location/{query}', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $args['query'];
    $laundry_model = new Laundry($db);
    $body = $laundry_model->search($data);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});
$app->get('/laundry/top', function (Request $request, Response $response, array $args) {
    global $db;
    $laundry_model = new Laundry($db);
    $body = $laundry_model->get_top();
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});
$app->get('/laundry/{id}', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $args['id'];
    $laundry_model = new Laundry($db);
    $laundry_model->load($data);
    $body = $laundry_model->get_data();
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});
$app->get('/pesanan/code', function (Request $request, Response $response, array $args) {
    global $db;
    $pesanan_model = new Pesanan($db);
    $body = $pesanan_model->load_code();
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});
$app->post('/pesanan/insert', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $request->getParsedBody();
    $pesanan_model = new Pesanan($db);
    $body = $pesanan_model->add($data['kode'], $data['id_user'], $data['id_laundry']);
    $detail_pesanan_model = new DetailPesanan($db);
    $body2 = $detail_pesanan_model->add($data['pakaian'], $body['id_pesanan']);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

//tambahan anton

$app->get('/getpesanan/{id}', function (Request $request, Response $response, array $args) {
    global $db; 
    $id = $args['id'];
    $pesanan_model = new Pesanan($db);
    $body = $pesanan_model->get_pesanan($id);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->get('/getalamatpemesan/{id}', function (Request $request, Response $response, array $args) {
    global $db; 
    $id = $args['id'];
    $user_model = new User($db);
    $body = $user_model->getalamatpemesan($id);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->put('/konfirmasi/{id}+{kg}', function (Request $request, Response $response, array $args) {
    global $db; 
    $id = $args['id'];
    $kg = $args['kg'];
    $pesanan_model = new Pesanan($db);
    $body = $pesanan_model->konfirmasi($id,$kg);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->put('/selesai/{id}', function (Request $request, Response $response, array $args) {
    global $db; 
    $id = $args['id'];
    $pesanan_model = new Pesanan($db);
    $body = $pesanan_model->selesai($id);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->delete('/deletepesanan/{id}', function (Request $request, Response $response, array $args) {
    global $db;
    $id = $args['id'];
    $data = $request->getParsedBody();
    $pesanan_model = new Pesanan($db);
    $pesanan_model->load($id);
    $body = $pesanan_model->delete();
    $detail_pesanan_model = new DetailPesanan($db);
    $body2 = $detail_pesanan_model->delete($id);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')
                            ->withHeader('Access-Control-Allow-Origin', '*')
                            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    return $newResponse;
});

$app->get('/logoutadmin/{id}', function (Request $request, Response $response, array $args) {
    global $db; 
    $id = $args['id'];
    $user_model = new User($db);
    $body = $user_model->logoutadmin($id);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

//tambahan anton



$app->post('/register', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $request->getParsedBody();
    $user_model = new User($db);
    $body = $user_model->add($data['nama'], $data['alamat'], $data['kota'], $data['telp'], $data['email'], $data['user'], $data['pass']);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->post('/login', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $request->getParsedBody();
    $user_model = new User($db);
    $body = $user_model->check($data['user'], $data['pass']);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->get('/logout', function (Request $request, Response $response, array $args) {
    global $db;
    $data = $request->getParsedBody();
    $user_model = new User($db);
    $body = $user_model->logout($data['id']);
    $response->getBody()->write(json_encode($body));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});



$app->get('/getorder/{order}', function (Request $request, Response $response, array $args) {
    global $db;
	
	$hasil["found"]="no";
	$order=$args['order'];
    $q="SELECT p.*,l.nama,DATE_FORMAT(p.tgl_masuk,'%d-%M-%Y') as tmasuk,DATE_FORMAT(p.tgl_keluar,'%d-%M-%Y') as tkeluar ".
	   "FROM pesanan p ".
	   "INNER JOIN laundry l ON (l.id=p.id_laundry) ".
	   "WHERE p.kode='". $order ."'";
	$res=mysqli_query($db->con,$q);
	if ($dataOrder=mysqli_fetch_assoc($res))
	{
		$hasil["found"]="ok";
		$hasil["head"]=$dataOrder;
		
		$detail=array();
		$q="SELECT * ".
		   "FROM detail_pesanan ".
		   "WHERE id_pesanan='". $dataOrder["id"] ."'";
		   
		$res=mysqli_query($db->con,$q);
		while ($row=mysqli_fetch_assoc($res))
		{
			array_push($detail,$row);
		}
		$hasil["detail"]=$detail;
	}
	
	
	
    $response->getBody()->write(json_encode($hasil));

    $newResponse = $response->withHeader('Content-type', 'application/json')->withHeader('Access-Control-Allow-Origin', '*');
    return $newResponse;
});

$app->run();