<div class="base-home">
			<h1 class="titulo"><span class="cor">Novo</span> cadastro</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."denunciado/Salvar" ?>" method="POST">
			<div class="col">
				<label>id_denunciado</label>
					<input name="txt_id" disabled type="number" >
			</div>
			<div class="col">
				<label>id_denuncia</label>
					<input name="txt_id_denuncia" type="number" 
					value="<?php echo "$denuncia->id_denuncia" ?>">
			</div>
			
				<label>nome</label>
					<input name="txt_nome" required autofocus  type="text" placeholder="Insira o nome do denunciado">

				<label>cpf</label>
					<input name="txt_cpf" required type="text" placeholder="Insira o cpf">

				<div class="col">
					<label>matricula</label>
					<input name="txt_matricula" value="" type="number" placeholder="Insira a matrícula">
				</div>	
				
				<div class="col">
					<label>vinculo</label>
					<input name="txt_vinculo" value="" type="text" placeholder="Vínculo empregatício">
				</div>

				<div class="col">
					<label>secretaria</label>
					<input name="txt_secretaria" value="" type="text" placeholder="secretaria">
				</div>	
				
				<div class="col">
					<label>unidade</label>
					<input name="txt_unidade" value="" type="text" placeholder="Insira a unidade de lotação">
				</div>
				
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	