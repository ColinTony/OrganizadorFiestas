<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            
             <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                        <div class="container">
                            <h3><?= $user['nombre'].' '.$user['apeP']?></h3>
                            <hr>
                            <?php if(session()->get('exito')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->get('exito') ?>
                                    </div>
                            <?php endif; ?>
                            <form class="needs-validation" action="/dashboard/perfil" method="post">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="nombres">Nombre(s)</label>
                                        <input type="text" class="form-control" placeholder="Nombre(s)" name="nombres" id="nombres"  value="<?=set_value("nombres",$user['nombre'])?>">
                                    </div>
                                    <div class="col">
                                        <label for="apeP">A.Paterno</label>
                                        <input type="text" class="form-control" name="apeP" id="apeP" placeholder="Apellido paterno" value="<?=set_value("apeP",$user['apeP'])?>">
                                    </div>
                                    <div class="col">
                                        <label for="apeM">A.Materno</label>
                                        <input type="text" class="form-control" name="apeM" id="apeM" placeholder="Apellido materno" value="<?=set_value("apeM",$user['apeM'])?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for="tel">Telefono</label>
                                        <input type="text" class="form-control" name="tel" id="tel" placeholder="5555555555"  value="<?=set_value("tel",$user['tel'])?>">
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" value="<?= set_value("email",$user['correo']) ?>" >
                                    </div>
                                    <div class="col">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña" id="password" value="<?= set_value("password") ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario" value="<?= set_value("usuario",$user['usuario']) ?>" >
                                </div>
                                <div class="form-group">
                                        <label for="password_confirm">Confirmar contraseña</label>
                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmar contraseña" value="" >
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
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                    <div class="col-12 col-sm-8 text-right">
                                        <a class="btn btn-danger" href="/dashboard">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>