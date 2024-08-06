<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrotaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    { 
        
        $dados = [];
        $dados['informacao'] = DB::Select("select * from frota ");
        $dados['cdc'] = DB::select("Select CDC as cdc
                                FROM `frota`
                                group by CDC order by CDC");
        
        
        return view('frota/index',['dados' => $dados]);
    }

   
    public function ver(Request $req)
    { 
        $id = $req->id;
        $dados = [];
        $dados['informacao'] = DB::Select("select * from bonificacao where id_ = $id");
        return view('visualizar_rv',['dados' => $dados]);
    }
}
    