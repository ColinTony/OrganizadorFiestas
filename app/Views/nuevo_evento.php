<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            
             <div class="container">
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
                                    <input type="hidden" class="form-control" placeholder="Ej: Proyecto X" name="nombre" id="nombre"  value="<?=set_value("idUsuario",$user['idUsuario'])?>">
                                    <div class="col">
                                        <label for="nombre">Nombre del evento</label>
                                        <input type="text" class="form-control" placeholder="Ej: Proyecto X" name="nombre" id="nombre"  value="<?=set_value("nombres")?>">
                                    </div>
                                    
                                    <div class="col">
                                        <label for='tipo'>Tipo de evento</label>
                                        <select class="form-control" id='tipo'>
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
                                        <input type="date" class="form-control" name="date" id="date" placeholder="Correo electronico" value="<?= set_value("date") ?>" >
                                    </div>
                                     <div class="col">
                                        <label for='hora'>Hora del evento</label>
                                        <input type="time" class="form-control" name="date" id="date" placeholder="Correo electronico" value="<?= set_value("date") ?>" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for="password_confirm">Menu</label>
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
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
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