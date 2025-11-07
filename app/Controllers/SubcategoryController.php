<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;

class SubcategoryController extends BaseController
{
    protected $categoryModel;
    protected $subcategoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->subcategoryModel = new SubcategoryModel();
    }

    // Menampilkan daftar subkategori
    public function index()
    {
        // Ambil semua subkategori dan kategori
        $subcategories = $this->subcategoryModel->findAll();
        $categories = $this->categoryModel->findAll();

        return view('TASK/subcategories/subcategory', [
            'subcategories' => $subcategories,
            'categories' => $categories
        ]);
    }

    // Menampilkan form tambah subkategori
    public function create()
    {
        // Ambil kategori untuk dropdown
        $categories = $this->categoryModel->findAll();

        return view('TASK/subcategories/create-subcategory', [
            'categories' => $categories
        ]);
    }

    // Menyimpan subkategori baru
    public function store()
    {
        // Insert data ke database
        $this->subcategoryModel->insert([
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id')
        ]);

        // Set flashdata untuk sukses (hapus with())
        session()->setFlashdata('success', 'Subcategory successfully created.');

        return redirect()->to('TASK/subcategories/subcategory'); // Pastikan redirect benar
    }

    // Menampilkan form edit subkategori
    public function edit($id)
    {
        $subcategory = $this->subcategoryModel->find($id);
        $categories = $this->categoryModel->findAll();

        return view('TASK/subcategories/edit-subcategory', [
            'subcategory' => $subcategory,
            'categories' => $categories
        ]);
    }

    // Memperbarui subkategori
    public function update($id)
    {
        $this->subcategoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id')
        ]);

        // Flash success message and redirect
        session()->setFlashdata('success', 'Subcategory successfully updated.');
        return redirect()->to('TASK/subcategories/subcategory');
    }

    // Menghapus subkategori
    public function delete($id)
    {
        $this->subcategoryModel->delete($id);
        session()->setFlashdata('success', 'deleted');

        return redirect()->to('TASK/subcategories/subcategory');
    }

}
