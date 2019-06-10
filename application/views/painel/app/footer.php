<nav id="mainnav-container">
    <div id="mainnav">

        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">


                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">

                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                <p class="mnp-name"><?php echo $admin['nome'];?></p>
                                <span class="mnp-desc"><?php echo $admin['email'];?></span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> Configurações
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> Ajuda
                            </a>
                            <a href="javascript:logout();" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                            </a>
                        </div>
                    </div>



                    <div id="mainnav-shortcut" class="">
                        <ul class="list-unstyled shortcut-wrap" style="text-align: center;">

                            <li class="col-xs-12" data-content="Bloquear Tela ">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>



                    <ul id="mainnav-menu" class="list-group">


                        <?php
                        $number = 0;

                        foreach ($menu_categoria as $value){


                        ?>

                        <li class="list-header"><?php echo $value['nome']?></li>


                            <?php
                            $this->db->from('menu_admin');
                            $this->db->where('categoria',$value['id']);
                            $this->db->where('status_menu',1);
                            $this->db->where('status',1);
                            $this->db->where('sub_id',0);
                            $this->db->order_by('ordem','desc');
                            $get = $this->db->get();
                            $menu = $get->result_array();
                            foreach ($menu as $values){
                               echo $this->Model->menu_admin($values,$number);
                                $number++;
                            }

                            ?>


                        <li class="list-divider"></li>


                        <?php } ?>

                    </ul>



                    <?php echo $this->Model->monitor_rodape();?>


                </div>
            </div>
        </div>

    </div>
</nav>

</div>
<footer id="footer">

    <div class="show-fixed pad-rgt pull-right">
        You have <a href="#" class="text-main"><span class="badge badge-danger">3</span> pending action.</a>
    </div>




    <div class="hide-fixed pull-right pad-rgt">
        Versão <b>0.1 ALPHA</b>
    </div>



    <p class="pad-lft">&#0169; <?php echo date('Y');?> <a href="https://jdlsites.com" target="_blank">Agência JDL</a></p>



</footer>


<button class="scroll-top btn">
    <i class="pci-chevron chevron-up"></i>
</button>
</div>
<script src="<?php echo base_url('assets/codes/') ?>js/jquery.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/bootstrap.min.js"></script>


<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.0.0-rc.2/js/froala_editor.pkgd.min.js'></script>


<script src="<?php echo base_url('assets/codes/') ?>js/nifty.min.js"></script>




<script src="<?php echo base_url('assets/codes/') ?>js/demo/nifty-demo.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.min.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.tooltip.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/sparkline/jquery.sparkline.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/demo/dashboard.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script>

    


</script>
</body>

</html>

