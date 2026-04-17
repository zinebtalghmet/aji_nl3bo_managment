<?php
namespace App\Controllers;

use App\Models\Table;

class TableController
{
    private Table $tableModel;

    public function __construct()
    {
        $this->tableModel = new Table();
    }

    public function index()
    {
        $tables = $this->tableModel->getAll();
        require __DIR__ . '/../Views/tables/index.php';
    }

    public function updateStatus(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];

            $this->tableModel->updateStatus($id, $status);

            header('Location: ' . BASE_URL . '/tables');
            exit;
        }
    }
}