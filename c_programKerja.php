<?php
session_start();
include_once("m_programKerja.php");

class c_programKerja {
    public $model;

    public function __construct() {
        $this->model = new m_programKerja();
    }

    public function invoke() {
        if (!isset($_SESSION['role'])) {
            header("Location: login.php");
            exit;
        }

        if (isset($_POST['action'])) {
            if ($_SESSION['role'] == 'Kepala Departemen') {
                if ($_POST['action'] == 'create') {
                    $this->model->createProgramKerja($_POST['namaProgram'], $_POST['suratKeterangan']);
                } elseif ($_POST['action'] == 'update') {
                    $this->model->updateProgramKerja($_POST['nomorProgram'], $_POST['namaProgram'], $_POST['suratKeterangan']);
                } elseif ($_POST['action'] == 'delete') {
                    $this->model->deleteProgramKerja($_POST['nomorProgram']);
                }
            }
        }

        $programKerja = $this->model->getSemuaProgramKerja();
        include 'v_programKerja.php';
    }
}