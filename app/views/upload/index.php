		<?php 
        //$view = "denuncia/index"; 
        
        $id_denuncia = isset($id_da_denuncia) ? $id_da_denuncia : 0;
        if(isset($processo)){
            foreach($processo as $p){
                @$id_processo = $p->id_processo;
                @$id_fase = $p->id_fase;
            }
        }

        if(isset($id_denuncia) && $id_denuncia > 0){
            echo '<div class="base-home">
		    <h1 class="titulo-pagina">Denúncia - upload</h1>
    	    </div>';
    ?>

    <!-- Formulário com os dados da denúncia onde serão anexados os arquivos -->
		<div class="EditarDenuncia">

		<br>
		<fieldset>
		<legend>Dados da denuncia</legend>
		<table>
			<tr>
				<th>numero documento</th>
				<th>tipo documento</th>
				<th>data de entrada</th>
			</tr>

            <tr>
			<td><input type="text" value="<?php echo $denuncia->numero_documento ?>" name="numero"></td>
			<td>	<label>tipo documento </label>
						<input value="<?php echo $denuncia->tipo_de_documento ?>" >
				</td>
				<td><input type="date" value="<?php echo $denuncia->data_entrada ?>"></td>
			</tr>   
		</table>

        <!-- Formulário para  upload -->
       <form class="upload" method="POST" enctype="multipart/form-data" action="<?php echo  URL_BASE . "Upload/recebedor" ?>">
            <fieldset><legend>Upload de arquivo</legend>
                <input type="file" name="arquivo">
                <label>Descrição do arquivo</label>
                <input class="descricao" type="text" autofocus name="descricao" required>
                <input type="submit" name="Anexar" value="Anexar">
                <input type="hidden" name="view" value="<?php echo $view ?>">
                <input type="hidden" name="id_denuncia" value="<?php echo $id_denuncia ?>">
            </fieldset>
        <br><br>
   </form>

<?php
    if(isset($arquivo)){?>
       <form method="POST" enctype="multipart/form-data" action="<?php echo  URL_BASE . "Upload/excluir" ?>">
            <fieldset>
                <legend>Arquivos anexados</legend>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Arquivo</th>
                            <th>Descrição</th>
                            <th>data inclusão</th>
                            <th colspan="2">Ação</th>
                        </tr>
                        <?php
                            foreach($arquivo as $arq){
                        ?>
                            <tr>
                                <td><?php echo  $arq->id_upload  ?></td>
                                <td><?php echo  $arq->arquivo  ?></td>
                                <td><?php echo  $arq->descricao  ?></td>
                                <td><?php echo  date("d/m/Y", strtotime($arq->data_inclusao)) ?></td>

		                <!-- DOWNLOAD DE ARQUIVOS  !-->
                        <?php
                            $caminho = $arq->caminho;
                            $arquivo = $arq->arquivo;
                            
                        ?>

                        <td> 
<!--                            <a href="<?php echo $caminho . $arquivo ?>" download>baixar </a> 
                            <a href="<?php echo URL_BASE . 'downloads/?path='.$caminho.'&file='.$arquivo ?>"> download> baixar </a>
-->
                            <a href="<?php echo URL_BASE . 'downloads/?path='.$caminho.'&file='.$arquivo ?>" download="<?php echo $arquivo ?>">Baixar </a>

</td>
                        <td><input type="submit" value="Excluir"></td>
                            <input type="hidden" name="id_denuncia" value="<?php echo $id_denuncia ?>">
                            <input type="hidden" name="id_upload" value="<?php echo $arq->id_upload ?>">
                    </tr>
                    <?php } ?>
                </table>
            </fieldset>


        <?php }
        
        ?>
        
            </fieldset>

<?php

        }else{
            echo '<div class="base-home">
		    <h1 class="titulo-pagina">Processo - upload</h1>
    	    </div>';
            
        echo "<br><br>";
?>
 <!-- Formulário com os dados do processo onde serão anexados os arquivos -->
    <div class="EditarDenuncia">
<!-- Formulário para  upload -->
<form class="upload" method="POST" enctype="multipart/form-data" action="<?php echo  URL_BASE . "Upload/recebedor" ?>">

<br>
<fieldset>
<legend>Dados do Processo</legend>
<table>
    <tr>
        <th>numero do proceso</th>
        <th>fase</th>
        <th>data de entrada</th>
    </tr>

    <?php 
        if(isset($processo)){
            foreach($processo as $p){}
        }
    ?>
    <tr>
    <td><input type="text" value="<?php echo $p->numero_processo ?>" name="numero_processo"></td>
    <td>	<label>fase</label>
                <input value="<?php echo $p->fase ?>" >
        </td>
        <td><input type="date" value="<?php echo $p->data_instauracao ?>"></td>
    </tr>   
</table>

    <fieldset><legend>Upload de arquivo</legend>
        <input type="file" name="arquivo">
        <label>Descrição do arquivo</label>
        <input class="descricao" type="text" autofocus name="descricao" required>
        <input type="submit" name="Anexar" value="Anexar">
        <input type="hidden" name="view" value="<?php echo $view ?>">
        <input type="hidden" name="id_processo" value="<?php echo $id_processo ?>">
        <input type="hidden" name="id_fase" value="<?php echo $id_fase ?>">
    </fieldset>
<br><br>
</form>

<?php
if(isset($arquivo)){?>
<form method="POST" action="<?php echo  URL_BASE . "Upload/excluir" ?>">
    <fieldset>
        <legend>Arquivos anexados</legend>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Arquivo</th>
                    <th>Descrição</th>
                    <th>data inclusão</th>
                    <th colspan="2">Ação</th>
                </tr>
                <?php
                    foreach($arquivo as $arq){
                ?>
                    <tr>
                        <td><?php echo  $arq->id_upload  ?></td>
                        <td><?php echo  $arq->arquivo  ?></td>
                        <td><?php echo  $arq->descricao  ?></td>
                        <td><?php echo  date("d/m/Y", strtotime($arq->data_inclusao)) ?></td>

                <!-- DOWNLOAD DE ARQUIVOS  !-->
                <?php
                    $caminho = $arq->caminho;
                    $arquivo = $arq->arquivo;
                ?>

                <td> 
                            <a href="<?php echo URL_BASE . 'downloads/?path='.$caminho.'&file='.$arquivo ?>" download>Baixar </a>
                </td>
                <td><input type="submit" value="Excluir"></td>
                    <input type="hidden" name="id_processo" value="<?php echo $id_id_processo ?>">
                    <input type="hidden" name="id_upload" value="<?php echo $arq->id_upload ?>">
            </tr>
            <?php } ?>
        </table>
    </fieldset>


<?php }
        }
    

?>

    </fieldset>
