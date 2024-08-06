<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class IndicadoresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {   
        $dados = [];
        
         $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_consolidada` 
                                order by data_cadastro desc limit 1");
        
        $dados['24H_VISAO_CLIENTE'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = '24H_VISAO_CLIENTE' and SUPERVISOR != 'TOTAL'");
        $dados['T_24H_VISAO_CLIENTE'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = '24H_VISAO_CLIENTE' and SUPERVISOR = 'TOTAL'");
        
        $dados['48H_ANATEL'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = '48H_ANATEL' and SUPERVISOR != 'TOTAL'");
        $dados['T_48H_ANATEL'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = '48H_ANATEL' and SUPERVISOR = 'TOTAL'");
        
        $dados['INST_3_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'INST_3_D_U' and SUPERVISOR != 'TOTAL'");
        $dados['T_INST_3_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'INST_3_D_U' and SUPERVISOR = 'TOTAL'");
        
        $dados['INST_5_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'INST_5_D_U' and SUPERVISOR != 'TOTAL'");
        $dados['T_INST_5_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'INST_5_D_U' and SUPERVISOR = 'TOTAL'");
        
        $dados['M_E_3_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'M_E_3_D_U' and SUPERVISOR != 'TOTAL'");
        $dados['T_M_E_3_D_U'] = DB::select("SELECT * FROM `prazo_consolidado` where INDICADOR = 'M_E_3_D_U' and SUPERVISOR = 'TOTAL'");
        
         if ($req->filial != 'TODOS' || !isset($req->filial)) {
            $filtroFilial = " and FILIAL = '".$req->filial."' ";
        } else {
            $filtroFilial = '';
        } 
        
        if ($req->indice != 'TODOS' || !isset($req->indice)) {
            $filtroIndice = " and INDICE = '".$req->indice."' ";
        } else {
            $filtroIndice = '';
        } 
        
        if ($req->indicadores != 'TODOS' || !isset($req->indicadores)) {
            $filtroIndicadores = " and INDICADORES = '".$req->indicadores."' ";
        } else {
            $filtroIndicadores = '';
        } 
        
        
        
        $dados['indicadores'] = DB::select("SELECT * FROM `indicadores` where indicadores !='' $filtroFilial $filtroIndice ");
        //dd($dados['indicadores']);
        $dados['filial'] = DB::select("SELECT filial as filial FROM `indicadores_contratuais` where FILIAL != 'FILIAL' group by filial");
        $dados['indice'] = DB::select("SELECT indice as indice FROM `indicadores_contratuais` where indice != 'indice' group by indice");
        $dados['ind'] = DB::select("SELECT indicadores as indicadores FROM `indicadores_contratuais` where indicadores != 'indicadores' group by indicadores");
       
       // dd($dados['indicadores']);
        
        return view('indicadores-prazo',['dados' => $dados]);
    }
    
    public function atualizacao ()
    {   
        $dados = [];
        $dados['ATRIBUICAO_GERAL'] = DB::select("SELECT af.data_cadastro as atualizacao FROM atribuicao_ffa af  GROUP BY af.data_cadastro ORDER BY af.data_cadastro LIMIT 1");
        $dados['BONIFICACAO'] = DB::select("SELECT bf.ATUALIZACAO as atualizacao FROM bonificacao bf where CPF !='CPF'  GROUP BY bf.ATUALIZACAO ORDER BY bf.ATUALIZACAO LIMIT 1");
        $dados['FILA_ATENDIMENTO'] = DB::select("SELECT ia.atualizacao as atualizacao FROM importacao_abertas ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['ABERTAS_RJ'] = DB::select("SELECT ia.atualizacao as atualizacao FROM importacao_abertas ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['ABERTAS_SP'] = DB::select("SELECT ia.atualizacao as atualizacao FROM importacao_abertas ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['ATRIBUICAO_RJ'] = DB::select("SELECT ia.atualizacao as atualizacao FROM importacao_abertas ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['ATRIBUICAO_SP'] =  DB::select("SELECT ia.atualizacao as atualizacao FROM importacao_abertas ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['PONTO'] = DB::select("SELECT ia.atualizacao as atualizacao FROM ponto ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['POS'] = DB::select("SELECT ia.atualizacao as atualizacao FROM pos ia GROUP BY ia.atualizacao ORDER BY ia.atualizacao desc LIMIT 1");
        $dados['PRODUCAO_DIA'] = DB::select("SELECT pd.data_cadastro as atualizacao FROM producao_dia pd WHERE pd.data_cadastro != 'data_cadastro' GROUP by data_cadastro ORDER by data_cadastro desc LIMIT 1");
        $dados['RECENTE'] = DB::select("SELECT rc.atualizacao as atualizacao FROM recente rc GROUP by atualizacao DESC LIMIT 1");
        $dados['REPETIDO'] = DB::select("SELECT rp.input as atualizacao FROM repetido rp GROUP by input DESC LIMIT 1");
        $dados['SERVIDOR'] = DB::select("SELECT * FROM servidores order by id desc limit 3");
        

        return view('atualizacao-bases',['dados' => $dados]);
    }
    
    public function sinalServidor ()
    {   
       
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $agora1 = date("Y-m-d H:i:s");
       // DB::insert("INSERT INTO servidores (servidor) VALUES ('Base'");
         DB::table('servidores')->insert(
        [
            'servidor'      => 'Bases',
        ]
      );
        return 'ok';
    }
    
        public function sinalServidorExt ()
    {   
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $agora1 = date("Y-m-d H:i:s");
           DB::table('servidores')->insert(
        [
            'servidor'      => 'Extração',
        ]);
        return 'ok';
    }
    
    
}
