<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= 'Invitados de '.$user['nombre'].' '.$user['apeP']?></h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Eventos
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mesa</th>
                                    <th>Nombre</th>
                                    <th>Apellido P.</th>
                                    <th>Apellido M.</th>
                                    <th>Correo</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row): ?>
                                    <tr>
                                        <td><?php echo $row['numMesa']?></td>
                                        <td><?php echo $row['nombre']?></td>
                                        <td><?php echo $row['apeP']?></td>
                                        <td><?php echo $row['apeM']?></td>
                                        <td><?php echo $row['correo']?></td>
                                        <td><a href="<?='/dashboard/invitados/modificar/'.$row['idInvitado'].'/'.$idEvento.'/'.$row['numMesa']?>">
                                            <button type="button" id="valor" class="btn btn-outline-info">Modificar</button></a></td>
                                        <td><a href="<?='/dashboard/invitados/elim/'.$row['idInvitado'].'/'.$idEvento?>">
                                            <button type="button" id="valor" class="btn btn-outline-danger">Eliminar</button></a></td>
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                 <div class="container-fluid">
                    <h3>Nuevo invitado</h3>
                    <hr>
                    <form class="needs-validation" action="/dashboard/nuevo_invitado" method="post">
                        <input type="hidden" class="form-control" name="idEvento" id="idEvento" placeholder="idEvento" value="<?= set_value("idEvento",$idEvento) ?>" required>
                        <input type="hidden" class="form-control" name="idUsuario" id="idUsuario" placeholder="idUsuario" value="<?= set_value("idUsuario",$user['idUsuario']) ?>" required>

                        <div class="row">
                            <div class="col">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) del invitado" value="<?= set_value("nombre") ?>" required>
                            </div>
                            <div class="col">
                                    <label for="apeP">Apellido P.</label>
                                    <input type="text" class="form-control" name="apeP" id="apeP" placeholder="Apellido Paterno." value="<?= set_value("apeP") ?>" required>
                            </div>
                            <div class="col">
                                    <label for="apeM">Apellido M.</label>
                                    <input type="text" class="form-control" name="apeM" id="apeM" placeholder="Apellido Materno." value="<?= set_value("apeM") ?>" required>
                            </div>
                            <div class="col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="mailito@dominio.com" value="<?= set_value("email") ?>" required>
                            </div>
                            <div class="col">
                                    <label for="mesa">Mesa</label>
                                    <select id="mesa" id='mesa' name="mesa" class="form-control" value="<?= set_value("mesa")?>">
                                        <option value="1">Mesa 1</option>

                                        <option value="2">Mesa 2</option>

                                        <option value="3">Mesa 3</option>

                                        <option value="4">Mesa 4</option>

                                        <option value="5">Mesa 5</option>

                                        <option value="6">Mesa 6</option>
                                    </select>
                            </div>
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
                            <div class="col-12 col-sm-1">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                            <div class="col-12 col-sm-1">
                                <a class="btn btn-danger" href="/dashboard/eventos">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>