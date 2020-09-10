<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    // ==================================================
    // controlador geral
    // ==================================================
    class Geral extends CI_Controller{
    
        // ==================================================
        public function index(){
            //verifica se existe sessão
            if($this->session->has_userdata('id_usuario')){
                //redireciona para o menu inicial da aplicação
                redirect('aplicacao');
            } else {
                //apresenta o quadro inicial da página
                $this->home();
            }            
        }

        // ==================================================
        public function home(){
            //apresenta o quadro de login
            if($this->session->has_userdata('id_usuario')){
                redirect('aplicacao');
            } else {
                $this->load->view('includes/inicio');
                $this->load->view('home');
                $this->load->view('includes/fim');
            }            
        }    
    }
?>