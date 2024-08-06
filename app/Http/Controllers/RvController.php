<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RvController extends Controller
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
        
        if ($req->gerente != 'TODOS' || !isset($req->gerente)) {
            $filtroG = " and GERENTE = '".$req->gerente."' ";
        } else {
            $filtroG = '';
        } 
        
        if ($req->coordenador != 'TODOS' || !isset($req->coordenador)) {
            $filtroC = " and COORDENADOR = '".$req->coordenador."' ";
        } else {
            $filtroC = '';
        }
        
        if ($req->supervisor != 'TODOS' || !isset($req->supervisor)) {
            $filtroS = " and SUPERVISOR = '".$req->supervisor."' ";
        } else {
            $filtroS = '';
        }
        
        if ($req->referencia != 'TODOS' || !isset($req->referencia)) {
            $filtroR = " and REFERENCIA = '".$req->referencia."' ";
        } else {
            $filtroR = '';
        }
      
        $dados['referencia'] = DB::select("Select REFERENCIA as referencia
                                FROM `bonificacao_v1` where REFERENCIA != 'REFERENCIA'
                                group by REFERENCIA order by REFERENCIA");
        
        $dados['gerente'] = DB::select("Select GERENTE as gerente
                                FROM `bonificacao_v1` where GERENTE != 'GERENTE' UNION Select GERENTE as gerente
                                FROM `bonificacao_v2` where GERENTE != 'GERENTE'
                                group by GERENTE order by GERENTE");
        
        $dados['coordenador'] = DB::select("Select COORDENADOR as coordenador
                                FROM `bonificacao_v1` where COORDENADOR != 'COORDENADOR' UNION Select COORDENADOR as gerente
                                FROM `bonificacao_v2` where COORDENADOR != 'COORDENADOR'
                                group by COORDENADOR order by COORDENADOR");
                                
        $dados['supervisor'] = DB::select("Select SUPERVISOR as supervisor
                                FROM `bonificacao_v1` where SUPERVISOR != 'SUPERVISOR' UNION Select SUPERVISOR as gerente
                                FROM `bonificacao_v2` where SUPERVISOR != 'SUPERVISOR'
                                group by SUPERVISOR order by SUPERVISOR");
                                
        $dados['atualizacao'] = DB::select("Select ATUALIZACAO as input
                                FROM `bonificacao_v1` 
                                order by ATUALIZACAO desc limit 1");

        $dados['HCELEGIVEL'] = DB::Select("select COUNT(GERENTE) AS qtd from bonificacao_v1 WHERE SITUACAO = 'Sim' $filtroG $filtroC $filtroS $filtroR UNION  select COUNT(GERENTE) AS qtd from bonificacao_v2 WHERE SITUACAO = 'Sim' $filtroG $filtroC $filtroS $filtroR ");
        $dados['VLELEGIVEL'] = DB::Select("select SUM(VALOR_A_RECEBER) AS qtd from bonificacao_v1 WHERE SITUACAO = 'Sim' $filtroG $filtroC $filtroS $filtroR UNION select SUM(VALOR_A_RECEBER) AS qtd from bonificacao_v2 WHERE SITUACAO = 'Sim' $filtroG $filtroC $filtroS $filtroR");
        $dados['HCINELEGIVEL'] = DB::Select("select COUNT(GERENTE) AS qtd from bonificacao_v1 WHERE SITUACAO = 'Não' $filtroG $filtroC $filtroS $filtroR UNION select COUNT(GERENTE) AS qtd from bonificacao_v2 WHERE SITUACAO = 'Não' $filtroG $filtroC $filtroS $filtroR");
        $dados['VLINELEGIVEL'] = DB::Select("select SUM(VALOR_A_RECEBER) AS qtd from bonificacao_v1 WHERE SITUACAO = 'Não' $filtroG $filtroC $filtroS $filtroR UNION select SUM(VALOR_A_RECEBER) AS qtd from bonificacao_v2 WHERE SITUACAO = 'Não' $filtroG $filtroC $filtroS $filtroR");

        $dados['acessos'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') ");
        $dados['alteracao_senha'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and data_alteracao_senha is null");
        $dados['nunca_acessaram'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and ultimo_login is null");
        $dados['acessaram'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and ultimo_login is not null");
        $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador') ");
        $dados['assinatura'] = DB::Select("select COUNT(GERENTE) AS qtd from bonificacao_v1 WHERE PAGO = 'S' and login_deacordo = '0' union select COUNT(GERENTE) AS qtd from bonificacao_v2 WHERE PAGO = 'S' and login_deacordo = '0'");
        
        $dados['informacao'] = DB::Select("select ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v1 union select ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE  from bonificacao_v2  ");            
      
        if (!isset($req['status']) || $req['status'] == '') {
            $dados['informacao'] = DB::Select("select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v1 where ELEGIBILIDADE != 'STATUS_GERAL_TEC' $filtroG $filtroC $filtroS union 
            select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v2 where ELEGIBILIDADE != 'STATUS_GERAL_TEC' $filtroG $filtroC $filtroS");            
        } else {
            
            if ($req['status'] == 'inelegiveis') {
                $dados['informacao'] = DB::Select("select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v1 where ELEGIBILIDADE = 'Não'  $filtroG $filtroC $filtroS union 
                select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v2 where ELEGIBILIDADE = 'Não'  $filtroG $filtroC $filtroS");
            }
            
            if ($req['status'] == 'elegiveis') {
                $dados['informacao'] = DB::Select("select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v1 where ELEGIBILIDADE = 'Sim' $filtroG $filtroC $filtroS union
                select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v2 where ELEGIBILIDADE = 'Sim' $filtroG $filtroC $filtroS");
            } 
            if ($req['status'] == 'pendente_assinatura') {
                $dados['informacao'] = DB::Select("select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v1 WHERE PAGO = 'S' and login_deacordo = '0' $filtroG $filtroC $filtroS union
                select CPF, ID, SUPERVISOR, COORDENADOR, GERENTE, VALOR_A_RECEBER, TECNICO, ELEGIBILIDADE from bonificacao_v2 WHERE PAGO = 'S' and login_deacordo = '0' $filtroG $filtroC $filtroS");
            } 
        }
        
        
        return view('rv',['dados' => $dados]);
    }

    public function index1(Request $req)
    { 
        $dados = [];
        $dados['acessos'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') ");
        $dados['alteracao_senha'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and data_alteracao_senha is null");
        $dados['nunca_acessaram'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and ultimo_login is null");
        $dados['acessaram'] = DB::Select("select count(name) AS qtd from users WHERE tipo in ('reparador', 'instalador') and ultimo_login is not null");
        $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador') ");
    
        if (!isset($req['status']) || $req['status'] == '') {
            $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador') ");
        } else {
            
            if ($req['status'] == 'alteracao_senha') {
                $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador')  and data_alteracao_senha is null");
            }
            
            if ($req['status'] == 'nunca_acessaram') {
                $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador')  and ultimo_login is null");
            } 
            if ($req['status'] == 'acessaram') {
                $dados['usuarios'] = DB::Select("select * from users WHERE tipo in ('reparador', 'instalador') and ultimo_login is not null");
            } 
        }
        return view('rv1',['dados' => $dados]);
    }

    public function ver(Request $req)
    { 
        $dados = [];
        $id = $req->id;
        $mt = $req->mt;
        
        $dados['informacao'] = DB::Select("select * from bonificacao_v1 where ID = $id and CPF = $mt");
        
        $dados['analitico_rv'] = DB::Select("select * from analitico_rv where cpf = $mt");
        
        
        
        $resultado = $dados['informacao'];
        
        if ($resultado == '') {
            $dados['informacao'] = DB::Select("select * from bonificacao_v2 where ID = $id and CPF = $mt");
            $dados['tipo'][0] = 'Reparador';
        } else {
            $dados['informacao'] = DB::Select("select * from bonificacao_v1 where ID = $id and CPF = $mt");
            $dados['tipo'][0] = 'Instalador';
        }
        //dd($dados);
        return view('visualizar_rv',['dados' => $dados]);
    }
}
    