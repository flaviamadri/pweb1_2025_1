<?php
include "./db.class.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<?php

$db = new db('usuario');
$data= null;
$errors = [];
$sucess= '';

if (!empty($_POST)) {
    //função trim remove espaços em branco do inicio e fim da string
    if(empty(trim($_POST['nome']))){
        $errors[] = 'O nome é obrigatório';
    }

    if(empty(trim($_POST['email']))){
        $errors[] = 'O email é obrigatório';
    }

    if(empty(trim($_POST['cpf']))){
        $errors[] = 'O cpf é obrigatório';
    }

    if(empty(trim($_POST['telefone']))){
        $errors[] = 'O telefone é obrigatório';
    }

    if(empty($errors)){
        try{
            if (empty($_POST['id'])){
                $db->store(dados: $_POST);
                $success = "Registro criado com sucesso!";
            }else {
                $db->update(dados: $_POST);
                $success = "Registro atualizado sucesso!";
            }
            echo "<script>
            setTimeout(
                ()=> window.location.href = 'UsuarioList.php', 1500
                ) </script>";
        }catch (Exception $e){
            $errors[] = "Erro ao salvar: " . $e->getMessage();
        }
    }

    if (empty($_POST['id'])) {

        $db->store($_POST);
        header('location:./UsuarioList.php');
    } else {

        $db->update($_POST);
        header('location:./UsuarioList.php');
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

//serve para depurar o codigo, ver o que tem dentro da variavel
//var_dump(value: $data);
//para a execução do codigo na linha onde foi colocada
//exit;

?>

<body>

    <div class="container mt-5">

        <div class="row">
        <?php if(!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                    <li> 
                        <?php foreach($errors as $error) { ?>
                            <? $error ?>
                            <?php } ?>
                </li>
                    </ul>
                    </div>
            <?php } ?>

            <?php if(!empty($success)) { ?>
                <div class="alert alert-success">
                    <strong> 
                        <?= $success ?>
                </strong>
            
            <?php } ?>

            <h3 style="margin-top: 100px;">Formulário Usuário</h3>
            <!-- http://localhost/pweb1_2025_1/php/site/admin/UsuarioForm.php -->
            <form action="" method="post">

                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                <div class="row">

                    <div class="col-md-6">
                        <label for="" class="form-label">Nome</label>
                        <input type="text" name="nome" value="<?php $data->nome ?? '' ?>" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" value="<?php $data->email ?? '' ?>" class="form-control">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">CPF</label>
                        <input type="text" name="cpf" value="<?php $data->cpf ?? '' ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Telefone</label>
                        <input type="text" name="telefone" value="<?php $data->telefone ?? '' ?>" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-primary"> <?= !empty($_GET['id'])? "Editar" : "Salvar" ?>
                        </button>
                        <a href="./UsuarioList.php" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>

            </form>

        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

</body>

</html>