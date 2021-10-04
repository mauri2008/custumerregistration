<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Projeto AMZ|MP</title>

    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
    <!-- JS BOOTSTRAP -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- FONTAWESOME -->
    <link href="<?= base_url('assets/fontawesome/css/all.css')?>" rel="stylesheet"> 

</head>
<body>
	<div id="base_url" class="d-none" data-url='<?= base_url()?>'></div>
    <div class="container">
		<div class=" d-flex justify-content-between mt-5">
			<h5> Cadastro de Clientes</h5>
			<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modaldefault"><i class="fas fa-plus"></i> Novo Cliente</button>
		</div>

		<div class="row mt-5">
			<?php if(count($clients->getResult()) > 0): ?>
			<ul class="list-group">
				<?php foreach($clients->getResult() as $client):?>
					<li class="list-group-item d-flex justify-content-between">
						<span><?= $client->client_name?></span>
						<div>
							<span class="text-warning" title="Editar Cliente" onclick="handleEdit(<?= $client->client_id?>,'<?= $client->client_name?>')" data-bs-toggle="modal" data-bs-target="#modaldefault" style="cursor: pointer;"><i class="far fa-edit me-3"></i></span>
							<span class="text-danger" title="Remover cliente" onclick="handleRemove(<?= $client->client_id?>)" style="cursor: pointer;"><i class="far fa-trash-alt me-3"></i></span>
						</div>
					</li>
				<?php endforeach;?>
			</ul>
			<?php else: ?>
				<h5>Nenhum cliente encontrado!</h5>
			<?php endif; ?>
		</div>
    </div> 
	
	
	<!-- modal -->

	<div class="modal fade" id="modaldefault" tabindex="-1" aria-labelledby="modaldefaultLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modaldefaultLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form_client">
					<input type="hidden" name="client_id" id="client_id">
					<div class="mb-3">
					  <label for="client_name"><small> Nome do cliente</small> </label>
					  <input type="text" class="form-control mt-2" name="client_name" id="client_name" aria-describedby="helpId" placeholder="Informe nome do cliente">
					  <div id="emailHelp" class="form-text text-danger d-none">*Informe nome do cliente.</div>
					</div>
				</form>
			</div>
			<div class="modal-footer"> 
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="btn-save">Salvar</button>
			</div>
			</div>
		</div>
	</div>

	<!-- Toast -->
	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 99999999">
		<div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">

			<div class="toast-body" id="msg-notification">

			Hello, world! This is a toast message.
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets/js/action.js')?>"></script>
</body>
</html>