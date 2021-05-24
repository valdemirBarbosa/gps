<div="base-home">
<script src="<?php echo URL_BASE . "assets/js/funcoes.js" ?>" ></script>
	<h1 class="titulo"><span class="cor">Lista de</span> denuncia</h1>
<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($denuncia) ?></b> denuncia(s) cadastrada(s)</span>
	<div class="btn-inc"><a href="<?php echo URL_BASE . "denuncia/novo" ?>" >INCLUIR </a></div>

		<form action="<?php echo URL_BASE . "denuncia/Salvar"?>" method="post" >
			<?php foreach($denuncia as $d){   ?>
				<label width="5%" align="left">id</label>
				<input name="txt_id" type="number" align="center" value="<?php echo $d->id_denuncia  ?>" />

				<label width="22%" align="left">NOME DO DENUNCIANTE</label><br/>
				<input name="txt_nome_denunciante" type="text" value="<?php echo  $d->nome_denunciante ?>" />

				<label width="10%" align="left">tipo documento</label><br/>
				<input name="txt_tipo_documento"  type="text" value="<?php echo $d->tipo_documento  ?>" />

				<label width="8%" align="center">número</label><br/>
				<input name="txt_numero_documento" type="number"align="center" value="<?php echo $d->numero_documento  ?>" />

				<label width="10%" align="left">data de entrada</label><br/>
				<input name="txt_data_entrada" id="dataMask" type="text" onkeydown="formataData()" value="<?php echo date('d/m/Y', strtotime($d->data_entrada)) ?>" />
				
				<label width="15%" align="left">observação</label><br/>
				<input name="txt_observacao" type="textarea> value="<?php echo $d->observacao  ?>" /><br/><br/>

				<label width="10%" colspan="2" align="center">Ação</label>
				<?php }   ?>
				
				<input type="submit" value="alterar" class="btn-inc" /> 
		</form>	
		
			  <tbody>
			  	<?php foreach($denuncia as $d){   ?>
				<tr class="cor1">

				<input align="center">
					<a href="<?php echo URL_BASE ."denuncia/Edit/".$d->id_denuncia ?>" class="btn">Editar</a>
				</input>
				<input align="center">
					<a href="<?php echo URL_BASE ."denuncia/Excluir/".$d->id_denuncia ?>" class="btn excluir">excluir</a>
				</input>
			 </tr>	
			 <?php } ?>									  

		  	</tbody>
</div>					
</div>
</div>

</body>
</html>