<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class UsuariosController extends Controller
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

    public function index()
    {   
        $dados = [];
        $logado = auth()->user()->empresa;
        $logadoId = auth()->user()->id;
        $dados['dados'] = DB::select("Select * from users where status in ('aprovado','pendente')");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'usuarios',
            'tipo'      => 'Lista de usuarios'
        ]);

        return view('usuario/usuario',['dados' => $dados]);
    }

    public function editar_usuario (Request $req)
    {   
        $dados = [];
        $dados['dados'] = DB::select("Select * from users where id='$req->id' order by id desc");
        $dados['coordenador'] = DB::select("Select coordenador from headcount group by coordenador");
        $dados['supervisor'] = DB::select("Select supervisor from headcount UNION Select fiscal from headcount");
        $dados['fiscal'] = DB::select("Select fiscal from headcount group by fiscal");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'usuarios',
            'tipo'      => 'Editar usuario'
        ]);
        
        return view('usuario/editar-usuario',['dados' => $dados]);
    }
    
    public function editar_usuario_alterar (Request $req)
    {   
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        $senha = DB::select("Select password as senha from users where id='$req->id'");
        $email = DB::select("Select email as email from users where id='$req->id'");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'usuarios',
            'tipo'      => 'Alterar usuario'
        ]);
        
        if ($req->senha == $senha[0]->senha) {
           DB::table('users')
            ->where('id', $req->id)
            ->update(
            [
                'status'        => $req->status,
                'role'       => $req->role,
            ]);
        } else {
            DB::table('users')
                ->where('id', $req->id)
                ->update(
                [
                    'status'        => $req->status,
                    'role'          => $req->role,
                    'password'      => Hash::make($req->senha),
                ]);
        }
        
        $dados = [];
        $dados['mensagem_fornecedor'] = 'Houve uma alteração no seu perfil.';
        $dados['motivo'] = 'Alteração de Acesso';
        $dados['informacoes'] = $req;
        
        $dadosMail = [ 
                    'emails' => [
                                1 => $email[0]->email,
                            ],
                ];
        
            foreach ($dadosMail as $emails) {
                Mail::to($emails)->send(new TestMail($dados));
            }
        
        
        return redirect('./usuarios')->with('mensagem','Atualizado com sucesso.');
    }
    
    public function alterar_senha (Request $req)
    {   
        $dados = [];
        $id = auth()->user()->id;
        $dados['dados'] = DB::select("Select * from users where id='$id'");
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'usuarios',
            'tipo'      => 'alterar senha'
        ]);
        
        return view('usuario/alterar-senha', ['dados' => $dados])->with('mensagem','Atualizado com sucesso.');
    }
    
    public function alterar_senha_alterar (Request $req)
    {   
        $dados = [];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y-m-d H:i:s');
        $logado = auth()->user()->name;
        
        $id = auth()->user()->id;
        
        $insert = DB::table('logs')->insert([
            'email'     =>  auth()->user()->email,
            'portal'    => 'usuarios',
            'tipo'      => 'Senha alterada'
        ]);
        
        DB::table('users')
        ->where('id', $id)
        ->update(
        [
            'name'        => $req->name,
            'email'       => $req->email,
            'password'    => Hash::make($req->senha),
        ]);
        return redirect('usuario/usuario')->with('mensagem','Atualizado com sucesso.');
    }
    
    public function deletar_usuario  (Request $req){
        DB::delete("delete from users WHERE id = $req->id"); 
        return back()->with('mensagem','Excluído com sucesso.');
    }
}

