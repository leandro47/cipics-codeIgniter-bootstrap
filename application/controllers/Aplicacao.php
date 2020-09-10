<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    // ==================================================
    // aplicação
    // ==================================================
    class Aplicacao extends CI_Controller{
    
        // ==============================================
        private function controlo(){
            //controla existência de sessão
            if(!$this->session->has_userdata('id_usuario')){
                redirect('geral');
            }
        }

        // ==============================================
        public function index(){
            $this->controlo();

            //apresenta o quadro inicial da aplicação
            $this->load->view('includes/inicio');
            $this->load->view('aplicacao/barra_usuario');

            //vai buscar todas as imagens que são públicas
            $this->load->model('aplicacao_model', 'aplicacao');
            $dados['fotos'] = $this->aplicacao->todas_fotos_publicas();
            $this->load->view('aplicacao/pagina_inicial', $dados);
            $this->load->view('includes/fim');
        }

        // ==============================================
        public function adicionar(){
            //adicionar uma nova foto
            $this->controlo();

            if($this->input->method() !== 'post'){
                //apresenta o formulário para carregar nova imagem
                $dados['erros'] = '';
                $this->load->view('includes/inicio');
                $this->load->view('aplicacao/barra_usuario');
                $this->load->view('aplicacao/adicionar_foto', $dados);
                $this->load->view('includes/fim');
                return;
            }

            //faz o upload da imagem
            //define as propriedades da biblioteca 'upload'
            $config['upload_path']          = './assets/fotos/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;

            //vai buscar os dados do ficheiro que pretende ser carregado
            $ficheiro= $_FILES["ficheiro_foto"]["name"];
            $ficheiro_original_sem_extensao = pathinfo($ficheiro, PATHINFO_FILENAME);
            $ficheiro_extensao = pathinfo($ficheiro,PATHINFO_EXTENSION);        

            //carrega o helper
            $this->load->helper('nome_ficheiro');
            $nome_foto_final = definir_nome_ficheiro($ficheiro_original_sem_extensao, $ficheiro_extensao);
            $config['file_name'] = $nome_foto_final;

            //carrega a biblioteca 'upload'
            $this->load->library('upload', $config);

            //tenta fazer o upload da imagem
            if($this->upload->do_upload('ficheiro_foto')){
                //guarda os dados na base de dados
                $this->load->model('aplicacao_model', 'aplicacao');

                //verifica se é para colocar pública
                $publica = true;
                if($this->input->post('check_publica') === null){
                    $publica = false;
                }

                //guarda a informação na base de dados
                $this->aplicacao->guardar_foto($nome_foto_final, $publica);

                //indica que a fotografia foi carregada com sucesso
                $this->load->view('includes/inicio');                
                $this->load->view('aplicacao/sucesso');
                $this->load->view('includes/fim');

            } else {
                //ocorreu um erro no carregamento da fotografia
                $this->load->view('includes/inicio');
                $dados['erros'] = $this->upload->display_errors();
                $this->load->view('aplicacao/erro',$dados);
                $this->load->view('includes/fim');
            }
        }

        // ==============================================
        public function minhas(){
            $this->controlo();

            //apresenta o quadro com as fotografias do usuário ativo
            $this->load->view('includes/inicio');
            $this->load->view('aplicacao/barra_usuario');

            //vai buscar todas as imagens que são públicas
            $this->load->model('aplicacao_model', 'aplicacao');
            $dados['fotos'] = $this->aplicacao->buscar_fotos_usuario();
            $this->load->view('aplicacao/minhas', $dados);
            $this->load->view('includes/fim');
        }

        // ==============================================
        public function eliminar($id){
            $this->controlo();
            
            //elimina a foto
            $this->load->model('aplicacao_model', 'aplicacao');
            $this->aplicacao->eliminar($id);
            $this->minhas();
        }

        // ==============================================
        public function privada($id){
            $this->controlo();

            //passa a foto de pública para privada
            $this->load->model('aplicacao_model', 'aplicacao');
            $this->aplicacao->mudar_para_privada($id);
            $this->minhas();
        }

        // ==============================================
        public function publica($id){
            $this->controlo();

            //passa a foto de privada para pública
            $this->load->model('aplicacao_model', 'aplicacao');
            $this->aplicacao->mudar_para_publica($id);
            $this->minhas();
        }
}