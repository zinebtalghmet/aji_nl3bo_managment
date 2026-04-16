<?php
namespace App\Controllers;

use App\Models\Category;

class CategoryController {
    private $categoryModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /aji_nl3bo_managment/login');
            exit;
        }
        $this->categoryModel = new Category();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../Views/categories/index.php';
    }

    public function create() {
        require __DIR__ . '/../Views/categories/create.php';
    }

    public function store() {
        $name = $_POST['name'];
        $this->categoryModel->createCategory($name);
        header('Location: /aji_nl3bo_managment/categories');
        exit;
    }

    public function edit($id) {
        $category = $this->categoryModel->getCategoryById($id);
        require __DIR__ . '/../Views/categories/edit.php';
    }

    public function update($id) {
        $name = $_POST['name'];
        $this->categoryModel->updateCategory($id, $name);
        header('Location: /aji_nl3bo_managment/categories');
        exit;
    }

    public function destroy($id) {
        $this->categoryModel->delete($id);
        header('Location: /aji_nl3bo_managment/categories');
        exit;
    }
}
