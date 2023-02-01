<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="proses.php" method="post">
        <!-- ============================= JURUSAN ================================= -->

        <h1>Jurusan</h1>
        <p>
            <b>Daftar Jurusan Tersedia</b>
        </p>
        <table border="1">
            <tr>
                <th>Kode Jurusan</th>
                <th>Nama Jurusan</th>
                <th>Kode Fakultas</th>
            </tr>
            <?php
            require_once("proses.php");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?= $row['KodeJurusan'] ?></td>
                    <td><?= $row['NamaJurusan'] ?></td>
                    <td><?= $row['KodeFK'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <p>
            <b>
                Form inputan :
            </b>
        </p>

        <form action="proses.php" method="post" onsubmit="window.location.href='classAcademi.php';">
            <label for="kode_jurusan">Kode Jurusan:</label>
            <input type="text" id="kode_jurusan" name="kode_jurusan" placeholder="masukkan kode jurusan"><br><br>


            <label for="nama_jurusan">Nama Jurusan:</label>
            <input type="text" id="nama_jurusan" name="nama_jurusan" placeholder="masukkan nama jurusan"><br><br>


            <label for="kodefk">Kode Fakultas:</label>
            <select name="kodefk" id="kodefk">
                <?php
                require_once("proses.php");
                while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?php echo $row['KodeFakultas'] ?>"><?php echo $row['KodeFakultas'] ?></option>
                <?php } ?>
            </select>


            <input type="submit" value="Submit" name="submitjur">
        </form>



        <!-- ========================== MATKUL ============================== -->

        <h1>Mata Kuliah</h1>
        <p>
            <b>Daftar Matakuliah Tersedia</b>
        </p>
        <table border="1">
            <tr>
                <th>Kode Mata kuliah</th>
                <th>Nama Mata kuliah</th>
                <th>SKS</th>
            </tr>

            <?php
            require_once("proses.php");
            while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?= $row['kodeMK'] ?></td>
                    <td><?= $row['namaMK'] ?></td>
                    <td><?= $row['SKS'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <p>
            <b>
                Form inputan :
            </b>
        </p>


        <form action="proses.php" method="post" onsubmit="window.location.href='classAcademi.php';">
            <label for="kode">Kode Mata Kuliah:</label>
            <input type="text" id="kode_matkul" name="kode_matkul"><br><br>

            <label for="nama">Nama Mata Kuliah:</label>
            <input type="text" id="nama_matkul" name="nama_matkul"><br><br>

            <label for="sks">Jumlah SKS:</label>
            <input type="number" id="jumlah_sks" name="jumlah_sks"><br><br>

            <input type="submit" value="Submit">
        </form>

        <!-- ========================================= KRS ================================ -->

        <h1>KRS</h1>
        <p>
            <b>Daftar KRS Tersedia</b>
        </p>
        <table border="1">
            <tr>
                <th>NIM</th>
                <th>Kode Mata kuliah</th>
                <th>Nilai UTS</th>
                <th>Nilai UAS</th>
            </tr>
            <?php
            require_once("proses.php");
            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?= $row['NIM'] ?></td>
                    <td><?= $row['kodeMK'] ?></td>
                    <td><?= $row['NilaiUTS'] ?></td>
                    <td><?= $row['NilaiUAS'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <p>
            <b>
                Form inputan :
            </b>
        </p>




        <form action="proses.php" method="post" onsubmit="window.location.href='classAcademi.php';">
            <label for="kode">NIM:</label>
            <!-- <input type="text" id="kode_matkul" name="kode_matkul"><br><br> -->
            <select name="nim" id="nim">
                <?php
                require_once("proses.php");
                while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?php echo $row['NIM'] ?>"><?php echo $row['NIM'] ?></option>
                <?php } ?>
            </select><br><br>


            <label for="kodemk">Kode Mata Kuliah:</label>
            <!-- <input type="text" id="nama_matkul" name= "nama_matkul"><br><br> -->
            <select name="kodemk" id="kodemk">
                <?php
                require_once("proses.php");
                while ($row1 = $stmt11->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?php echo $row1['kodeMK'] ?>"><?php echo $row1['kodeMK'] ?></option>
                <?php } ?>
            </select><br><br>


            <label for="nilai_uts">Nilai UTS:</label>
            <input type="number" id="nilai_uts" name="nilai_uts" placeholder="masukkan Nilai UTS"><br><br>


            <label for="nilai_uas">Nilai UAS:</label>
            <input type="number" id="nilai_uas" name="nilai_uas" placeholder="masukkan Nilai UAS"><br><br>


            <input type="submit" value="Submit">
        </form>

    </form>
</body>

</html>