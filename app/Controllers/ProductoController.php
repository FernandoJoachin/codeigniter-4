<?php

namespace App\Controllers;

use App\Entities\ProductoEntity;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;

class ProductoController extends BaseController
{
    public function index(){
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();
        return view("pagina/inicio",[
            "productos" => $productos
        ]);
    }

    public function crear(){
        $alertas = [];
        $producto = new ProductoEntity();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $producto = new ProductoEntity($POST);
            $alertas = $producto->validar_producto();
            if(empty($alertas)){
                $productoModel = new ProductoModel();
                $productoModel->insert($producto);
                return redirect()->to(base_url('/inicio'));
            }
        }

        return view("pagina/crear", [
            "alertas" => $alertas,
            "producto" => $producto
        ]);
    }
    
    public function editar($id){
        $alertas = [];
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        $producto = new ProductoEntity(get_object_vars($productoID));

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $producto = new ProductoEntity($POST);
            $alertas = $producto->validar_producto();
            if(empty($alertas)){
                $productoModel->update($id, $producto);
                return redirect()->to(base_url('/inicio'));
            }
        }

        return view("pagina/editar",[
            "producto" => $producto,
            "alertas" => $alertas
        ]);
    }
    public function eliminar($id){
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        if(!empty($productoID)){
            $productoModel->delete($id);
            return redirect()->to(base_url('/inicio'));
        }
        return view("pagina/eliminar");
    }
}
