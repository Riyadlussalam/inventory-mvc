<?php
session_start();
if (!isset($_SESSION['NIM'])) {
    header("Location: login.php");
    exit;
}

require "m_programKerja.php";
$model = new m_programKerja();
$programKerja = $model->getSemuaProgramKerja();
?>

<html>
<head>
    <title>Halaman Administrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            font-weight: bold;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button {
            font-family: Arial, sans-serif;
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin: 10px 0;
            text-decoration: none;
        }
        .button:hover {
            background-color: #45a049;
        }
        .delete-button {
            font-family: Arial, sans-serif;
            font-weight: bold;
            background-color: #f44336;
            color: white;
            border: none;
            padding: 3px 6px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin: 10px 0;
            text-decoration: none;
        }
        .update-button {
            font-family: Arial, sans-serif;
            font-weight: bold;
            background-color: blue;
            color: white;
            border: none;
            padding: 3px 6px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin: 10px 0;
            text-decoration: none;
        }
        .delete-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> (<?php echo $_SESSION['role']; ?>)</h2>

    <?php if ($_SESSION['role'] == 'Kepala Departemen'): ?>
        <a href="input_programKerja.php" class="button">Tambah Program Kerja Baru</a>
    <?php endif; ?>

    <h3>Daftar Program Kerja</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Program Kerja</th>
                <th>Surat Keterangan</th>
                <?php if ($_SESSION['role'] == 'Kepala Departemen'): ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programKerja as $proker): ?>
                <tr>
                    <td><?php echo $proker['nomorProgram']; ?></td>
                    <td><?php echo $proker['namaProgram']; ?></td>
                    <td><?php echo $proker['suratKeterangan']; ?></td>
                    <?php if ($_SESSION['role'] == 'Kepala Departemen'): ?>
                        <td>
                            <a href="update_programKerja.php?nomorProgram=<?php echo $proker['nomorProgram']; ?>" class="update-button">Update</a>
                            <form method="post" action="index.php" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="nomorProgram" value="<?php echo $proker['nomorProgram']; ?>">
                                <input type="submit" value="Hapus" class="delete-button">
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br><a style="background-color: #e53935;" href="logout.php" class="button">Logout</a>
</body>
</html>