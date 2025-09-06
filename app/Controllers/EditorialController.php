<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Editorial;

class EditorialController extends BaseController
{
    public function index()
    {
        $editorialModel = new Editorial();
        $data['editoriales'] = $editorialModel->findAll();

        $data['header'] = view('Layouts/header');
        $data['footer'] = view('Layouts/footer');

        return view('editoriales/index', $data);
    }

    public function crear()
{
    $editorialModel = new \App\Models\Editorial();
    $data['editoriales'] = $editorialModel->findAll();

    $data['header'] = view('Layouts/header');
    $data['footer'] = view('Layouts/footer');

    return view('editoriales/crear', $data);
}


    public function guardar()
    {
        $editorialModel = new Editorial();
        $editorialModel->insert([
            'empresa'      => $this->request->getPost('empresa'),
            'nacionalidad' => $this->request->getPost('nacionalidad')
        ]);

        return redirect()->to('/editoriales');
    }
}
