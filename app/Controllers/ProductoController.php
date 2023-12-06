<?php

namespace App\Controllers;

use App\Entities\ProductoEntity;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;

class ProductoController extends BaseController
{
    public function vistaProducto(){
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();
        return view("producto/inicio",[
            "productos" => $productos
        ]);
    }

    public function vistaCrearProducto(){
        return view("producto/crear");
    }

    public function vistaEditarProducto($id){
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        $producto = new ProductoEntity(get_object_vars($productoID));

        return view("producto/editar",[
            "producto" => $producto
        ]);
    }

    public function crearProducto(){
        $POST = $this->request->getPost();
        $producto = new ProductoEntity($POST);
        $alertas = $producto->validar_producto();
        if(empty($alertas)){
            $productoModel = new ProductoModel();
            $productoModel->insert($producto);
            return redirect()->to(base_url('/inicio'));
        }

        return redirect()->to(base_url('inicio/producto/crear'))->withInput()->with('errors', $alertas);
    }
    
    public function editarProducto($id){
        $productoModel = new ProductoModel();
        $POST = $this->request->getPost();
        $producto = new ProductoEntity($POST);
        $alertas = $producto->validar_producto();
        if(empty($alertas)){
            $productoModel->update($id, $producto);
            return redirect()->to(base_url('/inicio'));
        }
        return redirect()->to(base_url('inicio/producto/editar/'.$id))->withInput()->with('errors', $alertas);
    }
    public function eliminarProducto($id){
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        if(!empty($productoID)){
            $productoModel->delete($id);
            return redirect()->to(base_url('/inicio'));
        }
    }
}
