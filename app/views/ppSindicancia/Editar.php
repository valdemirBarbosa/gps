<div class="base-home">
		<h1 class="titulo"><span class="cor">Editar</span> Processo Sindicância</h1>
		<div class="base-formulario">	

		<span class="qtde">Há <b><?php  echo count($pp)?></b> processo preliminares e sindicâncias</span>

		<form action="<?php echo URL_BASE ."PpSindicancia/Salvar" ?>" method="POST">

		<?php foreach($pp as $ps){ ?>
				<label>id</label>
					<input name="txt_id" readonly="true" value="<?php echo $ps->id ?>" >

				<label>Id da Denuncia</label>
					<input name="txt_id_denuncia" readonly="true"  type="number" value="<?php echo $ps->id_denuncia ?>" >

				<label for="fase">FASE</label>
					<select name="txt_fase" id="txt_fase">
						<option value=""><?php echo $ps->fase ?></option>
						<option value="1">Procedimento Preliminar</option>
						<option value="2">SINDICÂNCIA</option>
					</select> 

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="text" placeholder="Insira o número do processo" value="<?php echo $ps->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $ps->data_instauracao ?>">

				<label>Observação</label>
					<input name="txt_observacao" type="text" value="<?php echo $ps->observacao ?>">
	<?php } ?>

				<input type="submit" value="Salvar Alterações" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">
			</form>
		</div>	
</div>	
	