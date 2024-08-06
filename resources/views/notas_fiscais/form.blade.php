<!-- resources/views/notas_fiscais/form.blade.php -->

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control" required>
        <option value="material" {{ (isset($notaFiscal) && $notaFiscal->status == 'material') ? 'selected' : '' }}>Material</option>
        <option value="servico" {{ (isset($notaFiscal) && $notaFiscal->status == 'servico') ? 'selected' : '' }}>Serviço</option>
    </select>
</div>
<div class="form-group">
    <label for="cpf_cnpj">CPF/CNPJ</label>
    <input type="text" name="cpf_cnpj" class="form-control" value="{{ $notaFiscal->cpf_cnpj ?? '' }}" required>
</div>
<div class="form-group">
    <label for="escopo">Escopo</label>
    <select name="escopo" class="form-control" required>
        <option value="pedido_compra" {{ (isset($notaFiscal) && $notaFiscal->escopo == 'pedido_compra') ? 'selected' : '' }}>Pedido de Compra</option>
        <option value="contratual" {{ (isset($notaFiscal) && $notaFiscal->escopo == 'contratual') ? 'selected' : '' }}>Contratual</option>
    </select>
</div>
<div class="form-group">
    <label for="numero_nf">Número NF</label>
    <input type="text" name="numero_nf" class="form-control" value="{{ $notaFiscal->numero_nf ?? '' }}" required>
</div>
<div class="form-group">
    <label for="serie">Série</label>
    <input type="text" name="serie" class="form-control" value="{{ $notaFiscal->serie ?? '' }}" required>
</div>
<div class="form-group">
    <label for="data_emissao">Data de Emissão</label>
    <input type="date" name="data_emissao" class="form-control" value="{{ $notaFiscal->data_emissao ?? '' }}" required>
</div>
<div class="form-group">
    <label for="anexo_nf">Anexo NF</label>
    <input type="text" name="anexo_nf" class="form-control" value="{{ $notaFiscal->anexo_nf ?? '' }}">
</div>
<div class="form-group">
    <label for="item">Item</label>
    <input type="text" name="item" class="form-control" value="{{ $notaFiscal->item ?? '' }}" required>
</div>
<div class="form-group">
    <label for="quantidade">Quantidade</label>
    <input type="number" name="quantidade" class="form-control" value="{{ $notaFiscal->quantidade ?? '' }}" required>
</div>
<div class="form-group">
    <label for="valor_unit_item">Valor Unitário do Item</label>
    <input type="number" name="valor_unit_item" class="form-control" step="0.01" value="{{ $notaFiscal->valor_unit_item ?? '' }}" required>
</div>
<div class="form-group">
    <label for="total_valor">Valor Total</label>
    <input type="number" name="total_valor" class="form-control" step="0.01" value="{{ $notaFiscal->total_valor ?? '' }}" required>
</div>
