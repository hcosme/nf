<?php

namespace App\Http\Controllers;

use App\Models\Closure;
use App\Models\Fechamento_teste_final;
use App\Models\file;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $order_id)
    {
        $requirements = Requirement::where('order_id', $order_id)->get();

        $requisitos = [];

        if ($type == 'FTTC') {
            $requisitos = [
                'MSAN - Primário',
                'MSAN - Secundário',
                'Conexão da Caixa TAR',
                'Ponto de Travessia',
                'PTR',
                'Interna do Cliente',
                'Tomada',
                'Etiqueta do Modem',
                'Modem sincronizado e navegando',
                'Paramentros do Modem',
                'Teste de velocidade',
                'Fechamento'
            ];
        } elseif ($type == 'FTTH')
        {
            $requisitos = [
                'Panoramica da CDOE',
                'Conexão DROP',
                'Ponto de Travessia',
                'PTR',
                'Interna do Cliente',
                'Tomada',
                'Etiqueta do Modem',
                'Modem sincronizado e navegando',
                'Paramentros do Modem',
                'Teste de velocidade',
                'Fechamento'
            ];
        }

        $fechamentos = Fechamento_teste_final::get();
        return view('files.create', compact('requisitos', 'order_id', 'requirements', 'fechamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requirements = $request->except('_token', 'order_id');
        foreach ($requirements as $key => $requirement) {
            if (Requirement::where('name', str_replace('_', ' ', $key))->where('order_id', $request->order_id)->first()) {
                $require = Requirement::where('name', str_replace('_', ' ', $key))->where('order_id', $request->order_id)->first();
                if ($require->name != 'Fechamento') {
                    $file = file::where('requirement_id', $require->id)->first();

                    if (Storage::exists($file->path)) {
                    Storage::delete($file->path);
                    }
                    $path = $requirement->store('requirements');
                    $file->update([
                        'path' => $path,
                        'url' => config('app.url') . '/storage/' . $path,
                    ]);
                } else {
                    $closure = Closure::where('requirement_id', $require->id)->first();

                    $closure->update([
                        'reason' => $request->Fechamento,
                    ]);
                }


            } else {
                $require = Requirement::create([
                    'name' => str_replace('_', ' ', $key),
                    'order_id' => $request->order_id,
                    'status' => 'Aguardando Aprovaçao'
                ]);

                if (str_replace('_', ' ', $key) == 'Fechamento') {
                    (new Closure())->create([
                        'requirement_id' => $require->id,
                        'reason' => $request->Fechamento
                    ]);
                } else {
                    $path = $requirement->store('requirements');
                    $file = file::create([
                        'path' => $path,
                        'url' => config('app.url') . '/storage/' . $path,
                        'requirement_id' => $require->id,

                    ]);
                }

                $newRequirement = [
                    'Cliente validou ?',
                    'Explicou o funcionamento do wi-fi?',
                    'Se foi informado o telefone do suporte técnico?',
                    'Qual foi a real reclamação?',
                    'Telefone de contato alternativo?',
                    'Verificar parâmetros do NGASP',
                    'Anexar dois anexos (01 obrigatório outro opcional)'
                ];

                foreach ($newRequirement as $new) {
                    Requirement::create([
                        'name' => $new,
                        'order_id' => $request->order_id,
                        'status' => 'Aguardando Aprovaçao'
                    ]);
                }
            }
        }
        return redirect()->route('testefinal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show(file $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $order_id)
    {
        $requirements = Requirement::with('file', 'closure')->where('order_id', $order_id)->get();

        $op = Requirement::with('file')->where('name', 'Anexar dois anexos (01 obrigatório outro opcional)')->where('order_id', $order_id)->first();

        $requisitos = [];

        if ($type == 'FTTC') {
            $requisitos = [
                'MSAN - Primário',
                'MSAN - Secundário',
                'Conexão da Caixa TAR',
                'Ponto de Travessia',
                'PTR',
                'Interna do Cliente',
                'Tomada',
                'Etiqueta do Modem',
                'Modem sincronizado e navegando',
                'Paramentros do Modem',
                'Teste de velocidade',
                'Fechamento'
            ];
        } elseif ($type == 'FTTH')
        {
            $requisitos = [
                'Panoramica da CDOE',
                'Conexão DROP',
                'Ponto de Travessia',
                'PTR',
                'Interna do Cliente',
                'Tomada',
                'Etiqueta do Modem',
                'Modem sincronizado e navegando',
                'Paramentros do Modem',
                'Teste de velocidade',
                'Fechamento'
            ];
        }

        $requirements_aditional = [
            'Cliente validou ?',
            'Explicou o funcionamento do wi-fi?',
            'Se foi informado o telefone do suporte técnico?',
            'Qual foi a real reclamação?',
            'Telefone de contato alternativo?',
            'Verificar parâmetros do NGASP',
        ];

        return view('files.edit', compact('requisitos', 'order_id', 'requirements', 'type', 'requirements_aditional', 'op'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, file $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(file $file)
    {
        //
    }

    public function approve($id, Request $request)
    {
        $requirement = Requirement::find($id);
        $type = $request->type;
        $table = $request->table;

        $requirement->update([
            'status' => 'Aprovado'
        ]);

        $order_id = $requirement->order_id;

       $requirements = Requirement::where('order_id', $requirement->order_id)->get();

       $requisitos = [];

        if ($request->table == 'table-one') {
            if ($type == 'FTTC') {
                $requisitos = [
                    'MSAN - Primário',
                    'MSAN - Secundário',
                    'Conexão da Caixa TAR',
                    'Ponto de Travessia',
                    'PTR',
                    'Interna do Cliente',
                    'Tomada',
                    'Etiqueta do Modem',
                    'Modem sincronizado e navegando',
                    'Paramentros do Modem',
                    'Fechamento'
                ];
            } elseif ($type == 'FTTH')
            {
                $requisitos = [
                    'Panoramica da CDOE',
                    'Conexão DROP',
                    'Ponto de Travessia',
                    'PTR',
                    'Interna do Cliente',
                    'Tomada',
                    'Etiqueta do Modem',
                    'Modem sincronizado e navegando',
                    'Paramentros do Modem',
                    'Teste de velocidade',
                    'Fechamento'

                ];
            }
        } else {
            $requisitos = [
                'Cliente validou ?',
                'Explicou o funcionamento do wi-fi?',
                'Se foi informado o telefone do suporte técnico?',
                'Qual foi a real reclamação?',
                'Telefone de contato alternativo?',
                'Verificar parâmetros do NGASP',
            ];
        }

       $data['html'] = view('files.partials.requirements', compact('requisitos', 'order_id', 'requirements', 'type', 'table'))->render();

       $data['table'] = $table;

       return jsonresponse(true, null, $data);
    }

    public function reprove($id, Request $request)
    {
        $requirement = Requirement::find($id);
        $type = $request->type;
        $table = $request->table;

        $requirement->update([
            'status' => 'Reprovado'
        ]);

        $order_id = $requirement->order_id;

       $requirements = Requirement::where('order_id', $requirement->order_id)->get();

       $requisitos = [];
        if ($request->table == 'table-one') {
            if ($type == 'FTTC') {
                $requisitos = [
                    'MSAN - Primário',
                    'MSAN - Secundário',
                    'Conexão da Caixa TAR',
                    'Ponto de Travessia',
                    'PTR',
                    'Interna do Cliente',
                    'Tomada',
                    'Etiqueta do Modem',
                    'Modem sincronizado e navegando',
                    'Paramentros do Modem',
                    'Fechamento'
                ];
            } elseif ($type == 'FTTH')
            {
                $requisitos = [
                    'Panoramica da CDOE',
                    'Conexão DROP',
                    'Ponto de Travessia',
                    'PTR',
                    'Interna do Cliente',
                    'Tomada',
                    'Etiqueta do Modem',
                    'Modem sincronizado e navegando',
                    'Paramentros do Modem',
                    'Teste de velocidade',
                    'Fechamento'
                ];
            }
        } else {
            $requisitos = [
                'Cliente validou ?',
                'Explicou o funcionamento do wi-fi?',
                'Se foi informado o telefone do suporte técnico?',
                'Qual foi a real reclamação?',
                'Telefone de contato alternativo?',
                'Verificar parâmetros do NGASP',
            ];
        }

        $data['html'] = view('files.partials.requirements', compact('requisitos', 'order_id', 'requirements', 'type', 'table'))->render();

        $data['table'] = $table;

       return jsonresponse(true, null, $data);
    }

    public function store_operador(Request $request)
    {
        $requirement = Requirement::where('name', 'Anexar dois anexos (01 obrigatório outro opcional)')->where('order_id', $request->order_id)->first();

        foreach ($request->except('order_id', '_token') as $key => $value) {
            $path = $value->store('requirements');
            file::create([
                'path' => $path,
                'url' => config('app.url') . '/storage/' . $path,
                'requirement_id' => $requirement->id,
            ]);
        }

        return redirect()->back();
    }
}
