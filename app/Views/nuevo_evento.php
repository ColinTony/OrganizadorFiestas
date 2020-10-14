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
             <div class="container" id="contenedor">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                        <div class="container">
                            <h3><?= 'Nuevo evento de '.$user['nombre'].' '.$user['apeP']?></h3>
                            <hr>
                            <?php if(session()->get('exito')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->get('exito') ?>
                                    </div>
                            <?php endif; ?>
                            <form class="needs-validation" action="/dashboard/newevento" method="post">
                                <div class="form-row">
                                    <input type="hidden" class="form-control" placeholder="Ej: Proyecto X" name="idUsuario" id="idUsuario"  value="<?=set_value("idUsuario",$user['idUsuario'])?>">
                                    <div class="col">
                                        <label for="nombre">Nombre del evento</label>
                                        <input type="text" class="form-control" placeholder="Ej: Proyecto X" name="nombre" id="nombre"  value="<?=set_value("nombres")?>">
                                    </div>
                                    
                                    <div class="col">
                                        <label for='tipo'>Tipo de evento</label>
                                        <select class="form-control" id='tipo' name="tipo" value="<?=set_value("tipo")?>">
                                            <option value="Graduacion">Graduación</option>
                                            <option value="Boda">Boda</option>
                                            <option value="Bautizo">Bautizo</option>
                                            <option value="XV años">XV años</option>
                                            <option value="Reunion familiar">Reunion familiar</option>
                                            <option value="Reunion de negocios">Reunion de negocios</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="date">Fecha del evento</label>
                                        <input type="date" class="form-control" name="date" id="date" min="<?= date("Y-m-d") ?>" placeholder="Correo electronico" value="<?= set_value("date") ?>" >
                                    </div>
                                     <div class="col">
                                        <label for='hora'>Hora (9:00:00hr - 24:00:00hr)</label>
                                        <input type="time" class="form-control" min="9:00:00" name="hora" id="hora" placeholder="Correo electronico" value="<?= set_value("hora") ?>" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for='menu'>Tipo de evento</label>
                                        <select class="form-control" id='menu' name ="menu" disabled="true">
                                            
                                        </select>
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
                                        <button type="submit" id="crear" name="crear" disabled="true" class="btn btn-primary">Crear evento</button>
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