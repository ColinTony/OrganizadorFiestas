<!DOCTYPE html>
<html lang="en">
<?php
include 'templates/module_head.php';
?>

<body id="page-top">
    <?php
    include 'templates/module_nav_inicial.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">
                    <h3>Login</h3>
                    <hr>
                    <?php if(session()->get('exito')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('exito') ?>
                        </div>
                    <?php endif; ?>
                    <form class="needs-validation" action="/login" method="post">
                        <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario" value="<?= set_value("usuario") ?>" required>
                        </div>
                        <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña" id="password" value="<?= set_value("password") ?>" required>
                        </div>
                        <?php if(isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors(); ?>
                                </div>
                            </div>
                        <?php endif;?> 
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                            <div class="col-12 col-sm-8 text-right">
                                <a class="btn btn-danger" href="/">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'templates/module_scripts.php';
    ?>
</body>

</html>