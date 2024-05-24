<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Rental Motor</h1>
    
    <?php
    // Dictionary untuk menyimpan data motor dan harganya
    $motor = array(
        "Scoopy" => 50000,
        "Mio M3" => 70000,
        "Address" => 60000,
        "Zx25r" => 80000
    );

    // Array untuk menyimpan nama-nama member
    $nama_member = array("sirojul kamal", "irghi kurniawan", "daerren samuel");

    // Fungsi untuk menghitung total biaya sewa motor
    function hitung_biaya($motor, $motor_sewa, $lama_sewa, $nama_pelanggan) {
        $total_biaya = $motor[$motor_sewa] * $lama_sewa;
        if (in_array($nama_pelanggan, $GLOBALS['nama_member'])) {
            $total_biaya -= $total_biaya * 0.05;  // Diskon 5% untuk member
        }
        $total_biaya += 10000;  // Tambahan pajak Rp. 10.000
        return $total_biaya;
    }

    // Ambil data dari form jika ada
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $motor_sewa = $_POST["motor_sewa"];
        $lama_sewa = $_POST["lama_sewa"];
        $nama_pelanggan = $_POST["nama_pelanggan"];

        // Hitung total biaya
        $total_biaya = hitung_biaya($motor, $motor_sewa, $lama_sewa, $nama_pelanggan);
        
        echo "<div class='pap'>";// Tampilkan hasil
        echo "<hr><h2>Detail Sewa</h2>";
        echo "<p><strong>Jenis Motor:</strong> $motor_sewa</p>";
        echo "<p><strong>Lama Sewa:</strong> $lama_sewa hari</p>";
        echo "<p><strong>Nama Pelanggan:</strong> $nama_pelanggan</p>";
        echo "<p><strong>Total Biaya:</strong> Rp. $total_biaya</p><hr>";
        echo "</div>";
    }
    ?>

    <h2>Sewa Motor</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="motor_sewa">Jenis Motor:</label><br>
        <select id="motor_sewa" name="motor_sewa">
            <?php
            // Tampilkan pilihan motor dari data yang tersedia
            foreach ($motor as $nama_motor => $harga) {
                echo "<option value='$nama_motor'>$nama_motor - Rp. $harga/hari</option>";
            }
            ?>
        </select><br>
        <label for="lama_sewa">Lama Sewa (hari):</label><br>
        <input type="number" id="lama_sewa" name="lama_sewa" min="1"><br>
        <label for="nama_pelanggan">Nama Pelanggan:</label><br>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>