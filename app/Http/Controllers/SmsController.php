<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
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

    public function ver (Request $req)
    {   
        $dados = [];
        
        $logado = auth()->user()->email;
        $inicio = date('Y-m-d',  strtotime($req->inicio));
        $fim = date('Y-m-d', strtotime($req->fim));
        
        
        if ($req->nome != 'TODOS' && isset($req->nome)) {
            $filtroG = " and nome = '".$req->nome."' ";
        } else {
            $filtroG = '';
        } 
        
       
        $dados['dados'] = DB::select("Select * from notificacao where id!= 0  $filtroG  ");
        $dados['log_torpedo'] = DB::select("Select * from log_torpedo where id!= 0  $filtroG  ");
        $dados['nome'] = DB::select("Select nome from notificacao group by nome");
        return view('contato/index',['dados' => $dados]);
    }
    
    
    public function novo (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from notificacao where id='$req->id'");
        return view('contato/novo',['dados' => $dados]);
    }
    
    
    public function novo_gravar (Request $req) 
    {
      
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        $credenciada = auth()->user()->credenciada;
        DB::table('notificacao')->insert(
        [
            'nome'              => $req->nome, 
            'contato'           => $req->contato, 
            'motivo'            => $req->motivo, 
            'status'            => $req->status,
            'data_cadastro'     => $data,
            'login_cadastro'    => $logado
        ]
      );
        return redirect('/contato')->with('success','Atualizado com sucesso.');
    }
    
    public function editar (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from notificacao where id='$req->id'");
        return view('contato/editar',['dados' => $dados]);
    }
    
    public function editar_gravar (Request $req)
    {   
       
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $data = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;

        DB::table('notificacao')
        ->where('id', $req->id)
        ->update(
        [    
            'nome'              => $req->nome, 
            'contato'           => $req->contato, 
            'motivo'            => $req->motivo,
            'status'            => $req->status,
            'data_cadastro'     => $data,
            'login_cadastro'    => $logado
        ]);
        return redirect('/contato')->with('success','Atualizado com sucesso.');
    }
    public function enviar_torpedo (Request $req)
    {   
    
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('aaaa-mm-dd H:i:s');
        $horario = date('H');
        
        $result = DB::select("Select * from notificacao where status = 'ATIVO'");
        
        if (count($result) > 0) {
            
            foreach ($result as $dados) {
        
                // Mensagem do SMS
        		$metodo = urlencode("envio");
        		$celular = urlencode($dados->contato);
        		$mensagem = urlencode($dados->motivo);
        		$usuario = urlencode("havila@hone.net.br");
        		$senha = urlencode("havila22");
        		
        		$url_api = "https://api.iagentesms.com.br/webservices/http.php?metodo={$metodo}&usuario={$usuario}&senha={$senha}&celular={$celular}&mensagem={$mensagem}&codigosms=102";
        		
        		/* 
        			1. Colaborador com mais de 2h de hora extra no dia;
        			2. 5 minutos antes do inicio e 5 minutos após;
        		*/
        
        		// Realizar a requisição http passando os parâmetros informados
        		$resposta_api = file_get_contents($url_api);
        
        		// Imprimir o resultado da requisição
        	    //dd($resposta_api);
        		
        		if ($resposta_api == 'OK') {
        		    $resposta = 'Torpedo enviado com sucesso para '.count($result). ' contatos. Custo de R$'. round((count($result)*0.08),2).'.';
        		} else {
        		    $resposta = 'Torpedo não enviado. Erro:'. $resposta_api;
        		}
        		
        		$data = date('Y-m-d H:i:s');
                $logado = auth()->user()->name;
        		
        		DB::table('log_torpedo')->insert(
                    [
                        'nome'              => $logado, 
                        'destinatario'      => $celular,
                        'conteudo'          => $dados->motivo,
                        'status'            => $resposta_api, 
                        'data_cadastro'     => $data
                    ]
                );
            }
         
        } 
        return redirect('/contato')->with('mensagem', $resposta);
        
    }
    
}

