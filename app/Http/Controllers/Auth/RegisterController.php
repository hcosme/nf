<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\TestMail2;
use App\Mail\TestMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'cpf'       => ['required', 'string', 'max:14'],
            'email'     => ['required', 'string', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $doc = $data['cpf'];
        $valor = trim($doc);
        $documento = str_replace(array('.','-','/',' '), "", $valor);
        $consulta = DB::select("select * from fornecedores where cpf = '$documento'");
        if (count($consulta) > 0 ) {
           
            
            $dados = [];
            $dados['informacoes'] = $data;
            $dados['motivo'] = 'Nova Solicitação de Acesso';
            $dados['mensagem_fornecedor'] = 'Recebemos sua solicitação de acesso ao portal de nota fiscal da TLP, aguarde o e-mail de liberação com todas as informações que você precisa para acessar sua área exclusiva';
            $dados['informacoes'] = $data;
           
            $dados['mensagem_fornecedor'] = 'Caro administrador, recebemos uma nova solicitação de acesso ao portal de nota fiscal da TLP, para liberação você precisa para acessar sua área exclusiva e realizar a liberação.';
            
            $emails = ['h.oliveira556@gmail.com', $data['email']]; // Supondo que $logado contém o e-mail do usuário logado
           
            foreach ($emails as $email) {
                Mail::to($email)->send(new TestMail($dados));
            }
            
            return User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'cpf'       => $data['cpf'],
                'status'    => 'pendente',
                'password'  => Hash::make($data['password'])
            ]);
            echo "<script>alert('Seu cadastro foi enviado para aprovação, aguarde o retorno no e-mail.'); window.history.back();</script>";
            return redirect()->back()->withErrors(['msg' => 'Seu cadastro foi enviado para aprovação, aguarde o retorno no e-mail.']);
        } else {
            echo "<script>alert('CPF/CNPJ não encontrado na base de parceiros, solicite seu cadastro.'); window.history.back();</script>";
            exit;
            //return redirect()->back()->withErrors(['msg' => 'CPF/CNPJ não encontrado  na base de parceiros, solicite seu cadastro.']);
        }
    }
}
