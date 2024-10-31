<?php

require "koneksiMVC.php";

class m_programKerja {
    private $namaProgram;
    private $suratKeterangan;
    public $hasil = array();

    public function __construct($namaProgram = null, $suratKeterangan = null) {
        $this->namaProgram = $namaProgram;
        $this->suratKeterangan = $suratKeterangan;
    }

    private function getNextNomorProgram() {
        global $mysqli;
        $result = $mysqli->query("SELECT COUNT(*) AS total FROM programKerja");
        $row = $result->fetch_assoc();
        return $row['total'] + 1;
    }

    public function createProgramKerja($namaProgram, $suratKeterangan) {
        global $mysqli;

        $duplicateCheck = $mysqli->query("SELECT * FROM programKerja WHERE namaProgram = '$namaProgram' AND suratKeterangan = '$suratKeterangan'");
        if ($duplicateCheck->num_rows > 0) {
            return;
        }

        $nomorProgram = $this->getNextNomorProgram();

        $mysqli->query("INSERT INTO programKerja (nomorProgram, namaProgram, suratKeterangan) VALUES ('$nomorProgram', '$namaProgram', '$suratKeterangan')");
    }

    public function getSemuaProgramKerja() {
        global $mysqli;
        $rs = $mysqli->query("SELECT * FROM programKerja ORDER BY nomorProgram ASC");
        $rows = array();

        while($row = $rs->fetch_assoc()) {
            $rows[] = $row;
        }
        $this->hasil = $rows;

        return $this->hasil;
    }

    public function updateProgramKerja($nomorProgram, $namaProgram, $suratKeterangan) {
        global $mysqli;

        $duplicateCheck = $mysqli->query("SELECT * FROM programKerja WHERE namaProgram = '$namaProgram' AND suratKeterangan = '$suratKeterangan' AND nomorProgram != '$nomorProgram'");
        if ($duplicateCheck->num_rows > 0) {
            return;
        }

        $mysqli->query("UPDATE programKerja SET namaProgram='$namaProgram', suratKeterangan='$suratKeterangan' WHERE nomorProgram='$nomorProgram'");
    }

    public function deleteProgramKerja($nomorProgram) {
        global $mysqli;
        $mysqli->query("DELETE FROM programKerja WHERE nomorProgram='$nomorProgram'");

        $this->resequenceNomorProgram();
    }

    private function resequenceNomorProgram() {
        global $mysqli;

        $result = $mysqli->query("SELECT * FROM programKerja ORDER BY nomorProgram ASC");
        $nomor = 1;

        while ($row = $result->fetch_assoc()) {
            $currentNomorProgram = $row['nomorProgram'];
            if ($currentNomorProgram != $nomor) {
                $mysqli->query("UPDATE programKerja SET nomorProgram = '$nomor' WHERE nomorProgram = '$currentNomorProgram'");
            }
            $nomor++;
        }
    }
}