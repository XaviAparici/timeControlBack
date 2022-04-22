<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $sql = "select * from usuarios";
        $usuarios = DB::select($sql);
        return $usuarios;
    }

    public function horaInicio(Request $request)
    {
        $ubicacion = json_encode($request->ubicacion);
        $fechaHoy = date("Y-m-d");
        DB::insert("insert into registrohoras (ubicacion, idUsuario) values (".$ubicacion." ,1)");
    }

    public function getData()
    {
        $fechaHoy = date("Y-m-d");
        $sql = "select horaInicio, horaFin from registrohoras where idUsuario = 1 and horaInicio BETWEEN '".$fechaHoy." 00:00:00' and '".$fechaHoy." 23:59:59' ORDER by horaInicio ASC LIMIT 1";
        $mostrar = DB::select($sql);
        return $mostrar;
    }

    public function horaFin()
    {
        $fecha = date("Y-m-d");
        $fechaActual = date("Y-m-d H:i:s");
        $sql = "select horaInicio from registrohoras where idUsuario = 1 and horaInicio BETWEEN '".$fecha." 00:00:00' and '".$fecha." 23:59:59' ORDER by id DESC LIMIT 1";
        $ultimoInicio = DB::select($sql);
        if(count($ultimoInicio)>0){
            DB::update("update registrohoras set horaFin = '".$fechaActual."' where idUsuario = 1 and horaInicio = '".$ultimoInicio[0]->horaInicio."'");
        }
    }
}
