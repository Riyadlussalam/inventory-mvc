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
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Tambah Program Kerja</h2>
    <form method="post" action="index.php">
        <input type="hidden" name="action" value="create">
        <label>Nama Program Kerja :</label>
        <input type="text" name="namaProgram" required>
        
        <label>Surat Keterangan :</label>
        <input type="text" name="suratKeterangan" required>
        
        <input type="submit" value="Simpan Program Kerja">
    </form>
</body>
</html>
