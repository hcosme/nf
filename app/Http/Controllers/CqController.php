<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CqController extends Controller
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

    public function cq(Request $req)
    {   
        $request = $req->all();
        
        if (isset($request['inicio'])) {
            if($request['inicio'] == null) {
                $data = '';
            } else {
                $dataInicio = date('d/m/Y',strtotime($request['inicio']));
                $dataFim = date('d/m/Y',strtotime($request['fim']));
                $data = " and data between '{$dataInicio}' and '{$dataFim}'";
            }
        } else {
            $data = '';
        }
        
        
        if (isset($request['estado'])) {
            if ($request['estado'] == 'MS') {
                $estado = " and cidade = 'CAMPO GRANDE'";
            }
            else {
                $estado = " and cidade != 'CAMPO GRANDE'";
            }        
        } else {
            $estado = "";
        }
        
        
        
        if (isset($request['status'])) {
            if ($request['status'] == 'pendente') {
                $status = " and cracha = ''";
            } else {
                $status = " and cracha != ''";
            }
        } else {
            $status = "";
        }
        
        
        if (isset($request['tecnico'])) {
            if ($request['tecnico'] == '' || $request['tecnico'] == 'TODOS') {
                $tecnico = "";
            }
            else {
                $tecnico = " and tecnico = '{$request['tecnico']}'";
            }
        } else {
            $tecnico = "";
        }
        
        $dados = [];
        $dados['dados'] = DB::select("Select * from cq where tecnico != 'tecnico' $estado $tecnico $status $data ");
        $dados['pendentes'] = DB::select("Select count(cidade) as QTD from cq where tecnico != 'tecnico' and cracha = '' $estado $tecnico  $data ");
        $dados['realizados'] = DB::select("Select count(cidade) as QTD from cq where tecnico != 'tecnico' and cracha != '' $estado $tecnico  $data ");
        $dados['tecnico'] = DB::select("Select tecnico from cq where tecnico != 'tecnico'  $estado  group by tecnico asc");
        return view('cq/cq',['dados' => $dados]);
    }
    
    public function ver_cq (Request $req)
    {   
        $info = $req->all();
        $id = $info['id'];
        $dados = [];
        $dados['dados'] = DB::select("Select * from cq where tecnico != 'tecnico' and id={$id}");
        return view('cq/ver',['dados' => $dados]);
    }
 
     public function visualizar_cq (Request $req)
    {   
        $info = $req->all();
        $id = $info['id'];
        $dados = [];
        $dados['dados'] = DB::select("Select * from cq where tecnico != 'tecnico' and id={$id}");
        return view('cq/visualizar',['dados' => $dados]);
    }
 
 
    public function editar_cq_gravar (Request $req)
    {   
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $hora = date('H:i:s');
        $logado = auth()->user()->name;
        $credenciada = auth()->user()->credenciada;
        DB::table('cq')
        ->where('id', $req->id)
        ->update(
        [
            'cracha' => $req->cracha, 
            'cordial' => $req->cordial,
            'trajeto' => $req->trajeto,
            'cabeamento' => $req->cabeamento,
            'funcionamento' => $req->funcionamento,
            'duvidas' => $req->duvidas,
            'senha_wifi' => $req->senha_wifi,
            'assinatura_digital' => $req->assinatura_digital,
            'numero_pessoal' => $req->numero_pessoal,
            'limpo'     => $req->limpo,
            'danos' => $req->danos,
            'avaliacao_servico' => $req->avaliacao_servico,
            'avaliacao_atendimento' => $req->avaliacao_atendimento,
            'tecnico_controle_qualidade' => $req->tecnico_controle_qualidade,
            'data_cq'   => $data,
            'hora_cq'   => $hora,
            'obs'       => $req->obs,
            'login_cadastro'   => $req->$logado,
        ]
      );
        return redirect('https://ligue.gestaoderecursos.com/ligue/public/cq');
    }

    
  
    public function realizar_cq (Request $req)
    {   
        return view('novo-tecnico');
    }


    public function realizar_cq_gravar (Request $req)
    {   
        return view('novo-tecnico');
    }


    public function editar_cq (Request $req)
    {   
       $info = $req->all();
        $id = $info['id'];
        $dados = [];
        $dados['dados'] = DB::select("Select * from cq where tecnico != 'tecnico' and id={$id}");
        return view('cq/editar',['dados' => $dados]);
    }
    
    public function cadastrar_tecnico (Request $req)
    {   
        return view('novo-tecnico');
    }

    public function cadastrar_tecnico_novo (Request $req) 
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        $credenciada = auth()->user()->credenciada;
        DB::table('headcount')->insert(
        [
            'tecnicos'          => $req->tecnico, 
            'data_cadastro'     => $req->data,
            'credenciadas'       => $credenciada, 
            'data_cadastro'     => $data,
            'login_cadastro'    => $logado,
        ]
      );
    //    dd($req);
        return $this->cq();
    }
    
     public function editar_tecnico (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from headcount where id='$req->id'");
        return view('editar-tecnico',['dados' => $dados]);
    }
    
    public function editar_tecnico_novo (Request $req)
    {   
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        DB::table('headcount')
        ->where('id', $req->id)
        ->update(
        [
            'tecnicos'          => $req->tecnico, 
            'data_cadastro'     => $req->data,
            'credenciadas'      => $req->credenciada, 
            'status'            => $req->status, 
            'data_cadastro'     => $hoje,
            'login_cadastro'    => $logado,
        ]);
        return redirect('/index')->with('success','Atualizado com sucesso.');
    }
    
    
    public function cadastrar_presenca (Request $req) 
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
        DB::table('apontamento')->insert(
        [
            'tecnico'           => $req->tecnico, 
            'data'              => $req->data,
            'credenciada'       => $req->credenciada, 
            'data_apontamento'  => $data,
            'login_apontamento' => $req->$logado,
            'turno'             => $req->turno,
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

