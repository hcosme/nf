<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TesteFinalController extends Controller
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
        date_default_timezone_set('America/Sao_Paulo');
        $diaAtual = date('d/m/Y');
        $logado = auth()->user()->name;

         if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        }

        if ($req->filial == 'TLI' || $req->filial == 'TLP' || $req->filial == 'TLG' || $req->filial == 'TLS') {
            $filtroFilial = " and provedor like  '".$req->filial."%' ";
        }

        $dados = [];
        
        if (auth()->user()->perfil == 4) {
            $perfil = " and provedor like  '".$logado."%' ";
            
        } else {
            $perfil = "";
        }
        
        $dados['tf'] = DB::select("Select * from backlog_novo_v2 where data_toa = '".$diaAtual."' and n_ordem != '' and tipo_ordem in ('Instalação','Reparo','Pró Ativo') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_manutencao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_instalacao'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' and tipo_ordem in ('Instalação') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_instalacao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_desconexao'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' and tipo_ordem in ('Desconexão') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_instalacao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_pro_ativo'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' and tipo_ordem in ('Pró ativo') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_instalacao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_voip'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' and tipo_ordem in ('VOIP') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_instalacao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_reparo'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' and tipo_ordem in ('Reparo') $perfil and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_manutencao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['total_total'] = DB::select("Select count(tipo_ordem) as qtd from backlog_novo_v2 where data_toa = '".$diaAtual."' $perfil and tipo_ordem in ('Instalação','Reparo','Pró Ativo') and estado in ('Não iniciado','Iniciado','pendente', 'Concluída') and empresa_manutencao in ('TLP','TLS','TLG','TLI') $filtroFilial");
        $dados['operador'] = DB::select("SELECT LOGIN_EDICAO AS operador FROM `tf` GROUP BY LOGIN_EDICAO ORDER BY LOGIN_EDICAO ASC");
        $dados['ativ_executadas'] = DB::select("Select count(SERVICO) as qtd from tf where DATA_CADASTRO = '".$diaAtual."'");
        return view('tf/testefinal',['dados' => $dados]);
    }

    public function cadastrar (Request $req)
    {
        return view('novo-testeFinal');
    }

    public function cadastrarTesteFinal (Request $req) {
        $logado = auth()->user()->name;
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        DB::table('tf')->insert(
        [
           'OPERADOR'          => $logado,
            'DATA'              => $req->data,
            'NUMERO_ORDEM'      => $req->numero_ordem,
            'SERVICO'           => $req->servico,
            'TECNICO'           => $req->tecnico,
            'STATUS'            => $req->status,
            'EXECUCAO'          => $req->execucao,
            'REGIONAL'          => $req->regional,
            'PRODUCAO'          => $req->producao,
            'TECNOLOGIA'        => $req->tecnologia,
            'OBS'               => $req->obs,
            'CONTATO_CLIENTE'   => $req->contato_cliente,
            'EVIDENCIA_MODEM'   => $req->evidencia_modem,
            'DATA_CADASTRO'     => $hoje
        ]
      );
        return redirect('/testefinal')->with('success','Cadastrado com sucesso.');
    }

    public function editar (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("Select * from tf where id='$req->id'");
        return view('editar-testeFinal',['dados' => $dados]);
    }

    public function editarTesteFinal (Request $req)
    {
        $dados = [];
       // dd($req->id);
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from tf where id='$req->id'");
        DB::table('tf')
        ->where('id', $req->id)
        ->update(
        [
            'DATA'              => $req->data,
            'NUMERO_ORDEM'      => $req->numero_ordem,
            'SERVICO'           => $req->servico,
            'TECNICO'           => $req->tecnico,
            'STATUS'            => $req->status,
            'EXECUCAO'          => $req->execucao,
            'REGIONAL'          => $req->regional,
            'PRODUCAO'          => $req->producao,
            'TECNOLOGIA'        => $req->tecnologia,
            'OBS'               => $req->obs,
            'CONTATO_CLIENTE'   => $req->contato_cliente,
            'EVIDENCIA_MODEM'   => $req->evidencia_modem,
            'DATA_EDICAO'       => $hoje,
            'LOGIN_EDICAO'      => $logado
        ]);
        return redirect('/testefinal')->with('success','Atualizado com sucesso.');
    }
    
        public function flag_completamento_instalacao (Request $req)
    { 
        
        $dados = [];
        $dados['informacao'] = DB::Select("SELECT * FROM `backlog_novo_v2` 
                                            WHERE flag_de_complemento = 'sim' 
                                            AND estado = 'Iniciado' 
                                            AND empresa_instalacao in ('TLI','TLP','TLS','TLG') 
                                            AND tipo_ordem = 'Instalação'");
  
        return view('certificacao/instalacao',['dados' => $dados]);
    }

   
    public function flag_completamento_reparo (Request $req)
    { 
        $id = $req->id;
        $dados = [];
        $dados['reparo'] = DB::Select("select * from bonificacao where id_ = $id");
        return view('visualizar_rv',['dados' => $dados]);
    }
    
}