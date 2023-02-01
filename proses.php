<?php
class Database
{
    private $host = "localhost";
    private $db_name = "perkuliahan";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class Jurusan
{
    private $conn;
    private $table_name = "jurusan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function insert($kode_jurusan, $nama_jurusan, $kodefk)
    {
        // INSERT INTO `jurusan` (`KodeJurusan`, `NamaJurusan`, `KodeFK`) 
        // VALUES ('AD', 'Administrasi', 'FH');
        try {
            $query = "INSERT INTO jurusan (KodeJurusan, NamaJurusan, KodeFK) 
                    VALUES (:kode_jurusan, :nama_jurusan, :kodefk)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':kode_jurusan', $kode_jurusan);
            $stmt->bindParam(':nama_jurusan', $nama_jurusan);
            $stmt->bindParam(':kodefk', $kodefk);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // $kode_jurusan = $_POST['kode_jurusan'];
    // $nama_jurusan = $_POST['nama_jurusan'];
    // $kodefk = $_POST['kodefk'];
}


class MataKuliah
{
    private $conn;
    private $table_name = "matkul";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function insert($kode_matkul, $nama_matkul, $jumlah_sks)
    {
        try {
            $query = "INSERT INTO matkul (kodeMK, namaMK, SKS) 
                    VALUES (:kode_matkul, :nama_matkul, :jumlah_sks)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':kode_matkul', $kode_matkul);
            $stmt->bindParam(':nama_matkul', $nama_matkul);
            $stmt->bindParam(':jumlah_sks', $jumlah_sks);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

class KRS
{
    private $conn;
    private $table_name = "krs";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function insert($nim, $kode_matkul, $nilai_uts, $nilai_uas)
    {
        try {
            // INSERT INTO `krs` (`no`, `NIM`, `kodeMK`, `NilaiUTS`, `NilaiUAS`) 
            // VALUES (NULL, '112021003', 'ANK', '77', '86');
            $query = "INSERT INTO krs (no, NIM, kodeMK, NilaiUTS, NilaiUAS) 
                    VALUES (NULL, :nim, :kode_matkul, :nilai_uts, :nilai_uas)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':kode_matkul', $kode_matkul);
            $stmt->bindParam(':nilai_uts', $nilai_uts);
            $stmt->bindParam(':nilai_uas', $nilai_uas);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

class Fakultas
{
    private $conn;
    private $table_name = "fakultas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

class Mahasiswa
{
    private $conn;
    private $table_name = "mahasiswa";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

$database = new Database();
$db = $database->getConnection();

$jurusan = new Jurusan($db);
$mata_kuliah = new MataKuliah($db);
$krs = new KRS($db);
$fakultas = new Fakultas($db);
$mhs = new Mahasiswa($db);

$stmt = $jurusan->read();
$stmt1 = $mata_kuliah->read();
$stmt11 = $mata_kuliah->read();
$stmt2 = $krs->read();
$stmt3 = $fakultas->read();
$stmt4 = $mhs->read();
$num = $stmt->rowCount();


//===================================== Form Submit ====================================

include_once 'classAcademi.php';

$insertmatkul = new MataKuliah($db);
$insertkrs = new KRS($db);
$insertjurusan = new Jurusan($db);



//=============== Submit Matkul ===============================
if (isset($_POST['kode_matkul']) && isset($_POST['nama_matkul']) && isset($_POST['jumlah_sks'])) {
    $kode_matkul = $_POST['kode_matkul'];
    $nama_matkul = $_POST['nama_matkul'];
    $jumlah_sks = $_POST['jumlah_sks'];

    if ($insertmatkul->insert($kode_matkul, $nama_matkul, $jumlah_sks)) {
        echo "<script>alert(' Sukses Yang mulia, silahkan refresh biar datanya keluar.');</script>";
        // header("Location: classAcademi.php");
    } else {
        echo "<script>alert('Gagal Yang mulia, silahkan refresh biar datanya keluar.');</script>";
        // header("Location: classAcademi.php?error");
    }
}

//=============== Submit KRS ===============================
if (isset($_POST['nim']) && isset($_POST['kodemk']) && isset($_POST['nilai_uts']) && isset($_POST['nilai_uas'])) {
    $nim = $_POST['nim'];
    $kode_matkul = $_POST['kodemk'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];


    if ($insertkrs->insert($nim, $kode_matkul, $nilai_uts, $nilai_uas)) {
        echo "<script>alert(' Sukses Yang mulia, silahkan refresh biar datanya keluar.');</script>";
        // header("Location: classAcademi.php");
    } else {
        echo "<script>alert('Gagal Yang mulia, silahkan refresh biar datanya keluar.');</script>";
        // header("Location: classAcademi.php?error");
    }
}

//=============== Submit Jurusan ===============================
if (isset($_POST['kode_jurusan']) && isset($_POST['nama_jurusan']) && isset($_POST['kodefk'])) {
    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    $kodefk = $_POST['kodefk'];

    if ($insertjurusan->insert($kode_jurusan, $nama_jurusan, $kodefk)) {
        echo "<script>alert(' Sukses Yang mulia, silahkan refresh biar datanya keluar.');</script>";
        echo "<script>window.history.back();;</script>";
        if(header("Location: classAcademi.php")){
            echo "<script>window.location.reload(1);</script>";
        }
        // header("Location: classAcademi.php");
    } else {
        echo "<script>alert('Gagal Yang mulia, silahkan refresh biar datanya keluar.');</script>";
    }
}
