<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class HeadcountController extends Controller
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

        if (isset($request['status'])) {
            if ($request['status'] == 'ATIVO' || $request['status'] == 'INATIVO') {
                $status = " and status = '{$request['status']}'";
            }
            else {
                $status = "";
            }
        } else {
            $status = "";
        }

        if (isset($request['coordenador'])) {
            if ($request['coordenador'] != 'TODOS') {
                $coordenador = " and coordenador = '{$request['coordenador']}'";
            }
            else {
                $coordenador = "";
            }
        } else {
            $coordenador = "";
        }

        if (isset($request['supervisor'])) {
            if ($request['supervisor'] != 'TODOS') {
                $supervisor = " and supervisor = '{$request['supervisor']}'";
            }
            else {
                $supervisor = "";
            }
        } else {
            $supervisor = "";
        }


        $dados = [];
        $dados['dados'] = DB::select("Select * from headcount where id != '' $status $coordenador $supervisor");
        $dados['gerente'] = DB::select("Select gerente from headcount group by gerente");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount group by supervisor");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'HeadCount',
            'tipo'      => 'Força de Trabalho'
        ]);
        
        return view('hc',['dados' => $dados]);
    }
    
    
    public function home_presenca_controlador (Request $request)
    {

      $dados   = [];
      $nome  = auth()->user()->name;
        $gestao  = auth()->user()->controlador;
        $gestao1 = auth()->user()->controlador1;
        $gestao2 = auth()->user()->controlador2;
        $gestao3 = auth()->user()->controlador3;
        $gestao4 = auth()->user()->controlador4;
        $perfil  = auth()->user()->perfil;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Realizar Apontamento'
        ]);
        

        if ($perfil == 0) {
            $dados['dados'] = DB::select("Select controlador, supervisor as credenciadas from headcount where controlador in ('{$nome}') and controlador != '' and gerente in ('MARIO LOPES', 'EVANDRO BARBERO VENANCIO','SAMORA TADEU','ANTONIO BRAGA')  group by supervisor order by controlador");
        } else {
            $dados['dados'] = DB::select("Select controlador, supervisor as credenciadas from headcount where supervisor is not null  and controlador != '' and  gerente in ('MARIO LOPES', 'EVANDRO BARBERO VENANCIO','SAMORA TADEU','ANTONIO BRAGA') group by supervisor order by controlador");
        }
        
        return view('controlador/lista-credenciadas',['dados' => $dados]);
    }

    public function cadastrar_tecnico (Request $req)
    {
        $dados = [];
        $dados['gerente'] = DB::select("Select gerente from headcount group by gerente");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount group by supervisor");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'HeadCount',
            'tipo'      => 'Cadastro tecnico'
        ]);
        
        
        return view('novo-tecnico',['dados' => $dados]);
    }

    public function cadastrar_tecnico_novo (Request $req)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        $credenciada = auth()->user()->credenciada;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'HeadCount',
            'tipo'      => 'Cadastrando tecnico'
        ]);
        
        DB::table('headcount')->insert(
        [
            'tecnicos'          => $req->tecnico,
            'data_cadastro'     => $req->data,
            'matricula_alp'     => $req->matricula_alp,
            'credenciadas'      => $credenciada,
            'coordenador'       => $req->coordenador,
            'controlador'       => $req->controlador,
            'fiscal'            => $req->fiscal,
            'status'            => $req->status,
            'supervisor'        => $req->supervisor,
            'atividade'         => $req->atividade,
            'matricula'         => $req->matricula,
            'gerente'           => $req->gerente,
            'placa'             => $req->placa,
            'telefone'          => $req->telefone,
            'skill'             => $req->skill,
            'data_cadastro'     => $data,
            'login_cadastro'    => $logado,
        ]
      );
    //    dd($req);
        return redirect('/index')->with('mensagem','Atualizado com sucesso.');
    }

    public function editar_tecnico (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("Select * from headcount where id='$req->id'");
        $dados['gerente'] = DB::select("Select gerente from headcount group by gerente");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount group by supervisor");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");
        $dados['atividade'] = DB::select("Select atividade from headcount group by atividade");
        $dados['skill'] = DB::select("Select skill from headcount group by skill");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'HeadCount',
            'tipo'      => 'Editar tecnico'
        ]);
        
        return view('editar-tecnico',['dados' => $dados]);
    }

    public function editar_tecnico_novo (Request $req)
    {
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'HeadCount',
            'tipo'      => 'Editando tecnico'
        ]);
        
        
        DB::table('headcount')
        ->where('id', $req->id)
        ->update(
        [
            'tecnicos'          => $req->tecnico,
            'matricula_alp'     => $req->matricula_alp,
            'data_cadastro'     => $req->data,
            'credenciadas'      => $req->credenciada,
            'controlador'       => $req->controlador,
            'atividade'         => $req->atividade,
            'matricula'         => $req->matricula,
            'status'            => $req->status,
            'coordenador'       => $req->coordenador,
            'supervisor'        => $req->supervisor,
            'fiscal'            => $req->fiscal,
            'gerente'           => $req->gerente,
            'atividade'         => $req->atividade,
            'telefone'          => $req->telefone,
            'skill'             => $req->skill,
            'data_cadastro'     => $hoje,
            'placa'             => $req->placa,
            'login_cadastro'    => $logado,
        ]);
        return redirect('/index')->with('mensagem','Atualizado com sucesso.');
    }

    public function apontamentos_pendentes (Request $req) {
        $dados = [];
        $gestao = auth()->user()->gestao;
        $perfil = auth()->user()->perfil;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Apontamentos pendentes'
        ]);
        
        
        $dados['dados'] = DB::select("SELECT a.supervisor as supervisor1, h.supervisor as supervisor, a.data FROM headcount h
                                        left JOIN apontamentos a on a.supervisor = h.supervisor
                                        GROUP by h.supervisor
                                        ORDER BY a.data_apontamento desc");

        return view('apontamentos-pendentes',['dados' => $dados]);
    }


    public function apontar_presenca (Request $req) {
        $dados   = [];
        $gestao  = auth()->user()->gestao;
        $gestao1 = auth()->user()->gestao1;
        $gestao2 = auth()->user()->gestao2;
        $gestao3 = auth()->user()->gestao3;
        $gestao4 = auth()->user()->gestao4;
        $perfil  = auth()->user()->perfil;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Realizar Apontamento'
        ]);
        

        if ($perfil == 0) {
            $dados['dados'] = DB::select("Select supervisor as credenciadas from headcount where supervisor in ('{$gestao}','{$gestao1}','{$gestao2}','{$gestao3}','{$gestao4}')  group by supervisor");
        } else {
            $dados['dados'] = DB::select("Select supervisor as credenciadas from headcount where supervisor is not null  group by supervisor");
        }

        return view('lista-credenciadas',['dados' => $dados]);
    }

    public function lancar_presenca (Request $req) {
        $dados = [];
        $credenciada = $req->all();
        $credenciadas = $credenciada['credenciada'];
        $dados['dados'] = DB::select("Select * from headcount where supervisor = '{$credenciadas}' and status = 'ATIVO' ");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Lancamento de apontamento'
        ]);
        
        
        return view('apontar-presenca-credenciada',['dados' => $dados]);
    }
    
    public function lancar_presenca_controlador (Request $req) {
        $dados = [];
        $credenciada = $req->all();
        $credenciadas = $credenciada['credenciada'];
        $dados['dados'] = DB::select("Select * from headcount where supervisor = '{$credenciadas}' and status = 'ATIVO'");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Lancamento de apontamento'
        ]);
        
        
        return view('controlador/apontar-presenca-credenciada',['dados' => $dados]);
    }

    public function novo_lancamento_presenca (Request $req)
    {


        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
       // dd($req['data'][0]);
        $data_programada = date('d/m/Y', strtotime($req['data'][0]));
        $verificar = DB::select("Select * from apontamentos where data = '{$data_programada}' and supervisor = '{$req['supervisor'][0]}'");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Novo apontamento'
        ]);
        
        
        if (!empty($verificar)) {
             return redirect('./alterar_presenca')->with('mensagem', 'Você já realizou esse apontamento!');
        } else {
            for ($i = 0; $i < count($req->tecnicos); $i++)
               {

                DB::table('apontamentos')->insert(
                    [
                        'tecnico'           => $req->tecnicos[$i],
                        'data'              => $data_programada,
                        'credenciada'       => $req->credenciada[$i],
                        'gerente'           => $req->gerente[$i],
                        'coordenador'       => $req->coordenador[$i],
                        'supervisor'        => $req->supervisor[$i],
                        'atividade'         => $req->atividade[$i],
                        'skill'             => $req->skill[$i],
                        'data_apontamento'  => $data,
                        'login_apontamento' => $logado,
                        'status'            => $req->status[$i],
                        'obs'               => $req->obs[$i]
                    ]
                );
            }
        }
        return redirect('./alterar_presenca')->with('mensagem', 'Apontamento realizado!');
    }
    
    public function novo_lancamento_presenca_controlador (Request $req)
    {

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
        $data_programada = date('d/m/Y', strtotime($req['data'][0]));
        $verificar = DB::select("Select * from apontamentos_cci where data = '{$data_programada}' and supervisor = '{$req['supervisor'][0]}'");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Novo apontamento'
        ]);
        
        
        if (!empty($verificar)) {
             return redirect('./alterar_presenca')->with('mensagem', 'Você já realizou esse apontamento!');
        } else {
            for ($i = 0; $i < count($req->tecnicos); $i++)
               {

                DB::table('apontamentos_cci')->insert(
                    [
                        'tecnico'           => $req->tecnicos[$i],
                        'data'              => $data,
                        'rota_ativa'       => $req->rota_ativa[$i],
                        'atividades_atribuidas'           => $req->atividades_atribuidas[$i],
                        'atividade_iniciada'       => $req->atividade_iniciada[$i],
                        'atividade_iniciada_ca'        => $req->atividade_iniciada_ca[$i],
                        'superapp'         => $req->superapp[$i],
                        'data_apontamento'  => $data,
                        'login_cadastro' => $logado
                    ]
                );
            }
        }
        return redirect('./alterar_presenca_controlador')->with('mensagem', 'Apontamento realizado!');
    }
    
    
    
    public function alterar_presenca (Request $req)
    {
        $dados = [];

        $gestao = auth()->user()->gestao;
        $gestao1 = auth()->user()->gestao1;
        $gestao2 = auth()->user()->gestao2;
        $gestao3 = auth()->user()->gestao3;
        $gestao4 = auth()->user()->gestao4;
        $perfil = auth()->user()->perfil;
        $dados['gerente'] = DB::select("Select gerente from headcount group by gerente");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount group by supervisor");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");

        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Alteracao de apontamento'
        ]);
        

        if ($perfil == 0) {
                if (isset($req['inicio'])) {
                if ($req['inicio'] != null) {
                    $dataInicio = date('d/m/Y', strtotime($req['inicio']));
                    $dataFim = date('d/m/Y', strtotime($req['fim']));
                    $data = " and data between '{$dataInicio}' and '{$dataFim}'";
                    $limit = '';
                } else {
                    $data = " and data between '01/01/2001' and '01/01/2001'";
                }
            } else {
                $data = " and data between '01/01/2001' and '01/01/2001'";
            }
            $dados['dados'] = DB::select("Select * from apontamentos where supervisor in ('{$gestao}','{$gestao1}','{$gestao2}','{$gestao3}','{$gestao4}') {$data}");

        } else {
            if (isset($req['supervisor'])) {
                if ($req['supervisor'] == 'TODOS') {
                    $supervisor = "";
                } else {
                    $supervisor = " and supervisor = '{$req['supervisor']}'";
                }
            } else {
                    $supervisor = "";

            }

            if (isset($req['inicio'])) {
                if ($req['inicio'] != null) {
                    $dataInicio = date('d/m/Y', strtotime($req['inicio']));
                    $dataFim = date('d/m/Y', strtotime($req['fim']));
                    $data = " and data between '{$dataInicio}' and '{$dataFim}'";
                } else {
                    $data = " and data between '01/01/2001' and '01/01/2001'";
                }
            } else {
                    $data = " and data between '01/01/2001' and '01/01/2001'";
            }

            if (isset($req['status'])) {
                 if ($req['status'] == 'TODOS') {
                    $status = "";
                } else {
                    $status = " and status = '{$req['status']}'";
                }
            } else {
                $status = "";
            }

            $dados['dados'] = DB::select("Select * from apontamentos where id !='' {$supervisor} {$status} {$data}");
        }

        return view('ver-apontamentos',['dados' => $dados]);
    }
    
    
    public function alterar_presenca_controlador (Request $req)
    {
        $dados = [];

        $gestao = auth()->user()->gestao;
        $gestao1 = auth()->user()->gestao1;
        $gestao2 = auth()->user()->gestao2;
        $gestao3 = auth()->user()->gestao3;
        $gestao4 = auth()->user()->gestao4;
        $perfil = auth()->user()->perfil;
        $dados['gerente'] = DB::select("Select gerente from headcount group by gerente");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount group by supervisor");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");

        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Alteracao de apontamento'
        ]);
        

        if ($perfil == 0) {
                if (isset($req['inicio'])) {
                if ($req['inicio'] != null) {
                    $dataInicio = date('d/m/Y', strtotime($req['inicio']));
                    $dataFim = date('d/m/Y', strtotime($req['fim']));
                    $data = " and data between '{$dataInicio}' and '{$dataFim}'";
                    $limit = '';
                } else {
                    $data = " and data between '01/01/2001' and '01/01/2001'";
                }
            } else {
                $data = " and data between '01/01/2001' and '01/01/2001'";
            }


            $dados['dados'] = DB::select("Select * from apontamentos_cci where id !='' {$data}");
        } else {
            $dados['dados'] = DB::select("Select * from apontamentos_cci where id !=''");
        }
        
        return view('controlador/ver-apontamentos',['dados' => $dados]);
    }

    public function ver_apontamento_tecnico (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("Select * from apontamentos where id = {$req['id']}");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Visualizar apontamento'
        ]);
        
        
        return view('ver-apontamento-tecnico',['dados' => $dados]);
    }

    public function editar_apontamento_tecnico  (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("Select * from apontamentos where id = {$req['id']}");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Editar apontamento'
        ]);
        
        
        return view('editar-apontamento',['dados' => $dados]);
    }


    public function editar_apontamento_tecnico_controlador (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("Select * from apontamentos_cci where id = {$req['id']}");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Editar apontamento'
        ]);
        
        
        return view('controlador/editar-apontamento',['dados' => $dados]);
    }




    public function editar_apontamento_tecnico_atualizar_controlador (Request $req)
    {
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        //dd($req);
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Editando apontamento'
        ]);
        
        
        DB::table('apontamentos_cci')
        ->where('id', $req->id)
        ->update(
        [
            'rota_ativa'       => $req->rota_ativa[0],
            'atividades_atribuidas'           => $req->atividades_atribuidas[0],
            'atividade_iniciada'       => $req->atividade_iniciada[0],
            'atividade_iniciada_ca'        => $req->atividade_iniciada_ca[0],
            'superapp'         => $req->superapp[0]
        ]);
        return redirect('/alterar_presenca_controlador')->with('mensagem','Atualizado com sucesso.');
    }


    public function editar_apontamento_tecnico_atualizar (Request $req)
    {
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Presenca',
            'tipo'      => 'Editando apontamento'
        ]);
        
        
        DB::table('apontamentos')
        ->where('id', $req->id)
        ->update(
        [
            'data'              => $req->data,
            'status'            => $req->status,
            'obs'               => $req->obs,
            'alteracao'         => $hoje,
            'login_alteracao'   => $logado
        ]);
        return redirect('/alterar_presenca')->with('mensagem','Atualizado com sucesso.');
    }

    public function deletar_tecnico  (Request $req){
        DB::delete("delete from headcount WHERE id = $req->id");
        return back()->with('mensagem','Excluído com sucesso.');
    }
    
    public function ausentes (Request $req)
    {
        $dados = [];
        $dados['dados'] = DB::select("SELECT tecnico, gerente, coordenador, supervisor, data, status, data_apontamento, login_apontamento FROM 
                    apontamentos WHERE data = DATE_FORMAT(NOW(), '%d/%m/%Y') and status in ('ATESTADO',' FALTA_S_JUSTIFICATIVA','FOLGA','FOLGA - ESCALA') ORDER BY gerente asc");
        
        $details = $dados['dados'];
        $dadosMail = [ 
             1 => 'h.oliveira556@gmail.com'
        ];
       
        foreach ($dadosMail as $emails) {
  
            Mail::to($emails)->send(new TestMail($details));
        }
    }
    
    public function deletar_apontamento (Request $req){
        DB::delete("delete from apontamentos WHERE id = $req->id");
        return back()->with('mensagem','Excluído com sucesso.');
    }
}

