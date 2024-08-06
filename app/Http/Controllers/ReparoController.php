<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReparoController extends Controller
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
        $dados['DataAtualizacao'] = DB::select("Select data from toa where data != 'Data' group by data ORDER by data desc limit 1");
        $ultimaData = $dados['DataAtualizacao'][0]->data;
        $dados['HoraAtualizacao'] = DB::select("Select fim from toa where data = '$ultimaData' group by fim ORDER by fim desc limit 1");
        $ultimoHorario = $dados['HoraAtualizacao'][0]->fim;
        $dados['AtualizacaoMontada'] =  $ultimaData.' '.$ultimoHorario;

        $inicio = date('d/m/Y',  strtotime($req->inicio));
        $fim = date('d/m/Y', strtotime($req->fim));

        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia) ) {
             if (!empty($req->inicio)) {
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim' ");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim' ");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim' ");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim' ");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim' ");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim' ");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim' ");

                /* RECENTE */
                $dados['recbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim' and recente_1 like '%SIM%'");
                $dados['recproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim' and recente_1 like '%SIM%' ");
                $dados['recpendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim' and recente_1 like '%SIM%' ");
                $dados['reccancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim' and recente_1 like '%SIM%' ");
                $dados['recsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim' and recente_1 like '%SIM%' ");
                $dados['recnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim' and recente_1 like '%SIM%' ");
                $dados['reciniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and recente_1 like '%SIM%'");

                /* REPETIDO */
                $dados['repbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['repproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['reppendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['repcancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['repsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['repnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                $dados['repiniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and repetido like '%SIM%'");
                /* RANKINGS*/

                $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' GROUP BY msan, uf ORDER BY qtd desc limit 10");
                
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");
                
                /* RANK QUALIDADE OK */

                $dados['rankingRecenteOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                /* RANK QUALIDADE INF */

                $dados['rankingRecentePendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");


                  return view('reparo',['dados' => $dados]);
             } else {
        
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') ");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída')");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') ");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') ");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') ");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') ");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') ");

                /* RECENTE */
                $dados['recbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and recente_1 like '%SIM%'");
                $dados['recproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and recente_1 like '%SIM%'");
                $dados['recpendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and recente_1 like '%SIM%'");
                $dados['reccancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and recente_1 like '%SIM%' ");
                $dados['recsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and recente_1 like '%SIM%' ");
                $dados['recnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and recente_1 like '%SIM%' ");
                $dados['reciniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and recente_1 like '%SIM%' ");

                /* REPTIDO */
                $dados['repbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and repetido like '%SIM%'");
                $dados['repproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and repetido like '%SIM%'");
                $dados['reppendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and repetido like '%SIM%'");
                $dados['repcancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and repetido like '%SIM%' ");
                $dados['repsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and repetido like '%SIM%'");
                $dados['repnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and repetido like '%SIM%' ");
                $dados['repiniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and repetido like '%SIM%' ");


                  /* RANKING */
                $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM toa WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");
               // dd($dados['rankingTecnicosOk']);
                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' GROUP BY msan, uf ORDER BY qtd desc limit 10");
               
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and razao_nao_executado_3 !='' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");
               
                 /* RANK QUALIDADE OK */

                $dados['rankingRecenteOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !=''and recente_1 like '%SIM%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and repetido like '%SIM%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                /* RANK QUALIDADE INF */

                $dados['rankingRecentePendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and recente_1 like '%SIM%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and repetido like '%SIM%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  return view('reparo',['dados' => $dados]);                
             }
       }
/* ============================================= METALICO ================================================================ */
        if ($req->tecnologia == 'METALICO') {

            if (!empty($req->inicio)) {

                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");

                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'");

                /* RECENTE */
                $dados['recbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'  and recente_1 like '%SIM%'");
                $dados['recproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'  and recente_1 like '%SIM%'");
                $dados['recpendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'  and recente_1 like '%SIM%'");
                $dados['reccancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%'  and recente_1 like '%SIM%'");
                $dados['recsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and recente_1 like '%SIM%'");
                $dados['recnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and recente_1 like '%SIM%'");
                $dados['reciniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and recente_1 like '%SIM%'");

                /* REPETIDO */
                $dados['repbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['repproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['reppendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['repcancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['repsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['repnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%' ");
                $dados['repiniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea not like '%FTTH%' and repetido like '%SIM%'");

                 /* RANKINGS*/

                $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' and microarea not like '%FTTH%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY msan, uf ORDER BY qtd desc limit 10");
                
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' and microarea not like '%FTTH%'  GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  return view('reparo',['dados' => $dados]);
             } else {
    
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea not like '%FTTH%'");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea not like '%FTTH%'");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea not like '%FTTH%'");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea not like '%FTTH%'");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea not like '%FTTH%'");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea not like '%FTTH%'");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea not like '%FTTH%'");

                /* RECENTE */
                $dados['recbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recpendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['reccancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['reciniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea not like '%FTTH%' and recente_1 like '%SIM%'
");

                /* REPETIDA */
                $dados['repbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['reppendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repcancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repiniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea not like '%FTTH%' and repetido like '%SIM%' 
");


                $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%' GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%'GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea not like '%FTTH%' GROUP BY msan, uf ORDER BY qtd desc limit 10");
                
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and razao_nao_executado_3 !='' and microarea not like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                 /* RANK QUALIDADE OK */

                $dados['rankingRecenteOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' and microarea not like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' and microarea not like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                /* RANK QUALIDADE INF */

                $dados['rankingRecentePendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' and microarea not like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' and microarea not like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

               

                  return view('reparo',['dados' => $dados]);                
             }

       }


/* ============================================= GPON ================================================================ */
        if ($req->tecnologia == 'GPON') {

            if (!empty($req->inicio)) {
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%'");

                /* RECENTE */
                $dados['recbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recpendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['reccancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['recnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['reciniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");

                /* REPETIDA */
                $dados['repbacklogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repproducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['reppendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repcancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repsuspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repnaoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['repiniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') and data between '$inicio' and '$fim'  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");

                 /* RANKINGS*/

                $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' and microarea  like '%FTTH%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY msan, uf ORDER BY qtd desc limit 10");
                
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' and microarea  like '%FTTH%'  GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                                 /* RANK QUALIDADE OK */

                $dados['rankingRecenteOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' and microarea  like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' and microarea  like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                /* RANK QUALIDADE INF */

                $dados['rankingRecentePendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim' and recente_1 like '%SIM%' and microarea  like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and data between '$inicio' and '$fim'  and repetido like '%SIM%' and microarea  like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");


                  return view('reparo',['dados' => $dados]);
             } else {
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea  like '%FTTH%'");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea  like '%FTTH%'");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea  like '%FTTH%'");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea  like '%FTTH%'");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea  like '%FTTH%'");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea  like '%FTTH%'");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea  like '%FTTH%'");

                /* RECENTE */
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea  like '%FTTH%' and recente_1 like '%SIM%'
");

                /* REPETIDO */
                $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
                $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado')  and microarea  like '%FTTH%' and repetido like '%SIM%' 
");
      


                   $dados['rankingTecnicosOk'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaOk'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanOk'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' GROUP BY msan, uf ORDER BY qtd desc limit 10");

                $dados['rankingTecnicosPendente'] = DB::select("Select provedor, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%'GROUP BY provedor, uf ORDER BY qtd desc limit 10");

                $dados['rankingMicroAreaPendente'] = DB::select("Select microarea, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' GROUP BY microarea, uf ORDER BY qtd desc limit 10");

                $dados['rankingMsanPendente'] = DB::select("Select msan, COUNT(estado) as qtd, uf FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' GROUP BY msan, uf ORDER BY qtd desc limit 10");
                
                $dados['rankingPendenciamentoPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%' and microarea  like '%FTTH%' and razao_nao_executado_3 !='' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");


                                 /* RANK QUALIDADE OK */

                $dados['rankingRecenteOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and recente_1 like '%SIM%' and microarea  like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaOk'] = DB::select("Select codigo_causa, COUNT(estado) as qtd FROM `toa` WHERE estado = 'Concluída' and tipo_da_atividade like 'Bilhete%'  and codigo_causa !='' and repetido like '%SIM%' and microarea  like '%FTTH%' GROUP BY codigo_causa ORDER BY qtd desc limit 10");

                /* RANK QUALIDADE INF */

                $dados['rankingRecentePendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and recente_1 like '%SIM%' and microarea  like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

                  $dados['rankingRepetidaPendente'] = DB::select("Select razao_nao_executado_3, COUNT(estado) as qtd FROM `toa` WHERE estado = 'pendente' and tipo_da_atividade like 'Bilhete%'  and razao_nao_executado_3 !='' and repetido like '%SIM%' and microarea  like '%FTTH%' GROUP BY razao_nao_executado_3 ORDER BY qtd desc limit 10");

             }
  return view('reparo',['dados' => $dados]);
      } else {

            $dados['backlogProducao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado not in ('Concluída','Cancelada', 'pendente', 'suspenso')  ");
            $dados['producao'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Concluída') ");
            $dados['pendente'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('pendente') ");
            $dados['cancelada'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('cancelada') ");
            $dados['suspenso'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('suspenso') ");
            $dados['naoIniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('Não Iniciado') ");
            $dados['iniciado'] = DB::select("Select count(provedor) as qtd from toa where tipo_da_atividade like 'Bilhete%' and estado in ('iniciado') ");


    



      }
/* ============================================= /GPON ================================================================ */


        return view('reparo',['dados' => $dados]);
    }

    public function online(Request $req)
    {  
        $dados = [];
        
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Producao',
                'tipo'      => 'Reparo'
        ]);
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = '';
        } 
 
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
            $filtro = " and skill = '".$req->tecnologia."' ";
        } 

        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } 
 
        if ($req->filial == 'SP' || $req->filial == 'GO' || $req->filial == 'DF') {
            $filtroFilial = " and filial = '".$req->filial."' ";
        } 

                
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
        
        $ultimaAtualizacao = date('Y-m-d H:i', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
        //$ultimaAtualizacao = '2023-09-27';
        //$dados['AtualizacaoMontada'] = [['data_atualizacao' => '2024-02-02 11:01:34']]; 
        
        if ($req->tecnologia == 'FTTH') {
            //dd('aqui');
                            $campos =  'sum(presenca_rep_h) as presenca, 
                                sum(meta_rep) as meta,
                                round(sum(abertas_h),0) as abertas,
                                round(sum(ritmo_h),0) as ritmo,
                                 round(sum(ritmo_h)/sum(abertas_h),2) as fila,
                                sum(hc_rep) as hc,
                                sum(realizado_rep_h) as realizado,
                                sum(rep_h_cancelada) as cancelada,
                                sum(realizado_rep_h-(presenca_rep_h*4)) as gap,
                                sum(presenca_rep_h*4) as capacidade,
                                sum(pendente_rep_h) as pendente,
                                100-round(SUM(pendente_rep_h)/(sum(pendente_rep_h)+SUM(realizado_rep_h)),2)*100 as eficiencia,
                                round(sum(realizado_rep_h)/sum(presenca_rep_h),2) as produtividade,
                                sum(iniciado_rep_h) as iniciado,
                                sum(nao_iniciado_rep_h) as nao_iniciado,
                                sum(sem_atividade_rep) as sem_atividade,
                                sum(ocioso_rep) as ocioso,
                                sum(zerado_ok_rep) as zerado_ok,
                                sum(producao_01_rep) as producao_01,
                                sum(suspenso_rep_h) as suspenso'
                                ;
                                
        }
        
        if ($req->tecnologia == 'FTTC') {
           // dd('aqui');
                            $campos =   'sum(presenca_rep_c) as presenca, 
                                sum(meta_rep) as meta, 
                                round(sum(abertas_c),0) as abertas,
                                round(sum(ritmo_c),0) as ritmo,
                                round(sum(ritmo_c)/sum(abertas_c),2) as fila,
                                sum(hc_rep) as hc,
                                sum(realizado_rep_c) as realizado,
                                sum(rep_c_cancelada) as cancelada,
                                sum(realizado_rep_c-(presenca_rep_c*4)) as gap,
                                sum(presenca_rep_c*4) as capacidade,
                                sum(pendente_rep_c) as pendente,
                                100-round(SUM(pendente_rep_c)/(sum(pendente_rep_c)+SUM(realizado_rep_c)),2)*100 as eficiencia,
                                round(sum(realizado_rep_c)/sum(presenca_rep_c),2) as produtividade,
                                sum(iniciado_rep_c) as iniciado,
                                sum(nao_iniciado_rep_c) as nao_iniciado,
                                sum(sem_atividade_rep) as sem_atividade,
                                sum(ocioso_rep) as ocioso,
                                sum(zerado_ok_rep) as zerado_ok,
                                sum(producao_01_rep) as producao_01,
                                sum(suspenso_rep_c) as suspenso';
                                
        }   
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            
            $campos = 'sum(presenca_rep_h+presenca_rep_c) as presenca, 
                                round(sum(abertas_c + abertas_h),0) as abertas,
                                round(sum(ritmo_c + ritmo_h),0) as ritmo,
                                round(sum((ritmo_c + ritmo_h)/(abertas_c + abertas_h)),2) as fila,
                                sum((presenca_rep_h+presenca_rep_c)) as meta, 
                                sum(hc_rep) as hc,
                                sum(realizado_rep_c+realizado_rep_h) as realizado,
                                sum(rep_c_cancelada+rep_h_cancelada) as cancelada,
                                sum((realizado_rep_c+realizado_rep_h)-((presenca_rep_h+presenca_rep_c)*4)) as gap,
                                sum((presenca_rep_c+presenca_rep_h)*4) as capacidade,
                                sum(pendente_rep_c+pendente_rep_h) as pendente,
                                100-round(SUM(pendente_rep_c+pendente_rep_h)/(sum(pendente_rep_c+pendente_rep_h)+SUM(realizado_rep_c+realizado_rep_h)),2)*100 as eficiencia,
                                round(sum(realizado_rep_c+realizado_rep_h)/sum(presenca_rep_c+presenca_rep_h),2) as produtividade,
                                sum(iniciado_rep_c+iniciado_rep_h) as iniciado,
                                sum(nao_iniciado_rep_c+nao_iniciado_rep_h) as nao_iniciado,
                                sum(sem_atividade_rep) as sem_atividade,
                                sum(ocioso_rep) as ocioso,
                                sum(zerado_ok_rep) as zerado_ok,
                                sum(producao_01_rep) as producao_01,
                                sum(suspenso_rep_c+suspenso_rep_h) as suspenso';
            
            
        }
        
            if ($req->tipo == 'ATIV. ESCRITORIO') {
            $campos = "
            sum(presenca_escritorio_tec) as presenca, 
                                round(sum(abertas_c + abertas_h),0) as abertas,
                                round(sum(ritmo_c + ritmo_h),0) as ritmo,
                                round(sum(abertas_c + abertas_h)/sum(ritmo_c + ritmo_h),2) as fila,
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
                                sum(suspenso_escritorio_tec) as suspenso
            ";
            
        }
        
        if ($req->tipo == 'PRO ATIVO' && $req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            
            $campos = 'sum(presenca_ativo_h+presenca_ativo_c) as presenca, 
                                round(sum(abertas_c + abertas_h),0) as abertas,
                                round(sum(ritmo_c + ritmo_h),0) as ritmo,
                                round(sum((ritmo_c + ritmo_h)/(abertas_c + abertas_h)),2) as fila,
                                sum((presenca_ativo_h+presenca_ativo_c)) as meta, 
                                sum(hc_rep) as hc,
                                sum(realizado_ativo_c+realizado_ativo_h) as realizado,
                                0 as cancelada,
                                sum((realizado_ativo_c+realizado_ativo_h)-((presenca_ativo_h+presenca_ativo_c)*4)) as gap,
                                sum((presenca_ativo_c+presenca_ativo_h)*4) as capacidade,
                                sum(pendente_ativo_c+pendente_ativo_h) as pendente,
                                100-round(SUM(pendente_ativo_c+pendente_ativo_h)/(sum(pendente_ativo_c+pendente_ativo_h)+SUM(realizado_ativo_c+realizado_ativo_h)),2)*100 as eficiencia,
                                round(sum(realizado_ativo_c+realizado_ativo_h)/sum(presenca_ativo_c+presenca_ativo_h),2) as produtividade,
                                sum(iniciado_ativo_c+iniciado_ativo_h) as iniciado,
                                sum(nao_iniciado_ativo_c+nao_iniciado_ativo_h) as nao_iniciado,
                                sum(sem_atividade_ativo) as sem_atividade,
                                sum(ocioso_ativo) as ocioso,
                                sum(zerado_ok_ativo) as zerado_ok,
                                sum(producao_01_ativo) as producao_01,
                                sum(suspenso_ativo_c+suspenso_ativo_h) as suspenso
                                ';
            
            
        }
        
        
        if ($req->tipo == 'PRO ATIVO' && $req->tecnologia == 'FTTH') {
            
        
            $campos = 'sum(presenca_ativo_h) as presenca, 
                                round(sum(abertas_h),0) as abertas,
                                round(sum(ritmo_h),0) as ritmo,
                                round(sum((ritmo_h)/(abertas_h)),2) as fila,
                                sum((presenca_ativo_h)) as meta, 
                                sum(hc_rep) as hc,
                                sum(realizado_ativo_h) as realizado,
                                0 as cancelada,
                                sum((realizado_ativo_h)-((presenca_ativo_h)*4)) as gap,
                                sum((presenca_ativo_h)*4) as capacidade,
                                sum(pendente_ativo_h) as pendente,
                                100-round(SUM(pendente_ativo_h)/(sum(pendente_ativo_h)+SUM(realizado_ativo_h)),2)*100 as eficiencia,
                                round(sum(realizado_ativo_h)/sum(presenca_ativo_h),2) as produtividade,
                                sum(iniciado_ativo_h) as iniciado,
                                sum(nao_iniciado_ativo_h) as nao_iniciado,
                                sum(sem_atividade_ativo) as sem_atividade,
                                sum(ocioso_ativo) as ocioso,
                                sum(zerado_ok_ativo) as zerado_ok,
                                sum(producao_01_ativo) as producao_01,
                                sum(suspenso_ativo_h) as suspenso
                                ';
            
        }
        

        
        
        if ($req->tipo == 'PRO ATIVO' && $req->tecnologia == 'FTTC') {
            
            $campos = 'sum(presenca_ativo_c) as presenca, 
                                round(sum(abertas_c),0) as abertas,
                                round(sum(ritmo_c),0) as ritmo,
                                round(sum((ritmo_c)/(abertas_c)),2) as fila,
                                sum((presenca_ativo_c)) as meta, 
                                sum(hc_rep) as hc,
                                sum(realizado_ativo_c) as realizado,
                                0 as cancelada,
                                sum((realizado_ativo_c)-((presenca_ativo_c)*4)) as gap,
                                sum((presenca_ativo_c)*4) as capacidade,
                                sum(pendente_ativo_c) as pendente,
                                100-round(SUM(pendente_ativo_c)/(sum(pendente_ativo_c)+SUM(realizado_ativo_c)),2)*100 as eficiencia,
                                round(sum(realizado_ativo_c)/sum(presenca_ativo_c),2) as produtividade,
                                sum(iniciado_ativo_c) as iniciado,
                                sum(nao_iniciado_ativo_c) as nao_iniciado,
                                sum(sem_atividade_ativo) as sem_atividade,
                                sum(ocioso_ativo) as ocioso,
                                sum(zerado_ok_ativo) as zerado_ok,
                                sum(producao_01_ativo) as producao_01,
                                sum(suspenso_ativo_c) as suspenso
                                
                                ';
            
        }
        


                
          if ($req->tipo == 'ALMOCO') {
            $campos = "
            sum(presenca_almoco_tec) as presenca, 
                                round(sum(abertas_c + abertas_h),0) as abertas,
                                round(sum(ritmo_c + ritmo_h),0) as ritmo,
                                round(sum(abertas_c + abertas_h)/sum(ritmo_c + ritmo_h),2) as fila,
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
                                sum(suspenso_almoco_tec) as suspenso
                                
            ";
            
        }
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $ultimaAtual = date('H', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
            
        } else {
            $filtroData =  " and data = '$hoje' and hora = '$ultimaAtual'";
        }
        
        
        
        $dados['visaoGerente'] = DB::select("Select gerente, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != ''  $filtroData   and data_cadastro like '".$ultimaAtualizacao."%'
                                $filtroFilial and  (presenca_rep_h = 1 or  presenca_rep_c = 1)
                                GROUP BY gerente, filial ORDER BY filial, gerente");
        
        
        $dados['visaoFFA'] = DB::select("Select  
                                $campos
                                FROM `producao_dia` 
                                where gerente != ''   and data_cadastro like '".$ultimaAtualizacao."%'
                                $filtroFilial  and (presenca_rep_h = 1 or  presenca_rep_c = 1) $filtroData
                                ");

      

        $dados['visaoCoordenador'] = DB::select("Select coordenador, filial, 
                                $campos
                                FROM `producao_dia` 
                                where  gerente != ''  $filtroData  and data_cadastro like '".$ultimaAtualizacao."%'
                                $filtroFilial  and (presenca_rep_h != 0 or  presenca_rep_c != 0 or realizado_rep_h != 0 or realizado_rep_c != 0)
                                GROUP BY coordenador, filial ORDER BY filial, coordenador");

 
      
        $dados['visaoSupervisor'] = DB::select("Select supervisor, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != ''   $filtroData   and data_cadastro like '".$ultimaAtualizacao."%'
                                $filtroFilial  and (presenca_rep_h != 0 or  presenca_rep_c != 0 or realizado_rep_h != 0 or realizado_rep_c != 0)
                                GROUP BY supervisor,filial ORDER BY filial, supervisor");
        
        $dados['visaoFiscal'] = DB::select("Select fiscal, filial,
                                $campos
                                FROM `producao_dia` 
                                where gerente != ''   $filtroData  and data_cadastro like '".$ultimaAtualizacao."%'
                                $filtroFilial  and (presenca_rep_h != 0 or  presenca_rep_c != 0 or realizado_rep_h != 0 or realizado_rep_c != 0)
                                GROUP BY fiscal,filial ORDER BY filial, fiscal");


        return view('reparoonline',['dados' => $dados]);
    }

    public function onlineTecnico(Request $req)
    {  
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $dados = [];
        
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Producao',
                'tipo'      => 'Instalacao tecnico'
        ]);
        
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " where skill != ''";
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
        
        if ($req->presenca != 'TODOS' || !isset($req->presenca)) {
            $filtroP = " and presenca_reparo = '".$req->presenca."'";
        } else {
            $filtroP = '';
        }
       
         
        if (isset($req->tipo) && $req->tipo == 'sem_atividade') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Tecnicos sem atividades'
            ]);
            $filtroSA = " and sem_atividade_rep = '1'";
        } else {
            $filtroSA = '';
        }
        if (isset($req->tipo ) && $req->tipo == 'ocioso') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Tecnicos ociosos'
            ]);
            $filtroSO = " and ocioso_rep = '1'";
        } else {
            $filtroSO = '';
        }
        if (isset($req->tipo)  && $req->tipo == 'zerado_ok') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Tecnicos zerados'
            ]);
            $filtroSZ = " and zerado_ok_rep = '1'";
        } else {
            $filtroSZ = '';
        }
        if (isset($req->tipo)  && $req->tipo == 'producao_01') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Tecnicos 1 producao'
            ]);
            $filtroSP = " and producao_01_rep = '1'";
        } else {
            $filtroSP = '';
        }
        
        if (isset($req->tipo)  && $req->tipo == 'ba_longo') {
            $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Reparo',
                'tipo'      => 'Tecnicos ba longo'
            ]);
            $filtroB = " and flag_ba_longo = '1'";
        } else {
            $filtroB = '';
        }
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
                                
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $ultimaAtual = date('H', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
            
        } else {
            $filtroData =  " and data = '$hoje' and hora = '$ultimaAtual'";
        }
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia` 
                                order by data_cadastro desc limit 1");
                                
        $ultimaAtualizacao = date('Y-m-d H:i', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));
        
        $dados['gerente'] = DB::select("Select gerente as gerente
                                FROM `producao_dia`  where data = '$hoje'  and data_cadastro like '".$ultimaAtualizacao."%'
                                group by gerente order by gerente");
    
        $dados['coordenador'] = DB::select("Select coordenador as coordenador
                                FROM `producao_dia`  where data = '$hoje'  and data_cadastro like '".$ultimaAtualizacao."%'
                                group by coordenador order by coordenador");
                                
        $dados['supervisor'] = DB::select("Select supervisor as supervisor
                                FROM `producao_dia`  where data = '$hoje'  and data_cadastro like '".$ultimaAtualizacao."%'
                                group by supervisor order by supervisor");


        $dados['visaoTecnico'] = DB::select("Select gerente, coordenador, supervisor, nome, skill, 
                                sum(presenca_rep_h+presenca_rep_c) as presenca, 
                                sum((meta_rep)) as meta, 
                                sum(hc) as hc,
                                sum(realizado_rep_c+realizado_rep_h) as realizado,
                                sum((realizado_rep_c+realizado_rep_h)-((presenca_rep_h+presenca_rep_c)*4)) as gap,
                                sum((presenca_rep_c+presenca_rep_h)*4) as capacidade,
                                sum(pendente_rep_c+pendente_rep_h) as pendente,
                                100-round(SUM(pendente_rep_c+pendente_rep_h)/(sum(pendente_rep_c+pendente_rep_h)+SUM(realizado_rep_c+realizado_rep_h)),2)*100 as eficiencia,
                                round(sum(realizado_rep_c+realizado_rep_h)/sum(presenca_rep_c+presenca_rep_h),2) as produtividade,
                                sum(iniciado_rep_c+iniciado_rep_h) as iniciado,
                                sum(nao_iniciado_rep_c+nao_iniciado_rep_h) as nao_iniciado,
                                sum(sem_atividade_rep) as sem_atividade,
                                sum(ocioso_rep) as ocioso,
                                sum(zerado_ok_rep) as zerado_ok,
                                sum(producao_01_rep) as producao_01,
                                sum(suspenso_rep_c+suspenso_rep_h) as suspenso,
                                sum(flag_ba_longo) as flag_ba_longo,
                                ba_longo,
                                data,
                                n_ordem_ba_longo,
                                tipo_ordem_ba_longo,
                                tempo_atividade
                                FROM `producao_dia`  where id != '' and (presenca_reparo > 0)
                                $filtroData 
                                $filtroG 
                                $filtroC
                                $filtroS     
                                $filtroP 
                                $filtroSA
                                $filtroSO
                                $filtroSZ
                                $filtroSP
                                $filtroB  and data_cadastro  like '".$ultimaAtualizacao."%'
                                GROUP BY nome, skill, gerente, coordenador, supervisor");

        return view('reparoonlinetecnico',['dados' => $dados]);
    }
    
    public function abertas(Request $req) 
    {
        $dados = [];
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " and ACESSO in ('GPON','METALICO')";
        } 
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
        } else {
            $filtroData =  " and data = '$hoje'";
        }
 
        if ($req->tecnologia == 'GPON' || $req->tecnologia == 'METALICO') {
            $filtro = " and ACESSO = '".$req->tecnologia."' ";
        } 
        
        /* AREA DE RISCO */
        $dados['area_de_risco'] = DB::select("SELECT * FROM `importacao_abertas` where RESPONSAVEL = 'AREA DE RISCO' AND EMPRESA = 'EZENTIS' AND REGIONAL = 'SAO PAULO LESTE' $filtroData");
        $dados['migracao'] = DB::select("SELECT * FROM `importacao_abertas` where RESPONSAVEL = 'MIGRACAO FTTC PARA FTTH' AND EMPRESA = 'EZENTIS' AND REGIONAL = 'SAO PAULO LESTE' $filtroData");
        $dados['preventiva_voip'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' AND TIPO_PROATIVO = 'VOIP' AND EMPRESA = 'EZENTIS' $filtroData AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['preventiva_bl'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' AND TIPO_PROATIVO != 'VOIP' AND EMPRESA = 'EZENTIS' $filtroData AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['preventiva'] =  $dados['preventiva_voip'][0]->qtd + $dados['preventiva_bl'][0]->qtd;
        $dataInicio = date('d/m/Y 00:00:00');  
        $dataFim = date('d/m/Y 23:59:59');
        $dt = date('d/m/Y');
        //dd($dt);
        /* ENTRANTE TOA   '6/8/2021' */
        $dados['abertas_toa'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND DT_CREATE_TOA = '$dt' AND EMPRESA in ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        //dd($dados['abertas_toa']);
        /* TIME LIFE */
        $dados['ate20h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 20H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['ate24h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 24H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['ate48h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 48H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['ate72h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 72H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['ate96h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 96H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
        $dados['maior96h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData 
        AND FAIXA_ENTRANTE = 'MAIOR 96H' AND EMPRESA in  ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE'");
         
        /* BACKLOG */
        $dados['dentro'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where CLASSIFICACAO_24H_CRIACAO_WFM = 'DENTRO' $filtroData
        AND V_ATIVIDADE = 'DEFEITO' AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        $dados['fora'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where CLASSIFICACAO_24H_CRIACAO_WFM = 'FORA' $filtroData AND V_ATIVIDADE = 'DEFEITO'   AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        $dados['total'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') $filtroData AND V_ATIVIDADE = 'DEFEITO'   $filtro  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')");
        
        $dados['enc_cop'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where
         V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'ENCERRADO' $filtroData AND RESPONSAVEL = 'COP' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        
        $dados['enc_massiva'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where  RESPONSAVEL = 'MASSIVA' $filtroData
        AND V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        
        $dados['enc_tec'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where   RESPONSAVEL = 'CIDADE' $filtroData
        AND V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        
        $dados['enc_proativo'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' $filtroData
         AND REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        
        $dados['enc_total'] =   $dados['enc_cop'][0]->qtd + $dados['enc_massiva'][0]->qtd + $dados['enc_tec'][0]->qtd + $dados['enc_proativo'][0]->qtd; 

        $dados['faixas'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        
        $dados['faixasTotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS', 'FFA') $filtro GROUP BY REGIONAL");
        
        $dados['faixasA'] = DB::select("SELECT dp.coordenador as COORDENADOR, dp.supervisao as SUPERVISAO, dp.supervisor as SUPERVISOR, ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE dp.coordenador = 'ALEXANDRE CRUZ' AND ia.REGIONAL = 'SAO PAULO LESTE' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY dp.coordenador, dp.supervisao, dp.supervisor");
        
        $dados['faixasR'] = DB::select("SELECT dp.coordenador as COORDENADOR, dp.supervisao as SUPERVISAO, ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE dp.coordenador = 'RUDILEI DOS SANTOS' AND ia.REGIONAL = 'SAO PAULO LESTE' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY dp.coordenador, dp.supervisao");
        
        $dados['rankingMsan'] = DB::select("SELECT AREA, MSAN, COUNT(MSAN) AS QTD FROM importacao_abertas WHERE V_ATIVIDADE = 'DEFEITO' AND SITUACAO = 'CAMPO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY MSAN, AREA ORDER BY QTD DESC LIMIT 10");
        $dados['rankingHora'] = DB::select("SELECT HORA_CRIACAO, COUNT(AREA) AS QTD FROM `importacao_abertas` WHERE V_ATIVIDADE = 'DEFEITO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY HORA_CRIACAO ORDER BY HORA_CRIACAO ASC");
        $dados['rankingArea'] = DB::select("SELECT MICRO_AREA as AREA, COUNT(AREA) AS QTD FROM `importacao_abertas` 
        WHERE V_ATIVIDADE = 'DEFEITO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY MICRO_AREA ORDER BY QTD DESC  LIMIT 10");
        /*
        $dados['rankingArea'] = DB::select("SELECT ia.AREA AS AREA, dp.coordenador AS COORDENADOR, COUNT(ia.AREA) AS QTD
                                            FROM importacao_abertas ia
                                            INNER JOIN de_para_supervisao dp ON dp.bairro = ia.AREA
                                            WHERE  V_ATIVIDADE = 'DEFEITO' $filtroData $filtro AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'SAO PAULO LESTE' GROUP BY AREA, COORDENADOR ORDER BY QTD DESC LIMIT 10");
        
        */
        //dd($dados['faixasA']);
        /*
        $dados['faixasA'] = DB::select("SELECT AREA, REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('FFA','EZENTIS') $filtro GROUP BY AREA");
        */
        $dados['faixasB'] = DB::select("SELECT AREA, REGIONAL, EMPRESA, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS') $filtro GROUP BY AREA, EMPRESA");
       
       $dados['faixasATotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('FFA','EZENTIS') $filtro GROUP BY REGIONAL");
        
        
        $dados['faixasBTotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS') $filtro GROUP BY REGIONAL");
    
    
        $dados['faixasCTotal'] = DB::select("SELECT ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE dp.coordenador = 'ALEXANDRE CRUZ' AND ia.REGIONAL = 'SAO PAULO LESTE' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY ia.REGIONAL");
        
        $dados['faixasRTotal'] = DB::select("SELECT ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE dp.coordenador in ('RUDILEI DOS SANTOS','ALEXANDRE CRUZ') AND ia.REGIONAL = 'SAO PAULO LESTE' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY ia.REGIONAL");
        $hoje1 = date('d/m/Y');
        $dados['atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'ATRIBUIDO'");
        
        $dados['n_atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
        $dados['n_atribuido_cop'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'COP' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ar'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AREA DE RISCO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cidade'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'CIDADE' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_massiva'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'MASSIVA' GROUP BY RESPONSAVEL");
        
        
        
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `importacao_abertas` GROUP BY atualizacao order by atualizacao desc limit 1");
   
        return view('abertas',['dados' => $dados]);


    }
    
    public function abertasRj(Request $req) 
    {
          $dados = [];
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " and ACESSO in ('GPON','METALICO')";
        } 
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        if (!empty($req->inicio) || !empty($req->fim)) {
            $filtroData = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."' ";
        } else {
            $filtroData =  " and data = '$hoje'";
        }
 
        if ($req->tecnologia == 'GPON' || $req->tecnologia == 'METALICO') {
            $filtro = " and ACESSO = '".$req->tecnologia."' ";
        } else {
            $filtro = '';
        }
        
        /* AREA DE RISCO */
        $dados['area_de_risco'] = DB::select("SELECT * FROM `importacao_abertas` where RESPONSAVEL = 'AREA DE RISCO' AND EMPRESA IN ('EZENTIS','FFA') AND RESPONSAVEL != 'AREA DE RISCO' AND REGIONAL = 'RIO DE JANEIRO' $filtroData ");
        $dados['migracao'] = DB::select("SELECT * FROM `importacao_abertas` where RESPONSAVEL = 'MIGRACAO FTTC PARA FTTH' AND EMPRESA = 'EZENTIS' AND REGIONAL = 'RIO DE JANEIRO' $filtroData AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['preventiva_voip'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' AND TIPO_PROATIVO = 'VOIP' AND EMPRESA = 'EZENTIS' $filtroData AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['preventiva_bl'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' AND TIPO_PROATIVO != 'VOIP' AND EMPRESA = 'EZENTIS' $filtroData AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['preventiva'] =  $dados['preventiva_voip'][0]->qtd + $dados['preventiva_bl'][0]->qtd;
        $dataInicio = date('d/m/Y 00:00:00');  
        $dataFim = date('d/m/Y 23:59:59');
        $dt = date('d/m/Y');
        //dd($dt);
        /* ENTRANTE TOA   '6/8/2021' */
        $dados['abertas_toa'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND DT_CREATE_TOA = '$dt' AND EMPRESA in ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        //dd($dados['abertas_toa']);
        /* TIME LIFE */
        $dados['ate20h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 20H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['ate24h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 24H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['ate48h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 48H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['ate72h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 72H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['ate96h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData AND FAIXA_ENTRANTE = 'ATE 96H' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['maior96h'] = DB::select("SELECT * FROM `importacao_abertas` where V_ATIVIDADE = 'DEFEITO' $filtroData 
        AND FAIXA_ENTRANTE = 'MAIOR 96H' AND EMPRESA in  ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO'");
         
        /* BACKLOG */
        $dados['dentro'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where CLASSIFICACAO_24H_CRIACAO_WFM = 'DENTRO' $filtroData
        AND V_ATIVIDADE = 'DEFEITO' AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro AND RESPONSAVEL != 'AREA DE RISCO'");
        $dados['fora'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where CLASSIFICACAO_24H_CRIACAO_WFM = 'FORA' $filtroData AND V_ATIVIDADE = 'DEFEITO'  AND RESPONSAVEL != 'AREA DE RISCO'  AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro");
        $dados['total'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') $filtroData AND V_ATIVIDADE = 'DEFEITO'   $filtro  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['enc_cop'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where
         V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'ENCERRADO' $filtroData AND RESPONSAVEL = 'COP' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro  AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['enc_massiva'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where  RESPONSAVEL = 'MASSIVA' $filtroData
        AND V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro  AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['enc_tec'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where   RESPONSAVEL = 'CIDADE' $filtroData
        AND V_ATIVIDADE != 'PREVENTIVA'   AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['enc_proativo'] = DB::select("SELECT count(regional) as qtd FROM `importacao_abertas` where V_ATIVIDADE = 'PREVENTIVA' $filtroData
         AND REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'ENCERRADO' AND EMPRESA IN ('EZENTIS', 'FFA') $filtro AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['enc_total'] =   $dados['enc_cop'][0]->qtd + $dados['enc_massiva'][0]->qtd + $dados['enc_tec'][0]->qtd + $dados['enc_proativo'][0]->qtd; 

        $dados['faixas'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS', 'FFA') $filtro AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['faixasTotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS', 'FFA') $filtro GROUP BY REGIONAL AND RESPONSAVEL != 'AREA DE RISCO'");
        
        $dados['faixasA'] = DB::select("SELECT dp.coordenador as COORDENADOR, dp.supervisao as SUPERVISAO, ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE  ia.RESPONSAVEL != 'AREA DE RISCO' and dp.coordenador = 'RODRIGO ABREU' AND ia.REGIONAL = 'RIO DE JANEIRO' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY dp.coordenador, dp.supervisao");
        
        $dados['faixasR'] = DB::select("SELECT dp.coordenador as COORDENADOR, dp.supervisao as SUPERVISAO, ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        INNER JOIN de_para_supervisao dp ON ia.AREA = dp.bairro
        WHERE dp.coordenador = 'RUDILEI DOS SANTOS' AND ia.RESPONSAVEL != 'AREA DE RISCO' AND ia.REGIONAL = 'RIO DE JANEIRO' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY dp.coordenador, dp.supervisao");
        
        $dados['rankingMsan'] = DB::select("SELECT AREA, MSAN, COUNT(MSAN) AS QTD FROM importacao_abertas WHERE V_ATIVIDADE = 'DEFEITO' AND SITUACAO = 'CAMPO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY MSAN, AREA ORDER BY QTD DESC LIMIT 10");
        $dados['rankingHora'] = DB::select("SELECT HORA_CRIACAO, COUNT(AREA) AS QTD FROM `importacao_abertas` WHERE V_ATIVIDADE = 'DEFEITO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND RESPONSAVEL != 'AREA DE RISCO' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY HORA_CRIACAO ORDER BY HORA_CRIACAO ASC");
        $dados['rankingArea'] = DB::select("SELECT MICRO_AREA as AREA, COUNT(AREA) AS QTD FROM `importacao_abertas` 
        WHERE V_ATIVIDADE = 'DEFEITO'  AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' AND DT_CREATE_TOA = '$hoje' $filtro GROUP BY MICRO_AREA ORDER BY QTD DESC  LIMIT 10");
    /*    
        $dados['rankingArea'] = DB::select("SELECT ia.AREA AS AREA, dp.coordenador AS COORDENADOR, COUNT(ia.AREA) AS QTD
                                            FROM importacao_abertas ia
                                            INNER JOIN de_para_supervisao dp ON dp.bairro = ia.AREA
                                            WHERE  V_ATIVIDADE = 'DEFEITO' $filtroData $filtro AND RESPONSAVEL != 'AREA DE RISCO' AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS','FFA') AND REGIONAL = 'RIO DE JANEIRO' GROUP BY AREA, COORDENADOR ORDER BY QTD DESC LIMIT 10");
        */
        
        //dd($dados['faixasA']);
        /*
        $dados['faixasA'] = DB::select("SELECT AREA, REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'SAO PAULO LESTE' AND SITUACAO = 'CAMPO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('FFA','EZENTIS') $filtro GROUP BY AREA");
        */
        $dados['faixasB'] = DB::select("SELECT AREA, REGIONAL, EMPRESA, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND RESPONSAVEL != 'AREA DE RISCO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS') $filtro GROUP BY AREA, EMPRESA");
       
       $dados['faixasATotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND RESPONSAVEL != 'AREA DE RISCO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('FFA','EZENTIS') $filtro GROUP BY REGIONAL");
        
        
        $dados['faixasBTotal'] = DB::select("SELECT REGIONAL, SUM(ATE_20H) AS A, SUM(ATE_24H) AS B, SUM(ATE_48H) AS C, SUM(ATE_72H) AS D, SUM(ATE_96H) AS E, SUM(MAIOR_96H) AS F 
        FROM `importacao_abertas` WHERE REGIONAL = 'RIO DE JANEIRO' AND SITUACAO = 'CAMPO' AND RESPONSAVEL != 'AREA DE RISCO' AND V_ATIVIDADE = 'DEFEITO' $filtroData AND EMPRESA IN ('EZENTIS') $filtro GROUP BY REGIONAL");
    
    
        $dados['faixasCTotal'] = DB::select("SELECT ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        WHERE  ia.REGIONAL = 'RIO DE JANEIRO' AND ia.RESPONSAVEL != 'AREA DE RISCO' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY ia.REGIONAL");
        
        $dados['faixasRTotal'] = DB::select("SELECT ia.REGIONAL AS REGIONAL, SUM(ia.ATE_20H) AS A, SUM(ia.ATE_24H) AS B, SUM(ia.ATE_48H) AS C, SUM(ia.ATE_72H) AS D, 
        SUM(ia.ATE_96H) AS E, SUM(ia.MAIOR_96H) AS F 
        FROM importacao_abertas ia
        
        WHERE  ia.RESPONSAVEL != 'AREA DE RISCO' AND ia.REGIONAL = 'RIO DE JANEIRO' AND ia.SITUACAO = 'CAMPO' AND ia.V_ATIVIDADE = 'DEFEITO' $filtroData $filtro GROUP BY ia.REGIONAL");
        $hoje1 = date('d/m/Y');
        $dados['atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'  AND ATRIBUICAO = 'ATRIBUIDO'");
        
        $dados['n_atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'  AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
         $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cop'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'COP' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ar'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AREA DE RISCO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cidade'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'CIDADE' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_massiva'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'MASSIVA' GROUP BY RESPONSAVEL");
        
        
        

        
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `importacao_abertas` GROUP BY atualizacao order by atualizacao desc limit 1");
        
        return view('abertasRj',['dados' => $dados]);


    }

    public function repetido(Request $req)
    {  
        $dados = [];
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " and skill in ('FTTH','FTTC')";
        } 
 
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
            $filtro = " and skill = '".$req->tecnologia."' ";
        } 
        
        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } 
 
        if ($req->filial == 'SP' || $req->filial == 'RJ') {
            $filtroFilial = " and filial = '".$req->filial."' ";
        }

      
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        $dados['atualizacao'] = DB::select("SELECT atualizacao AS input FROM `repetido` where atualizacao != 'atualizacao'  limit 1");
        
        $dados['visaoGerente'] = DB::select("Select gerente, filial,
                                sum(inst) as inst, sum(rep) as repetidos
                                FROM `repetido`  where gerente not in ('gerente','') $filtroFilial
                                GROUP BY gerente, filial ORDER BY filial, gerente");
                                
       // dd($dados['visaoGerente']);
        $dados['visaoFFA'] = DB::select("Select  
                                sum(inst) as inst, sum(rep) as repetidos
                                 FROM `repetido`  where gerente not in ('gerente','') $filtroFilial
                                ");

      

        $dados['visaoCoordenador'] = DB::select("Select coordenador, filial, 
                                sum(inst) as inst, sum(rep) as repetidos
                                FROM `repetido`  where gerente not in ('gerente','') $filtroFilial
                                GROUP BY coordenador, filial ORDER BY filial, coordenador");

 
      
        $dados['visaoSupervisor'] = DB::select("Select supervisor, filial,
                                
                                sum(inst) as inst, sum(rep) as repetidos
                                FROM `repetido` where gerente not in ('gerente','') $filtroFilial
                                GROUP BY supervisor,filial ORDER BY filial, supervisor");


        return view('repetido',['dados' => $dados]);
    }
    
    public function filaAtendimento(Request $req)
    {  
        $dados = [];
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " and skill in ('FTTH','FTTC')";
        } 
 
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
            $filtro = " and skill = '".$req->tecnologia."' ";
        } 
        /*
        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } */
 
        if ($req->filial == 'SAO PAULO LESTE' || $req->filial == 'RIO DE JANEIRO') {
            $filtroFilial = " and REGIONAL = '".$req->filial."' ";
        } else {
            $filtroFilial = "";
        }

      
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');
        
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `importacao_abertas` order by atualizacao desc  limit 1");
        
        $dados['backlog'] = DB::select("SELECT * FROM `importacao_abertas` where DT_FIM_SLA_TOA >= '$hoje' and data = '$hoje1' and V_ATIVIDADE = 'DEFEITO' AND EMPRESA in ('EZENTIS','FFA') AND CLASSIFICACAO_24H_CRIACAO_WFM ='DENTRO' AND ESTADO IN ('INICIADO','NAO INICIADO') $filtroFilial ORDER BY DT_FIM_SLA_TOA ASC");
       
        return view('fila',['dados' => $dados]);
    }

    public function propenso(Request $req)
    {  
        $dados = [];
        
        if ($req->tecnologia == 'TODOS' || !isset($req->tecnologia)) {
            $filtro = " and skill in ('FTTH','FTTC')";
        } 
 
        if ($req->tecnologia == 'FTTH' || $req->tecnologia == 'FTTC') {
            $filtro = " and skill = '".$req->tecnologia."' ";
        } 
        
        if ($req->filial == 'TODOS' || !isset($req->filial)) {
            $filtroFilial = '';
        } 
 
        if ($req->filial == 'SP' || $req->filial == 'RJ') {
            $filtroFilial = " and filial = '".$req->filial."' ";
        }

      
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');
        
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `propenso` order by atualizacao desc  limit 1");
        
        $dados['backlog'] = DB::select("SELECT * FROM `propenso` ");
       // dd($dados);
        return view('propenso',['dados' => $dados]);
    }
    
    public function atribuicao_rj (Request $req)
    {  
        $dados = [];
        
        if (isset($req->status)) {
            $filtroAt = " and ATRIBUICAO = {$req->status}";
        } else {
            $filtroAt = '';
        }
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');
        $hoje2 = date('d/m/y');
        $dataImport = date('n/j/Y');
        $dados['atualizacao'] = DB::select("SELECT data_cadastro as data FROM `producao_dia` order by data_cadastro desc  limit 1");
       // $dados['atribuido'] = DB::select("SELECT count(ATRIBUICAO) AS QTD FROM `importacao_abertas` WHERE DATA = '$hoje1' AND AREA != '0' AND EMPRESA IN ('FFA','EZENTIS') AND REGIONAL = '' AND ATRIBUICAO = 'ATRIBUIDO'");
       // $dados['n_atribuido'] = DB::select("SELECT count(ATRIBUICAO) AS QTD FROM `importacao_abertas` WHERE DATA = '$hoje1' AND AREA != '0' AND EMPRESA IN ('FFA','EZENTIS') AND ATRIBUICAO = 'N_ATRIBUIDO'");
        //$dados['bds'] = DB::select("SELECT * FROM `importacao_abertas` WHERE AREA != '0' AND FFA = 'S' AND DATA = '$hoje1' $filtroAt  ORDER BY ATRIBUICAO desc");
        
        $dados['atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'  AND ATRIBUICAO = 'ATRIBUIDO'");
        
        $dados['n_atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'  AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
        $dados['bds'] = DB::select("SELECT CLASSIFICACAO_24H_CRIACAO_WFM, WFM_CRIACAO_MAIS_24H, ESTADO, RESPONSAVEL, OS AS ORDEM, TECNICO AS PROVEDOR, ATRIBUICAO AS STATUS_ATRIBUICAO, DATA AS DATA FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND RESPONSAVEL != 'AREA DE RISCO'  AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
           $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cop'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'COP' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ar'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AREA DE RISCO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cidade'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'CIDADE' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_massiva'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'RIO DE JANEIRO' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'MASSIVA' GROUP BY RESPONSAVEL");
        
        return view('atribuicao_rj',['dados' => $dados]);
    }

    public function atribuicao_sp (Request $req)
    {  
        $dados = [];
        
        if (isset($req->status)) {
            $filtroAt = " and STATUS_ATRIBUICAO = {$req->status}";
        } else {
            $filtroAt = '';
        }
        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');

        $hoje2 = date('d/m/y');
        $dataImport = date('n/j/Y');
        $dados['atualizacao'] = DB::select("SELECT data_cadastro as data FROM `producao_dia` order by data_cadastro desc  limit 1");
       /* $dados['atribuido'] = DB::select("SELECT count(PROVEDOR) AS QTD FROM `import_atribuicao_sp` WHERE DATA = '$hoje1' AND PROVEDOR != '0' AND FFA = 'S' AND STATUS_ATRIBUICAO = 'ATRIBUIDO'");
        $dados['n_atribuido'] = DB::select("SELECT count(PROVEDOR) AS QTD FROM `import_atribuicao_sp` WHERE DATA = '$hoje1' AND PROVEDOR != '0' AND FFA = 'S' AND STATUS_ATRIBUICAO = 'N_ATRIBUIDO'");
        $dados['bds'] = DB::select("SELECT * FROM `import_atribuicao_sp` WHERE PROVEDOR != '0' AND FFA = 'S' AND DATA = '$hoje1' $filtroAt ORDER BY STATUS_ATRIBUICAO desc");
        */
        
         $dados['atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'ATRIBUIDO'");
        
        $dados['n_atribuido'] = DB::select("SELECT count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
        $dados['bds'] = DB::select("SELECT CLASSIFICACAO_24H_CRIACAO_WFM, WFM_CRIACAO_MAIS_24H, ESTADO, RESPONSAVEL, OS AS ORDEM, OS AS ORDEM, TECNICO AS PROVEDOR, ATRIBUICAO AS STATUS_ATRIBUICAO, DATA AS DATA FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1'  AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA')  AND ATRIBUICAO = 'N_ATRIBUIDO'");
        
           $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cop'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO' AND RESPONSAVEL = 'COP' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ar'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AREA DE RISCO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_ag'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'AGENDAMENTO' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_cidade'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'CIDADE' GROUP BY RESPONSAVEL");
        
        $dados['n_atribuido_massiva'] = DB::select("SELECT RESPONSAVEL, count(regional) as QTD FROM `importacao_abertas` 
        where CLASSIFICACAO_24H_CRIACAO_WFM IN ('DENTRO','FORA') AND V_ATIVIDADE = 'DEFEITO' AND  DATA = '$hoje1' AND REGIONAL = 'SAO PAULO LESTE' 
        AND SITUACAO = 'CAMPO' AND EMPRESA IN ('EZENTIS', 'FFA') AND ATRIBUICAO = 'N_ATRIBUIDO'  AND RESPONSAVEL = 'MASSIVA' GROUP BY RESPONSAVEL");
     
        return view('atribuicao_sp',['dados' => $dados]);
    }
        
    public function prazo_rj (Request $req)
    {  
        $dados = [];
    
      
        if (isset($req->status)) {
            $status = " and FAIXA_T = '".$req->status."' ";
        } else {
            $status = "";
        }
      
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');
        $hoje2 = date('d/m/Y');
        $dataImport = date('d/m/Y');
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `import_prazo_rj` order by atualizacao desc  limit 1");
        $dados['vence_6h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_rj` WHERE FAIXA_T = 'VENCE EM 6H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO'  ORDER BY PRAZO ASC");
        $dados['vence_3h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_rj` WHERE FAIXA_T = 'VENCE EM 3H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO'  ORDER BY PRAZO ASC");
        $dados['vence_2h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_rj` WHERE FAIXA_T = 'VENCE EM 2H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO'  ORDER BY PRAZO ASC");
        $dados['vence_1h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_rj` WHERE FAIXA_T = 'VENCE EM 1H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO'  ORDER BY PRAZO ASC");
        $hora = date('H:i:s');
        $dados['backlog'] = DB::select("SELECT * FROM `import_prazo_rj` WHERE  DATA_AG = '$hoje2' and DATA = '$dataImport' $status AND ESTADO !='CONCLUIDO'  ORDER BY PRAZO ASC");
        return view('prazo_rj',['dados' => $dados]);
    }

    public function prazo_sp (Request $req)
    {  
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y H:i:s');
        $hoje1 = date('d/m/Y');
        $hoje2 = date('d/m/Y');
        $dataImport = date('d/m/Y');
        $dados['atualizacao'] = DB::select("SELECT atualizacao as data FROM `import_prazo_sp` order by atualizacao desc  limit 1");
        $dados['vence_6h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_sp` WHERE FAIXA_T = 'VENCE EM 6H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO' ORDER BY PRAZO ASC");
        $dados['vence_3h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_sp` WHERE FAIXA_T = 'VENCE EM 3H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO' ORDER BY PRAZO ASC");
        $dados['vence_2h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_sp` WHERE FAIXA_T = 'VENCE EM 2H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO' ORDER BY PRAZO ASC");
        $dados['vence_1h'] = DB::select("SELECT count(ORDEM) AS QTD FROM `import_prazo_sp` WHERE FAIXA_T = 'VENCE EM 1H' AND DATA_AG = '$hoje2' and DATA = '$dataImport' AND ESTADO !='CONCLUIDO' ORDER BY PRAZO ASC");
        
        if (isset($req->status)) {
            $status = " and FAIXA_T = '".$req->status."' ";
        } else {
            $status = "";
        }
      
        $dados['backlog'] = DB::select("SELECT * FROM `import_prazo_sp` WHERE DATA_AG = '$hoje2'  and DATA = '$dataImport' $status AND ESTADO !='CONCLUIDO' ORDER BY PRAZO ASC");
        return view('prazo_sp',['dados' => $dados]);
    }
 
    public function repetidoTecnico(Request $req)
    {  
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        $dados = [];
      
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
        
          date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('d/m/Y');
        
        $dados['atualizacao'] = DB::select("SELECT atualizacao AS input FROM `repetido` where atualizacao != 'atualizacao'  limit 1");
        
        
        $dados['AtualizacaoMontada'] = DB::select("Select data_cadastro as data_atualizacao
                                FROM `producao_dia`
                                order by data_cadastro limit 1");

        $dados['gerente'] = DB::select("Select gerente as gerente
                                FROM `repetido`  where gerente not in ('gerente','')
                                group by gerente order by gerente");
    
        $dados['coordenador'] = DB::select("Select coordenador as coordenador
                                FROM `repetido` where coordenador not in ('coordenador','')
                                group by coordenador order by coordenador");
                                
        $dados['supervisor'] = DB::select("Select supervisor as supervisor
                                FROM `repetido` where supervisor not in ('supervisor','')
                                group by supervisor order by supervisor");

        $dados['visaoTecnico'] = DB::select("Select gerente, coordenador, supervisor, nome_toa as nome,
                                sum(inst) as inst, sum(rep) as repetidos
                                FROM `repetido` WHERE NOME_TOA not in ('NOME_TOA','') $filtroG $filtroC $filtroS
                                GROUP BY nome, gerente, coordenador, supervisor");
        
        return view('repetidotecnico',['dados' => $dados]);
    }
    
    public function tratarPropenso(Request $req) 
    {
        $dados = [];
        $dados['propenso'] = DB::select("SELECT * FROM propenso where ID=$req->ID");
        $dados['informacoes'] = DB::select("SELECT 
            *
            FROM historico_propenso where id_ocorrencia=$req->ID");
        
        return view('tratarPropenso',['dados' => $dados]);
    }
    
    public function gravarHistoricoPropenso(Request $req) 
    {
        $logado = auth()->user()->name;
        DB::table('historico_propenso')->insert(
        [
          'sid' => $req->SID, 
          'status' => $req->STATUS_HISTORICO, 
          'usuario' => $logado, 
          'historico' => $req->OBSERVACAO, 
          'id_ocorrencia' => $req->ID, 
        ]
      );
        
        $dados = [];
        $dados['propenso'] = DB::select("SELECT * FROM propenso where ID=$req->ID");
        $dados['informacoes'] = DB::select("SELECT 
            *
            FROM historico_propenso where id_ocorrencia=$req->ID");
           
        
        return redirect('tratarPropenso?ID='.$req->ID);
    }
    
    public function acessos(Request $req) 
    {
        $insert = DB::table('logs')->insert([
                'email'     =>  auth()->user()->email,
                'portal'    => 'Logs',
                'tipo'      => 'Acessos'
        ]);
        $dados['logins'] = DB::select("SELECT u.name as name, l.email as email, l.tipo, l.registro as registro, l.portal as portal FROM logs l 
                                            INNER JOIN users u on u.email = l.email
                                            where u.name not like '%ian%'
                                            ORDER BY l.registro  DESC");
                                            
       return view('acessos',['dados' => $dados]);
    }
    
}
