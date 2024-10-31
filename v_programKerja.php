<html>
<head>
    <style>
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
    <h2 style="font-family: Arial, sans-serif; font-weight: bold; margin-top: 20px;">Daftar Program Kerja BEM</h2> <br>

    <?php if ($_SESSION['role'] == 'Kepala Departemen'): ?>
    <a href="input_programKerja.php" class="button">Tambah Program Kerja Baru</a> <br><br>
    <?php endif; ?>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Program Kerja</th>
                <th>Surat Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($programKerja) && is_array($programKerja)) {
                foreach ($programKerja as $proker) {
                    echo "<tr>",
                         "<td>{$proker['nomorProgram']}</td>",
                         "<td>{$proker['namaProgram']}</td>",
                         "<td>{$proker['suratKeterangan']}</td>",
                         "<td>
                            <a href='update_programKerja.php?nomorProgram={$proker['nomorProgram']}' class='update-button'>Update</a>
                            <form method='post' action='' style='display:inline;'>
                                <input type='hidden' name='nomorProgram' value='{$proker['nomorProgram']}'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='submit' value='Hapus' class='delete-button'>
                            </form>
                         </td>",
                         "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' align='center'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>