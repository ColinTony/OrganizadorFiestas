<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Bienvenido <?= session()->get('nombre') ?></h4>
              <p>Bienvenido a la pagina para organizar tus fiestas. Espero disfrutes de esta gran herramienta</p>
              <hr>
              <p class="mb-0">No olvides invitar a tus amigos</p>

            </div>
            <?php if(session()->get('mensaje') == '1'):?>
              <div class="alert alert-success" role="alert">
                <h4 class="alert-info">Bienvenido <?= session()->get('msg') ?></h4>
                <p>Bienvenido a la pagina para organizar tus fiestas. Espero disfrutes de esta gran herramienta</p>
                <hr>
                <p class="mb-0">No olvides invitar a tus amigos</p>
              </div>
            <?php endif;?>
        </div>
    </main>