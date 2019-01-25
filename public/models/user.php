<?php 

class User{
    public $db;
    public $id;
    public $nama;
    public $alamat;
    public $telp;
    public $kota;
    public $email;
    public $username;
    public $password;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function check($username, $password){
        $sql = "SELECT COUNT(*) AS jumlah FROM user WHERE username = '".$username."' AND password = '".$password."'";
        $res = mysqli_query($this->db->con, $sql);
        $data = mysqli_fetch_assoc($res);
        if ($data['jumlah'] >= 1){
            $sql2 = "SELECT id FROM user WHERE username = '".$username."' AND password = '".$password."'";
            $res2 = mysqli_query($this->db->con, $sql2);
            $data2 = mysqli_fetch_assoc($res2);
            session_start();
            $_SESSION['id_user'] = $data2['id'];
            $_SESSION['user'] = $username;
            $_SESSION['priority'] = 1;
            return array('status' => 1, 'msg' => 'Success');
        } else {

            $sql = "SELECT COUNT(*) AS jumlah FROM laundry WHERE username = '".$username."' AND password = '".$password."'";
            $res = mysqli_query($this->db->con, $sql);
            $data = mysqli_fetch_assoc($res);
            if ($data['jumlah'] >= 1){
                $sql2 = "SELECT * FROM laundry WHERE username = '".$username."' AND password = '".$password."'";
                $res2 = mysqli_query($this->db->con, $sql2);
                $data2 = mysqli_fetch_assoc($res2);
                session_start();
                $_SESSION['id_user'] = $data2['id'];
                $_SESSION['user'] = $data2['nama'];
                $_SESSION['priority'] = 2;
                return array('status' => 2, 'msg' => 'Success');
            } else {
                return array('status' => 0, 'msg' => 'Username or Password Wrong');
            }
        }
    }

    public function logout($id){
        session_start();
        session_destroy();
        return array('status' => 1, 'msg' => 'Success');
    }

    public function logoutadmin($id){
        session_start();
        session_destroy();
        return array('status' => 1, 'msg' => 'Success');
    }

    public function getalamatpemesan($id){
        $sql = "SELECT * FROM user WHERE id = ".$id."";
        $res = mysqli_query($this->db->con, $sql);
        $return = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function add($nama, $alamat, $telp, $kota, $email, $username, $password){
        $sql = "INSERT INTO user VALUES(default, '".$nama."', '".$kota."', '".$alamat."', '".$telp."', '".$email."', '".$username."', '".$password."')";
        $res = mysqli_query($this->db->con, $sql);
        if ($res){
            return array('status' => 1, 'msg' => 'Success');
        }else{
            return array('status' => 0, 'msg' => 'Cannot Add Data to Database');
        }
    }
};

/*require_once '../database.php';

$db = new Database();
$product = new Product($db);
$product->load(3);
print_r($product->delete());*/
