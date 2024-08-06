<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrigadaController extends Controller
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
    public function index()
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from brigada");
        //dd($dados);
        return view('brigada',['dados' => $dados]);
    }
    
    public function cadastrar (Request $req)
    {   
        return view('novo-brigada');
    }
    
    public function cadastrarBrigada (Request $req) {
        //dd($req->ordem);
        $logado = auth()->user()->name;
        DB::table('brigada')->insert(
        [
            'ordem'                 => $req->ordem, 
            'tecnico_anterior'      => $req->tecnico_anterior,
            'endereco'              => $req->endereco, 
            'msan'                  => $req->msan,
            'caixa'                 => $req->caixa,
            'causa_abertura'        => $req->causa_abertura,
            'supervisor_anterior'   => $req->supervisor_anterior,
            'data_cadastro'         => $req->data_cadastro,
            'status'                => 'NOVO',
            'login_cadastro'        => $logado
        ]
      );
        return $this->index();
    }
    
    public function ver (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from brigada where id='$req->id'");
        return view('ver-brigada',['dados' => $dados]);
    }


    public function editar (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from brigada where id='$req->id'");
        return view('editar-brigada',['dados' => $dados]);
    }
    
    public function editarBrigada (Request $req)
    {   
        //dd($req->id);
        $dados = [];
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from brigada where id='$req->id'");
        DB::table('brigada')
        ->where('id', $req->id)
        ->update(
        [
            'ordem'                 => $req->ordem, 
            'tecnico_anterior'      => $req->tecnico_anterior,
            'endereco'              => $req->endereco, 
            'msan'                  => $req->msan,
            'caixa'                 => $req->caixa,
            'causa_abertura'        => $req->causa_abertura,
            'supervisor_anterior'   => $req->supervisor_anterior,
            'login_editar'          => $logado
        ]);
        return redirect('/brigada')->with('success','Atualizado com sucesso.');
    }
    
    public function excluir(Request $req){
        DB::delete("delete from brigada WHERE id = $req->id"); 
        return back()->with('success','Excluído com sucesso.');
    }
    
    public function atualizar (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from brigada where id='$req->id'");
        return view('atualizar-brigada',['dados' => $dados]);
    }
    
    public function atualizarBrigada (Request $req)
    {   
        //dd($req->file('antes'));
        date_default_timezone_set('America/Sao_Paulo');
        $correcao = date('d/m/Y H:i:s');
        $foto = date('dmYHis');
        $dados = [];
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from brigada where id='$req->id'");
        //dd(str_replace(' ','_',$logado));
        if (! is_null($req->file('antes'))) {
            $nomeAntes = 'antes_'.$foto.'_'.str_replace(' ','_',$logado).'.'.$req->antes->extension();
            $req->file('antes')->storeAs('/public/brigada', $nomeAntes);      
        } 
        if (! is_null($req->file('depois'))) {
            $nomeDepois = 'depois_'.$foto.'_'.str_replace(' ','_',$logado).'.'.$req->depois->extension();
            $req->file('depois')->storeAs('/public/brigada', $nomeDepois);      
        } 
        
        DB::table('brigada')
        ->where('id', $req->id)
        ->update(
        [
            'encontrado'    => $req->encontrado,
            'tratamento'    => $req->tratamento,
            'antes'         => $nomeAntes,
            'status'        => 'TRATADO',
            'depois'        => $nomeDepois,
            'data_correcao' => $correcao,
            'login_campo'   => $logado
        ]);
        
        return redirect('/brigada')->with('success','Atualizado com sucesso.');
    }

}