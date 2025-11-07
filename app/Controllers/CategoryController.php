<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $categories = $this->categoryModel->findAll();  // Mengambil semua kategori dari database
        return view('TASK/categories/category', ['categories' => $categories]);
    }

    // Menyimpan kategori baru
    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data kategori
        $this->categoryModel->save($data);

        // Flash message for success
        return redirect()->to('TASK/categories/category')->with('success', 'Category successfully created.');
    }

    // Menampilkan form untuk mengedit kategori
    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        // Ambil kategori berdasarkan ID
        $category = $this->categoryModel->find($id); // Mengambil kategori berdasarkan ID
        if (!$category) {
            return redirect()->to('category')->with('error', 'Category not found');
        }

        // Ambil semua kategori yang ada untuk dropdown (jika diperlukan)
        $categories = $this->categoryModel->findAll();

        // Kirim data kategori ke tampilan untuk diedit
        return view('TASK/categories/edit-category', ['category' => $category, 'categories' => $categories]);
    }

    public function update($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('TASK/categories/category')->with('error', 'Category not found');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->categoryModel->update($id, $data);

        // Flash message for success
        return redirect()->to('TASK/categories/category')->with('success', 'Category successfully updated.');
    }

    public function delete($id)
    {
        // Check if category exists before deleting
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('TASK/categories/category')->with('error', 'Category not found');
        }

        $this->categoryModel->delete($id);

        // Flash message for success
        return redirect()->to('TASK/categories/category')->with('success', 'Category successfully deleted.');
    }

}