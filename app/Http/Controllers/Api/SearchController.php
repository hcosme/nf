<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  public function search(Request $req){
      
     if ($req[0]['token'] == '' || isset($req[0]['token'])) {
         $retorno = "Favor Informar o Token.";
     } else {
         $consultaToken = DB::select("SELECT *  FROM token_api where token = '".$req[0]['token']."'");
         if ($consultaToken == '' || empty($consultaToken)) {
             $retorno = "Acesso Negado.";
         } else {
            $consulta = DB::select("SELECT * FROM {$req[0]['projeto']} where cpf = {$req[0]['cpf']} AND data LIKE  '".$req[0]['mes']."%' ");
            if ($consulta == '' || empty($consulta)) {
                $retorno = "Seus dados nПлкo foram encontrados. Favor entrar em contato com seu gestor.";
            } else {
                $retorno = $consulta;
            }
        }
     }
    return $retorno;
  }
}
