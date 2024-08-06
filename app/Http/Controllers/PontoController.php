<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PontoController extends Controller
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
        $inicio = date('d/m/Y',  strtotime($req->inicio));
        $fim = date('d/m/Y', strtotime($req->fim));
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and DATA between '".$req->inicio."' and '".$req->fim."' ";
        } else {
            $filtroData =  "";
        }
 
 
        if ($req->gerente != 'TODOS' || !isset($req->gerente)) {
            $filtroG = " and gerente = '".$req->gerente."' ";
        } else {
            $filtroG = '';
        } 
        
        if ($req->coordenador != 'TODOS' || !isset($req->coordenador)) {
            $filtroC = " and coordenador = '".$req->coordenador."' ";
        } else {
            $filtroC = '';
        }
        
        if ($req->supervisor != 'TODOS' || !isset($req->supervisor)) {
            $filtroS = " and supervisor = '".$req->supervisor."' ";
        } else {
            $filtroS = '';
        }
        $req = $req->all();
        /*
        
        if (isset($req['gerente'])) {
            $filtroG = " and gerente = '".$req['gerente']."' ";
        } else {
            $filtroG = '';
        } 
        
        if (isset($req['coordenador'])) {
            $filtroC = " and coordenador = '".$req['coordenador']."' ";
        } else {
            $filtroC = '';
        }
        
        if (isset($req['supervisor'])) {
            $filtroS = " and supervisor = '".$req['supervisor']."' ";
        } else {
            $filtroS = '';
        } */
        
        $dados['atualizacao'] = DB::Select("select atualizacao from ponto where data != 'DATA' order by data asc limit 1");
      
        $dados['qtd_sem_producao'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_demora'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_fechamento'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_n_ponto'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
    
        $dados['s_qtd_sem_producao'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_demora'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_fechamento'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_n_ponto'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_gps'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' $filtroG $filtroC $filtroS $filtroData  and GPS_INICIO = 'N' OR  GPS_FIM = 'N' ");
        $dados['s_qtd_2h'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and MAIS_2H_DIA = 'S' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_aderencia'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MARCACOES != 4     $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_gps'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_2h'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and MAIS_2H_DIA = 'S' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_aderencia'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MARCACOES != 4     $filtroG $filtroC $filtroS $filtroData");
  
        $dados['qtd_domingos'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and DOMINGOS > 2     $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_domingos'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and DOMINGOS > 2 $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_7_dias'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MAIS_DE_7_DIAS > 6 $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_7_dias'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MAIS_DE_7_DIAS > 6     $filtroG $filtroC $filtroS $filtroData");
  
    /*
        $dados['s_qtd_sem_producao'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_demora'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_fechamento'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_n_ponto'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        if (empty($req->inicio)) {
            //dd('aqui');
    */
         
         /*
            $dados['s_qtd_50'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') AS qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') $filtroG $filtroC $filtroS $filtroData ");
            $dados['s_qtd_100'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia not in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado')  $filtroG $filtroC $filtroS $filtroData");
            $dados['s_qtd_total'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA'  AND STATUS_FINAL != 'N Ponto' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado','Domingo') $filtroG $filtroC $filtroS $filtroData");
         */
            
         
            $dados['s_qtd_50'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') $filtroG $filtroC $filtroS $filtroData ");
            $dados['s_qtd_100'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia not in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado')  $filtroG $filtroC $filtroS $filtroData");
            $dados['s_qtd_total'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA'  AND STATUS_FINAL != 'N Ponto' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado','Domingo') $filtroG $filtroC $filtroS $filtroData");
         
    /*     
            
        } else {
            
            $dados['s_qtd_50'] = DB::Select("select TOTAL_50 as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1 ");
            $dados['s_qtd_100'] = DB::Select("select TOTAL_100_ as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1");
            $dados['s_qtd_total'] = DB::Select("select TOTAL_HE_ as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1");
        
            
            
        }
        
      */  
        
        
        $dados['gerente'] = DB::Select("select gerente as gerente from ponto where gerente NOT IN ('GERENTE','') group by gerente");
        $dados['coordenador'] = DB::Select("select coordenador as coordenador from ponto where gerente NOT IN ('GERENTE','') group by coordenador");
        $dados['supervisor'] = DB::Select("select supervisor as supervisor from ponto where gerente NOT IN ('GERENTE','') group by supervisor");
      

        $dados['s_qtd_t_50'] = DB::Select("select nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','sabado')  AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS $filtroData group by nome_toa order by qtd desc limit 10");
                                            
        $dados['s_qtd_t_100'] = DB::Select("select nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' AND dia in ('Domingo') $filtroG $filtroC $filtroS $filtroData  AND STATUS_FINAL != 'N Ponto'  group by nome_toa order by qtd desc limit 10");
       
       $dados['s_qtd_t_negativa'] = DB::Select("select sum(TOTAL_HE) as ordem, nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData  AND STATUS_FINAL != 'N Ponto' group by nome_toa order by ordem asc limit 10");
       
       
        //dd($dados);
         $dados['ajustar'] = DB::Select("select ID, COORDENADOR, SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE  
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData and CARGA_HORARIA = 'INCORRETO'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
        
        $dados['n_ponto'] = DB::Select("select *  
                                                from marcacao_n_efetuada where NOME != 'NOME' $filtroG $filtroC $filtroS $filtroData ");
        
        
        $dados['t_n_ponto'] = DB::Select("select count(NOME) AS qtd 
                                                from marcacao_n_efetuada where NOME != 'NOME' $filtroG $filtroC $filtroS $filtroData ");
       
        if (!isset($req['status'])) {
            $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV, SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF   
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL != 'OK' 
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
        } else {
            if ($req['status'] == 'sem_prod') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE , SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'HE Sem produção' GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
            }
            if ($req['status'] == 'demora') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'Demora no inicio da atividade'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
            }
            if ($req['status'] == 'fechamento') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'Fechamento divergente de produção'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            if ($req['status'] == 'nponto') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'N Ponto'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
            if ($req['status'] == 'domingos') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND DOMINGOS > 2
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
            if ($req['status'] == '7_dias') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND MAIS_DE_7_DIAS > 6
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }

    
        }
        
        
        return view('ponto',['dados' => $dados]);
    }
    
    public function index1(Request $req)
    {   
        $dados = [];
        $inicio = date('d/m/Y',  strtotime($req->inicio));
        $fim = date('d/m/Y', strtotime($req->fim));
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and DATA between '".$req->inicio."' and '".$req->fim."' ";
        } else {
            $filtroData =  "";
        }
 
 
        if ($req->gerente != 'TODOS' || !isset($req->gerente)) {
            $filtroG = " and gerente = '".$req->gerente."' ";
            $filtroG1 = " and UJ.gerente = '".$req->gerente."' ";
        } else {
            $filtroG = '';
            $filtroG1 = '';
        } 
        
        if ($req->coordenador != 'TODOS' || !isset($req->coordenador)) {
            $filtroC = " and coordenador = '".$req->coordenador."' ";
        } else {
            $filtroC = '';
        }
        
        if ($req->supervisor != 'TODOS' || !isset($req->supervisor)) {
            $filtroS = " and supervisor = '".$req->supervisor."' ";
        } else {
            $filtroS = '';
        }
        $req = $req->all();
        /*
        
        if (isset($req['gerente'])) {
            $filtroG = " and gerente = '".$req['gerente']."' ";
        } else {
            $filtroG = '';
        } 
        
        if (isset($req['coordenador'])) {
            $filtroC = " and coordenador = '".$req['coordenador']."' ";
        } else {
            $filtroC = '';
        }
        
        if (isset($req['supervisor'])) {
            $filtroS = " and supervisor = '".$req['supervisor']."' ";
        } else {
            $filtroS = '';
        } */
        
         $dados['atualizacao'] = DB::Select("select atualizacao from ponto where data != 'DATA' order by data desc limit 1");
      
        
        $dados['qtd_sem_producao'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_demora'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_fechamento'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_n_ponto'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_gps'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' $filtroG $filtroC $filtroS $filtroData  and GPS_INICIO = 'N' OR  GPS_FIM = 'N' ");
        $dados['s_qtd_2h'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and MAIS_2H_DIA = 'S' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_aderencia'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MARCACOES != 4     $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_gps'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' $filtroG $filtroC $filtroS $filtroData  and GPS_INICIO = 'N' OR GPS_FIM = 'N' ");
        $dados['qtd_2h'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and MAIS_2H_DIA = 'S' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_aderencia'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MARCACOES != 4 $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_domingo'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' and DIA = 'Domingo' and ULTIMA_MARCACAO LIKE '%18:%'     $filtroG $filtroC $filtroS $filtroData");
  
        $dados['s_qtd_sem_producao'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_demora'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_fechamento'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_n_ponto'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_domingo'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto 
        where nome_toa != 'NOME_TOA'  and DIA = 'Domingo' and ULTIMA_MARCACAO LIKE '%18:%' $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_domingos'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and DOMINGOS > 2     $filtroG $filtroC $filtroS $filtroData group by nome_toa");
        $dados['s_qtd_domingos'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto' and DOMINGOS > 2 and DIA = 'Domingo' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_7_dias'] = DB::Select("select concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MAIS_DE_7_DIAS > 7 $filtroG $filtroC $filtroS $filtroData");
        $dados['qtd_7_dias'] = DB::Select("select count(nome_toa) as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != '' and MAIS_DE_7_DIAS > 7  $filtroG $filtroC $filtroS $filtroData group by nome_toa");
      
    /*
        
        $dados['s_qtd_sem_producao'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'HE Sem produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_demora'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Demora no inicio da atividade' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_fechamento'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'Fechamento divergente de produção' $filtroG $filtroC $filtroS $filtroData");
        $dados['s_qtd_n_ponto'] = DB::Select("select time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL = 'N Ponto' $filtroG $filtroC $filtroS $filtroData");
        if (empty($req->inicio)) {
            //dd('aqui');
    */
         
         /*
            $dados['s_qtd_50'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') AS qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') $filtroG $filtroC $filtroS $filtroData ");
            $dados['s_qtd_100'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia not in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado')  $filtroG $filtroC $filtroS $filtroData");
            $dados['s_qtd_total'] = DB::Select("select   time_format( SEC_TO_TIME( sum(TIME_TO_SEC(TOTAL_HE) ) ),'%H:%i:%s') as qtd from ponto where nome_toa != 'NOME_TOA'  AND STATUS_FINAL != 'N Ponto' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado','Domingo') $filtroG $filtroC $filtroS $filtroData");
         */
            
         
            $dados['s_qtd_50'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado') $filtroG $filtroC $filtroS $filtroData ");
            $dados['s_qtd_100'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  AND dia not in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado')  $filtroG $filtroC $filtroS $filtroData");
            $dados['s_qtd_total'] = DB::Select("SELECT concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') AS qtd FROM ponto where nome_toa != 'NOME_TOA'  AND STATUS_FINAL != 'N Ponto' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','Sabado','Domingo') $filtroG $filtroC $filtroS $filtroData");
         
    /*     
            
        } else {
            
            $dados['s_qtd_50'] = DB::Select("select TOTAL_50 as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1 ");
            $dados['s_qtd_100'] = DB::Select("select TOTAL_100_ as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1");
            $dados['s_qtd_total'] = DB::Select("select TOTAL_HE_ as qtd from ponto where nome_toa != 'NOME_TOA' AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS LIMIT 1");
        
            
            
        }
        
      */  
        
        
        $dados['gerente'] = DB::Select("select gerente as gerente from ponto where gerente NOT IN ('GERENTE','') group by gerente");
        $dados['coordenador'] = DB::Select("select coordenador as coordenador from ponto where gerente NOT IN ('GERENTE','') group by coordenador");
        $dados['supervisor'] = DB::Select("select supervisor as supervisor from ponto where gerente NOT IN ('GERENTE','') group by supervisor");
      

        $dados['s_qtd_t_50'] = DB::Select("select nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' AND dia in ('Segunda','Terca','Quarta','Quinta','Sexta','sabado')  AND STATUS_FINAL != 'N Ponto'  $filtroG $filtroC $filtroS $filtroData group by nome_toa order by qtd desc limit 10");
                                            
        $dados['s_qtd_t_100'] = DB::Select("select nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' AND dia in ('Domingo') $filtroG $filtroC $filtroS $filtroData  AND STATUS_FINAL != 'N Ponto'  group by nome_toa order by qtd desc limit 10");
       
       $dados['s_qtd_t_negativa'] = DB::Select("select sum(TOTAL_HE) as ordem, nome_toa as nome, concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as qtd from ponto 
                                            where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData  AND STATUS_FINAL != 'N Ponto' group by nome_toa order by ordem asc limit 10");
       
       
        //dd($dados);
         $dados['ajustar'] = DB::Select("select ID, COORDENADOR, SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE  
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData and CARGA_HORARIA = 'INCORRETO'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
        
        $dados['n_ponto'] = DB::Select("select *  
                                                from marcacao_n_efetuada where NOME != 'NOME' $filtroG $filtroC $filtroS $filtroData ");
        
        $dados['grafico1'] = DB::Select("SELECT  DATA, DIA, ROUND(SUM(TOTAL_HE),2) as HE_TOTAL FROM `ponto` WHERE DIA != 'DIA'  
                                                                                    $filtroG $filtroC $filtroS $filtroData  GROUP by DATA, DIA ORDER BY DATA ASC ");
                                                                                    
        $dados['grafico2'] = DB::Select("SELECT UJ.DIA, SUM(UJ.S_HORAS) AS A_TOTAL_HE, SUM(AJ.S_HORAS) AS TOTAL_HE, SUM(((UJ.S_HORAS)/2)*4) AS PROJECAO FROM `ULTIMA_JANELA` UJ 
                                            INNER JOIN ANTIGA_JANELA AJ ON UJ.DIA=AJ.DIA AND UJ.gerente=AJ.gerente WHERE UJ.DIA != '' $filtroG1 GROUP BY UJ.DIA");
        
        $dados['s_qtd_t_50_a'] = DB::Select("select concat(round(SUM(S_HORAS),0), ':', RIGHT(round(SUM(S_HORAS),2),2),':00') as qtd, SUM(S_HORAS) as soma from ANTIGA_JANELA 
                                            where  dia in ('Segunda','Terca','Quarta','Quinta','Sexta','sabado') $filtroG");
                                            
        $dados['s_qtd_t_100_a'] = DB::Select("select concat(round(SUM(S_HORAS),0), ':', RIGHT(round(SUM(S_HORAS),2),2),':00') as qtd, SUM(S_HORAS) as soma from ANTIGA_JANELA 
                                            where  dia in ('Domingo') $filtroG");
       
         $dados['s_qtd_t_50_u'] = DB::Select("select concat(round(SUM((S_HORAS/2)*4),0), ':', RIGHT(round(SUM(S_HORAS),2),2),':00') as qtd, SUM(S_HORAS) as soma  from ULTIMA_JANELA 
                                            where  dia in ('Segunda','Terca','Quarta','Quinta','Sexta','sabado') $filtroG");
                                            
        $dados['s_qtd_t_100_u'] = DB::Select("select concat(round(SUM((S_HORAS/2)*4),0), ':', RIGHT(round(SUM(S_HORAS),2),2),':00') as qtd, SUM(S_HORAS) as soma  from ULTIMA_JANELA 
                                            where  dia in ('Domingo') $filtroG");
        
        
        $dados['t_n_ponto'] = DB::Select("select count(NOME) AS qtd 
                                                from marcacao_n_efetuada where NOME != 'NOME' $filtroG $filtroC $filtroS $filtroData ");
       
        if (!isset($req['status'])) {
            $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV, SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM   
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL != 'OK' 
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
        } else {
            if ($req['status'] == 'sem_prod') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE , SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM
                                                from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'HE Sem produção' GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
            }
            if ($req['status'] == 'demora') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'Demora no inicio da atividade'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");
            }
            if ($req['status'] == 'fechamento') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                                concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'Fechamento divergente de produção'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
              if ($req['status'] == 'nponto') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL = 'N Ponto'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
                  if ($req['status'] == 'gps') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL != 'N Ponto' and GPS_INICIO = 'N' OR GPS_FIM = 'N' 
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
                  if ($req['status'] == '2h') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL != 'N Ponto'  and MAIS_2H_DIA = 'S' 
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
                  if ($req['status'] == 'aderencia') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND STATUS_FINAL != 'N Ponto'  AND STATUS_FINAL != '' and MARCACOES != 4  
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
                  if ($req['status'] == 'domingo') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES, GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData and DIA = 'Domingo' and ULTIMA_MARCACAO LIKE '%18:%'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }

            if ($req['status'] == 'domingos') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES,GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND DOMINGOS > 2 AND DIA = 'Domingo'
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
            
            if ($req['status'] == '7_dias') {
                $dados['ponto'] = DB::Select("select ID, COORDENADOR, DIF_FIM_PONT_ATIV, DIF_INI_PONT_ATIV,  SUPERVISOR, NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO, INICIO_ATIVIDADE, FIM_ATIVIDADE, 
                                               concat(round(SUM(TOTAL_HE),0), ':', RIGHT(round(SUM(TOTAL_HE),2),2),':00') as TOTAL_HE, SUM(ATIV_OK) AS OK, SUM(ATIV_INF) AS INF, MARCACOES,GPS_INICIO, GPS_FIM  from ponto 
                                               where nome_toa != 'NOME_TOA' $filtroG $filtroC $filtroS $filtroData AND MAIS_DE_7_DIAS > 7
                                                 GROUP BY ID, COORDENADOR, SUPERVISOR, 
                                                NOME_TOA, DATA, DIA, PRIMEIRA_MARCACAO, ULTIMA_MARCACAO");        
            }
        }
          
        return view('ponto1',['dados' => $dados]);
    }



    public function detalhe(Request $req)
    {   
        $id = $req->id;
       
        $dados = [];
        $dados['ponto'] = DB::Select("select * from ponto where ID = '$id'");
        return view('detalhe',['dados' => $dados]);
    }

    public function horas (Request $req)
    {   
        $id = $req->id;
        $dados = [];
        
        if (isset($req['cdc'])) {
            $filtroG = " and cdc = '".$req['cdc']."' ";
        } 
        if ($req['cdc'] == 'TODOS' || !isset($req['cdc'])) {
            $filtroG = '';
        }
        
        if (isset($req['status'])) {
            $campo = $req['status'];
        } else {
            $campo = "horas_50";
        }
     
        
        $dados['cdc'] = DB::Select("select cdc as cdc from horas_realizadas where cdc NOT IN ('cdc','') group by cdc");
        $dados['filial'] = DB::Select("select filial as filial from horas_realizadas where filial NOT IN ('filial','') group by filial");
        $dados['status_hora'] = DB::Select("select * from status_hora_aux order by id asc");
        $dados['atualizacao'] = DB::Select("select atualizacao from ponto where data != 'DATA' order by data desc limit 1");
        $dados['horas'] = DB::Select("select mat, funcionario, cdc, filial, gestor, horas_50, horas_100, total_he,total_he_banco,total_he_folha from horas_realizadas where mat != '' $filtroG");
        $dados['horas_50'] = DB::Select("select *  from horas_realizadas where mat != '' $filtroG order by horas_50 desc");
        $dados['horas_100'] = DB::Select("select * from horas_realizadas where mat != '' $filtroG order by horas_100 desc");
        $dados['total_he'] = DB::Select("select * from horas_realizadas where mat != '' $filtroG order by total_he desc");
        $dados['total_he_banco'] = DB::Select("select * from horas_realizadas where mat != '' $filtroG order by total_he_banco desc");
        $dados['total_he_folha'] = DB::Select("select * from horas_realizadas where mat != '' $filtroG order by total_he_folha desc");
        $dados['s_horas_50'] = DB::Select("select concat(round(SUM((total_50_)),0), ':', RIGHT(round(SUM((total_50_)),2),2),':00') as qtd from horas_realizadas where mat != '' $filtroG");
        $dados['s_horas_100'] = DB::Select("select concat(round(SUM(total_100_),0), ':', RIGHT(round(SUM(total_100_),2),2),':00') as qtd from horas_realizadas where mat != '' $filtroG");
        $dados['s_total_he'] = DB::Select("select concat(round(SUM(total_he_),0), ':', RIGHT(round(SUM(total_he_),2),2),':00') as qtd from horas_realizadas where mat != '' $filtroG order by total_he desc");
        $dados['s_total_he_banco'] = DB::Select("select concat(round(SUM(total_he_banco_),0), ':', RIGHT(round(SUM(total_he_banco_),2),2),':00') as qtd from horas_realizadas where mat != '' $filtroG order by total_he_banco desc");
        $dados['s_total_he_folha'] = DB::Select("select concat(round(SUM(total_he_folha_),0), ':', RIGHT(round(SUM(total_he_folha_),2),2),':00') as qtd from horas_realizadas where mat != '' $filtroG order by total_he_folha desc");
     
     
     
        return view('horas',['dados' => $dados]);
    }


    
    public function tratar(Request $req)
    {   
        $id = $req->id;
       
        $dados = [];
        $dados['ponto'] = DB::Select("select * from ponto where ID = '$id'");
        //dd($dados['ponto']);
        return view('tratar',['dados' => $dados]);
    }
    
}