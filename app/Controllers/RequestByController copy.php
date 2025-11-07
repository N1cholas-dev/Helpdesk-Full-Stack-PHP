<?php

namespace App\Controllers;

use App\Models\RequestByModel;

class RequestByController extends BaseController
{
    public function index()
    {
        $requestByModel = new RequestByModel();
        $requestByList = $requestByModel->findAll();

        $data = [
            'requestByList' => $requestByList,
        ];

        return view('request_by/index', $data);
    }

    // Method untuk menambahkan data request_by
    public function create()
    {
        return view('request_by/create');
    }

    public function store()
    {
        $requestByModel = new RequestByModel();
        $requestByModel->save([
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/requestby');
    }

    // Method untuk mengedit data request_by
    public function edit($id)
    {
        $requestByModel = new RequestByModel();
        $requestBy = $requestByModel->find($id);

        if (!$requestBy) {
            return redirect()->to('/requestby')->with('error', 'Request By not found');
        }

        return view('request_by/edit', ['requestBy' => $requestBy]);
    }

    public function update($id)
    {
        $requestByModel = new RequestByModel();
        $requestByModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/requestby')->with('success', 'Request By updated successfully');
    }

    public function delete($id)
    {
        $requestByModel = new RequestByModel();
        $requestByModel->delete($id);

        return redirect()->to('/requestby')->with('success', 'Request By deleted successfully');
    }
}
