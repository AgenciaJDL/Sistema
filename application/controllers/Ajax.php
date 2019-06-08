<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }


    public function NavegacaoView(){
        if ($this->Model->session_admin() == true):

            $this->db->from('administrador');
            $this->db->where('id',$_SESSION['ID_ADMIN']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];


            $this->db->from('menu_admin_categorias');
            $this->db->where('status',1);
            $this->db->order_by('ordem','desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();




            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;
            $array['pedido_resumo_diario'] = array([
                "total_pedidos" => "147",
                "total_intencoes" => "28",
                "pedidos_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','pedidos',1547,645),
                "intencoes_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','intencoes',154,28),

            ]);



            $arr['post'] = $_POST;


            if($_POST['campo'] == 0):
                $this->load->view('app/header',$array);
                $this->load->view('app/navigation',$array);
                $this->load->view('app/footer',$array);

            else:
                $this->load->view('sys/data/ViewPost',$arr);
                $this->load->view('sys/Ons/Js');

            endif;

            $this->load->view('sys/Ons/addOns',$array);

            else:

            echo 'reload_action';
        endif;

        }
    public function logout()
    {
        $log_update['data_saida'] = date('d/m/Y H:i:s');
        $this->db->where('id', $_SESSION['ID_LOG']);
        $this->db->update('log_admin', $log_update);


        unset($_SESSION['ID_ADMIN']);
        unset($_SESSION['USER_ADMIN']);
        unset($_SESSION['ID_LOG']);
        unset($_SESSION['IP_ADMIN']);
        unset($_SESSION['EMAIL_ADMIN']);
        unset($_SESSION['PASS_ADMIN']);
        echo 11;
    }

    public function login()
    {
        try {

            if ($this->Model->session_admin() == true):

                echo 'O usuario já está logado!';

            else:

                $this->db->from('administrador');
                $this->db->where('user', $_POST['user']);
                $this->db->where('pass', md5($_POST['pass']));
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    $result = $get->result_array()[0];


                    $update['ultimo_acesso'] = date('d/m/Y H:i:s');
                    $this->db->where('id', $result['id']);
                    $this->db->update('administrador', $update);


                    $log['id_admin'] = $result['id'];
                    $log['acao'] = 'ADMINISTRAÇÃO -  Login: USUARIO: '.$_POST['user'].' || SENHA: *********';

                    $log['ip'] = $_SERVER['REMOTE_ADDR'];
                    $log['data_entrada'] = date('d/m/Y H:i:s');
                    $this->db->insert('log_admin', $log);


                    $_SESSION['ID_LOG'] = $this->db->insert_id();
                    $_SESSION['ID_ADMIN'] = $result['id'];
                    $_SESSION['USER_ADMIN'] = $result['user'];
                    $_SESSION['IP_ADMIN'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['EMAIL_ADMIN'] = $result['email'];
                    $_SESSION['PASS_ADMIN'] = $result['pass'];

                    echo 11;

                else:


                    $log['acao'] = 'ADMINISTRAÇÃO - Tentativa de Login: USUARIO: '.$_POST['user'].' || SENHA: '.$_POST['pass'].'';
                    $log['ip'] = $_SERVER['REMOTE_ADDR'];
                    $log['data'] = date('d/m/Y H:i:s');
                    $this->db->insert('log_erros', $log);


                    echo 'Usuario ou Senha Incorretos';

                endif;
            endif;

        } catch (Exception $e) {
            echo 'Ocorreu um erro no Sistema';
        }


    }


}
