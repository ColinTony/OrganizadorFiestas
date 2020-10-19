<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h1>Eliga un horario entre 9:00 hrs y 23:00 hrs
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
             <div class="container-fluid">
                    <h3>Modificar invitado</h3>
                    <hr>
                    <form class="needs-validation" action="/dashboard/modificar_invitado" method="post">
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
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <div class="col-12 col-sm-1">
                                <a class="btn btn-danger" href="/">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </main>