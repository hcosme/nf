<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaFiscal;
use Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class NotaFiscalController extends Controller
{
    public function index(Request $request)
    {
        $inicio = date('d/m/Y',  strtotime($request->inicio));
        $fim = date('d/m/Y', strtotime($request->fim));
        
        if (!empty($request->inicio) || !empty($request->fim)) {
            if ($request->consultar_por == 'Cadastro') {
                $filtroData = " and data_cadastro between '".$request->inicio.' 00:00:00'."' and '".$request->fim.' 23:59:59'."' ";
            }
            if ($request->consultar_por == 'Pagamento') {
                $filtroData = " and data_pagamento between '".$request->inicio.' 00:00:00'."' and '".$request->fim.' 23:59:59'."' ";
            }
            if ($request->consultar_por == 'Vencimento') {
                $filtroData = " and vencimento between '".$request->inicio.' 00:00:00'."' and '".$request->fim.' 23:59:59'."' ";
            }
        } else {
            $filtroData =  "";
        }
 
        if ($request->cnpj != null || !empty($request->cnpj)) {
            $filtroG = " and cpf_cnpj = '".$request->cnpj."' ";
        } else {
            $filtroG = '';
        } 
        
        if ($request->nf != null || !empty($request->nf)) {
            $filtroC = " and numero_nf = '".$request->nf."' ";
        } else {
            $filtroC = '';
        }
        
        if ($request->situacao != null || !empty($request->situacao)) {
            $filtroS = " and situacao = '".$request->situacao."' ";
        } else {
            $filtroS = '';
        }
        
           
        if ($request->status != null || !empty($request->status)) {
            $filtroH = " and status = '".$request->status."' ";
        } else {
            $filtroH = '';
        }
        $notasFiscais = [];
        $documento = auth()->user()->cpf;
        if (auth()->user()->role == 'administrador') {
            $notasFiscais['dados'] = DB::select("Select *, SUM(total_valor) AS total_valor from nota_fiscals WHERE id != 0 $filtroData $filtroG $filtroC $filtroS $filtroH GROUP BY numero_nf ORDER BY data_cadastro DESC");
            $notasFiscais['ff'] = DB::select("Select * from fornecedores  GROUP BY fornecedores ORDER BY fornecedores asc");
        } else {
            $notasFiscais['dados'] = DB::select("Select *, SUM(total_valor) AS total_valor from nota_fiscals WHERE id != 0  $filtroData $filtroC $filtroS $filtroH and cpf_cnpj = '$documento' GROUP BY numero_nf ORDER BY data_cadastro DESC");
            $notasFiscais['ff'] = DB::select("Select * from fornecedores where cpf = '$documento' GROUP BY fornecedores ORDER BY fornecedores asc");
            
        }
        
        return view('nf.index', compact('notasFiscais'));
    }
    
    public function edit (Request $request)
    {
        $logado = auth()->user()->cpf;
        $dados = DB::select("Select * from nota_fiscals where numero_nf = '$request->id'");
        return view('nf.editar', compact('dados'));
    }
    
    public function fornecedores (Request $request)
    {
        
        $logado = auth()->user()->cpf;
        if (auth()->user()->role == 'administrador') {
            $dados = DB::select("Select * from fornecedores");
        } else {
            $dados = DB::select("Select * from fornecedores where cpf = '$logado' ");
        }
        return view('nf.fornecedores', compact('dados'));
    }
    
    public function create()
    {
        $logado = auth()->user()->cpf;
        $pedidos = DB::select("Select * from pedidos where empresa = '$logado'");
        return view('nf.novo', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $logado = auth()->user()->email;
        if ($request->hasFile('anexo_nf')) {
            $data['anexo_nf'] = $request->file('anexo_nf')->store('anexos', 'public');
        }

    // Array para armazenar os IDs dos itens selecionados
$selectedItems = $request->input('selected_items', []);

try {
    // Iniciar uma transação
    DB::beginTransaction();

    // Iterar sobre os itens selecionados
    foreach ($selectedItems as $itemId) {
        // Encontrar o item pelo ID (supondo que você tenha um modelo 'Pedido' ou similar)
        $pedido = DB::table('pedidos')->where('id', $itemId)->first();

        if ($pedido) {
            // Gravar no banco de dados
            $insert = DB::table('nota_fiscals')->insert([
                'status'            => $request->status,
                'cpf_cnpj'          => $request->cpf_cnpj,
                'escopo'            => $request->escopo,
                'numero_nf'         => $request->numero_nf,
                'pedido'            => $pedido->pedido, // Exemplo de como obter dados do pedido
                'serie'             => $request->serie,
                'data_emissao'      => $request->data_emissao,
                'login_cadastro'    => $logado,
                'anexo_nf'          => $data['anexo_nf'],
                'item'              => $pedido->item, // Exemplo de como obter dados do pedido
                'quantidade'        => $pedido->quantidade, // Exemplo de como obter dados do pedido
                'valor_unit_item'   => $pedido->valor_unit, // Exemplo de como obter dados do pedido
                'total_valor'       => $pedido->valor_unit * $pedido->quantidade, // Exemplo de cálculo
            ]);
        } else {
            // Tratar caso o pedido não seja encontrado (opcional)
            // Pode ser um log ou uma mensagem de erro, conforme necessário
        }
    }

    // Commit da transação
    DB::commit();

    // Envio de emails, conforme seu código original
    // ...

 
        
        /*
        for ($i = 0; $i < count($request->item); $i++) 
        {
        
            $insert = DB::table('nota_fiscals')->insert([
                'status'            => $request->status,
                'cpf_cnpj'          => $request->cpf_cnpj,
                'escopo'            => $request->escopo,
                'numero_nf'         => $request->numero_nf,
                'pedido'            => $request->pedido[$i],
                'serie'             => $request->serie,
                'data_emissao'      => $request->data_emissao,
                'login_cadastro'    => $logado,
                'anexo_nf'          => $data['anexo_nf'],
                'item'              => $request->item[$i],
                'quantidade'        => $request->quantidade[$i],
                'valor_unit_item'   => $request->valor_unit_item[$i],
                'total_valor'       => $request->total_valor[$i],
            ]);
        } */
        
        
        $dados = [];
        $dados['mensagem_fornecedor'] = 'Você tem um novo cadastro de NF no portal.';
        $dados['motivo'] = 'Nova NF';
        $dados['informacoes'] = $request;
        
        $emails = ['h.oliveira556@gmail.com', $logado]; // Supondo que $logado contém o e-mail do usuário logado
        foreach ($emails as $email) {
            Mail::to($email)->send(new TestMail($dados));
        }
            
        //return redirect()->route('./consultar-nf')->with('success', 'Nota Fiscal criada com sucesso!');
        return redirect()->route('nf.index')->with('success', 'Nota Fiscal criada com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, rollback da transação
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao criar Nota Fiscal: ' . $e->getMessage());
        }

 
 
    }

    public function status(Request $request)
    {   
        $info = DB::select("Select * from nota_fiscals where numero_nf = $request->numero_nf");
       
          DB::table('nota_fiscals')
            ->where('numero_nf', $request->numero_nf)
            ->update(
            [
                'situacao' => $request->situacao
            ]);
        
        $dados = [];
        $dados['mensagem_fornecedor'] = 'Houve uma alteração na situação da sua NF.';
        $dados['motivo'] = 'Alteração NF';
        $dados['informacoes'] = $info;
     
        
        $emails = ['h.oliveira556@gmail.com', $info[0]->login_cadastro]; // Supondo que $logado contém o e-mail do usuário logado
            foreach ($emails as $email) {
                Mail::to($email)->send(new TestMail($dados));
            }
        return redirect()->route('consultar_nf')->with('success', 'Nota Fiscal criada com sucesso!');
        
    }


}
