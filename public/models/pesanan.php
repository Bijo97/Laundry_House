<?php 

class Pesanan{
    public $db;
    public $id;
    public $kode;
    public $berat;
    public $status;
    public $tgl_masuk;
    public $tgl_keluar;
    public $id_user;
    public $id_laundry;
    public $harga;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function load($id){
        $sql = "SELECT * FROM pesanan WHERE id = ".$id;
        $res = mysqli_query($this->db->con, $sql);
        $data = mysqli_fetch_assoc($res);
        $this->id = $data['id'];
        $this->kode = $data['kode'];
        $this->berat = $data['berat'];
        $this->status = $data['status'];
        $this->tgl_masuk = $data['tgl_masuk'];
        $this->tgl_keluar = $data['tgl_keluar'];
        $this->id_user = $data['id_user'];
        $this->id_laundry = $data['id_laundry'];
        $this->harga = $data['harga'];
    }

    public function load_code(){
        $cek = true;
        $return = "";

        while ($cek == true){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $sql = "SELECT COUNT(*) AS jumlah FROM pesanan WHERE kode = '".$randomString."'";
            $res = mysqli_query($this->db->con, $sql);
            $row = mysqli_fetch_assoc($res);

            if ($row['jumlah'] >= 1){
                $cek = true;
            } else {
                $return = array('code' => $randomString);
                $cek = false;
            }
        }

        return $return;
    }

    public function get_data(){
        return array(
            'id' => $this->id,
            'kode' => $this->kode,
            'berat' => $this->berat,
            'status' => $this->status,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'id_user' => $this->id_user,
            'id_laundry' => $this->id_laundry,
            'harga' => $this->harga
        );
    }

    //tambahan anton

    public function get_pesanan($id){
        $sql = "SELECT * FROM pesanan WHERE id_laundry = ".$id." order by status, kode";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function konfirmasi($id,$kg){
        $harga = $kg / 5 * 8000;
        $sql = "UPDATE pesanan set status = 1, berat = ".$kg.", harga = ".$harga."  WHERE id = ".$id."";
        $res = mysqli_query($this->db->con, $sql);

        // $sql2 = "UPDATE pesanan set berat = ".$kg." WHERE id = ".$id."";
        // $res2 = mysqli_query($this->db->con, $sql2);
        
        if ($res){
            return array('status' => 1, 'msg' => 'Success');
        }else{
            return array('status' => 0, 'msg' => $harga);
        }
    }
     public function selesai($id){
        $sql = "UPDATE pesanan set status = 2  WHERE id = ".$id."";
        $res = mysqli_query($this->db->con, $sql);
        if ($res){
            return array('status' => 1, 'msg' => 'Success');
        }else{
            return array('status' => 0, 'msg' => 'Cannot Delete Data in Database');
        }
    }

    //tambahan anton

    public function add($kode, $id_user, $id_laundry){
        $today = date("Y-m-d");
        $sql = "INSERT INTO pesanan VALUES(default, '".$kode."', 0, 0, ".$today.", ".$today.", ".$id_user.", ".$id_laundry.", 0)";
        $res = mysqli_query($this->db->con, $sql);
        if ($res){
            $sql2 = "SELECT MAX(id) AS maks FROM pesanan";
            $res2 = mysqli_query($this->db->con, $sql2);
            $row = mysqli_fetch_assoc($res2);
            return array('status' => 1, 'msg' => 'Success', 'id_pesanan' => $row['maks']);
        }else{
            return array('status' => 0, 'msg' => 'Cannot Add Data to Database');
        }
    }

     public function delete(){
        $sql = "DELETE FROM pesanan WHERE id = ".$this->id;
        $res = mysqli_query($this->db->con, $sql);
        if ($res){
            return array('status' => 1, 'msg' => 'Success');
        }else{
            return array('status' => 0, 'msg' => 'Cannot Delete Data in Database');
        }
    }
    
};

/*require_once '../database.php';

$db = new Database();
$product = new Product($db);
$product->load(3);
print_r($product->delete());*/
