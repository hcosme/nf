{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
@section('content')
    <div class="callout callout-info">
     
      </div>
      <div class="callout callout-info">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
             
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">ID:</label>
                        <input type="text" class="form-control form-control-sm" name="id" style="background:#" value="<?php echo $dados['dados'][0]->id?>" readonly="">
                    </div>
                
                 <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Contrato:</label>
                        <input type="text" class="form-control form-control-sm" name="contrato" style="background:#" value="<?php echo $dados['dados'][0]->contrato?>" readonly="" disabled>
                    </div>
                    
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Empresa:</label>
                        <input type="text" class="form-control form-control-sm" name="login_cadastro" style="background:#" value="<?php echo $dados['dados'][0]->empreiteira?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome Técnico:</label>
                        <input type="text" class="form-control form-control-sm" name="tecnico" style="background:#" value="<?php echo $dados['dados'][0]->tecnico?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="data_cadastro" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Login Cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="login_cadastro" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
                    </div>
              </div><br>
              <h5><b>Checklist Pós Instalação</b></h5>
              <hr>      <div class="row">
                
             
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">1. Técnico estava identificado com crachá e uniforme?</label>
                        <select name="cracha" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->cracha?>"><?php echo $dados['dados'][0]->cracha?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">2. Técnico foi educado e cordial?</label>
                        <select name="cordial" class="form-control form-control-sm" value="" readonly>
                          <option value="<?php echo $dados['dados'][0]->cordial?>""><?php echo $dados['dados'][0]->cordial?>"</option>
                          </select>
                        </div>          
                        
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">3. Local e trajeto foi combinado com cliente?</label>
                        <select name="trajeto" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->trajeto?>"><?php echo $dados['dados'][0]->trajeto?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">4. Todo o cabeamento foi novo?</label>
                        <select name="cabeamento" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->cabeamento?>"><?php echo $dados['dados'][0]->cabeamento?></option>
                        </select>
                        </div>          
                        
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">5. Técnico explicou o funcionamento dos produtos?</label>
                        <select name="funcionamento" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->funcionamento?>"><?php echo $dados['dados'][0]->funcionamento?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">6. Tirou todas as dúvidas sobre os serviços e sistemas?</label>
                        <select name="duvidas" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->duvidas?>"><?php echo $dados['dados'][0]->duvidas?></option>
                        </select>
                        </div>          
                        
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">7. Deixou a senha do WI-FI anotada?</label>
                        <select name="senha_wifi" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->senha_wifi?>"><?php echo $dados['dados'][0]->senha_wifi?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">8. Solicitou assinatura digital e fechamento da ordem de serviço?</label>
                        <select name="assinatura_digital" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->assinatura_digital?>"><?php echo $dados['dados'][0]->assinatura_digital?></option>
                        </select>
                        </div>          
                        
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">9. Técnico deixou algum número pessoal para contato?</label>
                        <select name="numero_pessoal" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->numero_pessoal?>"><?php echo $dados['dados'][0]->numero_pessoal?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">10. Local ficou limpo e organizado?</label>
                        <select name="limpo" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->limpo?>"><?php echo $dados['dados'][0]->limpo?></option>
                        </select>
                        </div>          
                        
                        
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">11. Foi deixado algum dano no imovel?</label>
                        <select name="danos" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->danos?>"><?php echo $dados['dados'][0]->danos?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">12. Qual sua avaliação sobre os serviços prestados pela equipe?</label>
                        <select name="avaliacao_servico" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->avaliacao_servico?>"><?php echo $dados['dados'][0]->avaliacao_servico?></option>
                        </select>
                        </div>          
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">13. Qual sua avaliação sobre o atendimento da equipe?</label>
                        <select name="avaliacao_atendimento" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->avaliacao_atendimento?>"><?php echo $dados['dados'][0]->avaliacao_atendimento?></option>
                        </select>
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">14. Gostaria de receber um técnico de Controle de Qualidade?</label>
                        <select name="tecnico_controle_qualidade" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo $dados['dados'][0]->tecnico_controle_qualidade?>"><?php echo $dados['dados'][0]->tecnico_controle_qualidade?></option>
                        </select>
                        </div>          
                        
                        
                         <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Observação</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obs"  readonly><?php echo $dados['dados'][0]->obs?></textarea>
                         </div>
                         
                        
                        </div><br>
              
                  
                        
                        
               
 <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        "packages":["map"],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        "mapsApiKey": "AIzaSyC6a5-_Ba4h1gtx2EBj1wCnkJfJrAj_Huc"
      });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          [37.4232, -122.0853, 'Work'],
          [37.4289, -122.1697, 'University'],
          [37.6153, -122.3900, 'Airport'],
          [37.4422, -122.1731, 'Shopping']
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {
          showTooltip: true,
          showInfoWindow: true
        });
      }

    </script>
  </head>
<br>
<div class="box-footer">
                <a href="./editar_cq?id=<?php echo $dados['dados'][0]->id?>"><button type="button" class="btn btn-success">Editar</button> </a>
                <a href="./cq"><button type="button" class="btn btn-secondary">Retornar</button> </a>
              </div><br>
            </form>
          </div>
          <!-- /.box -->

         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')

@stop
