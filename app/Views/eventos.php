<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= 'Eventos de '.$user['nombre'].' '.$user['apeP']?></h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Eventos
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover container-fluid">
                        <table class="table table-bordered table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Evento</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Ver</th>
                                    <th>Modificar</th>
                                    <th>Invitados</th>
                                    <th>Organizar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row): ?>
                                    <tr>
                                        <td id="idEvento"><?php echo $row['idEvento']?></td>
                                        <td><?php echo $row['nombre']?></td>
                                        <td><?php echo $row['tipo']?></td>
                                        <td><?php echo $row['fecha']?></td>
                                        <td><?php echo $row['hora']?></td>
                                        <td><a href="<?='/dashboard/eventos/ver/'.$row['idEvento']?>"><button type="button" id="valor" class="btn btn-outline-success">Ver evento</button></a></td>
                                        <td><a href="<?='/dashboard/eventos/modificar/'.$row['idEvento']?>"><button type="button" class="btn btn-outline-primary">Modificar</button></a></td>
                                        <td><a href="<?='/dashboard/eventos/invitados/'.$row['idEvento']?>"><button type="button" class="btn btn-outline-warning">Invitados</button></a></td>
                                        <td><a href="<?='/dashboard/eventos/organizar/'.$row['idEvento']?>"><button type="button" class="btn btn-outline-secondary">Organizar</button></a></td>
                                        <td><a href="<?='/dashboard/eventos/elim/'.$row['idEvento']?>"><button type="button" class="btn btn-outline-danger">Eliminar</button></a></td>
                                    </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>