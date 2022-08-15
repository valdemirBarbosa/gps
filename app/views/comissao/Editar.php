<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados da Comissão de Sindicância de Processos Administrativo</h1>
</div>

<div class="comissaoForm">
  <form enctype="multipart/form-data" action="<?php echo URL_BASE ."comissao/Salvar" ?>" method="POST">

  	<?php
	  	$view = "denuncia/Index";
		$_SESSION['view'] = $view;

		foreach($dados as $com){}
	?>
	
		<table>
			<tr>
				<th>id da portaria:</th>
				<th>número da portaria</th>
				<th>Data elaboração</th>

			</tr>	

			<tr>
				<td>
					<input tipe="value" value="<?php echo $com->id_portaria ?>">
				</td>	

				<td>
					<input autofocus name="num_portaria" value="<?php echo $com->numero_portaria ?>">
				</td>

				<td>
					<input autofocus name="data_elaboracao" value="<?php echo date("d/m/Y", strtotime($com->data_elaboracao)) ?>">
				</td>	
			</tr>

				<tr><td><div class="div"> <!--  dividir a tabela no meio dando espaço  --></div></td></tr>

				<tr>
				<th>Data início</th>
				<th>Data fim</th>
				<th>Assinante</th>
			</tr>

			<tr>

				<td>
					<input autofocus name="data_elaboracao" value="<?php echo date("d/m/Y", strtotime($com->data_vigencia)) ?>">
				</td>	

				<td>
					<input autofocus name="data_elaboracao" value="<?php echo date("d/m/Y", strtotime($com->data_fim_vigencia)) ?>">
				</td>	

				<td>
					<input autofocus name="data_elaboracao" value="<?php echo $com->assinatura_gestor ?>">
				</td>	
			</tr>	
							
<?php// } ?>
		</table>
</form>
</div>