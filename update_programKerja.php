<?php
require "koneksiMVC.php";
require_once "m_programKerja.php";

if (isset($_GET['nomorProgram'])) {
    $nomorProgram = $_GET['nomorProgram'];

    $model = new m_programKerja();
    $programKerja = $model->getSemuaProgramKerja();
    
    foreach ($programKerja as $proker) {
        if ($proker['nomorProgram'] == $nomorProgram) {
            $namaProgram = $proker['namaProgram'];
            $suratKeterangan = $proker['suratKeterangan'];
            break;
        }
    }
} else {
    die("Nomor program tidak ditemukan.");
}
?>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 300px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        } 
    </style>
</head>
<body>
    <h2>Update Program Kerja</h2>
    <form method="post" action="admin.php">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="nomorProgram" value="<?php echo $nomorProgram; ?>">

        <label>Nama Program Kerja:</label>
        <input type="text" name="namaProgram" value="<?php echo $namaProgram; ?>" required>

        <label>Surat Keterangan:</label>
        <input type="text" name="suratKeterangan" value="<?php echo $suratKeterangan; ?>" required>

        <input type="submit" value="Update Program Kerja">
    </form>
</body>
</html>
