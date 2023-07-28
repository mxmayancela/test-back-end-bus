<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $routes = Route::with('id_city_origin', 'id_city_destination', 'id_bus')->get();
            return $this->responseTo(
                success: true,
                data: $routes,
                status: 200,
                message: 'Se ha obtenido las rutas correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $route = new Route();
            $route->id_city_origin = $request->id_city_origin;
            $route->id_city_destination = $request->id_city_destination;
            $route->id_bus = $request->id_bus;
            $route->save();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha creado la ruta correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function show($id)
    {
        try {
            $route = Route::with('id_city_origin', 'id_city_destination', 'id_bus')->find($id);
            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha obtenido la ruta correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $route = Route::find($id);
            $route->id_city_origin = $request->id_city_origin;
            $route->id_city_destination = $request->id_city_destination;
            $route->id_bus = $request->id_bus;
            $route->save();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha actualizado la ruta correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }

    public function destroy($id)
    {
        try {
            $route = Route::find($id);
            $route->delete();

            return $this->responseTo(
                success: true,
                data: $route,
                status: 200,
                message: 'Se ha eliminado la ruta correctamente',
                typeMessage: 'success'
            );
        } catch (\Throwable $th) {
            return $this->responseTo(
                success: false,
                data: null,
                status: 500,
                message: $th->getMessage(),
                typeMessage: 'danger'
            );
        }
    }
}
