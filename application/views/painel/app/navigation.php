<div class="boxed" id="navigationViewAerea">

    <div id="content-container">
        <div id="page-head" >

            <?php
            $this->db->from('administrador');
            $this->db->where('id',$_SESSION['ID_ADMIN']);
            $get = $this->db->get();
            $admin = $get->result_array()[0];
            ?>
            <div class="pad-all text-center">
                <h3>Bem Vindo, <?php echo $admin['nome'];?>.</h3>
                <p><?php echo $this->Model->frases_motivacionais()?>.</p>
            </div>
        </div>



        <div id="page-content">

            <div class="row">
                <div class="col-lg-7">

                    <div id="demo-panel-network" class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button onclick="reload();" class="btn btn-default btn-active-primary" data-toggle="panel-overlay" data-target="#demo-panel-network"><i class="demo-psi-repeat-2"></i></button>
                                <div class="dropdown">
                                    <button class="dropdown-toggle btn btn-default btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Relatorio Geral</a></li>
                                        <li><a href="#">Relatorio Financeiro</a></li>
                                        <li><a href="#">Ações de Marketing</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Configurações de Coleta de Dados</a></li>
                                    </ul>
                                </div>
                            </div>
                            <h3 class="panel-title">Resumo</h3>
                        </div>


                        <div class="pad-all">
                            <div id="demo-chart-network" style="height: 255px"></div>
                        </div>


                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="text-semibold text-uppercase text-main">Intenções de Compras</p>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="media">
                                                <div class="media-left">
                                                    <span class="text-3x text-thin text-main">0</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="pad-rgt">
                                        <p class="text-semibold text-uppercase text-main">Frase do Dia</p>
                                        <p class="text-muted mar-top">Não desista, apesar de todo trabalho, vai ficar bem</p>
                                    </div>
                                </div>



                                <div class="col-lg-4">

                                    <p class="text-uppercase text-semibold text-main">Pedidos Efetuados</p>

                                    <?php echo $this->Model->charts('','media_pedidos','dashboard_under_day',$pedido_resumo_diario);?>

                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="col-lg-5">
                    <div class="row">

                        <?php echo $this->Model->cols_sm('Earning','6');?>
                        <?php echo $this->Model->cols_sm('Sales','6');?>


                    </div>


                    <?php echo $this->Model->usages('new-users');?>


                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-warning panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="fa fa-users icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Usuarios</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-info panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-file-zip icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Tickets de Suporte</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-mint panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="fas fa-shopping-cart icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Produtos Enviados</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger panel-colorful media middle pad-all">
                        <div class="media-left">
                            <div class="pad-hor">
                                <i class="demo-pli-video icon-3x"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-semibold">0</p>
                            <p class="mar-no">Reviews</p>
                        </div>
                    </div>
                </div>

            </div>




        </div>

    </div>


