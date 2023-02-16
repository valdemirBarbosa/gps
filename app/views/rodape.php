<footer>
	Direitos reservados a @ValdemirBs
	<?php echo "Usuário Logado: ". ucfirst($_SESSION['nome']) ." | tempo online: ".$_SESSION['tempoOnLine']/24 . " segundos  |  Data: ".date("d/m/Y"); ?>
</footer>
