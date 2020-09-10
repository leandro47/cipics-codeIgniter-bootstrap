<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>
<div class="container-fluid">
    <div class="d-flex">

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo site_url('aplicacao') ?>"><i class="fa fa-home mr-2"></i>Página inicial</a>
                <a class="dropdown-item" href="<?php echo site_url('aplicacao/adicionar') ?>"><i class="fa fa-plus-circle mr-2"></i>Adicionar Foto</a>
                <a class="dropdown-item" href="<?php echo site_url('aplicacao/minhas') ?>"><i class="fa fa-cog mr-2"></i>As minhas fotos</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('usuarios/logout') ?>"><i class="fa fa-sign-out mr-2"></i>Logout</a>
            </div>
        </div>

        <div class="align-self-center ml-3">
            <h4>
                <i class="fa fa-user mr-3"></i><span><?php echo $this->session->usuario ?></span>
            </h4>
        </div>
    </div>    
    <hr>
</div>