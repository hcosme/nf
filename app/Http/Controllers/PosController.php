<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
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
        date_default_timezone_set('America/Sao_Paulo');
        
        $dados = [];
        $diaAtual = date('d/m/Y');
        if (!empty($req->filial) || isset($req->filial)) {

            if ($req->filial == 'TODOS') {
                $uf = '';
            } else {
                $uf = " and uf = '".$req->filial."'";
            } 
        } else {
            $uf = "";
        } 
     
        if (!empty($req->inicio) || isset($req->inicio)) {
            
            $dia = " and data between '".date('d/m/Y', strtotime($req->inicio))."' and '".date('d/m/Y', strtotime($req->fim))."'";
           // dd($dia);
        } else {
            $dia = '';
        }

        $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico') and com_sucesso != 'SIM' $uf $dia");
        $dados['instalacao'] = DB::select("Select count(tipo_atividade) as QTD from pos where tipo_atividade like '%instalacao%'  $uf $dia ");        
        $dados['instalacaoAuditadas'] = DB::select("Select  count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%instalacao%' and com_sucesso !='0'  $uf $dia   ");
        $dados['reparo'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%bilhete%'  $uf $dia  ");
        $dados['reparoAuditadas'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and com_sucesso !='0' and tipo_atividade like '%bilhete%'  $uf $dia  ");

        if (isset($req->status)) {
            if ($req->status == 'inst') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico')  and tipo_atividade like '%instalacao%' and com_sucesso != 'SIM' $uf $dia");
            }
            if ($req->status == 'inst_auditado') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico')  and tipo_atividade like '%instalacao%' and com_sucesso  != 'SIM' $uf $dia");
            }
            if ($req->status == 'rep') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico')  and com_sucesso  != 'SIM'  and tipo_atividade like '%bilhete%' $uf $dia");
            }
            if ($req->status == 'rep_auditado') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico') and com_sucesso != 'SIM'  and tipo_atividade like '%bilhete%'  $uf $dia");
            }
        }
        return view('pos',['dados' => $dados]);
    }
    
    public function vago ()
    {   
        date_default_timezone_set('America/Sao_Paulo');
        $dados = [];
        $dados['disponibilidade'] = DB::select("Select * from vago LIMIT 9999 ");
        return view('disponibilidade',['dados' => $dados]); 
    }
    
    public function dashboard (Request $req)
    {   
        date_default_timezone_set('America/Sao_Paulo');
        
        $dados = [];
        $diaAtual = date('d/m/Y');
        if (!empty($req->filial) || isset($req->filial)) {

            if ($req->filial == 'TODOS') {
                $uf = '';
            } else {
                $uf = " and uf = '".$req->filial."'";
            } 
        } else {
            $uf = "";
        } 
     
        if (!empty($req->inicio) || isset($req->inicio)) {
            $dia = ' and data between '.$req->inicio.' and '.$req->fim;
        } else {
            $dia = '';
        }

        $dados['total_instalacao'] = DB::select("Select count(CLIENTE) as QTD from pos where tecnico not in ('tecnico') and  tipo_atividade like '%instalacao%' $uf $dia");
        $dados['tratar_instalacao'] = DB::select("Select count(tipo_atividade) as QTD from pos where tipo_atividade like '%instalacao%' and com_sucesso = '0'  $uf $dia");        
        $dados['instalacaoAuditadas'] = DB::select("Select  count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%instalacao%' and com_sucesso !='0'  $uf $dia");
        $dados['instalacaoProativo'] = DB::select("Select  count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%instalacao%' and proativo ='SIM'  $uf $dia");
        $dados['instalacaoDespachar'] = DB::select("Select  count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%instalacao%' and despachado ='NÃO'  $uf $dia");
        
        
        $dados['total_reparo'] = DB::select("Select count(CLIENTE) as QTD from pos where tecnico not in ('tecnico') and  tipo_atividade like '%bilhete%' $uf $dia");
        $dados['tratar_reparo'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and tipo_atividade like '%bilhete%' and com_sucesso = '0' $uf $dia");
        $dados['reparoAuditadas'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and com_sucesso !='0' and tipo_atividade like '%bilhete%'  $uf $dia  ");
        $dados['reparoProativo'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico') and proativo ='SIM'  and tipo_atividade like '%bilhete%'  $uf $dia  ");
        
        $dados['rank_auditoria'] = DB::select("Select operador, count(CLIENTE) as qtd from pos where tecnico not in ('tecnico') and operador not in ('0','') $uf $dia group by operador order by qtd desc");
        $dados['rank_despacho'] = DB::select("Select usuario_despacho, count(CLIENTE) as qtd from pos where tecnico not in ('tecnico') and usuario_despacho not in ('0','') $uf $dia group by usuario_despacho order by qtd desc");
        
        return view('pos-dashboard',['dados' => $dados]);
    }
    
    
    
     public function proativo(Request $req)
    {   
        date_default_timezone_set('America/Sao_Paulo');
        
        $dados = [];
        $diaAtual = date('d/m/Y');
        if (!empty($req->filial) || isset($req->filial)) {

            if ($req->filial == 'TODOS') {
                $uf = '';
            } else {
                $uf = " and uf = '".$req->filial."'";
            } 
        } else {
            $uf = "";
        } 
     
        if (!empty($req->inicio) || isset($req->inicio)) {
            $dia = ' and data between '.$req->inicio.' and '.$req->fim;
        } else {
            $dia = '';
        }

        $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico') and parametro = 'SIM' AND com_sucesso IN ('SIM','NÃO') and com_sucesso !='0' and proativo = 'SIM' $uf $dia");
        $dados['despachar'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico')  and despachado = 'NÃO' AND proativo = 'SIM' $uf $dia");        
        $dados['despachado'] = DB::select("Select count(tipo_atividade) as QTD from pos where tecnico not in ('tecnico')  and despachado = 'SIM' AND proativo = 'SIM' $uf $dia");

        if (isset($req->status)) {
            if ($req->status == 'despachar') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico')  and despachado = 'NÃO' AND  proativo = 'SIM'  $uf $dia");
            }
            if ($req->status == 'despachado') {
                $dados['pos'] = DB::select("Select * from pos where tecnico not in ('tecnico')  and despachado = 'SIM' AND proativo = 'SIM'  $uf $dia");
            }
          
        }
        return view('pos-proativo',['dados' => $dados]);
    }
    
    
    public function ver (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from pos where id='$req->id'");
        dd($dados);
        return view('ver-pos',['dados' => $dados]);
    }

    public function editar (Request $req)
    {   
        $dados = [];
        $dados['pos'] = DB::select("Select * from pos where id='$req->id'");
        return view('editar-pos',['dados' => $dados]);
    }
    
    public function editar_despachar (Request $req)
    {   
        $dados = [];
        $dados['pos'] = DB::select("Select * from pos where id='$req->id'");
        return view('editar-pos-despachar',['dados' => $dados]);
    }
    
    public function editarPos (Request $req)
    {   
       
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');

        $hoje = date('d/m/Y H:i:s');
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from pos where id='$req->id'");
        DB::table('pos')
        ->where('id', $req->id)
        ->update(
        [
            'operador'                => $req->operador, 
            'parametro'               => $req->parametro,
            'com_sucesso'             => $req->com_sucesso, 
            'deixou_telefone_contato' => $req->deixou_telefone_contato,
            'proativo'                => $req->proativo,
            'n_proativo'              => $req->n_proativo,
            'despachado'              => 'NÃO',
            'obs'                     => $req->obs,
            'data_tratamento'         => $hoje
        ]);
        return redirect('/pos')->with('success','Atualizado com sucesso.');
    }
    
    public function editarPos_despachar (Request $req)
    {   
       
        $dados = [];
        $logado = auth()->user()->name;
        $dados['dados'] = DB::select("Select * from pos where id='$req->id'");
        DB::table('pos')
        ->where('id', $req->id)
        ->update(
        [
            'despachado'       => $req->despachado,
            'usuario_despacho' => $logado,
        ]);
        return redirect('/pos-proativo')->with('success','Atualizado com sucesso.');
    }
    
  
}