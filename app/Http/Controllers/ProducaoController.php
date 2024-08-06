<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class ProducaoController extends Controller
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
    
        if (!isset($req->status) || $req->status == 'PRESENCAS') {
            $camposF = "
             SUM(REPARO_PT) AS REPARO, 
             SUM(DESCON_PT) AS DESCON, 
             SUM(INST_PT) AS INST, 
             SUM(MUD_END_PT) AS MUD_END, 
             SUM(MUD_TEC_PT) AS MUD_TEC,
             SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT) AS TOTAL
                        ";
        }
        
        if (!isset($req->status) || $req->status == 'DESPACHADO') {
            $camposF = "
             SUM(REPARO_AT) AS REPARO, 
             SUM(DESCON_AT) AS DESCON, 
             SUM(INST_AT) AS INST, 
             SUM(MUD_END_AT) AS MUD_END, 
             SUM(MUD_TEC_AT) AS MUD_TEC,
             SUM(REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT) AS TOTAL
                        ";
        }
      
        if (!isset($req->status) || $req->status == 'PRODUCAO') {
            $camposF = "
             SUM(REPARO_AP) AS REPARO, 
             SUM(DESCON_AP) AS DESCON, 
             SUM(INST_AP) AS INST, 
             SUM(MUD_END_AP) AS MUD_END, 
             SUM(MUD_TEC_AP) AS MUD_TEC,
             SUM(REPARO_AP+DESCON_AP+INST_AP+MUD_END_AP+MUD_TEC_AP) AS TOTAL
             
                        ";
        }

        if (!isset($req->status) || $req->status == 'IMPRODUTIVA') {
            $camposF = "
             SUM(REPARO_AT-REPARO_AP) AS REPARO, 
             SUM(DESCON_AT-DESCON_AP) AS DESCON, 
             SUM(INST_AT-INST_AP) AS INST, 
             SUM(MUD_END_AT-MUD_END_AP) AS MUD_END, 
             SUM(MUD_TEC_AT-MUD_TEC_AP) AS MUD_TEC,
             SUM((REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT)-
             (REPARO_AP+DESCON_AP+INST_AP+MUD_END_AP+MUD_TEC_AP)) AS TOTAL
                        ";
        }

        if (!isset($req->status) || $req->status == 'MED_ATRIBUICAO') {
            $camposF = "
            ROUND(SUM(REPARO_AT)/SUM(REPARO_PT),2) AS REPARO, 
            ROUND(SUM(DESCON_AT)/SUM(DESCON_PT),2) AS DESCON, 
            ROUND(SUM(INST_AT)/SUM(INST_PT),2) AS INST, 
            ROUND(SUM(MUD_END_AT)/SUM(MUD_END_PT),2) AS MUD_END, 
            ROUND(SUM(MUD_TEC_AT)/SUM(MUD_TEC_PT),2) AS MUD_TEC,
            ROUND(SUM(REPARO_AT+ DESCON_AT+ INST_AT+ MUD_END_AT+MUD_TEC_AT)/SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT),2) AS TOTAL
            
                        ";
        }

        if (!isset($req->status) || $req->status == 'MED_PRODUTIVIDADE') {
            $camposF = "
            ROUND(SUM(REPARO_AP)/SUM(REPARO_PT),2) AS REPARO, 
            ROUND(SUM(DESCON_AP)/SUM(DESCON_PT),2) AS DESCON, 
            ROUND(SUM(INST_AP)/SUM(INST_PT),2) AS INST, 
            ROUND(SUM(MUD_END_AP)/SUM(MUD_END_PT),2) AS MUD_END, 
            ROUND(SUM(MUD_TEC_AP)/SUM(MUD_TEC_PT),2) AS MUD_TEC,
            ROUND(SUM(REPARO_AP+ DESCON_AP+ INST_AP+ MUD_END_AP+MUD_TEC_AP)/SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT),2) AS TOTAL
             "; 
        }
        
        if (!isset($req->status) || $req->status == 'EFICIENCIA') {
            $camposF = "
            CONCAT(ROUND(SUM(REPARO_AP)/SUM(REPARO_AT)*100,2),'%') AS REPARO, 
            CONCAT(ROUND(SUM(DESCON_AP)/SUM(DESCON_AT)*100,2),'%') AS DESCON, 
            CONCAT(ROUND(SUM(INST_AP)/SUM(INST_AT)*100,2),'%') AS INST, 
            CONCAT(ROUND(SUM(MUD_END_AP)/SUM(MUD_END_AT)*100,2),'%') AS MUD_END, 
            CONCAT(ROUND(SUM(MUD_TEC_AP)/SUM(MUD_TEC_AT)*100,2),'%') AS MUD_TEC,
            CONCAT(ROUND(SUM(REPARO_AP+ DESCON_AP+ INST_AP+ MUD_END_AP+MUD_TEC_AP)/SUM(REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT)*100,2),'%') AS TOTAL
             ";
        }
        

      
        if (!isset($req->atividade) || $req->atividade == 'TODOS') {
            $campos = "
             SUM(REPARO_PT) AS REPARO_PT, 
             SUM(DESCON_PT) AS DESCON_PT, 
             SUM(INST_PT) AS INST_PT, 
             SUM(MUD_END_PT) AS MUD_END_PT, 
             SUM(MUD_TEC_PT) AS MUD_TEC_PT, 
             SUM(REPARO_AT) AS REPARO_AT, 
             SUM(DESCON_AT) AS DESCON_AT, 
             SUM(INST_AT) AS INST_AT, 
             SUM(MUD_END_AT) AS MUD_END_AT, 
             SUM(MUD_TEC_AT) AS MUD_TEC_AT, 
             SUM(REPARO_AP) AS REPARO_AP, 
             SUM(DESCON_AP) AS DESCON_AP, 
             SUM(INST_AP) AS INST_AP, 
             SUM(MUD_END_AP) AS MUD_END_AP, 
             SUM(MUD_TEC_AP) AS MUD_TEC_AP, 
             SUM(REPARO_AI) AS REPARO_AI, 
             SUM(DESCON_AI) AS DESCON_AI, 
             SUM(INST_AI) AS INST_AI, 
             SUM(MUD_END_AI) AS MUD_END_AI, 
             SUM(MUD_TEC_AI) AS MUD_TEC_AI

            ";
            $filtro = " and TECNOLOGIA != ''";
        } else {
            $campos = "
             SUM(REPARO_PT) AS REPARO_PT, 
             SUM(DESCON_PT) AS DESCON_PT, 
             SUM(INST_PT) AS INST_PT, 
             SUM(MUD_END_PT) AS MUD_END_PT, 
             SUM(MUD_TEC_PT) AS MUD_TEC_PT, 
             SUM(REPARO_AT) AS REPARO_AT, 
             SUM(DESCON_AT) AS DESCON_AT, 
             SUM(INST_AT) AS INST_AT, 
             SUM(MUD_END_AT) AS MUD_END_AT, 
             SUM(MUD_TEC_AT) AS MUD_TEC_AT, 
             SUM(REPARO_AP) AS REPARO_AP, 
             SUM(DESCON_AP) AS DESCON_AP, 
             SUM(INST_AP) AS INST_AP, 
             SUM(MUD_END_AP) AS MUD_END_AP, 
             SUM(MUD_TEC_AP) AS MUD_TEC_AP, 
             SUM(REPARO_AI) AS REPARO_AI, 
             SUM(DESCON_AI) AS DESCON_AI, 
             SUM(INST_AI) AS INST_AI, 
             SUM(MUD_END_AI) AS MUD_END_AI, 
             SUM(MUD_TEC_AI) AS MUD_TEC_AI
            ";
            
        }
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtroTec = '';
        } else {
            $filtroTec = " and TECNOLOGIA = '".$req->tecnologia."'";
        }
 
        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } 
 
        if ($req->filial == 'SP' || $req->filial == 'RJ' || $req->filial == 'FFA') {
            $filtroFilial = " and FILIAL = '".$req->filial."' ";
        } 
        
        if (!isset($req->filial)) {
            $filtroFilial1 = " and FILIAL = 'FFA' ";
        } else {
            $filtroFilial1 = " and FILIAL = '".$req->filial."' ";
        }
        
        if (!isset($req->referencia)) {
            $dataReal = date('m/Y');
            $filtroReferencia = " and REFERENCIA = '".$dataReal."' ";
        } else {
            $filtroReferencia = " and REFERENCIA = '".$req->referencia."' ";
        }
        
        
        
        if ($req->filial == 'TODOS') {
            $filtroFilial1 = " and FILIAL = 'FFA' ";
        } 
 

        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `atribuicao_ffa` 
                                order by data_cadastro desc limit 1");
        
        $dados['visaoMetaInstalacao'] = DB::select("Select * FROM `metas_ffa` where TIPo = 'INSTALACAO' $filtroFilial $filtroTec $filtroReferencia");
        $dados['visaoMetaMudanca'] = DB::select("Select * FROM `metas_ffa` where TIPo = 'MUDANCA' $filtroFilial $filtroTec $filtroReferencia");
        $dados['visaoMetaMudancaTecnologia'] = DB::select("Select * FROM `metas_ffa` where TIPo = 'MUDANCA_TECNOLOGIA' $filtroFilial $filtroTec $filtroReferencia");
        
        $dados['visaoMetaInstalacaoF'] = DB::select("Select sum(META) as META,  sum(REALIZADO) as REALIZADO, sum(PROJECAO) as PROJECAO, sum(GAP) as GAP FROM `metas_ffa` where TIPo = 'INSTALACAO' $filtroFilial $filtroTec $filtroReferencia");
        $dados['visaoMetaMudancaF'] = DB::select("Select sum(META) as META,  sum(REALIZADO) as REALIZADO, sum(PROJECAO) as PROJECAO, sum(GAP) as GAP FROM `metas_ffa` where TIPo = 'MUDANCA' $filtroFilial $filtroTec $filtroReferencia");
        $dados['visaoMetaMudancaTecnologiaF'] = DB::select("Select sum(META) as META,  sum(REALIZADO) as REALIZADO, sum(PROJECAO) as PROJECAO, sum(GAP) as GAP FROM `metas_ffa` where TIPo = 'MUDANCA_TECNOLOGIA' $filtroFilial $filtroTec $filtroReferencia");
        
        
        $dados['visaoMetaDiogo'] = DB::select("SELECT filial as FILIAL, TIPO, sum(REALIZADO) as REALIZADO, SUM(PROJECAO) as PROJETADO, 
                                                SUM(META) as META, SUM(GAP) as GAP, round(sum((GAP)/(META)*100),2) as 'RGAP', SUM(MEDIA_DIA) as MEDIA_DIA, 
                                                SUM(ONTEM) as ONTEM, sum(META_DIA) as META_DIA FROM metas_ffa WHERE TIPO != 'TIPO' $filtroFilial1 $filtroTec $filtroReferencia GROUP BY FILIAL, TIPO");
        
        $dados['referencia'] = DB::select("select REFERENCIA from atribuicao_ffa where REFERENCIA != 'REFERENCIA' group by REFERENCIA ");
        
         $dados['visaoGerenteF'] = DB::select("Select FILIAL, 
                                $camposF
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO'                                 
                                $filtro 
                                $filtroFilial $filtroTec $filtroReferencia
                                GROUP BY  FILIAL ORDER BY FILIAL");
        
        
        $dados['visaoGerente'] = DB::select("Select GERENTE AS FILIAL,
                                $campos
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO'                                 
                                $filtro 
                                $filtroFilial $filtroTec $filtroReferencia
                                GROUP BY  GERENTE ORDER BY FILIAL");
        $dados['visaoFFAF'] = DB::select("Select  
                                $camposF
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro
                                $filtroFilial $filtroTec $filtroReferencia
                                ");
                                
        $dados['visaoFFA'] = DB::select("Select  
                                $campos
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro
                                $filtroFilial $filtroTec $filtroReferencia
                                ");

           $dados['visaoCoordenador'] = DB::select("Select COORDENADOR, FILIAL, 
                                $campos
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro  
                                $filtroFilial $filtroTec $filtroReferencia
                                GROUP BY COORDENADOR, FILIAL ORDER BY FILIAL, COORDENADOR");

        $dados['visaoSupervisor'] = DB::select("Select SUPERVISOR, FILIAL,
                                $campos
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro
                                $filtroFilial $filtroTec $filtroReferencia
                                GROUP BY SUPERVISOR,FILIAL ORDER BY FILIAL, SUPERVISOR");


        $dados['visaoCoordenadorF'] = DB::select("Select COORDENADOR, FILIAL, 
                                $camposF
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro 
                                $filtroFilial  $filtroTec $filtroReferencia
                                GROUP BY COORDENADOR, FILIAL ORDER BY FILIAL, COORDENADOR");

        $dados['visaoSupervisorF'] = DB::select("Select SUPERVISOR, FILIAL,
                                $camposF
                                FROM `atribuicao_ffa` 
                                where TECNICO != 'TECNICO' 
                                $filtro
                                $filtroFilial  $filtroTec $filtroReferencia
                                GROUP BY SUPERVISOR,FILIAL ORDER BY FILIAL, SUPERVISOR");

        //dd($dados);
        return view('producao-consolidada',['dados' => $dados]);
    }


    public function indexTecnico(Request $req)
    {  

        $dados = [];
     
         if ($req->filial != 'TODOS' || !isset($req->filial)) {
            $filtroG = " and FILIAL = '".$req->filial."' ";
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
        
        if (!isset($req->referencia)) {
            $dataReal = date('m/Y');
            $filtroReferencia = " and REFERENCIA = '".$dataReal."' ";
        } else {
            $filtroReferencia = " and REFERENCIA = '".$req->referencia."' ";
        }
        
       
        $dados['referencia'] = DB::select("select REFERENCIA from atribuicao_ffa where REFERENCIA != 'REFERENCIA' group by REFERENCIA ");
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `atribuicao_ffa` 
                                order by data_cadastro desc limit 1");
        $dados['atualizacao'] = DB::select("Select data_cadastro as input
                                FROM `atribuicao_ffa` 
                                order by data_cadastro limit 1");


        $dados['gerente'] = DB::select("Select FILIAL as FILIAL
                                FROM `atribuicao_ffa` where TECNICO != 'TECNICO'
                                group by FILIAL order by FILIAL");
        //dd($dados['gerente']);
        $dados['coordenador'] = DB::select("Select coordenador as coordenador
                                FROM `atribuicao_ffa`  where TECNICO != 'TECNICO'
                                group by coordenador order by coordenador");
                                
        $dados['supervisor'] = DB::select("Select supervisor as supervisor
                                FROM `atribuicao_ffa`  where TECNICO != 'TECNICO'
                                group by supervisor order by supervisor");
        
         if (!isset($req->status) || $req->status == 'PRESENCAS') {
            $camposF = "
             SUM(REPARO_PT) AS REPARO, 
             SUM(DESCON_PT) AS DESCON, 
             SUM(INST_PT) AS INST, 
             SUM(MUD_END_PT) AS MUD_END, 
             SUM(MUD_TEC_PT) AS MUD_TEC,
             SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT) AS TOTAL
                        ";
        }
        
        if (!isset($req->status) || $req->status == 'DESPACHADO') {
            $camposF = "
             SUM(REPARO_AT) AS REPARO, 
             SUM(DESCON_AT) AS DESCON, 
             SUM(INST_AT) AS INST, 
             SUM(MUD_END_AT) AS MUD_END, 
             SUM(MUD_TEC_AT) AS MUD_TEC,
             SUM(REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT) AS TOTAL
                        ";
        }
      
        if (!isset($req->status) || $req->status == 'PRODUCAO') {
            $camposF = "
             SUM(REPARO_AP) AS REPARO, 
             SUM(DESCON_AP) AS DESCON, 
             SUM(INST_AP) AS INST, 
             SUM(MUD_END_AP) AS MUD_END, 
             SUM(MUD_TEC_AP) AS MUD_TEC,
             SUM(REPARO_AP+DESCON_AP+INST_AP+MUD_END_AP+MUD_TEC_AP) AS TOTAL
             
                        ";
        }

        if (!isset($req->status) || $req->status == 'IMPRODUTIVA') {
            $camposF = "
             SUM(REPARO_AT-REPARO_AP) AS REPARO, 
             SUM(DESCON_AT-DESCON_AP) AS DESCON, 
             SUM(INST_AT-INST_AP) AS INST, 
             SUM(MUD_END_AT-MUD_END_AP) AS MUD_END, 
             SUM(MUD_TEC_AT-MUD_TEC_AP) AS MUD_TEC,
             SUM((REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT)-
             (REPARO_AP+DESCON_AP+INST_AP+MUD_END_AP+MUD_TEC_AP)) AS TOTAL
                        ";
        }

        if (!isset($req->status) || $req->status == 'MED_ATRIBUICAO') {
            $camposF = "
            ROUND(SUM(REPARO_AT)/SUM(REPARO_PT),2) AS REPARO, 
            ROUND(SUM(DESCON_AT)/SUM(DESCON_PT),2) AS DESCON, 
            ROUND(SUM(INST_AT)/SUM(INST_PT),2) AS INST, 
            ROUND(SUM(MUD_END_AT)/SUM(MUD_END_PT),2) AS MUD_END, 
            ROUND(SUM(MUD_TEC_AT)/SUM(MUD_TEC_PT),2) AS MUD_TEC,
            ROUND(SUM(REPARO_AT+ DESCON_AT+ INST_AT+ MUD_END_AT+MUD_TEC_AT)/SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT),2) AS TOTAL
            
                        ";
        }

        if (!isset($req->status) || $req->status == 'MED_PRODUTIVIDADE') {
            $camposF = "
            ROUND(SUM(REPARO_AP)/SUM(REPARO_PT),2) AS REPARO, 
            ROUND(SUM(DESCON_AP)/SUM(DESCON_PT),2) AS DESCON, 
            ROUND(SUM(INST_AP)/SUM(INST_PT),2) AS INST, 
            ROUND(SUM(MUD_END_AP)/SUM(MUD_END_PT),2) AS MUD_END, 
            ROUND(SUM(MUD_TEC_AP)/SUM(MUD_TEC_PT),2) AS MUD_TEC,
            ROUND(SUM(REPARO_AP+ DESCON_AP+ INST_AP+ MUD_END_AP+MUD_TEC_AP)/SUM(REPARO_PT+DESCON_PT+INST_PT+MUD_END_PT+MUD_TEC_PT),2) AS TOTAL
             "; 
        }
        
        if (!isset($req->status) || $req->status == 'EFICIENCIA') {
            $camposF = "
            CONCAT(ROUND(SUM(REPARO_AP)/SUM(REPARO_AT)*100,2),'%') AS REPARO, 
            CONCAT(ROUND(SUM(DESCON_AP)/SUM(DESCON_AT)*100,2),'%') AS DESCON, 
            CONCAT(ROUND(SUM(INST_AP)/SUM(INST_AT)*100,2),'%') AS INST, 
            CONCAT(ROUND(SUM(MUD_END_AP)/SUM(MUD_END_AT)*100,2),'%') AS MUD_END, 
            CONCAT(ROUND(SUM(MUD_TEC_AP)/SUM(MUD_TEC_AT)*100,2),'%') AS MUD_TEC,
            CONCAT(ROUND(SUM(REPARO_AP+ DESCON_AP+ INST_AP+ MUD_END_AP+MUD_TEC_AP)/SUM(REPARO_AT+DESCON_AT+INST_AT+MUD_END_AT+MUD_TEC_AT)*100,2),'%') AS TOTAL
             ";
        }
        

          if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtroTec = '';
        } else {
            $filtroTec = " and TECNOLOGIA = '".$req->tecnologia."'";
        }
 
        
        $dados['visaoTecnico'] = DB::select("Select FILIAL,GERENTE, COORDENADOR, SUPERVISOR, TECNICO, 
                                $camposF
                                FROM `atribuicao_ffa` WHERE FILIAL != 'FILIAL'
                                $filtroG 
                                $filtroC
                                $filtroS  $filtroTec $filtroReferencia
                                GROUP BY FILIAL,GERENTE, COORDENADOR, SUPERVISOR, TECNICO");
        
        return view('producao-consolidada-tecnico',['dados' => $dados]);
    }
}
