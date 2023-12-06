<?php

namespace App\Controllers;

use App\Entities\ProductoEntity;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;

/**
 * Controlador para gestionar las operaciones relacionadas con productos.
 */
class ProductoController extends BaseController
{
    /**
     * Muestra la página de inicio con la lista de productos.
     *
     * @return mixed Vista de inicio con la lista de productos.
     */
    public function index()
    {
        $productoModel = new ProductoModel();
        $productos = $productoModel->findAll();
        return view("pagina/producto/inicio", [
            "productos" => $productos
        ]);
    }

    /**
     * Crea un nuevo producto.
     *
     * @return mixed Vista de creación de productos o redirección a la página de inicio.
     */
    public function crear()
    {
        $alertas = [];
        $producto = new ProductoEntity();

        if ($this->request->getServer("REQUEST_METHOD") === "POST") {
            $POST = $this->request->getPost();
            $producto = new ProductoEntity($POST);
            $alertas = $producto->validar_producto();
            if (empty($alertas)) {
                $productoModel = new ProductoModel();
                $productoModel->insert($producto);
                return redirect()->to(base_url('/inicio'));
            }
        }

        return view("pagina/producto/crear", [
            "alertas" => $alertas,
            "producto" => $producto
        ]);
    }

    /**
     * Edita un producto existente.
     *
     * @param int $id ID del producto a editar.
     * @return mixed Vista de edición de productos o redirección a la página de inicio.
     */
    public function editar($id)
    {
        $alertas = [];
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        $producto = new ProductoEntity(get_object_vars($productoID));

        if ($this->request->getServer("REQUEST_METHOD") === "POST") {
            $POST = $this->request->getPost();
            $producto = new ProductoEntity($POST);
            $alertas = $producto->validar_producto();
            if (empty($alertas)) {
                $productoModel->update($id, $producto);
                return redirect()->to(base_url('/inicio'));
            }
        }

        return view("pagina/producto/editar", [
            "producto" => $producto,
            "alertas" => $alertas
        ]);
    }

    /**
     * Elimina un producto existente.
     *
     * @param int $id ID del producto a eliminar.
     * @return mixed Redirección a la página de inicio.
     */
    public function eliminar($id)
    {
        $productoModel = new ProductoModel();
        $productoID = $productoModel->find($id);
        if (!empty($productoID)) {
            $productoModel->delete($id);
            return redirect()->to(base_url('/inicio'));
        }
    }
}
