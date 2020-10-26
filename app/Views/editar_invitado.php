 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
             <div class="container-fluid">
                    <h3>Editar invitado</h3>
                    <hr>
                    <form class="needs-validation" action="/dashboard/invitados/modificar/<?=$invitado['idInvitado'].'/'.$invitado['idEvento'].'/'.$invitado['numMesa']?>" method="post">
                        <input type="hidden" class="form-control" name="idEvento" id="idEvento" placeholder="idEvento" value="<?= set_value("idEvento",$invitado['idEvento']) ?>" required>
                        <input type="hidden" class="form-control" name="idUsuario" id="idUsuario" placeholder="idUsuario" value="<?= set_value("idUsuario",$user['idUsuario']) ?>" required>

                        
                            <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) del invitado" value="<?= set_value("nombre",$invitado['nombre']) ?>" required>
                            </div>
                            <div class="form-group">
                                    <label for="apeP">Apellido P.</label>
                                    <input type="text" class="form-control" name="apeP" id="apeP" placeholder="Apellido Paterno." value="<?= set_value("apeP",$invitado['apeP']) ?>" required>
                            </div>
                            <div class="form-group">
                                    <label for="apeM">Apellido M.</label>
                                    <input type="text" class="form-control" name="apeM" id="apeM" placeholder="Apellido Materno." value="<?= set_value("apeM",$invitado['apeM']) ?>" required>
                            </div>
                            <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="mailito@dominio.com" value="<?= set_value("email",$invitado['correo']) ?>" required>
                            </div>
                            <div class="form-group">
                                    <label for="mesa">Mesa</label>
                                    <select id="mesa" id='mesa' name="mesa" class="form-control" value="<?= set_value("mesa")?>">
                                        <option value="<?php $invitado['numMesa'] ?>"><?= $invitado['numMesa']?> </option>
                                        <option value="1">Mesa 1</option>

                                        <option value="2">Mesa 2</option>

                                        <option value="3">Mesa 3</option>

                                        <option value="4">Mesa 4</option>

                                        <option value="5">Mesa 5</option>

                                        <option value="6">Mesa 6</option>
                                    </select>
                            </div>
                        
                        <br>
                        <?php if(isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors(); ?>
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="row align-content-end">
                            <div class="col-6 col-sm-6">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <div class="col-6 col-sm-6">
                                <a class="btn btn-danger" href='/dashboard/eventos/invitados/<?=$invitado['idEvento']?>'>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </main>
