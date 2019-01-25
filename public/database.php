<?php 

class Database {
    public $con;

    function __construct(){
        $this->con = mysqli_connect("localhost", "root", "", "proyek_soa");
    }
};