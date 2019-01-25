<?php 

class Laundry{
    public $db;
    public $id;
    public $nama;
    public $alamat;
    public $telp;
    public $kota;
    public $email;
    public $username;
    public $password;
    public $latitude;
    public $longitude;
    public $short_url;
    public $gambar;
    public $rating;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function load($id){
        $sql = "SELECT * FROM laundry WHERE id = ".$id;
        $res = mysqli_query($this->db->con, $sql);
        $data = mysqli_fetch_assoc($res);
        $this->id = $data['id'];
        $this->nama = $data['nama'];
        $this->alamat = $data['alamat'];
        $this->telp = $data['telp'];
        $this->kota = $data['kota'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->short_url = $data['short_url'];
        $this->gambar = $data['gambar'];
        $this->rating = $data['rating'];
    }

    public function load_all(){
        $sql = "SELECT * FROM laundry";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function get_data(){
        return array(
            'id' => $this->id,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telp' => $this->telp,
            'kota' => $this->kota,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'short_url' => $this->short_url,
            'gambar' => $this->gambar,
            'rating' => $this->rating
        );
    }

    public function search($nama){
        $sql = "SELECT id, nama, alamat, latitude, longitude, short_url FROM laundry WHERE nama LIKE '%".$nama."%'";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function get_location(){
        $sql = "SELECT id, nama, alamat, latitude, longitude, short_url FROM laundry";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function get_top(){
        $sql = "SELECT * FROM laundry ORDER BY rating DESC LIMIT 6";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }
};

/*require_once '../database.php';

$db = new Database();
$product = new Product($db);
$product->load(3);
print_r($product->delete());*/
