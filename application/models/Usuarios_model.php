<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    // ==================================================
    // model Usuários
    // ==================================================
    class Usuarios_model extends CI_Model{
    
        // ==============================================
        public function signup_check_usuario(){
            //verifica se já existe um usuário com o mesmo nome ou email
            $usuario = $this->input->post('text_usuario');
            $email = $this->input->post('text_email');
            $resultados = $this->db->from('usuarios')
                                   ->where('usuario', $usuario)
                                   ->or_where('email', $email)
                                   ->get();
            return $resultados->num_rows() !== 0 ? true : false ;
        }

        // ==============================================
        public function signup_criar_conta(){
            //cria uma nova conta de usuario
            $dados = array(
                'usuario'   => $this->input->post('text_usuario'),
                'senha'     => md5($this->input->post('text_pass_1')),
                'email'     => $this->input->post('text_email')
            );
            $this->db->insert('usuarios', $dados);
        }
    

        // ==============================================
        public function verificar_login(){
            //verifica se os dados inseridos são os corretos para o login
            $dados = array(
                'usuario'   => $this->input->post('text_usuario'),
                'senha'     => md5($this->input->post('text_senha'))
            );
            $resultados = $this->db->from('usuarios')
                                   ->where($dados)
                                   ->get();
            if($resultados->num_rows() === 0){
                //login inválido
                return false;
            } else {
                //login válido

                //coloca os dados do usuários na sessão
                $this->session->set_userdata(
                    array(
                        'id_usuario'    => $resultados->row()->id_usuario,
                        'usuario'       => $resultados->row()->usuario,
                        'email'         => $resultados->row()->email
                    )
                );
                return true;
            }
        }
    }
?>