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


    public function changestatus(){
        if ($this->Model->session_admin() == true):

            $arr['status'] = $_POST['status'];
            $this->db->where('id',$_POST['item']);
            $this->db->update($_POST['table'],$arr);

            echo 11;
        endif;

        }

    public function deleteitens(){
        if ($this->Model->session_admin() == true):

            $this->db->from('menu_admin');
            $this->db->where('id',$_POST['table']);
            $get = $this->db->get();
            $menu_admin = $get->result_array()[0];


            $this->db->where('id',$_POST['item']);
            $this->db->delete($menu_admin['tabela']);

            echo 11;

        endif;

        }

    public function ProcessarForm(){
        if ($this->Model->session_admin() == true):



            $_POST = $this->Model->tratar_campos($_POST);

        $this->db->from('menu_admin');
        $this->db->where('id',$_POST['tabelaid']);
        $get = $this->db->get();
        $menu_admin = $get->result_array()[0];
        unset($_POST['tabelaid']);


        if(isset($_POST['iditem'])):

            $editid = $_POST['iditem'];
            unset($_POST['iditem']);
            $lastinsertbackup = 0;


                       $this->db->from($menu_admin['tabela']);
                       $this->db->where('id',$editid);
                       $get = $this->db->get();
                       $backuptable = $get->result_array()[0];


                       $backup['data_alterada'] = date('d/m/Y H:i:s');
                       $backup['id_admin'] = $_SESSION['ID_ADMIN'];
                       $backup['ip_alteracao'] = $_SERVER['REMOTE_ADDR'];


                       $explodedata = explode(',',$menu_admin['tb']);

                       $databackup = '';
                       for($n=0;$n<count($explodedata);$n++):

                           @$databackup .= '<<< <b>'.$explodedata[$n].': </b>'.$backuptable[$explodedata[$n]].' >>>,';

                       endfor;
                       $backup['sql_dump'] = $databackup;

                       $this->db->insert('beforedata',$backup);
                       $lastinsertbackup = $this->db->insert_id();

            $this->db->where('id',$editid);
            $this->db->update($menu_admin['tabela'],$_POST);

            $log['acao'] = 'Alterado dado com <b>ID '.$editid.'</b> na <b>tabela '.$menu_admin['tabela'].'</b>';
            $log['tipo_acao'] = 2;
            $log['beforedata'] = $lastinsertbackup;
            $log['id_admin'] = $_SESSION['ID_ADMIN'];
            $log['ip'] = $_SERVER['REMOTE_ADDR'];
            $log['data_up_admin'] = $_SESSION['ID_ADMIN'];
            $this->db->insert('log_admin',$log);

            echo 11;
        else:

        $this->db->insert($menu_admin['tabela'],$_POST);
        $lastinsert = $this->db->insert_id();


            $log['acao'] = 'Adicionado dado com <b>ID '.$lastinsert.'</b> na <b>tabela '.$menu_admin['tabela'].'</b>';
            $log['tipo_acao'] = 2;
            $log['id_admin'] = $_SESSION['ID_ADMIN'];
            $log['ip'] = $_SERVER['REMOTE_ADDR'];
            $log['data_up_admin'] = $_SESSION['ID_ADMIN'];
            $this->db->insert('log_admin',$log);

            echo 11;
        endif;



endif;

    }

    public function formFilds(){

        if ($this->Model->session_admin() == true):

        $return = '';

        $this->db->from('menu_admin');
        $this->db->where('id',$_POST['tabela']);
        $get = $this->db->get();

        $count = $get->num_rows();
        if(isset($_POST['edit'])):

            $class = 'form_'.$_POST['edit'];

        else:

            $class = 'form_';

        endif;

        if($count > 0):


        $menu = $get->result_array()[0];

        $campoexplode = explode(',',$menu['tb']);

            $return .= '<form method="post" action="javascript:saveForm();" id="'.$class.'">';
if(isset($_POST['edit'])):
            $return .= '<input type="hidden" name="iditem" value="'.$_POST['edit'].'">';
endif;
            $return .= '<input type="hidden" name="tabelaid" value="'.$_POST['tabela'].'">';
        for($i=0;$i<count($campoexplode);$i++):

if($campoexplode[$i] == 'nome' and $_POST['tabela'] == '30' or $campoexplode[$i] == 'nome' and $_POST['tabela'] == '31'):
    $campowidth = '95%';
elseif($campoexplode[$i] == 'conteudo'):
    $campowidth = '100%';

else:
        $campowidth = '30%';

endif;

            if($this->Model->TitleSearch($campoexplode[$i]) == true):
                $return .= $this->Model->TitleReplace($campoexplode[$i]);
                else:


                    if($campoexplode[$i] == 'permissoes' and isset($_SESSION['PERMISSAO_ADMIN']) and $_SESSION['PERMISSAO_ADMIN'] > 1):

                        $return .= '<input type="hidden" name="permissoes" value="'.$_SESSION['PERMISSAO_ADMIN'].'">';
                        else:

                    if(isset($_POST['edit'])):
                        $return .= $this->Model->campos_filtro($_POST['edit'],$campoexplode[$i],$_POST['tabela'],$campowidth);

                    else:
                        $return .= $this->Model->campos_filtro(0,$campoexplode[$i],$_POST['tabela'],$campowidth);

                    endif;

                    endif;
            endif;


        endfor;


            $return .= '</form>';
        echo ' <script>
    var editor = new FroalaEditor(\'#froala-editor\'); 
    
    $(document).ready(function() {
    $(\'select\').select2();
});    
  </script>';


        endif;
        echo $return;
endif;
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
                $this->load->view('painel/app/header',$array);
                $this->load->view('painel/app/navigation',$array);
                $this->load->view('painel/app/footer',$array);

            else:
                $this->load->view('painel/sys/data/ViewPost',$arr);
                $this->load->view('painel/sys/Ons/Js');

            endif;

            $this->load->view('painel/sys/Ons/addOns',$array);

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
                    $_SESSION['PERMISSAO_ADMIN'] = $result['permissoes'];
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
