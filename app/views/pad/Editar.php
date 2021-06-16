<div class="base-home">
		<h1 class="titulo"><span class="cor">Editar</span> Processo Administrativo Disciplinar - PAD </h1>
		<div class="base-formulario">	

		<span class="qtde">Há <b><?php  echo count($pad)?></b> processo preliminares e sindicâncias</span>

		<form action="<?php echo URL_BASE ."Pad/Salvar" ?>" method="POST">

		<?php foreach($pad as $pd){ ?>
				<label>Id do PAD</label>
					<input name="txt_id_pad" enable="false" value="<?php echo $pd->id_pad ?>" >

				<label>Id da denuncia</label>
					<input name="txt_id_denuncia"  enable="false" value="<?php echo $pd->id_denuncia ?>" >

				<label>id_pp_sindicancia</label>
				<input type="number" name="txt_id_pp_sindicancia" value="<?php echo $pd->id_pp_sindicancia ?>" >

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">

				<label>Observação</label>
					<input name="txt_observacao" type="text" value="<?php echo $pd->observacao ?>">

				<label>Anexo
					<input type="file" name="image[]" multiple="multiple" ></label>
		<?php } ?>

<!--			
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
!-->
				<input type="submit" value="Salvar Alterações" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">
			</form>
		</div>	
</div>	
	