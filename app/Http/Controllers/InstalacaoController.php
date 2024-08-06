<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class InstalacaoController extends Controller
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
  
    public function online(Request $req)
    {  
        $dados = [];
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Instalacao',
            'tipo'      => 'Producao'
        ]);
        
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = '';
        }
        
        if (!isset($req->tipo) || $req->tipo == 'TODOS' || $req->tecnologia == 'TODOS') {
           
            $campos = "
                                sum(presenca_instalacao) as presenca, 
                                sum(meta+meta_mud+meta_mud_tec) as meta, 
                                sum(meta_organica) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_h+realizado_c+realizado_mud+realizado_mud_tec) as realizado,
                                sum(inst_h_cancelada+inst_c_cancelada+mud_cancelada+mud_tec_cancelada) as cancelada,
                                sum((realizado_h+realizado_c+realizado_mud+realizado_mud_tec)-(meta_organica+meta_mud+meta_mud_tec)) as gap,
                                sum(capacidade+capacidade_mud+capacidade_mud_tec) as capacidade,
                                sum(pendente_h+pendente_c+pendente_mud+pendente_mud_tec) as pendente,
                                100-round(SUM(pendente_h+pendente_c+pendente_mud+pendente_mud_tec)/(sum(pendente_h+pendente_c+pendente_mud+pendente_mud_tec)+SUM(realizado_h+realizado_c+realizado_mud+realizado_mud_tec)),2)*100 as eficiencia,
                                round(sum(realizado_h+realizado_c+realizado_mud+realizado_mud_tec)/sum(presenca_c+presenca_h),2) as produtividade,
                                sum(iniciado_h+iniciado_c+iniciado_mud+iniciado_mud_tec) as iniciado,
                                sum(nao_iniciado_h+nao_iniciado_c+nao_iniciado_mud+nao_iniciado_mud_tec) as nao_iniciado,
                                sum(sem_atividade) as sem_atividade,
                                sum(ocioso) as ocioso,
                                sum(zerado_ok) as zerado_ok,
                                sum(producao_01) as producao_01,
                                sum(suspenso_c+suspenso_h+suspenso_mud+suspenso_mud_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
        }
    
         if ($req->tipo == 'INSTALACAO' && $req->tecnologia == 'TODOS') {
            $campos = "
            sum(presenca_h+presenca_c) as presenca, 
                                sum(meta) as meta, 
                                sum(meta_organica) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_h+realizado_c) as realizado,
                                sum(inst_c_cancelada+inst_h_cancelada) as cancelada,
                                sum((realizado_h+realizado_c)-meta_organica) as gap,
                                sum(capacidade) as capacidade,
                                sum(pendente_h+pendente_c) as pendente,
                                100-round(SUM(pendente_h+pendente_c)/(sum(pendente_h+pendente_c)+SUM(realizado_h+realizado_c)),2)*100 as eficiencia,
                                round(sum(realizado_h+realizado_c)/sum(presenca_c+presenca_h),2) as produtividade,
                                sum(iniciado_h+iniciado_c) as iniciado,
                                sum(nao_iniciado_h+nao_iniciado_c) as nao_iniciado,
                                sum(sem_atividade) as sem_atividade,
                                sum(ocioso) as ocioso,
                                sum(zerado_ok) as zerado_ok,
                                sum(producao_01) as producao_01,
                                sum(suspenso_c+suspenso_h) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
            $erroDiogo = ' and realizado_mud = 0 and realizado_mud_tec = 0';
        } else {
            $erroDiogo = '';
        }
    
        if ($req->tipo == 'INSTALACAO' && $req->tecnologia == 'FTTH') {
            $campos = "
            sum(presenca_h) as presenca, 
                                sum(meta) as meta, 
                                sum(meta_organica) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_h) as realizado,
                                sum(inst_h_cancelada) as cancelada,
                                sum((realizado_h)-meta_organica) as gap,
                                sum(capacidade) as capacidade,
                                sum(pendente_h) as pendente,
                                100-round(SUM(pendente_h)/(sum(pendente_h)+SUM(realizado_h)),2)*100 as eficiencia,
                                round(sum(realizado_h)/sum(presenca_h),2) as produtividade,
                                sum(iniciado_h) as iniciado,
                                sum(nao_iniciado_h) as nao_iniciado,
                                sum(sem_atividade) as sem_atividade,
                                sum(ocioso) as ocioso,
                                sum(zerado_ok) as zerado_ok,
                                sum(producao_01) as producao_01,
                                sum(suspenso_h) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
                                
            ";
                        $erroDiogo = ' and realizado_mud = 0 and realizado_mud_tec = 0';
        } 
        
           if ($req->tipo == 'INSTALACAO' && $req->tecnologia == 'FTTC') {
               
            $campos = "
            sum(presenca_c) as presenca, 
                                sum(meta) as meta, 
                                sum(meta_organica) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_c) as realizado,
                                sum(inst_c_cancelada) as cancelada,
                                sum((realizado_c)-meta_organica) as gap,
                                sum(capacidade) as capacidade,
                                sum(pendente_c) as pendente,
                                100-round(SUM(pendente_c)/(sum(pendente_c)+SUM(realizado_c)),2)*100 as eficiencia,
                                round(sum(realizado_c)/sum(presenca_c),2) as produtividade,
                                sum(iniciado_c) as iniciado,
                                sum(nao_iniciado_c) as nao_iniciado,
                                sum(sem_atividade) as sem_atividade,
                                sum(ocioso) as ocioso,
                                sum(zerado_ok) as zerado_ok,
                                sum(producao_01) as producao_01,
                                sum(suspenso_c) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            $erroDiogo = ' and realizado_mud = 0 and realizado_mud_tec = 0';
        } 

         if ($req->tipo == 'MUD') {
            $campos = "
            sum(presenca_mud) as presenca, 
                                sum(meta_mud) as meta, 
                                sum(meta_mud) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_mud) as realizado,
                                sum(mud_cancelada) as cancelada,
                                sum(realizado_mud-meta_mud) as gap,
                                sum(capacidade_mud) as capacidade,
                                sum(pendente_mud) as pendente,
                                100-round(SUM(pendente_mud)/(sum(pendente_mud)+SUM(realizado_mud)),2)*100 as eficiencia,
                                round(sum(realizado_mud)/sum(presenca_mud),2) as produtividade,
                                sum(iniciado_mud) as iniciado,
                                sum(nao_iniciado_mud) as nao_iniciado,
                                sum(sem_atividade_mud) as sem_atividade,
                                sum(ocioso_mud) as ocioso,
                                sum(zerado_ok_mud) as zerado_ok,
                                sum(producao_01_mud) as producao_01,
                                sum(suspenso_mud) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
        } 
        
          if ($req->tipo == 'MUD_TEC') {
            $campos = "
            sum(presenca_mud_tec) as presenca, 
                                sum(meta_mud_tec) as meta, 
                                sum(meta_mud_tec) as meta_organica,
                                sum(projecao) as projecao,
                                sum(hc) as hc,
                                sum(realizado_mud_tec) as realizado,
                                sum(mud_tec_cancelada) as cancelada,
                                sum(realizado_mud_tec-meta_mud_tec) as gap,
                                sum(capacidade_mud_tec) as capacidade,
                                sum(pendente_mud_tec) as pendente,
                                100-round(SUM(pendente_mud_tec)/(sum(pendente_mud_tec)+SUM(realizado_mud_tec)),2)*100 as eficiencia,
                                round(sum(realizado_mud_tec)/sum(presenca_mud_tec),2) as produtividade,
                                sum(iniciado_mud_tec) as iniciado,
                                sum(nao_iniciado_mud_tec) as nao_iniciado,
                                sum(sem_atividade_mud_tec) as sem_atividade,
                                sum(ocioso_mud_tec) as ocioso,
                                sum(zerado_ok_mud_tec) as zerado_ok,
                                sum(producao_01_mud_tec) as producao_01,
                                sum(suspenso_mud_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
        } 
        
          if ($req->tipo == 'DESCONEXAO') {
            $campos = "
            sum(presenca_desc_tec) as presenca, 
                                sum(meta_desc_tec) as meta, 
                                sum(meta_desc_tec) as meta_organica,
                                sum(realizado_desc_tec+iniciado_desc_tec+nao_iniciado_desc_tec) as projecao,
                                sum(hc) as hc,
                                sum(realizado_desc_tec) as realizado,
                                sum(desc_cancelada) as cancelada,
                                sum(realizado_desc_tec-meta_desc_tec) as gap,
                                sum(capacidade_desc_tec) as capacidade,
                                sum(pendente_desc_tec) as pendente,
                                100-round(SUM(pendente_desc_tec)/(sum(pendente_desc_tec)+SUM(realizado_desc_tec)),2)*100 as eficiencia,
                                round(sum(realizado_desc_tec)/sum(presenca_desc_tec),2) as produtividade,
                                sum(iniciado_desc_tec) as iniciado,
                                sum(nao_iniciado_desc_tec) as nao_iniciado,
                                sum(sem_atividade_desc_tec) as sem_atividade,
                                sum(ocioso_desc_tec) as ocioso,
                                sum(zerado_ok_desc_tec) as zerado_ok,
                                sum(producao_01_desc_tec) as producao_01,
                                sum(suspenso_desc_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
        } 
        
          if ($req->tipo == 'ATIV. ESCRITORIO') {
            $campos = "
            sum(presenca_escritorio_tec) as presenca, 
                                sum(meta_escritorio_tec) as meta, 
                                sum(meta_escritorio_tec) as meta_organica,
                                sum(realizado_escritorio_tec+iniciado_escritorio_tec+nao_iniciado_escritorio_tec) as projecao,
                                sum(hc) as hc,
                                sum(realizado_escritorio_tec) as realizado,
                                sum(ativ_esc_cancelada) as cancelada,
                                sum(realizado_escritorio_tec-meta_escritorio_tec) as gap,
                                sum(capacidade_escritorio_tec) as capacidade,
                                sum(pendente_escritorio_tec) as pendente,
                                100-round(SUM(pendente_escritorio_tec)/(sum(pendente_escritorio_tec)+SUM(realizado_escritorio_tec)),2)*100 as eficiencia,
                                round(sum(realizado_escritorio_tec)/sum(presenca_escritorio_tec),2) as produtividade,
                                sum(iniciado_escritorio_tec) as iniciado,
                                sum(nao_iniciado_escritorio_tec) as nao_iniciado,
                                sum(sem_atividade_escritorio_tec) as sem_atividade,
                                sum(ocioso_escritorio_tec) as ocioso,
                                sum(zerado_ok_escritorio_tec) as zerado_ok,
                                sum(producao_01_escritorio_tec) as producao_01,
                                sum(suspenso_escritorio_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
        }
        
        
          if ($req->tipo == 'ALMOCO') {
            $campos = "
            sum(presenca_almoco_tec) as presenca, 
                                sum(meta_almoco_tec) as meta, 
                                sum(meta_almoco_tec) as meta_organica,
                                sum(realizado_almoco_tec+iniciado_almoco_tec+nao_iniciado_almoco_tec) as projecao,
                                sum(hc) as hc,
                                sum(realizado_almoco_tec) as realizado,
                                sum(realizado_almoco_tec-meta_almoco_tec) as gap,
                                sum(capacidade_almoco_tec) as capacidade,
                                sum(pendente_almoco_tec) as pendente,
                                100-round(SUM(pendente_almoco_tec)/(sum(pendente_almoco_tec)+SUM(realizado_almoco_tec)),2)*100 as eficiencia,
                                round(sum(realizado_almoco_tec)/sum(presenca_almoco_tec),2) as produtividade,
                                sum(iniciado_almoco_tec) as iniciado,
                                sum(nao_iniciado_almoco_tec) as nao_iniciado,
                                sum(sem_atividade_almoco_tec) as sem_atividade,
                                sum(ocioso_almoco_tec) as ocioso,
                                sum(zerado_ok_almoco_tec) as zerado_ok,
                                sum(producao_01_almoco_tec) as producao_01,
                                sum(suspenso_almoco_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo
            ";
            
        }
        
        if (($req->tipo == 'MUD_TEC' || $req->tipo == 'MUD') && ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC')) {
           
            $filtro = " and skill = '".$req->tecnologia."' ";
        } else {
            $filtro = '';
        }
        
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
           
            $filtro = " and skill = '".$req->tecnologia."' ";
        } else {
            $filtro = '';
        }

        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } 
 
        if ($req->filial == 'SP' || $req->filial == 'GO' || $req->filial == 'DF') {
            $filtroFilial = " and filial = '".$req->filial."' ";
        } 

        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
        } else {
            $filtroData =  " and data = '$hoje'";
        }
        //dd('MANUTENÇÃO');
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
                                
        $ultimaAtualizacao = date('Y-m-d H:i', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
       
        
        $dados['visaoGerente'] = DB::select("Select gerente, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != '' $filtroData
                                $filtro 
                                $filtroFilial and data_cadastro like '".$ultimaAtualizacao."%'
                                GROUP BY gerente, filial ORDER BY filial, gerente");
       
        $dados['visaoFFA'] = DB::select("Select  
                                $campos
                                FROM `producao_dia` 
                                where gerente != '' $filtroData
                                $filtro and data_cadastro  like '".$ultimaAtualizacao."%'
                                $filtroFilial 
                                ");

      

        $dados['visaoCoordenador'] = DB::select("Select coordenador, filial, 
                                $campos
                                FROM `producao_dia` 
                                where gerente != '' $filtroData
                                $filtro   
                                $filtroFilial  and data_cadastro  like '".$ultimaAtualizacao."%'
                                GROUP BY coordenador, filial ORDER BY filial, coordenador");

 
      
        $dados['visaoSupervisor'] = DB::select("Select supervisor, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != '' $filtroData
                                $filtro and meta_organica != 0 and (presenca_instalacao > 0)
                                $filtroFilial  and data_cadastro like '".$ultimaAtualizacao."%'
                                GROUP BY supervisor,filial ORDER BY filial, supervisor");
                                
        $dados['visaoFiscal'] = DB::select("Select fiscal, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != '' $filtroData
                                $filtro and meta_organica != 0 and (presenca_instalacao > 0)
                                $filtroFilial  and data_cadastro like '".$ultimaAtualizacao."%'
                                GROUP BY fiscal,filial ORDER BY filial, fiscal");

        return view('instalacaoonline',['dados' => $dados]);
    }


      public function onlineTecnico(Request $req)
    {  
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Instalacao',
            'tipo'      => 'Tecnicos'
        ]);
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $dados = [];
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " where skill != '' "; 
            
        } 
 
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
            $filtro = " where skill = '".$req->tecnologia."' ";
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
        
        if ($req->presenca != 'TODOS' || !isset($req->presenca) || $req->presenca != 0) {
            $filtroP = " and (presenca_instalacao != 0)";
        } else {
            $filtroP = '';
        }
       
         
        if (isset($req->tipo) && $req->tipo == 'sem_atividade') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Tecnicos sem atividade'
            ]);
            
            $filtroSA = " and sem_atividade = '1'";
        } else {
            $filtroSA = '';
        }
        
        if (isset($req->tipo) && $req->tipo == 'ocioso') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Tecnicos ociosos'
            ]);
            
            $filtroSO = " and ocioso = 1";
        } else {
            $filtroSO = '';
        }
        
        if (isset($req->tipo) && $req->tipo == 'zerado_ok') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Tecnicos zerados'
            ]);
            
            $filtroSZ = " and zerado_ok = '1'";
        } else {
            $filtroSZ = '';
        }
        
        if (isset($req->tipo) && $req->tipo == 'producao_01') {
           $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Tecnicos 1 producao'
            ]);
            
            $filtroSP = " and producao_01 = '1'";
        } else {
            $filtroSP = '';
        }
        
        if (isset($req->tipo) && $req->tipo == 'ba_longo') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Tecnicos ba longo'
            ]);
            
            $filtroB = " and flag_ba_longo = '1'";
        } else {
            $filtroB = '';
        }
       
        if (isset($req->tipo) && $req->tipo == 'TODOS') {
            $filtroB = "";
        } else {
            $filtroB = '';
        }
       
       
       
        
         date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
        } else {
            $filtroData =  " and data = '$hoje'";
        }

              
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");

        $ultimaAtualizacao = date('Y-m-d H:i', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
                
        $dados['gerente'] = DB::select("Select gerente as gerente
                                FROM `producao_dia` where data = '$hoje'  and data_cadastro like '".$ultimaAtualizacao."%'
                                group by gerente order by gerente");
        //dd($dados['gerente']);
        $dados['coordenador'] = DB::select("Select coordenador as coordenador
                                FROM `producao_dia`  where data = '$hoje'  and data_cadastro like '".$ultimaAtualizacao."%'
                                group by coordenador order by coordenador");
                                
        $dados['supervisor'] = DB::select("Select supervisor as supervisor
                                FROM `producao_dia`  where data = '$hoje'  and data_cadastro  like '".$ultimaAtualizacao."%'
                                group by supervisor order by supervisor");
                                
        $dados['visaoTecnico'] = DB::select("Select gerente, coordenador, supervisor, nome, skill, 
                                sum(presenca_instalacao) as presenca, 
                                sum(meta+meta_mud+meta_mud_tec) as meta, 
                                sum(meta_organica) as meta_organica,
                                sum(realizado_h+realizado_c+realizado_mud+realizado_mud_tec) as realizado,
                                sum(inst_h_cancelada+inst_c_cancelada+mud_cancelada+mud_tec_cancelada) as cancelada,
                                sum((realizado_h+realizado_c+realizado_mud+realizado_mud_tec)-(meta_organica+meta_mud+meta_mud_tec)) as gap,
                                sum(capacidade+capacidade_mud+capacidade_mud_tec) as capacidade,
                                sum(pendente_h+pendente_c+pendente_mud+pendente_mud_tec) as pendente,
                                100-round(SUM(pendente_h+pendente_c+pendente_mud+pendente_mud_tec)/(sum(pendente_h+pendente_c+pendente_mud+pendente_mud_tec)+SUM(realizado_h+realizado_c+realizado_mud+realizado_mud_tec)),2)*100 as eficiencia,
                                round(sum(realizado_h+realizado_c+realizado_mud+realizado_mud_tec)/sum(presenca_c+presenca_h),2) as produtividade,
                                sum(iniciado_h+iniciado_c+iniciado_mud+iniciado_mud_tec) as iniciado,
                                sum(nao_iniciado_h+nao_iniciado_c+nao_iniciado_mud+nao_iniciado_mud_tec) as nao_iniciado,
                                sum(sem_atividade) as sem_atividade,
                                sum(ocioso) as ocioso,
                                sum(zerado_ok) as zerado_ok,
                                sum(producao_01) as producao_01,
                                sum(suspenso_c+suspenso_h+suspenso_mud+suspenso_mud_tec) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo,
                                ba_longo,
                                data,
                                n_ordem_ba_longo,
                                tipo_ordem_ba_longo,
                                tempo_atividade
                                FROM `producao_dia` where id != '' and (presenca_instalacao > 0)
                                $filtroData
                                $filtroSA 
                                $filtroSO 
                                $filtroSZ 
                                $filtroSP
                                $filtroG 
                                $filtroC
                                $filtroS  
                                 $filtroB
                                 and meta_organica != 0  and data_cadastro = '$ultimaAtualizacao'
                                GROUP BY nome, skill, gerente, coordenador, supervisor");
        
        return view('instalacaoonlinetecnico',['dados' => $dados]);
    }

    public function backlog_tlp_1 (Request $req)
    {  
        date_default_timezone_set('America/Sao_Paulo');
        $dados = [];
        
        if (isset($req->gerencia)) {
            $gerencia = " and gerencia = '".$req->gerencia."' ";
        } else {
            $gerencia = '';
        }
        
        if (isset($req->gross)) {
            if ($req->gerencia == 1 || $req->gerencia == 0) {
                $gerencia = " and gross = '".$req->gerencia."' ";
            } else {
                $gerencia = "";
            }
        }
        else {
            $gerencia = '';
        }
        
        if (isset($req->atividade)) {
            $atividade = " and atividade = '".$req->atividade."' ";
        } else {
            $atividade = '';
        }
        
        if (isset($req->empresa_instalacao)) {
            $empresa_instalacao = " and empresa_instalacao = '".$req->empresa_instalacao."' ";
        } else {
            $empresa_instalacao = '';
        }
        
        if (isset($req->tipo_backlog)) {
            $tipo_backlog = " and tipo_backlog = '".$req->tipo_backlog."' ";
        } else {
            $tipo_backlog = '';
        }
        //dd($empresa_instalacao,$gerencia ,$atividade, $tipo_backlog );
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM backlog_tlp where data_import != 'data_import'
                                order by data_import limit 1");
        
        $dados['empresa'] = DB::select("SELECT a.empresa_instalacao as gerencia, 
                                    SUM(CASE a.faixa WHEN 'de 0 a 3 dias' THEN a.instalacao ELSE 0 END) AS 'b0_a_3_dias', 
                                    SUM(CASE a.faixa WHEN 'de 4 a 5 dias' THEN a.instalacao ELSE 0 END) AS 'b4_a_5_dias', 
                                    SUM(CASE a.faixa WHEN 'de 6 a 10 dias' THEN a.instalacao ELSE 0 END) AS 'b6_a_10_dias', 
                                    SUM(CASE a.faixa WHEN 'de 11 a 20 dias' THEN a.instalacao ELSE 0 END) AS 'b11_a_20_dias', 
                                    SUM(CASE a.faixa WHEN 'Acima de 20 dias' THEN a.instalacao ELSE 0 END) AS 'acima_de_20_dias', 
                                        SUM(a.instalacao) as total 
                                        FROM backlog_tlp a 
                                        WHERE a.atividade like 'inst%' 
                                        and a.estado in ('Não iniciado','Iniciado') $gerencia  $empresa_instalacao
                                        GROUP BY a.empresa_instalacao");
        
        $dados['backlog_gerencia'] = DB::select("SELECT a.gerencia, 
                                    SUM(CASE a.faixa WHEN 'de 0 a 3 dias' THEN a.instalacao ELSE 0 END) AS 'b0_a_3_dias', 
                                    SUM(CASE a.faixa WHEN 'de 4 a 5 dias' THEN a.instalacao ELSE 0 END) AS 'b4_a_5_dias', 
                                    SUM(CASE a.faixa WHEN 'de 6 a 10 dias' THEN a.instalacao ELSE 0 END) AS 'b6_a_10_dias', 
                                    SUM(CASE a.faixa WHEN 'de 11 a 20 dias' THEN a.instalacao ELSE 0 END) AS 'b11_a_20_dias', 
                                    SUM(CASE a.faixa WHEN 'Acima de 20 dias' THEN a.instalacao ELSE 0 END) AS 'acima_de_20_dias', 
                                        SUM(a.instalacao) as total 
                                        FROM backlog_tlp a 
                                        WHERE a.atividade like 'inst%' 
                                        and a.estado in ('Não iniciado','Iniciado') $gerencia  $empresa_instalacao
                                        GROUP BY a.gerencia");
                                        
        $dados['backlog_tipo'] = DB::select("SELECT a.tipo_backlog as gerencia, 
                                    SUM(CASE a.faixa WHEN 'de 0 a 3 dias' THEN a.instalacao ELSE 0 END) AS 'b0_a_3_dias', 
                                    SUM(CASE a.faixa WHEN 'de 4 a 5 dias' THEN a.instalacao ELSE 0 END) AS 'b4_a_5_dias', 
                                    SUM(CASE a.faixa WHEN 'de 6 a 10 dias' THEN a.instalacao ELSE 0 END) AS 'b6_a_10_dias', 
                                    SUM(CASE a.faixa WHEN 'de 11 a 20 dias' THEN a.instalacao ELSE 0 END) AS 'b11_a_20_dias', 
                                    SUM(CASE a.faixa WHEN 'Acima de 20 dias' THEN a.instalacao ELSE 0 END) AS 'acima_de_20_dias', 
                                        SUM(a.instalacao) as total 
                                        FROM backlog_tlp a 
                                       WHERE a.atividade like 'inst%' 
                                       and a.estado in ('Não iniciado','Iniciado') $gerencia  $empresa_instalacao
                                        GROUP BY a.tipo_backlog");
                                        
        $dados['backlog_esteira'] = DB::select("SELECT a.esteira as gerencia, 
                                    SUM(CASE a.faixa WHEN 'de 0 a 3 dias' THEN a.instalacao ELSE 0 END) AS 'b0_a_3_dias', 
                                    SUM(CASE a.faixa WHEN 'de 4 a 5 dias' THEN a.instalacao ELSE 0 END) AS 'b4_a_5_dias', 
                                    SUM(CASE a.faixa WHEN 'de 6 a 10 dias' THEN a.instalacao ELSE 0 END) AS 'b6_a_10_dias', 
                                    SUM(CASE a.faixa WHEN 'de 11 a 20 dias' THEN a.instalacao ELSE 0 END) AS 'b11_a_20_dias', 
                                    SUM(CASE a.faixa WHEN 'Acima de 20 dias' THEN a.instalacao ELSE 0 END) AS 'acima_de_20_dias', 
                                        SUM(a.instalacao) as total 
                                        FROM backlog_tlp a 
                                        WHERE a.atividade like 'inst%' 
                                        and a.estado in ('Não iniciado','Iniciado') $gerencia  $empresa_instalacao
                                        GROUP BY a.esteira");
                                        
        $dados['backlog_total'] = DB::select("SELECT  
                                    SUM(CASE a.faixa WHEN 'de 0 a 3 dias' THEN a.instalacao ELSE 0 END) AS 'b0_a_3_dias', 
                                    SUM(CASE a.faixa WHEN 'de 4 a 5 dias' THEN a.instalacao ELSE 0 END) AS 'b4_a_5_dias', 
                                    SUM(CASE a.faixa WHEN 'de 6 a 10 dias' THEN a.instalacao ELSE 0 END) AS 'b6_a_10_dias', 
                                    SUM(CASE a.faixa WHEN 'de 11 a 20 dias' THEN a.instalacao ELSE 0 END) AS 'b11_a_20_dias', 
                                    SUM(CASE a.faixa WHEN 'Acima de 20 dias' THEN a.instalacao ELSE 0 END) AS 'acima_de_20_dias',  
                                    SUM(a.instalacao) as total 
                                    FROM backlog_tlp a 
                                    WHERE a.atividade like 'inst%'
                                    and a.estado in ('Não iniciado','Iniciado') $gerencia  $empresa_instalacao
                                       
                                    ");
        
        
        
        $dados['atividade'] = DB::select("Select atividade as atividade
                                FROM `backlog_tlp`
                                where estado in ('Não iniciado','Iniciado') 
                                and atividade like 'insta%' and gerencia != '(vazio)'
                                group by atividade");
        
        $dados['gerencia'] = DB::select("Select gerencia as gerencia
                                FROM `backlog_tlp`
                                where estado in ('Não iniciado','Iniciado') and gerencia != '(vazio)'
                                group by gerencia");
        
        $dados['empresa_instalacao'] = DB::select("Select empresa_instalacao as empresa_instalacao
                                FROM `backlog_tlp`
                                where estado in ('Não iniciado','Iniciado') and gerencia != '(vazio)'
                                and atividade like 'insta%'
                                group by empresa_instalacao");
        
        $dados['empresa_reparo'] = DB::select("Select empresa_reparo as empresa_reparo
                                FROM `backlog_tlp`
                                where estado in ('Não iniciado','Iniciado') and gerencia != '(vazio)'
                                and atividade like 'insta%'
                                group by empresa_reparo");                        
                               
        $dados['tipo_backlog'] = DB::select("Select tipo_backlog as tipo_backlog
                                FROM `backlog_tlp`
                                where estado in ('Não iniciado','Iniciado') and gerencia != '(vazio)'
                                and atividade like 'insta%'
                                group by tipo_backlog");                        
                               
        return view('backlog_tlp',['dados' => $dados]);
    }
    
    public function backlog_tlp (Request $req)
    {  
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Backlog',
            'tipo'      => 'instalacao'
        ]);
        
        
        date_default_timezone_set('America/Sao_Paulo');
        $dados = [];
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM `backlog_novo_v2` where data_import != 'data_import'
                                order by data_import desc limit 1");
                                
        
        $dados['tlp'] = DB::select("SELECT count(tipo_backlog) as qtd FROM `backlog_novo_v2` WHERE tipo_backlog in ('Backlog Operação','(vazio)') 
        and empresa_instalacao like 'TL%' AND tipo_ordem = 'Instalação' and fx_agend_os != '(vazio)' and empresa_instalacao = 'TLP'");
        
        $dados['tli'] = DB::select("SELECT count(tipo_backlog) as qtd FROM `backlog_novo_v2` WHERE tipo_backlog in ('Backlog Operação','(vazio)') 
        and empresa_instalacao like 'TL%' AND tipo_ordem = 'Instalação' and fx_agend_os != '(vazio)' and empresa_instalacao = 'TLI'");

        $dados['tls'] = DB::select("SELECT count(tipo_backlog) as qtd FROM `backlog_novo_v2` WHERE tipo_backlog in ('Backlog Operação','(vazio)') 
        and empresa_instalacao like 'TL%' AND tipo_ordem = 'Instalação' and fx_agend_os != '(vazio)' and empresa_instalacao = 'TLS'");
        
        $dados['tlg'] = DB::select("SELECT count(tipo_backlog) as qtd FROM `backlog_novo_v2` WHERE tipo_backlog in ('Backlog Operação','(vazio)') 
        and empresa_instalacao like 'TL%' AND tipo_ordem = 'Instalação' and fx_agend_os != '(vazio)' and empresa_instalacao = 'TLG'");
        
        
        
        if (isset($req->gerencia)) {
            $gerencia = " and gerencia = '".$req->gerencia."' ";
        } else {
            $gerencia = '';
        }
        
        if (isset($req->gross)) {
            if ($req->gross == 1 || $req->gross == 0) {
                $gross = " and flag_gross = '".$req->gross."' ";
            } else {
                $gross = "";
            }
        }
        else {
            $gross = '';
        }
        
        if (isset($req->atividade)) {
            $atividade = " and tipo = 'Instalação' ";
        } else {
             $atividade = " and tipo = 'Instalação' ";
        }
        /*
        if (isset($req->empresa_instalacao)) {
            $empresa_instalacao = " and empresa_instalacao = '".$req->empresa_instalacao."' ";
        } else {
            $empresa_instalacao = '';
        }
        */
        
        if (isset($req->empresa_instalacao)) {
            $empresa_instalacao = " and empresa_instalacao IN ('TLP', 'TLG','TLS','TLI')";
        } else {
            $empresa_instalacao = " and empresa_instalacao IN ('TLP', 'TLG','TLS','TLI')";
        }
        
        if (isset($req->tipo_backlog)) {
            $tipo_backlog = " and tipo_backlog = '".$req->tipo_backlog."' ";
        } else {
            $tipo_backlog = '';
        }
        
        $dados['backlog_total'] = DB::select("SELECT  *  
                                    FROM backlog_novo a 
                                    WHERE status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                       
                                    ");
        
        
        
        $dados['atividade'] = DB::select("Select tipo as atividade
                                FROM `backlog_novo` where tipo != '(vazio)' $empresa_instalacao and tipo = 'Instalação'
                                group by tipo");
        
        $dados['gerencia'] = DB::select("Select gerencia as gerencia
                                FROM `backlog_novo` where gerencia != '(vazio)' $empresa_instalacao  and tipo = 'Instalação'
                                group by gerencia");
        
        $dados['empresa_instalacao'] = DB::select("Select empresa_instalacao as empresa_instalacao 
                                FROM `backlog_novo` where empresa_instalacao != '(vazio)' $empresa_instalacao  and tipo = 'Instalação'
                                group by empresa_instalacao");
        
        $dados['empresa_reparo'] = DB::select("Select empresa_manutencao as empresa_reparo
                                FROM `backlog_novo` where empresa_manutencao != '(vazio)' $empresa_instalacao  and tipo = 'Instalação'
                                group by empresa_reparo");                        
        
        $dados['empresa'] = DB::select("SELECT empresa_instalacao as gerencia ,  SUM(de_0_a_3_dias) as b0_a_3_dias, SUM(de_4_a_5_dias) as b4_a_5_dias, 
                                            SUM(de_6_a_10_dias) as b6_a_10_dias, SUM(de_11_a_20_dias) as b11_a_20_dias, sum(acima_de_20_dias) as acima_de_20_dias,
                                            SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total FROM `backlog_novo` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY empresa_instalacao");
        
        $dados['backlog_gerencia'] = DB::select("SELECT gerencia as gerencia1, empresa_instalacao as gerencia ,  SUM(de_0_a_3_dias) as b0_a_3_dias, SUM(de_4_a_5_dias) as b4_a_5_dias, 
                                            SUM(de_6_a_10_dias) as b6_a_10_dias, SUM(de_11_a_20_dias) as b11_a_20_dias,  sum(acima_de_20_dias) as acima_de_20_dias,
                                            SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total FROM `backlog_novo` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $empresa_instalacao $gross $gerencia
                                            GROUP BY empresa_instalacao ORDER BY gerencia1"); 
        //dd($dados['backlog_gerencia']);                             
        $dados['backlog_tipo'] = DB::select("SELECT fila_esteira as gerencia ,  SUM(de_0_a_3_dias) as b0_a_3_dias, SUM(de_4_a_5_dias) as b4_a_5_dias, 
                                            SUM(de_6_a_10_dias) as b6_a_10_dias, SUM(de_11_a_20_dias) as b11_a_20_dias,  sum(acima_de_20_dias) as acima_de_20_dias,
                                            SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total FROM `backlog_novo` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY fila_esteira");
                                        
        $dados['backlog_esteira'] = DB::select("SELECT fx_agend_os as gerencia ,  SUM(de_0_a_3_dias) as b0_a_3_dias, SUM(de_4_a_5_dias) as b4_a_5_dias, 
                                            SUM(de_6_a_10_dias) as b6_a_10_dias, SUM(de_11_a_20_dias) as b11_a_20_dias,  sum(acima_de_20_dias) as acima_de_20_dias,
                                            SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total FROM `backlog_novo` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY fx_agend_os");
                                        
        $dados['backlog_total'] = DB::select("SELECT  
                                    SUM(de_0_a_3_dias) as b0_a_3_dias, 
                                    SUM(de_4_a_5_dias) as b4_a_5_dias, 
                                    SUM(de_6_a_10_dias) as b6_a_10_dias, 
                                    SUM(de_11_a_20_dias) as b11_a_20_dias,  
                                    sum(acima_de_20_dias) as acima_de_20_dias,
                                    SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE 
                                    backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)' and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross");
                                    
                                    
                                    
         $dados['backlog_total_tlp'] = DB::select("SELECT SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)' and status_ordem = 'Backlog' and empresa_instalacao = 'TLP'  $empresa_instalacao");
        
        $dados['backlog_total_tlp_gloss'] = DB::select("SELECT  SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and flag_gross = 1 and empresa_instalacao != '(vazio)' and status_ordem = 'Backlog' and empresa_instalacao = 'TLP'  $empresa_instalacao");
        
        $dados['backlog_total_tlg'] = DB::select("SELECT SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)' and status_ordem = 'Backlog' and empresa_instalacao = 'TLG'  $empresa_instalacao");
        
        $dados['backlog_total_tlg_gloss'] = DB::select("SELECT  SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)'  and flag_gross = 1 and status_ordem = 'Backlog' and empresa_instalacao = 'TLG'  $empresa_instalacao");
         
         $dados['backlog_total_tls'] = DB::select("SELECT SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)' and status_ordem = 'Backlog' and empresa_instalacao in ('TLS','TLI')  $empresa_instalacao");
        
        $dados['backlog_total_tls_gloss'] = DB::select("SELECT  SUM(de_0_a_3_dias + de_4_a_5_dias + de_6_a_10_dias + de_11_a_20_dias + acima_de_20_dias) as total 
                                    FROM backlog_novo WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_instalacao != '(vazio)' and flag_gross = 1 and status_ordem = 'Backlog' and empresa_instalacao in ('TLS','TLI')  $empresa_instalacao");
         
       
         
        $dados['tipo_backlog'] = DB::select("Select backlog_executivo as tipo_backlog
                                FROM `backlog_novo` where backlog_executivo != '(vazio)'
                                group by tipo_backlog");          
        
        //dd($dados);
        return view('backlog_tlp',['dados' => $dados]);
    }

    public function recente (Request $req)
    {  
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Qualidade',
            'tipo'      => 'Recente'
        ]);
        
        
        date_default_timezone_set('America/Sao_Paulo');
        $dados = [];
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM `backlog_novo_v2` where data_import != 'data_import'
                                order by data_import desc limit 1");
                                
        return view('qualidade/recente',['dados' => $dados]);
    }

    public function repetido (Request $req)
    {  
        date_default_timezone_set('America/Sao_Paulo');
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Qualidade',
            'tipo'      => 'Recente'
        ]);
        
        $dados = [];
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM `backlog_novo_v2` where data_import != 'data_import'
                                order by data_import desc limit 1");
                                
        return view('qualidade/repetido',['dados' => $dados]);
    }


        public function backlog_tlp_rep (Request $req)
    {  
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'Backlog',
            'tipo'      => 'Reparo'
        ]);
        
        
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM `backlog_novo_v2` where data_import != 'data_import'
                                order by data_import desc limit 1");
                                
        
        
        if (isset($req->gerencia)) {
            $gerencia = " and gerencia = '".$req->gerencia."' ";
        } else {
            $gerencia = '';
        }
        
        if (isset($req->gross)) {
            if ($req->gross == 1 || $req->gross == 0) {
                $gross = " and flag_gross = '".$req->gross."' ";
            } else {
                $gross = "";
            }
        }
        else {
            $gross = '';
        }
        
        if (isset($req->atividade)) {
            $atividade = " and tipo = 'Reparo' ";
        } else {
             $atividade = " and tipo = 'Reparo' ";
        }
        /*
        if (isset($req->empresa_instalacao)) {
            $empresa_instalacao = " and empresa_instalacao = '".$req->empresa_instalacao."' ";
        } else {
            $empresa_instalacao = '';
        }
        */
        
        if (isset($req->empresa_instalacao)) {
            $empresa_instalacao = " and empresa_manutencao IN ('TLP', 'TLG','TLS','TLI')";
        } else {
            $empresa_instalacao = " and empresa_manutencao IN ('TLP', 'TLG','TLS','TLI')";
        }
        
        if (isset($req->tipo_backlog)) {
            $tipo_backlog = " and tipo_backlog = '".$req->tipo_backlog."' ";
        } else {
            $tipo_backlog = '';
        }
        
        $dados['backlog_total'] = DB::select("SELECT  *  
                                    FROM backlog_novo_rep a 
                                    WHERE status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                       
                                    ");
        
        
        
        $dados['atividade'] = DB::select("Select tipo as atividade
                                FROM `backlog_novo_rep` where tipo != '(vazio)' $empresa_instalacao and tipo = 'Reparo'
                                group by tipo");
        
        $dados['gerencia'] = DB::select("Select gerencia as gerencia
                                FROM `backlog_novo_rep` where gerencia != '(vazio)' $empresa_instalacao  and tipo = 'Reparo'
                                group by gerencia");
        
        $dados['empresa_instalacao'] = DB::select("Select empresa_manutencao as empresa_instalacao 
                                FROM `backlog_novo_rep` where empresa_manutencao != '(vazio)' $empresa_instalacao  and tipo = 'Reparo'
                                group by empresa_manutencao");
        
        $dados['empresa_reparo'] = DB::select("Select empresa_manutencao as empresa_reparo
                                FROM `backlog_novo_rep` where empresa_manutencao != '(vazio)' $empresa_instalacao  and tipo = 'Reparo'
                                group by empresa_reparo");                        
        
        $dados['empresa'] = DB::select("SELECT empresa_manutencao as gerencia ,  SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total FROM `backlog_novo_rep` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY empresa_manutencao");
        
        $dados['backlog_gerencia'] = DB::select("SELECT gerencia as gerencia1, empresa_manutencao as gerencia , SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total FROM `backlog_novo_rep` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $empresa_instalacao $gross $gerencia
                                            GROUP BY empresa_manutencao ORDER BY gerencia1"); 

        $dados['backlog_gerencia2'] = DB::select("SELECT resp_2_ott as gerencia1, resp_1_ott as gerencia , SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total FROM `backlog_novo_rep` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $empresa_instalacao $gross $gerencia
                                            GROUP BY resp_2_ott, resp_1_ott ORDER BY gerencia1");  
 
        //dd($dados['backlog_gerencia']);                             
        $dados['backlog_tipo'] = DB::select("SELECT tipo as gerencia , SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total FROM `backlog_novo_rep` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY tipo");
                                        
        $dados['backlog_esteira'] = DB::select("SELECT fx_agend_os as gerencia , SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total FROM `backlog_novo_rep` WHERE
                                            backlog_executivo in ('Backlog Operação','(vazio)')  and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross
                                            GROUP BY fx_agend_os");
                                        
        $dados['backlog_total'] = DB::select("SELECT  
                                    SUM(r_00_24hrs) as b0_a_3_dias, SUM(r_24_48hrs) as b4_a_5_dias, 
                                            SUM(r_48_72hrs) as b6_a_10_dias, SUM(r_72_96hrs) as b11_a_20_dias, sum(r_96hrs) as acima_de_20_dias,
                                            SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE 
                                    backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)' and status_ordem = 'Backlog' $gerencia  $empresa_instalacao $gross");
                                    
                                    
                                    
         $dados['backlog_total_tlp'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)' and status_ordem = 'Backlog' and empresa_manutencao = 'TLP'  $empresa_instalacao");
        
        $dados['backlog_total_tlp_gloss'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and flag_gross = 1 and empresa_manutencao != '(vazio)' and status_ordem = 'Backlog' and empresa_manutencao = 'TLP'  $empresa_instalacao");
        
        $dados['backlog_total_tlg'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)' and status_ordem = 'Backlog' and empresa_manutencao = 'TLG'  $empresa_instalacao");
        
        $dados['backlog_total_tlg_gloss'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)'  and flag_gross = 1 and status_ordem = 'Backlog' and empresa_manutencao = 'TLG'  $empresa_instalacao");
         
         $dados['backlog_total_tls'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)' and status_ordem = 'Backlog' and empresa_manutencao in ('TLS','TLI')  $empresa_instalacao");
        
        $dados['backlog_total_tls_gloss'] = DB::select("SELECT SUM(r_00_24hrs + r_24_48hrs + r_48_72hrs + r_72_96hrs + r_96hrs) as total 
                                    FROM backlog_novo_rep WHERE backlog_executivo  in ('Backlog Operação','(vazio)')  and empresa_manutencao != '(vazio)' and flag_gross = 1 and status_ordem = 'Backlog' and empresa_manutencao in ('TLS','TLI')  $empresa_instalacao");
         
       
         
        $dados['tipo_backlog'] = DB::select("Select backlog_executivo as tipo_backlog
                                FROM `backlog_novo_rep` where backlog_executivo != '(vazio)'
                                group by tipo_backlog");          
        
        //dd($dados);
        return view('backlog_tlp_rep',['dados' => $dados]);
    }


    public function intra_hora_instalacao ()
    {  
        $dados = [];
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao FROM `producao_dia` order by data_cadastro desc limit 1");
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'intra-hora-instalacao',
            'tipo'      => 'instalacao'
        ]);
        
        return view('intrahora/instalacao', ['dados' => $dados]);
    }

    public function intra_hora_reparo ()
    {  
        $dados = [];
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao FROM `producao_dia` order by data_cadastro desc limit 1");
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'intra-hora-reparo',
            'tipo'      => 'reparo'
        ]);
        return view('intrahora/reparo', ['dados' => $dados]);
    }

    public function importing(Request $req)
    {  
         Excel::import(new UsersImport, 'prod_dia.csv');
        dd($req);
        return view('import');
    }
}
