<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificacaoController extends Controller
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
    public function flag_completamento_instalacao (Request $req)
    { 
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $filtroData =  " and hc.data = '$hoje'";
        
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Instalacao',
                'tipo'      => 'Flag complemento'
        ]);
        
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_import as data_atualizacao
                                FROM `backlog_novo_v2` where data_import != 'data_import'
                                order by data_import desc limit 1");
       $dados['AtualizacaoMontada'] = [['data_atualizacao' => '2024-02-02 11:01:34']];                          
                                
        if (isset($req->tipo)) {
            if ($req->tipo == 'reparo') {
                  $dados['informacao'] = DB::Select("SELECT hc.supervisor as supervisor, hc.fiscal as fiscal, bn.provedor as provedor, bn.flag_de_complemento as flag_de_complemento, 
                                                        bn.data_toa as data_toa, bn.eta as eta, bn.time_flag_ok as time_flag_ok, bn.tipodaatividade as tipodaatividade, bn.n_ordem as n_ordem 
                                                        FROM backlog_novo_v2  bn
                                                JOIN producao_dia hc ON bn.provedor=hc.nome  
                                                WHERE bn.flag_de_complemento = 'sim' 
                                                AND bn.estado = 'Iniciado' 
                                                AND bn.empresa_manutencao in ('TLI','TLP','TLS','TLG') 
                                                AND bn.tipo_ordem = 'Reparo'
                                                $filtroData
                                                order by hc.id desc
                                                ");
            } 
            
            if ($req->tipo == 'instalacao') {
                $dados['informacao'] = DB::Select("SELECT hc.supervisor as supervisor, hc.fiscal as fiscal, bn.provedor as provedor, bn.flag_de_complemento as flag_de_complemento, 
                                                        bn.data_toa as data_toa, bn.eta as eta, bn.time_flag_ok as time_flag_ok, bn.tipodaatividade as tipodaatividade, bn.n_ordem as n_ordem 
                                                        FROM backlog_novo_v2  bn
                                                JOIN producao_dia hc ON bn.provedor=hc.nome  
                                            WHERE bn.flag_de_complemento = 'sim' 
                                            AND bn.estado = 'Iniciado' 
                                            AND bn.empresa_instalacao in ('TLI','TLP','TLS','TLG') 
                                            AND bn.tipo_ordem = 'Instalação'
                                            $filtroData order by hc.id desc");
            } 
        } else {
            $dados['informacao'] = DB::Select("SELECT hc.supervisor as supervisor, hc.fiscal as fiscal, bn.provedor as provedor, bn.flag_de_complemento as flag_de_complemento, 
                                                        bn.data_toa as data_toa, bn.eta as eta, bn.time_flag_ok as time_flag_ok, bn.tipodaatividade as tipodaatividade, bn.n_ordem as n_ordem 
                                                        FROM backlog_novo_v2  bn
                                                JOIN producao_dia hc ON bn.provedor=hc.nome 
                                            WHERE bn.flag_de_complemento = 'sim' 
                                            AND bn.estado = 'Iniciado' 
                                            AND bn.empresa_instalacao in ('TLI','TLP','TLS','TLG') OR empresa_manutencao in ('TLI','TLP','TLS','TLG') 
                                            AND bn.tipo_ordem IN ('Instalação','Reparo') 
                                            $filtroData order by hc.id desc
                                            ");
        }
        
        $dados['total'] = DB::Select("SELECT COUNT(flag_de_complemento) AS QTD FROM backlog_novo_v2 
                                            WHERE flag_de_complemento = 'sim' 
                                            AND estado = 'Iniciado' 
                                            AND empresa_instalacao in ('TLI','TLP','TLS','TLG') OR empresa_manutencao in ('TLI','TLP','TLS','TLG') 
                                            AND tipo_ordem IN ('Instalação','Reparo')");
        
        $dados['instalacao'] = DB::Select("SELECT COUNT(flag_de_complemento) AS QTD FROM backlog_novo_v2 
                                            WHERE flag_de_complemento = 'sim' 
                                            AND estado = 'Iniciado' 
                                            AND empresa_instalacao in ('TLI','TLP','TLS','TLG') 
                                            AND tipo_ordem = 'Instalação'");
         
         $dados['reparo'] = DB::Select("SELECT COUNT(flag_de_complemento) AS QTD FROM backlog_novo_v2 
                                                WHERE flag_de_complemento = 'sim' 
                                                AND estado = 'Iniciado' 
                                                AND empresa_manutencao in ('TLI','TLP','TLS','TLG') 
                                                AND tipo_ordem = 'Reparo'");
        
        return view('certificacao/index',['dados' => $dados]);
    }

    public function flag_completamento_reparo (Request $req)
    { 
        $dados = [];
        
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Flag complemento'
        ]);
        
        $dados['informacao'] = DB::Select("SELECT * FROM backlog_novo_v2 
                                            WHERE flag_de_complemento = 'sim' 
                                            AND estado = 'Iniciado' 
                                            AND empresa_manutencao in ('TLI','TLP','TLS','TLG') 
                                            AND tipo_ordem = 'Reparo'");
                                            
        return view('certificacao/index',['dados' => $dados]);
    }
}
    