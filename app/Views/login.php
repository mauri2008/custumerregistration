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
    <div class="container-page ">

            <div class="form-container">
                <div class=" d-flex justify-content-center flex-column">
                    <img src="<?= base_url('assets/image/logo.png')?>" class="img-fluid m-auto" alt="Logo tipo ">
                    <div class="card mt-2">
                        <div class="card-body form-content">
                            <h4 class="text-center m-0">Bem-vindo</h4>
                            <small class="form-subtitle text-center">Entre com suas credenciais para acessar sua conta.</small>
                            <?php if(isset($validation))echo '<div class="form-alert">'.implode("<br>",$validation).'</div>'?>
                            <form action="<?= base_url('signin')?>" method="POST">
                                <?= csrf_field()?>
                                <div class="input-group flex-nowrap mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user text-primary"></i></span>
                                    <input type="text" name="user_username" class="form-control" placeholder="Usuário" aria-label="Usuário" aria-describedby="addon-wrapping" required>
                                </div>
                                <div class="input-group flex-nowrap mb-4">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock text-primary"></i></span>
                                    <input type="password" name="user_password" class="form-control" placeholder="Senha" aria-label="Senha" aria-describedby="addon-wrapping" required>
                                </div>
        
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Entrar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


    </div>  
</body>
</html>