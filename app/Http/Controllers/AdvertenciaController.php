<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertenciaController extends Controller
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
        $emailLogado = auth()->user()->email;
        $dados['dados'] = DB::select("Select * from advertencia where usuario = '$emailLogado'");
        $dados['aplicadores'] = DB::select("Select lider_aplicacao from advertencia where usuario = '$emailLogado' group by lider_aplicacao");
        $dados['pendente'] = DB::select("Select * from advertencia where status != 'aplicadas' and usuario = '$emailLogado'");
        $dados['aplicadas'] = DB::select("Select * from advertencia where status = 'aplicadas' and usuario = '$emailLogado'");
        return view('advertencia/index',['dados' => $dados]);
    }

    public function cadastrar (Request $req)
    {
        $dados['dados'] = DB::select("Select 
                                        supervisor, 
                                        gerente, 
                                        coordenador, 
                                        tecnicos from headcount_advertencia group by tecnicos order by gerente, coordenador, supervisor, tecnicos asc");
                                        
        return view('advertencia/novo',['dados' => $dados]);
    }

    public function cadastrarAdvertencia (Request $req) 
    {
        date_default_timezone_set('America/Sao_Paulo');
        $logado = auth()->user()->name;
        $hoje = date('Y-m-d H:i:s');
        $dados['dados'] = DB::select("Select * from headcount_advertencia where tecnicos='$req->colaborador'");
        $cpf = $dados['dados'][0]->cpf;

        DB::table('advertencia')->insert(
        [
            'colaborador'           => $req->colaborador,
            'motivo'                => $req->motivo,
            'data_ocorrido'         => $req->data_ocorrido,
            'local_ocorrido'        => $req->local_ocorrido,
            'data_aplicacao'        => $req->data_aplicacao,
            'local_aplicacao'       => $req->local_aplicacao,
            'horario_aplicacao'     => $req->horario_aplicacao,
            'lider_aplicacao'       => $req->lider_aplicacao,
            'tipo_advertencia'      => $req->tipo_advertencia,
            'status'                => $req->status,
            'consideracoes'         => $req->consideracoes,
            'prazo'                 => $req->prazo,
            'usuario'               => $logado,
            'cpf'                   => $cpf,
            'data_cadastro'         => $hoje
        ]
      );
        return redirect('/advertencia')->with('success','Cadastrado com sucesso.');
    }

    public function editar (Request $req)
    {
        $dados = [];
        $dados['info'] = DB::select("Select 
                                        supervisor, 
                                        gerente, 
                                        coordenador, 
                                        tecnicos from headcount group by tecnicos order by gerente, coordenador, supervisor, tecnicos asc");
        
        $dados['dados'] = DB::select("Select * from advertencia where id='$req->id'");
        return view('advertencia/editar',['dados' => $dados]);
    }

    public function editarAdvertencia (Request $req)
    {
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from advertencia where id='$req->id'");
        $hojeFoto = date('YmdHis');
        $logadoFoto = auth()->user()->id;
        $numero = str_pad(rand(1, 9999), 4, 0, STR_PAD_LEFT);
        
        if ($req->file('anexo') != null || $req->file('anexo') != '') {
            $anexo =  'anexo'.'_'.$hojeFoto.'_'.$logadoFoto.'.'.$req->anexo->extension();
            $status = 'APLICADAS';
            $req->file('anexo')->storeAs('/public/advertencia', $anexo);   
        } else {
            $anexo = '';
            $status = $req->status;
            
        }
        
        DB::table('advertencia')
        ->where('id', $req->id)
        ->update(
        [
            'colaborador'           => $req->colaborador,
            'motivo'                => $req->motivo,
            'data_ocorrido'         => $req->data_ocorrido,
            'local_ocorrido'        => $req->local_ocorrido,
            'data_aplicacao'        => $req->data_aplicacao,
            'local_aplicacao'       => $req->local_aplicacao,
            'horario_aplicacao'     => $req->horario_aplicacao,
            'lider_aplicacao'       => $req->lider_aplicacao,
            'tipo_advertencia'      => $req->tipo_advertencia,
            'status'                => $status,
            'consideracoes'         => $req->consideracoes,
            'prazo'                 => $req->prazo,
            'usuario'               => $logado,
            'anexo'                 => $anexo
        ]);
        return redirect('/advertencia')->with('success','Atualizado com sucesso.');
    }
    
    public function ver (Request $req)
    {
        $dados = [];
        $dados['info'] = DB::select("Select 
                                        supervisor, 
                                        gerente, 
                                        coordenador, 
                                        tecnicos from headcount_advertencia  group by tecnicos order by gerente, coordenador, supervisor, tecnicos asc");
        
        $dados['dados'] = DB::select("Select * from advertencia where id='$req->id'");
        
        return view('advertencia/advertencia',['dados' => $dados]);
    }
    
    public function ver_anexo (Request $req)
    {
        $dados = [];
        
        $dados['dados'] = DB::select("Select * from advertencia where id='$req->id' and usuario = '$emailLogado'");
        
        return view('advertencia/ver-anexo',['dados' => $dados]);
    }

    
}