<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TabuladorController extends Controller
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

    public function index(Request $request)
    {   
        
        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('Y-m-d H:i:s');
        $logado = auth()->user()->email;
        $insert = DB::table('logs')->insert([
                'email' =>  $logado,
                'portal' => 'tabulador',
                'tipo' => 'inicio'
            ]);
        
        $req = $request->all();
        
        if (isset($req['tipo'])) {
            if ($req['tipo'] == 'GROSS') {
                $filtroTipo = " AND  MUDANCA = 'N' AND TROCA_TECNOLOGIA = 'Não'  and ATIVIDADE LIKE '%INST%' ";
            }
        
            if ($req['tipo'] == 'INSTALACAO') {
                $filtroTipo = " and ATIVIDADE LIKE 'Inst%' ";
            }
             if ($req['tipo'] == 'REPARO') {
                $filtroTipo = " and ATIVIDADE LIKE 'Bilhete%' ";
            }
            
            if ($req['tipo'] == 'MUDANCA') {
                $filtroTipo = " AND  MUDANCA = 'S' and ATIVIDADE LIKE '%INST%' ";
            }
        
            if ($req['tipo'] == 'TROCA TECNOLOGIA') {
                $filtroTipo = " AND TROCA_TECNOLOGIA = 'Sim'  and ATIVIDADE LIKE '%INST%' ";
            }
        
            
        } else {
            $filtroTipo = "";
        }
        
          if (isset($req['tipo'])) {
            if ($req['tipo'] == 'MUDANCA') {
                $filtroTipo1 = " AND  t.MUDANCA = 'S' and t.ATIVIDADE LIKE '%INST%' ";
            }
        
            if ($req['tipo'] == 'TROCA TECNOLOGIA') {
                $filtroTipo1 = " AND t.TROCA_TECNOLOGIA = 'Sim'  and t.ATIVIDADE LIKE '%INST%' ";
            }
        
            if ($req['tipo'] == 'GROSS') {
                $filtroTipo1 = " AND  t.MUDANCA = 'N' AND t.TROCA_TECNOLOGIA = 'Não'  and t.ATIVIDADE LIKE '%INST%' ";
            }
        
            if ($req['tipo'] == 'INSTALACAO') {
                $filtroTipo1 = " and t.ATIVIDADE LIKE 'Inst%' ";
            }
             if ($req['tipo'] == 'REPARO') {
                $filtroTipo1 = " and t.ATIVIDADE LIKE 'Bilhete%' ";
            }
        } else {
            $filtroTipo1 = "";
        }
        
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $dataAtual = date('Y-m-d');
        $dados = [];
        
        $dados['totalClientes'] = DB::select("Select count(provedor) as qtd from tabulador where id != 0  $filtroTipo");
        $dados['emLigacao'] = DB::select("Select count(provedor) as qtd from tabulador where id != 0 $filtroTipo and SUCESSO_CONTATO IN ('','N','S')  and LIMITE > '{$data}'");
        
        //$dados['emLigacao'] = DB::select("Select t.* from tabulador t 
          //          inner join tabulador_agendamentos tb on t.N_ORDEM=tb.N_ORDEM
            //        where tb.N_ORDEM IS NULL and t.id != 0  and (t.LIMITE != NULL) $filtroTipo1");
        
        
        
        
        $dados['pendentes'] = DB::select("Select count(provedor) as qtd from tabulador where id != 0 $filtroTipo and SUCESSO_CONTATO IN ('','N')");
        
        
        
        
        $dados['realizadosHoje'] = DB::select("Select count(provedor) as qtd from tabulador_agendamentos where id != 1 $filtroTipo and SUCESSO_CONTATO IN ('S','N') and DATA_CADASTRO LIKE '%{$dataAtual}%'");
        $dados['realizadosParaHoje'] = DB::select("Select count(provedor) as qtd from tabulador_agendamentos where id != 1 $filtroTipo and SUCESSO_CONTATO IN ('S')  and DATA_AGENDAMENTO like '%{$dataAtual}%'");
        $dados['agendamentosRealizados'] = DB::select("Select count(provedor) as qtd from tabulador_agendamentos where id != 1 $filtroTipo and SUCESSO_CONTATO IN ('S') ");
        $dados['dadosTbl'] = DB::select("Select * from tabulador where id != '1' $filtroTipo");
        
        $logado = auth()->user()->name;
        $dados['verificacao'] = DB::select("
                    Select t.* from tabulador t 
                    where t.id != 0 and t.SUCESSO_CONTATO = '' AND t.LOGIN_CADASTRO = '{$logado}' $filtroTipo1");

        if (!empty($dados['verificacao'])) {
            $dados['dados'] = DB::select("
                    Select t.* from tabulador t 
                    where t.id != 0 and t.SUCESSO_CONTATO = '' AND t.LOGIN_CADASTRO = '{$logado}' $filtroTipo1 limit 1");
        } else {
        $dados['dados'] = DB::select("
                    Select t.* from tabulador t 
                    LEFT join tabulador_agendamentos tb on t.N_ORDEM=tb.N_ORDEM
                    where tb.N_ORDEM IS NULL and t.id != 0  and t.SUCESSO_CONTATO IN ('','N') and (t.LIMITE < '{$data}' OR t.LIMITE IS NULL) $filtroTipo1 limit 1
                    ");
        }
        
        return view('tabulador/index',['dados' => $dados]);
    }

    public function read (Request $req)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('Y-m-d H:i:s');
        $logado = auth()->user()->email;
        $insert = DB::table('logs')->insert([
                'email' =>  $logado,
                'portal' => 'tabulador',
                'tipo' => 'ver'
        ]);
        $dados = [];
        $dados['dados'] = DB::select("Select * from tabulador where id='$req->id'");
        return view('tabulador/read',['dados' => $dados]);
    }

    public function edit (Request $req)
    {   
        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('Y-m-d H:i:s');
        $logado = auth()->user()->email;
        $insert = DB::table('logs')->insert([
                'email' =>  $logado,
                'portal' => 'tabulador',
                'tipo' => 'ligacao'
        ]);
        
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $duracao = '00:05:00';
        $v = explode(':', $duracao);
        $v2 = date('Y-m-d H:i:s', strtotime("{$data} + {$v[0]} hours {$v[1]} minutes {$v[2]} seconds"));
        
        $dados['dados'] = DB::select("Select * from tabulador where id='$req->id'");
        $logado = auth()->user()->name;
        DB::table('tabulador')
        ->where('id', $req->id)
        ->update(
        [
            'ABRIU' => $data,
            'LIMITE' => $v2,
            'LOGIN_CADASTRO' => $logado
        ]
      );
        return view('tabulador/edit',['dados' => $dados]);
    }
    
    public function update (Request $req) 
    {
        $data_hora = date('Y-m-d H:i:s');
        $logado = auth()->user()->email;
        $insert = DB::table('logs')->insert([
                'email' =>  $logado,
                'portal' => 'tabulador',
                'tipo' => 'finalizou'
        ]);
        
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        DB::table('tabulador')
        ->where('id', $req->id)
        ->update(
        [
            'SUCESSO_CONTATO'       => $req->SUCESSO_CONTATO, 
            'RESULTADO_CONTATO_1'   => $req->RESULTADO_CONTATO_1,
            'RESULTADO_CONTATO_2'   => $req->RESULTADO_CONTATO_2, 
            'RESULTADO_CONTATO_3'   => $req->RESULTADO_CONTATO_3,
            'BUCKET_ATUAL'          => $req->BUCKET_ATUAL, 
            'BUCKET_DESTINO'        => $req->BUCKET_DESTINO, 
            'CONDICOES_AGENDAMENTO' => $req->CONDICOES_AGENDAMENTO, 
            'CONTATO_COM_SUCESSO'   => $req->CONTATO_COM_SUCESSO, 
            'NOME_CONTATO'          => $req->NOME_CONTATO, 
            'MOTIVO_N_AGENDAMENTO'  => $req->MOTIVO_N_AGENDAMENTO,
            'DATA_AGENDAMENTO'      => $req->DATA_AGENDAMENTO,    
            'TURNO'                 => $req->TURNO,
            'DATA_CADASTRO'         => $data,
            'LOGIN_CADASTRO'        => $logado
        ]
      );
      
      DB::table('tabulador_agendamentos')
        ->insert(
        [
            'PROVEDOR'              => $req->PROVEDOR, 
            'N_ORDEM'               => $req->N_ORDEM, 
            'PRODUTO'               => $req->PRODUTO, 
            'ATIVIDADE'             => $req->ATIVIDADE, 
            'ESTADO'                => $req->ESTADO, 
            'ENDERECO'              => $req->ENDERECO,
            'COMPLEMENTO'           => $req->COMPLEMENTO,
            'TROCA_TECNOLOGIA'      => $req->TROCA_TECNOLOGIA,
            'CIDADE'                => $req->CIDADE,
            'CLIENTE'               => $req->CLIENTE, 
            'ORDEM'                 => $req->ORDEM, 
            'DATA'                  => $req->DATA, 
            'MUDANCA'               => $req->MUDANCA, 
            'TELEFONE_1'            => $req->TELEFONE_1, 
            'CELULAR'               => $req->CELULAR, 
            'TELEFONE_2'            => $req->TELEFONE_2, 
            'TELEFONE_3'            => $req->TELEFONE_3, 
            'RESERVA_ATIVIDADE'     => $req->RESERVA_ATIVIDADE, 
            'VELOCIDADE'            => $req->VELOCIDADE, 
            'SUCESSO_CONTATO'       => $req->SUCESSO_CONTATO, 
            'RESULTADO_CONTATO_1'   => $req->RESULTADO_CONTATO_1,
            'RESULTADO_CONTATO_2'   => $req->RESULTADO_CONTATO_2, 
            'RESULTADO_CONTATO_3'   => $req->RESULTADO_CONTATO_3,
            'BUCKET_ATUAL'          => $req->BUCKET_ATUAL, 
            'BUCKET_DESTINO'        => $req->BUCKET_DESTINO, 
            'CONDICOES_AGENDAMENTO' => $req->CONDICOES_AGENDAMENTO, 
            'CONTATO_COM_SUCESSO'   => $req->CONTATO_COM_SUCESSO, 
            'NOME_CONTATO'          => $req->NOME_CONTATO, 
            'MOTIVO_N_AGENDAMENTO'  => $req->MOTIVO_N_AGENDAMENTO,
            'DATA_AGENDAMENTO'      => $req->DATA_AGENDAMENTO,    
            'TURNO'                 => $req->TURNO,
            'DATA_CADASTRO'         => $data,
            'LOGIN_CADASTRO'        => $logado,
            'CANCELAR_REPARO'       => $req->CANCELAR_REPARO,    
            'MOTIVO_CANCELAR_REPARO' => $req->MOTIVO_CANCELAR_REPARO,
            'ABRIU'                 => $req->ABRIU,
            'RESULTADO_CONTATO_4'   => $req->RESULTADO_CONTATO_4,
            'obs'                   => $req->obs,
            
       
            
        ]
      );
      
      
        return redirect('./tabulador-index')->with('mensagem','Atualizado com sucesso.');
    }
    
    public function operadores (Request $req)
    {
        $dataAtual = date('Y-m-d');
        $dados['dados'] = DB::select('SELECT u.name as usuario,
                                	(select ll.registro from logs ll WHERE ll.email=u.email and ll.tipo = "login" ORDER by ll.registro desc limit 1) as login,
                                	(select le.registro from logs le WHERE le.email=u.email and le.tipo = "ligacao" ORDER by le.registro desc limit 1) em_agendamento,
                                    (select li.registro from logs li WHERE li.email=u.email and li.tipo = "finalizou" ORDER by li.registro desc limit 1) ultima_atividade 
                                from users u where u.agendamento = 1 
                                GROUP BY u.name'); 
                    
                    
        $dados['status_operadores'] = DB::select("SELECT t.LOGIN_CADASTRO AS LOGIN_CADASTRO, (SELECT COUNT(t1.PROVEDOR) FROM tabulador_agendamentos t1 where t1.LOGIN_CADASTRO=t.LOGIN_CADASTRO) as LIGACAO,
        (SELECT COUNT(t2.PROVEDOR) FROM tabulador_agendamentos t2 where t2.SUCESSO_CONTATO = 'S' AND t2.CONDICOES_AGENDAMENTO = 'S' and t2.LOGIN_CADASTRO=t.LOGIN_CADASTRO) as COM_SUCESSO,
        (SELECT COUNT(t3.PROVEDOR) FROM tabulador_agendamentos t3 where t3.SUCESSO_CONTATO = 'N' and t3.LOGIN_CADASTRO=t.LOGIN_CADASTRO) as SEM_SUCESSO,
        (SELECT COUNT(t4.PROVEDOR) FROM tabulador_agendamentos t4 where t4.SUCESSO_CONTATO = 'S' AND t4.CONDICOES_AGENDAMENTO = 'S'  and t4.LOGIN_CADASTRO=t.LOGIN_CADASTRO) as AGENDAMENTOS,
        (SELECT COUNT(t5.PROVEDOR) FROM tabulador_agendamentos t5 where t5.SUCESSO_CONTATO = 'S' AND t5.CONDICOES_AGENDAMENTO = 'S'  and t5.LOGIN_CADASTRO=t.LOGIN_CADASTRO and t5.DATA_AGENDAMENTO like '{$dataAtual}%') as AGENDAMENTOS_HOJE,
        (SELECT COUNT(t6.PROVEDOR) FROM tabulador_agendamentos t6 where t6.ABRIU !='' AND t6.SUCESSO_CONTATO = 'S' AND t6.CONDICOES_AGENDAMENTO = 'S'  and t6.LOGIN_CADASTRO=t.LOGIN_CADASTRO and t6.DATA_AGENDAMENTO > '{$dataAtual}') as AGENDAMENTOS_FUTURO
        FROM tabulador_agendamentos t  GROUP BY t.LOGIN_CADASTRO");

        return view('tabulador/operadores',['dados' => $dados]);
    }

    
    public function tratada (Request $req)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        
         DB::table('tabulador_agendamentos')
        ->insert(
        [
            'PROVEDOR'              => $req->PROVEDOR, 
            'N_ORDEM'               => $req->N_ORDEM, 
            'PRODUTO'               => $req->PRODUTO, 
            'ATIVIDADE'             => $req->ATIVIDADE, 
            'ESTADO'                => $req->ESTADO, 
            'ENDERECO'              => $req->ENDERECO,
            'COMPLEMENTO'           => $req->COMPLEMENTO,
            'TROCA_TECNOLOGIA'      => $req->TROCA_TECNOLOGIA,
            'CIDADE'                => $req->CIDADE,
            'CLIENTE'               => $req->CLIENTE, 
            'ORDEM'                 => $req->ORDEM, 
            'DATA'                  => $req->DATA, 
            'MUDANCA'               => $req->MUDANCA, 
            'TELEFONE_1'            => $req->TELEFONE_1, 
            'CELULAR'               => $req->CELULAR, 
            'TELEFONE_2'            => $req->TELEFONE_2, 
            'TELEFONE_3'            => $req->TELEFONE_3, 
            'RESERVA_ATIVIDADE'     => $req->RESERVA_ATIVIDADE, 
            'VELOCIDADE'            => $req->VELOCIDADE,
            'obs'            => 'TRATADA',
            'DATA_CADASTRO'         => $data,
            'LOGIN_CADASTRO'        => $logado,
        ]
      );
      
        return redirect('./tabulador-index')->with('mensagem','Atualizado com sucesso.');
        
    //    return back()->with('mensagem','Atualizado com sucesso.');
    }
    
    public function delete (Request $req)
    {
        DB::delete("delete from tabulador WHERE id = $req->id"); 
        return back()->with('mensagem','Excluído com sucesso.');
    }
    
    
    
}

