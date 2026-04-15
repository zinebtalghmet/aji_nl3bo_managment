<?php
namespace App\Controllers;

use App\Models\Reservation;
use App\Models\Table;

class ReservationController
{
    private Reservation $reservationModel;
    private Table $tableModel;

    public function __construct()
    {
        $this->reservationModel = new Reservation();
        $this->tableModel = new Table();
    }

    public function index()
    {
        $reservations = $this->reservationModel->getAll();
        require __DIR__ . '/../Views/reservations/index.php';
    }

    public function create()
    {
        $tables = $this->tableModel->getFreeTables();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'] ?? null,
                'table_id' => $_POST['table_id'],
                'client_name' => $_POST['client_name'],
                'client_phone' => $_POST['client_phone'],
                'reserved_at' => $_POST['reserved_at'],
                'status' => 'confirmed'
            ];

            $this->reservationModel->create($data);

            $this->tableModel->updateStatus($data['table_id'], 'occupied');

            header('Location: /reservations');
            exit;
        }

        require __DIR__ . '/../Views/reservations/create.php';
    }

    public function cancel(int $id)
    {
        $reservation = $this->reservationModel->getById($id);

        if ($reservation) {
            $this->tableModel->updateStatus($reservation['table_id'], 'free');

            $this->reservationModel->delete($id);
        }

        header('Location: /reservations');
        exit;
    }
}