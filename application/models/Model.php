<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }

    public function tratar_campos($post)
    {

        if (isset($post['pass'])):
            $post['pass'] = md5($post['pass']);
        endif;


        return $post;
    }

    public function newbuttomtable($post)
    {

        $return = '';

        $this->db->from('menu_admin');
        $this->db->where('id', $post['campo']);
        $get = $this->db->get();
        $count = $get->num_rows();

        if ($count > 0):
            $result = $get->result_array()[0];


            if (!empty($result['condicao'])):

                $explode = explode(',', $result['condicao']);


                if (!empty($explode[0]) and !empty($explode[1]) and $explode[0] == 'tipo'):

                    $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ',' . $explode[1] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';

                else:

                    $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';

                endif;


            else:

                $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';

            endif;


            $return .= ' <a href="javascript:deletetudo();" class="btn btn-danger removeallselects disabled"><i class="fa fa-trash"></i> DELETAR SELECIONADOS</a>';


            $return .= '<div class="clearfixs"></div>';
            $return .= '<br>';


        endif;

        return $return;

    }


    public function recupera_fields($arr, $id)
    {


        $this->db->select('' . $arr['sel'] . '');
        $this->db->from('' . $arr['t1'] . '');
        $this->db->where('id', $id);
        $get = $this->db->get();
        $menu_admin = $get->result_array()[0];

        $this->db->from('' . $arr['t2'] . '');
        $this->db->where('id', $menu_admin[$arr['sel']]);
        $get = $this->db->get();
        $result = $get->result_array();


        return $result;

    }


    //Inicio Tables Admin Funções

    public function rowstbodyViewAdmin($arr)
    {

        $this->db->from('administrador');
        $this->db->where('status', 1);
        $this->db->where('id', $_SESSION['ID_ADMIN']);
        $get = $this->db->get();
        $administrador = $get->result_array()[0];

        $this->db->select('tabela,condicao,th');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();

        $explodeCond1 = explode('(//)', $menu_admin[0]['condicao']);
        $this->db->from('' . $menu_admin[0]['tabela'] . '');

        if (!empty($menu_admin[0]['condicao'])):
            for ($i = 0; $i < count($explodeCond1); $i++):
                $explodeCond2 = explode(',', $explodeCond1[$i]);
                $this->db->where($explodeCond2[0], $explodeCond2[1]);
            endfor;
        endif;


        $this->db->order_by('id', 'desc');
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):
            $result = $get->result_array();

            foreach ($result as $value) {

                if ($arr['campo'] == 2):

                    if ($value['permissoes'] >= $administrador['permissoes']):
                        echo $this->tbodyViewAdmin($menu_admin[0]['tabela'], $arr, $value);
                    endif;
                else:
                    echo $this->tbodyViewAdmin($menu_admin[0]['tabela'], $arr, $value);

                endif;
            }
        endif;
    }

    public function tbodyViewAdmin($table, $arr, $value)
    {
        $return = '';
        $this->db->select('th,response');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();
        $forExplode = explode(',', $menu_admin[0]['th']);
        $return .= '<tr id="' . $value['id'] . '" lang="dsa">';
        for ($i = 0; $i < count($forExplode); $i++):
            if (trim($forExplode[$i]) == 'acoes'):

                $styletd = 'style="text-align:center!important;"';

            else:

                $styletd = '';

            endif;

            if($arr['campo'] == '34' and $value['id'] == 34):

                else:

            if ($i == 0):
                $return .= '<td ' . $styletd . ' onclick="addSelect(' . $value['id'] . ');">' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

            else:
                $return .= '<td ' . $styletd . '>' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

            endif;

            endif;

        endfor;
        $return .= '</tr>';
        return $return;
    }


    public function theadViewAdmin($arr)
    {
        $return = '';
        $this->db->select('th');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();
        $forExplode = explode(',', $menu_admin[0]['th']);
        $return .= '<tr>';
        for ($i = 0; $i < count($forExplode); $i++):
            $return .= '<th style="text-align: center;">' . $this->tabela_filtro(trim($forExplode[$i])) . '</th>';
        endfor;
        $return .= '</tr>';
        return $return;
    }

    //Fim Tables Admin Funções


    public function frases_motivacionais()
    {
        return 'As pessoas costumam dizer que a motivação não dura sempre. Bem, nem o efeito do banho, por isso recomenda-se diariamente.';
    }


    public function notificacoes()
    {

        $return = '<br><a class="media add-tooltip" style="text-align: center!important;padding: 10px;">Nenhuma Notificação a Exibir</a>';
        /*
        $return = ' <li>
                                            <a href="#" class="media add-tooltip" data-title="Used space : 95%" data-container="body" data-placement="bottom">
                                                <div class="media-left">
                                                    <i class="demo-pli-data-settings icon-2x text-main"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-nowrap text-main text-semibold">HDD is full</p>
                                                    <div class="progress progress-sm mar-no">
                                                        <div style="width: 95%;" class="progress-bar progress-bar-danger">
                                                            <span class="sr-only">95% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>';
*/

        return $return;
    }

    public function usages($usage)
    {
        $return = '';

        $arr['usage'] = $usage;

        $this->load->view('painel/sys/data/usages', $arr);

        return $return;

    }

    public function cols_sm($cols, $size)
    {
        $return = '';

        $arr['coluna'] = $cols;
        $arr['size'] = $size;

        $this->load->view('painel/sys/data/charts', $arr);

        return $return;


    }

    public function charts($data, $view, $template, $arrs)
    {


        $return = '';


        $arr['template'] = $template;
        $arr['sys'] = $arrs[0];


        $this->load->view('painel/sys/data/' . $view, $arr);


        return $return;

    }


    public function monitor_rodape()
    {


        return '<div class="mainnav-widget">

                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>

                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                            <ul class="list-group">
                                <li class="list-header pad-no mar-ver">Metas & Acessos</li>
                                <li class="mar-btm">
                                    <span class="label label-primary pull-right">5%</span>
                                    <p>Meta Diária</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-primary" style="width: 5%;">
                                            <span class="sr-only">5%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mar-btm">
                                    <span class="label label-purple pull-right">120</span>
                                    <p>Acessos</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                            <span class="sr-only">0</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">Alterar Parâmetros </a></li>
                            </ul>
                        </div>
                    </div>';
    }


    public function porcentagem_compara_dias($area_de_atuacao, $tipo, $dec_primario, $dec_secundario)
    {


        $return = 0;

        if ($area_de_atuacao == 'pedidos'):


            if ($tipo == 'pedidos'):


                if ($dec_secundario > $dec_primario):

                    $return = 100;

                else:

                    $return = (100 - intval(((($dec_primario - $dec_secundario) / $dec_primario) * 100)));
                endif;
            elseif ($tipo == 'intencoes'):

                if ($dec_secundario > $dec_primario):

                    $return = 100;

                else:

                    $return = (100 - intval(((($dec_primario - $dec_secundario) / $dec_primario) * 100)));
                endif;
            endif;

        endif;

        return $return;

    }

    public function menu_admin($arr, $ordem)
    {

        $return = '';

        $this->db->from('administrador');
        $this->db->where('id', $_SESSION['ID_ADMIN']);
        $get = $this->db->get();
        $administrativo = $get->result_array()[0];


        if ($arr['has_sub'] > 0):

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            $this->db->where('status', 1);
            $get = $this->db->get();
            $resultmen = $get->result_array();

            $this->db->from('menu_admin');
            $this->db->where('status_menu', 1);
            $this->db->where('status', 1);
            $this->db->where('sub_id', $arr['id']);
            if ($administrativo['permissoes'] <> 1):
                $this->db->where('tipo_painel>=', $administrativo['permissoes']);
                $this->db->or_where('tipo_painel', 1);
                $this->db->where('status_menu', 1);
                $this->db->where('status', 1);
                $this->db->where('sub_id', $arr['id']);
            endif;

            $this->db->order_by('ordem', 'desc');
            $get = $this->db->get();

            $menu_subs_count = $get->num_rows();

            $menu_subs = $get->result_array();
            $menu_sub_itens = '';
            foreach ($menu_subs as $value) {
                if ($this->db->table_exists('' . $value['tabela'] . '')):
                    $menu_sub_itens .= '<li ><a href="javascript:view(1,' . $value['id'] . ');">' . $value['nome'] . '</a></li>';
                else:
                    $menu_sub_itens .= '<li ><a href="javascript:alerts(\'Table Não Encontrada no Banco de Dados\');">' . $value['nome'] . '</a></li>';

                endif;
            }


            if ($ordem == 0):
                $class = 'class="active-sub"';
            else:
                $class = '';
            endif;

            if ($menu_subs_count > 0):
                $arrow = '<i class="arrow"></i>';
            else:
                $arrow = '';
            endif;
            if (!empty($resultmen[0]['tipo_painel'])):

                $this->db->from('menu_admin');
                $this->db->where('status_menu', 1);
                $this->db->where('status', 1);
                $this->db->where('sub_id', $arr['id']);
                if ($administrativo['permissoes'] <> 1):
                    $this->db->where('tipo_painel>=', $administrativo['permissoes']);
                    $this->db->or_where('tipo_painel', 1);
                    $this->db->where('status_menu', 1);
                    $this->db->where('status', 1);
                    $this->db->where('sub_id', $arr['id']);
                endif;
                $get = $this->db->get();
                $countmtps = $get->num_rows();

                if ($countmtps > 0):

                    $return = '<li ' . $class . '>
                            <a href="javascript:void(0);">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">' . $arr['nome'] . '</span>
                                ' . $arrow . '
                            </a>

                            <ul class="collapse">
                                
                            ' . $menu_sub_itens . '

                            </ul>
                        </li>';

                endif;

            endif;
        else:

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            $this->db->where('status', 1);
            $get = $this->db->get();
            $resultmen = $get->result_array();

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            $this->db->where('status', 1);
            if ($administrativo['permissoes'] <> 1):
                $this->db->where('tipo_painel>=', $administrativo['permissoes']);
                $this->db->or_where('tipo_painel', 1);
                $this->db->where('id', $arr['id']);
                $this->db->where('status', 1);
            endif;
            $get = $this->db->get();
            $countgetwhere = $get->num_rows();


            if ($countgetwhere > 0 and !empty($resultmen[0]['tipo_painel'])):
                if ($this->db->table_exists('' . $arr['tabela'] . '')):
                    echo '<li ><a href="javascript:view(1,' . $arr['id'] . ');"> <i class="demo-pli-home"></i> ' . $arr['nome'] . '</a></li>';
                else:
                    echo '<li ><a  href="javascript:alerts(\'Table Não Encontrada no Banco de Dados\');"> <i class="demo-pli-home"></i> ' . $arr['nome'] . '</a></li>';
                endif;
            endif;
        endif;

        return $return;
    }

    public function session_admin()
    {

        if (isset($_SESSION['ID_ADMIN']) and isset($_SESSION['USER_ADMIN']) and isset($_SESSION['IP_ADMIN']) and isset($_SESSION['EMAIL_ADMIN']) and isset($_SESSION['PASS_ADMIN'])):


            try {
                $this->db->from('administrador');
                $this->db->where('id', $_SESSION['ID_ADMIN']);
                $this->db->where('user', $_SESSION['USER_ADMIN']);
                $this->db->where('email', $_SESSION['EMAIL_ADMIN']);
                $this->db->where('pass', $_SESSION['PASS_ADMIN']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    return true;

                else:

                    unset($_SESSION['ID_ADMIN']);
                    unset($_SESSION['USER_ADMIN']);
                    unset($_SESSION['IP_ADMIN']);
                    unset($_SESSION['EMAIL_ADMIN']);
                    unset($_SESSION['PASS_ADMIN']);

                    return false;

                endif;

            } catch (Exception $e) {
                return false;
            }

        else:

            return false;

        endif;

    }

    public function TitleSearch($field)
    {

        $varReturn = false;
        switch ($field) {
            case '|admin_credentials|':
                $varReturn = true;
                break;
            case '|PAGINA_TITLE|':
                $varReturn = true;
                break;
            case '|permissao_admin|':
                $varReturn = true;
                break;
            case '|admin_title|':
                $varReturn = true;
                break;
            case '|user_title|':
                $varReturn = true;
                break;
            case '|user_title|':
                $varReturn = true;
                break;

            case '|user_docs|':
                $varReturn = true;
                break;
            case '|user_credentials|':
                $varReturn = true;
                break;
            case '|user_address|':
                $varReturn = true;
                break;

            case '|user_anexos_docs|':
                $varReturn = true;
                break;

            case '|leilao_title|':
                $varReturn = true;
                break;

            case '|lote_title|':
                $varReturn = true;
                break;

            case '|lote_regras|':
                $varReturn = true;
                break;

            case '|lote_anexos|':
                $varReturn = true;
                break;

            case '|outros_anexos|':
                $varReturn = true;
                break;

            case '|lote_descricao|':
                $varReturn = true;
                break;

        }

        return $varReturn;
    }

    public function TitleReplace($field)
    {

        $varReturn = $field;
        switch ($field) {
            case '|admin_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Administrador</h4>';
                break;

            case '|PAGINA_TITLE|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Criação & Estilo da Pagina</h4>';
                break;

            case '|permissao_admin|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Credenciais do Administrador</h4>';
                break;

            case '|lote_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Lote</h4>';
                break;

            case '|lote_regras|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Regras do Lote</h4>';
                break;

            case '|admin_credentials|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;margin-top: 20px;">Credenciais do Administrador</h4>';
                break;

            case '|user_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;margin-top: 20px;">Informações do Usuario</h4>';
                break;
            case '|user_address|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Endereço do Usuario</h4>';
                break;
            case '|user_docs|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Documentos do Usuario</h4>';
                break;

            case '|user_credentials|':
                $varReturn = '<h6><a href="javascript:alterar_pass();">ALTERAR SENHA</a></h6>';
                break;
            case '|leilao_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Leilão</h4>';
                break;

            //Anexar DOCUMENTOS
            case '|user_anexos_docs|':
                $varReturn = '';
                break;

            case '|lote_anexos|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Arquivos para Anexar</h4>';
                break;

            case '|lote_descricao|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Descrição do Lote</h4>';
                break;
            case '|outros_anexos|':
                $varReturn = '';
                break;


        }

        return $varReturn;
    }

    public function tabela_filtro($field)
    {

        switch ($field) {
            case 'status':
                $field = "Status";
                break;

            case 'id':
                $field = "Registro";
                break;


            case 'id_user':
                $field = "Cliente";
                break;

            case 'id_cliente':
                $field = "Cliente";
                break;

            case 'oq_inclui':
                $field = "Incluso";
                break;
            case 'obs':
                $field = "Observação";
                break;

            case 'valor_custo_adulto':
                $field = "Custo Para Adulto";
                break;

            case 'valor_venda_adulto':
                $field = "Venda Para Adulto";
                break;


            case 'valor_custo_crianca':
                $field = "Custo Para Criança";
                break;

            case 'valor_venda_crianca':
                $field = "Venda Para Criança";
                break;

            case 'desconto_adulto':
                $field = "Desconto para Adultos";
                break;


            case 'desconto_crianca':
                $field = "Desconto para Crianças";
                break;


            case 'oq_n_inclui':
                $field = "Não Incluso";
                break;
            case 'valor_total':
                $field = "Valor do Pedido";
                break;
            case 'dia_ida':
                $field = "Data do Tour";
                break;
            case 'dia_volta':
                $field = "Data da Volta";
                break;

            case 'data_pedido':
                $field = "Data do Pedido";
                break;

            case 'data_passeio':
                $field = "Data do Passeio / Marcada";
                break;

            case 'id_passeio':
                $field = "Passeio";
                break;


            case 'image':
                $field = "Foto";
                break;


            case 'image1':
                $field = "Foto 1";
                break;


            case 'image2':
                $field = "Foto 2";
                break;


            case 'image3':
                $field = "Foto 3";
                break;


            case 'image4':
                $field = "Foto 4";
                break;


            case 'image5':
                $field = "Foto 5";
                break;


            case 'disponibilidade':
                $field = "Pacote Disponível ou Agêndamento";
                break;

            case 'dias':
                $field = "Dias Escolhidos - Passeio";
                break;

            case 'custos_extras':
                $field = "Custos / Despesas Extras";
                break;

            case 'valor':
                $field = "Custos Total";
                break;

            case 'nome':
                $field = "Nome";
                break;
            case 'email':
                $field = "E-mail";
                break;
            case 'user':
                $field = "Usuario";
                break;
            case 'cpf_passaporte':
                $field = "CPF ou Passaporte";
                break;


            case 'rua':
                $field = "Logradouro";
                break;

            case 'rg':
                $field = "Numero da Identidade";
                break;

            case 'rg_frente':
                $field = "Foto Documento Frente";
                break;
            case 'rg_tras':
                $field = "Foto Documento Verso";
                break;

            case 'pass':
                $field = "Senha";
                break;

            case 'meta_title':
                $field = "Titulo (META DESCRIÇÃO)";
                break;

            case 'observacao':
                $field = "Observação";
                break;

            case 'data_inicio':
                $field = "Data Inicial";
                break;

            case 'data_fim':
                $field = "Data Final";
                break;

            case 'lance_inicial':
                $field = "Valor Inicial";
                break;

            case 'lance_minimo':
                $field = "Valor Minimo para Finalizar";
                break;

            case 'comissao_leiloeiro':
                $field = "Comissão do Leiloeiro";
                break;


            case 'descricao_completa':
                $field = "Descrição do Lote";
                break;

            case 'titulo_extra1':
                $field = "Titulo 1";
                break;

            case 'titulo_extra2':
                $field = "Titulo 2";
                break;

            case 'titulo_extra3':
                $field = "Titulo 3";
                break;

            case 'descricao_extra1':
                $field = "Descrição 1";
                break;

            case 'descricao_extra2':
                $field = "Descrição 2";
                break;

            case 'descricao_extra3':
                $field = "Descrição 3";
                break;

            case 'url':
                $field = "URL";
                break;

            case 'conteudo':
                $field = "Conteúdo";
                break;

            case 'cpf':
                $field = "CPF";
                break;

            case 'ultimo_acesso':
                $field = "Último Acesso";
                break;


        }

        return ucwords($field);
    }

    public function tabela_campos_filtro($response, $tabela, $campo, $valor, $outros_values)
    {

        $this->db->from('menu_admin');
        $this->db->where('id', $tabela);
        $get = $this->db->get();
        $menu_admin = $get->result_array()[0];

        if ($response > 0):
            $this->db->from('' . $menu_admin['tabela'] . '');
            $this->db->where('id', $outros_values['id']);
            $get = $this->db->get();
            $response = $get->result_array();
        endif;
        if ($campo == 'acoes'):
            $valor = '';
            if ($response > 0):


                $valor .= '<div style="float: left;width: 100%;margin-bottom: 8px!important;">';
                $valor .= '<label>Situação: </label>&nbsp;&nbsp;&nbsp;';
                $valor .= '<select class="form-control" onchange="chagestatus(this,' . $outros_values['id'] . ',\'' . $menu_admin['tabela'] . '\');">';

                if ($response[0]['status'] == 1):
                    $valor .= '<option value="1">Ativado</option>';
                    $valor .= '<option value="0">Desativado</option>';
                else:

                    $valor .= '<option value="0">Desativado</option>';
                    $valor .= '<option value="1">Ativado</option>';

                endif;


                $valor .= '</select>';
                $valor .= '</div>';
                $valor .= '<div class="clearfix"></div>';
                $valor .= '';

            endif;
            $valor .= '<a href="javascript:editar_item(\'modal\',\'' . $tabela . '\',' . $outros_values['id'] . ');" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a> &nbsp;&nbsp;&nbsp;';
            $valor .= '<a href="javascript:delecsts(\'' . $tabela . '\',' . $outros_values['id'] . ',0);" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</a>';
        endif;

        if ($campo == 'image'):

            $valor = '<img src="' . base_url('web/imagens/' . $valor) . '" style="width:100px;">';

        endif;
        if ($campo == 'data_pedido' or $campo == 'dia_ida'):
            $date = new DateTime('' . $valor . '');
            $valor = $date->format('d/m/Y');

        endif;
        if ($campo == 'id_user'):
            $this->db->from('clientes');
            $this->db->where('id', $valor);
            $get = $this->db->get();
            $result = $get->result_array()[0];
            $valor = $result['nome'];

        endif;
        if ($campo == 'id_passeio'):
            $this->db->from('passeios');
            $this->db->where('id', $valor);
            $get = $this->db->get();

            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array()[0];
                $valor = $result['nome'];
            else:
                $valor = '<b>Não Encontrado</b>';
            endif;

        endif;


        return $valor;
    }

    public function tabela_valor_filtro($fieldname, $fields)
    {

        if ($fieldname == 'status'):

            $fields = ($fields == 0) ? '<a class="btn"><i class="mdi mdi-check-circle"></i> Ativar</a>' : '<a class="btn"><i class="mdi mdi-close-box"></i> Desativar</a>';

        endif;

        return $fields;
    }

    public function campos_filtro($id, $fields, $tabela, $wid)
    {

        if ($id > 0):


            $this->db->from('menu_admin');
            $this->db->where('id', $tabela);
            $get = $this->db->get();
            $menu_adm = $get->result_array()[0];


            $this->db->from($menu_adm['tabela']);
            $this->db->where('id', $id);
            $get = $this->db->get();
            $result = $get->result_array()[0];
            $value = 'value="' . $result['' . $fields . ''] . '"';
            $valuetxt = $result['' . $fields . ''];

        else:

            $value = '';
            $valuetxt = '';
        endif;


        if ($fields == 'pass'):
            $value = '';
            $valuetxt = '';
        endif;

        $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="text" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';

        if ($fields == 'pass'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="password" autocomplete="off" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . ' >
                    </div>';
        endif;

        if ($fields == 'dias'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="number" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';
        endif;

        if ($fields == 'dia_ida' or $fields == 'dia_volta' or $fields == 'data_pedido'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="date" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';
        endif;

        if ($fields == 'image' or $fields == 'image1' or $fields == 'image2' or $fields == 'image3' or $fields == 'image4' or $fields == 'image5'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="file" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '">
                    </div>';
        endif;
        if ($fields == 'conteudo'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';padding: 0 20px 0 20px;">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <textarea name="' . $fields . '" style="float:left;width:100%;height:250px;padding:20px;" id="froala-editor"> ' . $valuetxt . '</textarea>
                    </div>';

        endif;

        if ($fields == 'email'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="email" class="form-control" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';

        endif;
        if ($fields == 'status'):

            if ($id > 0):
                if ($result[$fields] == 1):

                    $options = '<option selected>Ativo</option>';
                    $options .= '<option>Desativado</option>';
                else:
                    $options = '<option>Ativo</option>';
                    $options .= '<option selected>Desativado</option>';

                endif;

            else:

                $options = '<option selected>Ativo</option>';
                $options .= '<option>Desativado</option>';
            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;


        if ($fields == 'id_user' or $fields == 'id_passeio' or $fields == 'permissoes'):
            $options = '<option>Selecione uma Opção</option>';


            if (isset($_GET['edit'])):


                if ($fields == 'id_user'):
                    $this->db->from('clientes');
                endif;
                if ($fields == 'id_passeio'):
                    $this->db->from('passeios');
                endif;

                if ($fields == 'permissoes'):
                    $this->db->from('permissoes');
                endif;
                $get = $this->db->get();
                $users = $get->result_array();

                foreach ($users as $val) {

                    if ($val['id'] == $valuetxt):
                        $options .= '<option value="' . $val['id'] . '" selected>' . $val['nome'] . '</option>';

                    else:
                        $options .= '<option value="' . $val['id'] . '">' . $val['nome'] . '</option>';

                    endif;

                }

            else:


                if ($fields == 'id_user'):
                    $this->db->from('clientes');
                endif;
                if ($fields == 'id_passeio'):
                    $this->db->from('passeios');
                endif;
                if ($fields == 'permissoes'):
                    $this->db->from('permissoes');
                endif;
                $get = $this->db->get();
                $users = $get->result_array();

                foreach ($users as $val) {

                    if ($val['id'] == $valuetxt):
                        $options .= '<option value="' . $val['id'] . '" selected>' . $val['nome'] . '</option>';

                    else:
                        $options .= '<option value="' . $val['id'] . '">' . $val['nome'] . '</option>';

                    endif;

                }

            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="js-example-basic-single form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;

        return $tfields;
    }


}