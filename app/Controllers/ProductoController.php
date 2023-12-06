<?php

namespace App\Controllers;

use App\Entities\ProductoEntity;
use App\Models\ProductoModel;

/**
 * Clase que actúa como un controlador para los diferentes servicios
 * para gestionar operaciones CRUD con los productos.
 * 
 * @extends BaseController Clase Base de controlador proporcionada por CodeIgniter.
 */
class ProductoController extends BaseController
{
    /**
     * Muestra la vista de la tabla de productos.
     *
     * Este método carga y devuelve la vista correspondiente a la página principal.
     * 
     * @return string La vista renderizada de inicio en donde está la tabla.
     */
    public function vistaProducto(){
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();
        return view("producto/inicio",[
            "productos" => $productos
        ]);
    }

    /**
     * Muestra la vista de crear producto.
     *
     * Este método carga y devuelve la vista correspondiente a la página de crear producto.
     * 
     * @return string La vista renderizada de crear producto.
     */
    public function vistaCrearProducto(){
        return view("producto/crear");
    }

    /**
     * Muestra la vista de editar producto.
     *
     * Este método carga y devuelve la vista correspondiente a la página de editar producto.
     * 
     * @param mixed $id El ID del producto a editar.
     * 
     * @return string La vista renderizada de editar producto.
     */
    public function vistaEditarProducto($id){
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        $producto = new ProductoEntity(get_object_vars($productoID));

        return view("producto/editar",[
            "producto" => $producto
        ]);
    }

    /**
     * Crea un nuevo producto utilizando los datos proporcionados.
     *
     * Este método procesa la creación de un nuevo producto, valida los datos del formulario,
     * y, si son válidos, inserta el producto en la base de datos, de lo contrario muestra mensajes de error.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige la página dependiendo de la validación.
     */
    public function crearProducto(){
        $POST = $this->request->getPost();
        $producto = new ProductoEntity($POST);
        $alertas = $producto->validar_producto();
        if(empty($alertas)){
            $productoModel = new ProductoModel();
            try {
                $productoModel->insert($producto);
                return redirect()->to(base_url('/inicio'));
            } catch (\Throwable $th) {
                $alertas["error"][] = "Algo salio mal al crear el producto. Por favor, inténtalo de nuevo.";
            }
        }

        return redirect()->to(base_url('inicio/producto/crear'))->withInput()->with('errors', $alertas);
    }
    
    /**
     * Edita un producto existente utilizando los datos proporcionados.
     *
     * Este método procesa la edición de un producto existente, valida los datos del formulario,
     * y, si son válidos, actualiza el producto en la base de datos, de lo contrario muestra mensajes de error.
     * 
     * @param mixed $id El ID del producto a editar.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige la página dependiendo de la validación.
     */
    public function editarProducto($id){
        $productoModel = new ProductoModel();
        $POST = $this->request->getPost();
        $producto = new ProductoEntity($POST);
        $alertas = $producto->validar_producto();
        if(empty($alertas)){
            try {
                $productoModel->update($id, $producto);
                return redirect()->to(base_url('/inicio'));
            } catch (\Throwable $th) {
                $alertas["error"][] = "Algo salio mal al editar el certificado. Por favor, inténtalo de nuevo.";
            };
        }
        return redirect()->to(base_url('inicio/producto/editar/'.$id))->withInput()->with('errors', $alertas);
    }

    /**
     * Elimina un producto existente de la base de datos.
     *
     * Este método busca un producto por su ID, y si existe, lo elimina de la base de datos
     * de forma permanente, de lo contrario, no realiza ninguna acción     
     * 
     * @param mixed $id El ID del producto a eliminar.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige la página de la tabla de productos.
     */
    public function eliminarProducto($id){
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        if(!empty($productoID)){
            $productoModel->delete($id);
            return redirect()->to(base_url('/inicio'));
        }
    }
}
