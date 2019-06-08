<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }

    public function index()
    {

        if($this->Model->session_admin() == true):


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

            $this->load->view('app/header',$array);
            $this->load->view('app/navigation',$array);
            $this->load->view('app/footer',$array);

        else:
        $this->load->view('login');
        endif;
    }
}
