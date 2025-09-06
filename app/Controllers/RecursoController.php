<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\RecursoModel;
use App\Models\Editorial;
use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;


class RecursoController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('vw_listar_recursos');
        $data['recursos'] = $builder->get()->getResultArray();

        $data['header'] = view('Layouts/header');
        $data['footer'] = view('Layouts/footer');

        return view('recursos/index', $data);
    }

    public function crear()
    {
        $editorialModel   = new Editorial();
        $categoriaModel   = new CategoriaModel();
        $subcategoriaModel= new SubcategoriaModel();

        $data['editoriales']   = $editorialModel->findAll();
        $data['categorias']    = $categoriaModel->findAll();
        $data['subcategorias'] = $subcategoriaModel->findAll();

        $data['header'] = view('Layouts/header');
        $data['footer'] = view('Layouts/footer');

        return view('recursos/crear', $data);
    }

    public function guardar()
    {
        $recursoModel = new RecursoModel();

        $data = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial'    => $this->request->getPost('ideditorial'),
            'tipo'           => $this->request->getPost('tipo'),
            'titulo'         => $this->request->getPost('titulo'),
            'apublicacion'   => $this->request->getPost('apublicacion'),
            'isbn'           => $this->request->getPost('isbn'),
            'numpaginas'     => $this->request->getPost('numpaginas'),
            'estado'         => $this->request->getPost('estado'),
        ];

        // Subir portada
        $portada = $this->request->getFile('rutaportada');
        if ($portada && $portada->isValid()) {
            $nombrePortada = $portada->getRandomName();
            $portada->move('uploads', $nombrePortada);
            $data['rutaportada'] = $nombrePortada;
        }

        // Subir recurso PDF
        $archivo = $this->request->getFile('rutarecurso');
        if ($archivo && $archivo->isValid()) {
            $nombreArchivo = $archivo->getRandomName();
            $archivo->move('uploads', $nombreArchivo);
            $data['rutarecurso'] = $nombreArchivo;
        }

        $recursoModel->insert($data);
        return redirect()->to('/recursos');
    }

    public function editar($id)
    {
        $recursoModel = new RecursoModel();
        $editorialModel   = new Editorial();
        $categoriaModel   = new CategoriaModel();
        $subcategoriaModel= new SubcategoriaModel();

        $data['recurso']      = $recursoModel->find($id);
        $data['editoriales']  = $editorialModel->findAll();
        $data['categorias']   = $categoriaModel->findAll();
        $data['subcategorias']= $subcategoriaModel->findAll();

        $data['header'] = view('Layouts/header');
        $data['footer'] = view('Layouts/footer');

        return view('recursos/editar', $data);
    }

    public function actualizar()
    {
        $recursoModel = new RecursoModel();
        $id = $this->request->getPost('idrecurso');

        $data = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial'    => $this->request->getPost('ideditorial'),
            'tipo'           => $this->request->getPost('tipo'),
            'titulo'         => $this->request->getPost('titulo'),
            'apublicacion'   => $this->request->getPost('apublicacion'),
            'isbn'           => $this->request->getPost('isbn'),
            'numpaginas'     => $this->request->getPost('numpaginas'),
            'estado'         => $this->request->getPost('estado'),
        ];

        // Subir nueva portada si se proporciona
        $portada = $this->request->getFile('rutaportada');
        if ($portada && $portada->isValid()) {
            $nombrePortada = $portada->getRandomName();
            $portada->move('uploads', $nombrePortada);
            $data['rutaportada'] = $nombrePortada;
        }

        // Subir nuevo recurso PDF si se proporciona
        $archivo = $this->request->getFile('rutarecurso');
        if ($archivo && $archivo->isValid()) {
            $nombreArchivo = $archivo->getRandomName();
            $archivo->move('uploads', $nombreArchivo);
            $data['rutarecurso'] = $nombreArchivo;
        }

        $recursoModel->update($id, $data);
        return redirect()->to('/recursos');
    }

    public function eliminar($id)
    {
        $recursoModel = new RecursoModel();
        $recursoModel->delete($id);
        return redirect()->to('/recursos');
    }
}
