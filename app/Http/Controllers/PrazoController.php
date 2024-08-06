<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrazoController extends Controller
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
    public function prazo_agendamento (Request $req)
    { 
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $filtroData =  " and hc.data = '$hoje'";
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Prazo',
                'tipo'      => 'Agendamentos'
        ]);
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
        
        if ($req->filial != 'TODOS' || !isset($req->filial)) {
            $filtro = " and gerencia = '".$req->filial."' ";
        } else {
            $filtro = '';
        } 
                          
        if ($req->controlador != 'TODOS' || !isset($req->controlador)) {
            $filtroA = " and controlador = '".$req->controlador."' ";
        } else {
            $filtroA = '';
        } 
        
        if ($req->supervisor != 'TODOS' || !isset($req->supervisor)) {
            $filtroC = " and supervisor = '".$req->supervisor."' ";
        } else {
            $filtroC = '';
        }
        
        if ($req->localidade != 'TODOS' || !isset($req->localidade)) {
            $filtroD = " and localidade = '".$req->localidade."' ";
        } else {
            $filtroD = '';
        }
        
        if ($req->time_slot != 'TODOS' || !isset($req->time_slot)) {
            $filtroB = " and time_slot = '".$req->time_slot."' ";
        } else {
            $filtroB = '';
        }
        
                                
        $dados['controlador'] = DB::Select("SELECT controlador as nome FROM painel_agendamento_import where gerencia != 'gerencia' group by controlador");
        $dados['supervisor'] = DB::Select("SELECT supervisor as nome FROM painel_agendamento_import where gerencia != 'gerencia' group by supervisor");
        $dados['localidade'] = DB::Select("SELECT localidade as nome FROM painel_agendamento_import where gerencia != 'gerencia' group by localidade");
        $dados['time_slot'] = DB::Select("SELECT time_slot as nome FROM painel_agendamento_import where gerencia != 'gerencia' group by time_slot");
        
        $dados['informacao'] = DB::Select("SELECT * FROM painel_agendamento_import where gerencia != 'gerencia' $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLS'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLI'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLG'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLP'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' $filtroA  $filtroC $filtroB $filtroD $filtro");
        
        $dados['TLS1'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS' and vencimento_em = 'Menos de 01 hora' ");
        $dados['TLI1'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' and vencimento_em = 'Menos de 01 hora' ");
        $dados['TLG1'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' and vencimento_em = 'Menos de 01 hora' ");
        $dados['TLP1'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' and vencimento_em = 'Menos de 01 hora' ");
        
        $dados['TLS2'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS' and vencimento_em = 'Menos de 02 horas' ");
        $dados['TLI2'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' and vencimento_em = 'Menos de 02 horas' ");
        $dados['TLG2'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' and vencimento_em = 'Menos de 02 horas' ");
        $dados['TLP2'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' and vencimento_em = 'Menos de 02 horas' ");
        
        $dados['TLS3'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS' and vencimento_em = 'Menos de 03 horas' ");
        $dados['TLI3'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' and vencimento_em = 'Menos de 03 horas' ");
        $dados['TLG3'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' and vencimento_em = 'Menos de 03 horas' ");
        $dados['TLP3'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' and vencimento_em = 'Menos de 03 horas' ");
        
        $dados['TLS4'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS' and vencimento_em = 'Menos de 04 horas' ");
        $dados['TLI4'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' and vencimento_em = 'Menos de 04 horas' ");
        $dados['TLG4'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' and vencimento_em = 'Menos de 04 horas' ");
        $dados['TLP4'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' and vencimento_em = 'Menos de 04 horas' ");
        
        $dados['TLS5'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLS' and vencimento_em = 'Menos de 05 horas' ");
        $dados['TLI5'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLI' and vencimento_em = 'Menos de 05 horas' ");
        $dados['TLG5'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLG' and vencimento_em = 'Menos de 05 horas' ");
        $dados['TLP5'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_agendamento_import where empresa_manutencao = 'TLP' and vencimento_em = 'Menos de 05 horas' ");
        
        return view('prazo/agendamento',['dados' => $dados]);
    }

    public function prazo_sla (Request $req)
    { 
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $filtroData =  " and hc.data = '$hoje'";
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Prazo',
                'tipo'      => 'Indicadores'
        ]);
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
        
        if ($req->filial != 'TODOS' || !isset($req->filial)) {
            $filtro = " and gerencia = '".$req->filial."' ";
        } else {
            $filtro = '';
        } 
        
        if ($req->controlador != 'TODOS' || !isset($req->controlador)) {
            $filtroA = " and controlador = '".$req->controlador."' ";
        } else {
            $filtroA = '';
        } 
        
        if ($req->supervisor != 'TODOS' || !isset($req->supervisor)) {
            $filtroC = " and supervisor = '".$req->supervisor."' ";
        } else {
            $filtroC = '';
        }
        
        if ($req->localidade != 'TODOS' || !isset($req->localidade)) {
            $filtroD = " and localidade = '".$req->localidade."' ";
        } else {
            $filtroD = '';
        }
        
        if ($req->vencimento_em != 'TODOS' || !isset($req->vencimento_em)) {
            $filtroB = " and vencimento_em = '".$req->vencimento_em."' ";
        } else {
            $filtroB = '';
        }
        
        
        $dados['localidade'] = DB::Select("SELECT localidade as nome FROM painel_indicador_import where gerencia != 'gerencia' group by localidade");
        $dados['vencimento_em'] = DB::Select("SELECT vencimento_em as nome FROM painel_indicador_import where gerencia != 'gerencia' group by vencimento_em");
        $dados['controlador'] = DB::Select("SELECT controlador as nome FROM painel_indicador_import where gerencia != 'gerencia' group by controlador");
        $dados['supervisor'] = DB::Select("SELECT supervisor as nome FROM painel_indicador_import where gerencia != 'gerencia' group by supervisor");
        $dados['informacao'] = DB::Select("SELECT * FROM painel_indicador_import  where gerencia != 'gerencia'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLS'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_indicador_import where empresa_manutencao = 'TLS'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLI'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_indicador_import where empresa_manutencao = 'TLI'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLG'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_indicador_import where empresa_manutencao = 'TLG'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        $dados['TLP'] = DB::Select("SELECT count(gerencia) as qtd FROM painel_indicador_import where empresa_manutencao = 'TLP'  $filtroA  $filtroC $filtroB $filtroD $filtro");
        
        return view('prazo/sla',['dados' => $dados]);
    }
}
    