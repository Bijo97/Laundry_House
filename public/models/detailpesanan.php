<?php 

class DetailPesanan{
    public $db;
    public $id;
    public $pakaian;
    public $id_pesanan;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function load($id){
        $sql = "SELECT * FROM detail_pesanan WHERE id = ".$id;
        $res = mysqli_query($this->db->con, $sql);
        $data = mysqli_fetch_assoc($res);
        $this->id = $data['id'];
        $this->pakaian = $data['pakaian'];
        $this->id_pesanan = $data['id_pesanan'];
    }

    public function get_data(){
        return array(
            'id' => $this->id,
            'pakaian' => $this->pakaian,
            'id_pesanan' => $this->id_pesanan
        );
    }

    public function get_pesanan($id_pesanan){
        $sql = "SELECT * FROM detail_pesanan WHERE id_pesanan = ".$id_pesanan;
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function add($pakaian, $id_pesanan){
        $cek = true;
        for ($i = 0; $i < count($pakaian); $i++){
            $sql = "INSERT INTO detail_pesanan VALUES(default, '".$pakaian[$i]."', ".$id_pesanan.")";
            $res = mysqli_query($this->db->con, $sql);
            if ($res){
                $cek = true;
            } else {
                $cek = false;
                break;
            }
        }
        
        if ($cek){
            return array('status' => 1, 'msg' => 'Success');
        }else{
            return array('status' => 0, 'msg' => 'Cannot Add Data to Database');
        }
    }

     public function delete($id_pesanan){
        $sql = "DELETE FROM detail_pesanan WHERE id_pesanan = ".$id_pesanan;
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
