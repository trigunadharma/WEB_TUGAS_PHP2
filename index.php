<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        form input[type="text"],
        form input[type="number"],
        form select,
        form button {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        .success {
            display: none; /* Sembunyikan secara default */
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .show {
            display: block; /* Tampilkan ketika dibutuhkan */
        }
    </style>
</head>
<body>
    <form id="online" method="post">
        <input type="text" name="nama" placeholder="Nama Pelanggan"><br><br>
        <select name="produk">
            <!-- Opsional: Produk akan dimasukkan menggunakan PHP -->
            <?php
            $produkPilihan = ["TV", "AC", "KULKAS"];
            foreach ($produkPilihan as $produk) {
                echo "<option value='$produk'>$produk</option>";
            }
            ?>
        </select><br><br>
        <input type="number" name="jumlah" placeholder="Jumlah Beli"><br><br>
        <button type="submit" name="submit">Hitung</button>
    </form>

    <?php
    if(isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $produk = $_POST['produk'];
        $jumlah = $_POST['jumlah'];

        $harga;

        switch ($produk) {
            case "TV":
                $harga = 200000;
                break;
            case "AC":
                $harga = 3000000;
                break;
            case "KULKAS":
                $harga = 5000000;
                break;
            default:
                $harga = 0;
        }

        $hargaKotor = $harga * $jumlah;
        // Diskon
        if (strtolower($produk) == "kulkas" && $jumlah >= 3) $diskon = 0.3 * $hargaKotor;
        elseif (strtolower($produk) == "ac" && $jumlah >= 3) $diskon = 0.2 * $hargaKotor;
        else $diskon = 0.1 * $hargaKotor;

        // Hitung PPN (10% dari harga kotor setelah diskon)
        $ppn = 0.1 * ($hargaKotor - $diskon);

        // Hitung harga bersih
        $hargaBersih = $hargaKotor - $diskon + $ppn;
        ?>
        <div class="success show"> <!-- Tampilkan setelah formulir dikirim -->
            <h2>Ringkasan Transaksi (Sukses)</h2>
            <p><b>Nama Pelanggan:</b> <?php echo $nama; ?></p>
            <p><b>Produk Yang Dibeli:</b> <?php echo $produk; ?></p>
            <p><b>Harga Produk:</b> <?php echo $harga; ?></p>
            <p><b>Jumlah Produk Yang Dibeli:</b> <?php echo $jumlah; ?></p>
            <p><b>Total harga yang dibayarkan:</b> <?php echo $hargaKotor; ?></p>
            <p><b>Diskon yang didapatkan:</b> <?php echo $diskon; ?></p>
            <p><b>PPN:</b> <?php echo $ppn; ?></p>
            <p><b>Harga Bersih:</b> <?php echo $hargaBersih; ?></p>
        </div>
    <?php } ?>
</body>
</html>
