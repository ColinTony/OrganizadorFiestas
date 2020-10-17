<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            
            <h1 class="mt-4 text-gray-dark text-center"><?= 'Evento: '.$evento['0']['tipo'].' ('.$evento['0']['nombre'].')'?></h1>
            <h2 class="mt-4 text-success text-center"><?= 'Fecha: '.$evento['0']['fecha'].' -- Hora:'.$evento['0']['hora']?></h2>
            <h2 class="mt-4 text-primary text-center"><?= 'Menu: '.$evento['0']['menu']?></h1></h2>

            
            <table class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Mesa</th>
                  <th>Nombre</th>
                  <th>Apellido P.</th>
                  <th>Apellido M.</th>
                  <th>Correo</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($mesa1 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?> 
			    
			    <tr class="text-center">
			      <td colspan="5"><h1>Mesa 2</h1></td>
			    </tr>
			    <?php foreach ($mesa2 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?>
                <tr class="text-center">
			      <td colspan="5"><h1>Mesa 3</h1></td>
			    </tr>
			    <?php foreach ($mesa3 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?>
			    <tr class="text-center">
			      <td colspan="5"><h1>Mesa 4</h1></td>
			    </tr>
			    <?php foreach ($mesa4 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?>
			    <tr class="text-center">
			      <td colspan="5"><h1>Mesa 5</h1></td>
			    </tr>
			    <?php foreach ($mesa5 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?>
			    <tr class="text-center">
			      <td colspan="5"><h1>Mesa 6</h1></td>
			    </tr>
			    <?php foreach ($mesa6 as $row): ?>
	                <tr>
	                    <td><?php echo $row['numMesa']?></td>
	                    <td><?php echo $row['nombre']?></td>
	                    <td><?php echo $row['apeP']?></td>
	                    <td><?php echo $row['apeM']?></td>
	                    <td><?php echo $row['correo']?></td>
	                </tr>
                <?php endforeach; ?>
			  </tbody>
			</table>
			<div class="row">
				<form method="post" action="/dashboard/pdf">
					<div class="col-12 col-sm-4">
						<input type="hidden" name="idEvento" id="idEvento" value="<?= set_value("idEvento",$evento['0']['idEvento'])?>">
						<button type="submit" class="btn btn-primary">PDF</button>
                	</div>	
				</form>
				
                <div class="col-12 col-sm-8 text-right">
                	<a class="btn btn-danger" href="/dashboard/eventos">Volver</a>
               	</div>
            </div>
        </div>
    </main>