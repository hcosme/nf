<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasFiscaisTable extends Migration
{
    public function up()
    {
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['material', 'servico']);
            $table->string('cpf_cnpj', 18);
            $table->enum('escopo', ['pedido_compra', 'contratual']);
            $table->string('numero_nf', 20);
            $table->string('serie', 10);
            $table->date('data_emissao');
            $table->string('anexo_nf')->nullable();
            $table->string('item', 100);
            $table->integer('quantidade');
            $table->decimal('valor_unit_item', 10, 2);
            $table->decimal('total_valor', 10, 2);
            $table->timestamp('data_cadastro_login_cadastro')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notas_fiscais');
    }
}
