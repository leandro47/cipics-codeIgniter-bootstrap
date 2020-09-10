<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-sm-6 offset-3 col-8 offset-2">
            <div class="card p-4">
                <h3>Login</h3>
                <hr>

                <form action="<?php echo site_url('usuarios/login') ?>" method="post">

                <!-- erro -->
                <?php if(isset($erro)): ?>
                    <p class="alert alert-danger text-center"><?php echo $erro ?></p>
                <?php endif; ?>

                <div class="form-group">
                    <input  type="text" 
                            name="text_usuario" 
                            class="form-control" 
                            placeholder="Usuário" 
                            required
                            >
                </div>
                <div class="form-group">
                    <input  type="password" 
                            name="text_senha"
                            class="form-control" 
                            placeholder="Senha"
                            required
                            >
                </div>
                <div class="text-center">
                    <a href="<?php echo site_url('geral') ?>" class="btn btn-primary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>