<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Área Administrativa</title>


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <link href="<?php echo base_url('assets/codes/') ?>css/bootstrap.min.css" rel="stylesheet">


    <link href="<?php echo base_url('assets/codes/') ?>css/nifty.min.css" rel="stylesheet">


    <link href="<?php echo base_url('assets/codes/') ?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">



    <link href="<?php echo base_url('assets/codes/') ?>plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/codes/') ?>plugins/pace/pace.min.js"></script>


    <link href="<?php echo base_url('assets/codes/') ?>css/demo/nifty-demo.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <!--DataTables [ OPTIONAL ]-->
    <link href="<?php echo base_url('assets/codes/') ?>plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/codes/') ?>plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">
    <script> var DIR = '<?php echo base_url();?>'; </script>

    <style type="text/css">

        .highlight {
            background-color:#ccffcc;
        }

    </style>

</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">


    <header id="navbar">
        <div id="navbar-container" class="boxed">


            <div class="navbar-header">
                <a href="<?php echo base_url();?>" class="navbar-brand">
                   <!-- <img src="img/logo.png" alt="Nifty Logo" class="brand-icon"> -->
                    <div class="brand-title">
                        <span class="brand-text">Administrativo</span>
                    </div>
                </a>
            </div>

            <div class="navbar-content">
                <ul class="nav navbar-top-links">


                    <li class="tgl-menu-btn">
                        <a class="mainnav-toggle" href="#">
                            <i class="demo-pli-list-view"></i>
                        </a>
                    </li>

                    <li>
                        <div class="custom-search-form">
                            <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                                <i class="demo-pli-magnifi-glass"></i>
                            </label>
                            <form method="post" action="javascript:search(1,$('#search-input').val());">
                                <div class="search-container collapse" id="nav-searchbox">
                                    <input id="search-input" type="text" class="form-control" placeholder="O que você procura?">
                                </div>
                            </form>
                        </div>
                    </li>

                </ul>
                <ul class="nav navbar-top-links">
                    <li class="mega-dropdown">
                        <a href="#" class="mega-dropdown-toggle">
                            <i class="demo-pli-layout-grid"></i>
                        </a>
                        <div class="dropdown-menu mega-dropdown-menu">
                            <div class="row">
                                <div class="col-sm-4 col-md-3">

                                    <ul class="list-unstyled">
                                        <li class="dropdown-header"><i class="demo-pli-file icon-lg icon-fw"></i> Navegação</li>
                                        <li><a href="<?php echo base_url('perfil');?>">Meu Perfil</a></li>
                                        <li><a href="https://jdlsites.com/loja-virtual/faq">FAQ</a></li>
                                        <li><a href="javascript:lock();">Sreen Lock</a></li>
                                        <li><a href="javascrit:logout();" class="disabled">Logout</a></li>                                        </ul>

                                </div>
                                <div class="col-sm-4 col-md-4">

                                    <ul class="list-unstyled">
                                        <li class="dropdown-header"><i class="demo-pli-mail icon-lg icon-fw"></i> Acessar E-mail</li>
                                        <li><a href="<?php echo str_replace(array('admin','http://','https://','www'),array('','http://webmail.','https://webmail.',''),base_url(''));?>" target="_blank">Caixa de Email</a></li>
                                        <li><a href="<?php echo base_url('email-marketing');?>">Email Marketing</a></li>
                                    </ul>
                                    <p class="pad-top text-main text-sm text-uppercase text-bold"><i class="icon-lg demo-pli-calendar-4 icon-fw"></i>Updates</p>
                                    <p class="pad-top mar-top bord-top text-sm">O seu sistema esta atualizado</p>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="<?php echo base_url('solicitar-backup');?>" class="media mar-btm">
                                                <span class="badge badge-warning pull-right">OFF</span>
                                                <div class="media-left">
                                                    <i class="demo-pli-data-settings icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-semibold text-main mar-no">Backup</p>
                                                    <small class="text-muted">Solicitar backups, completos e parciais</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('suporte');?>" class="media mar-btm">
                                                <div class="media-left">
                                                    <i class="demo-pli-support icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-semibold text-main mar-no">Suporte</p>
                                                    <small class="text-muted">Suporte para seu sistema</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="media mar-btm">
                                                <div class="media-left">
                                                    <i class="demo-pli-computer-secure icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-semibold text-main mar-no">Segurança</p>
                                                    <small class="text-muted">Gerencie modulos de segurança do sistema</small>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </li>



                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                             <i class="demo-pli-bell"></i>
                            <!--  <span class="badge badge-header badge-danger"></span> -->
                        </a>


                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <div class="nano scrollable">
                                <div class="nano-content">
                                    <ul class="head-list">

                                        <?php echo $this->Model->notificacoes()?>
                                    </ul>
                                </div>
                            </div>

                            <div class="pad-all bord-top">
                                <a href="<?php echo base_url('notificacoes');?>" class="btn-link text-main box-block">
                                    <i class="pci-chevron chevron-right pull-right"></i>Ver Todas as Notificações
                                </a>
                            </div>
                        </div>
                    </li>



                    <li id="dropdown-user" class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="ic-user pull-right">

                                    <i class="demo-pli-male"></i>
                                </span>

                        </a>


                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                            <ul class="head-list">
                                <li>
                                    <a href="<?php echo base_url('meu-perfil');?>"><i class="demo-pli-male icon-lg icon-fw"></i> Perfil</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('mensagens-equipe');?>"><span class="badge badge-danger pull-right">0</span><i class="demo-pli-mail icon-lg icon-fw"></i> Mensagens</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('configuracoes');?>"><!--<span class="label label-success pull-right">New</span>--><i class="demo-pli-gear icon-lg icon-fw"></i> Configurações</a>
                                </li>
                                <li>
                                    <a href="javascript:lock();"><i class="demo-pli-computer-secure icon-lg icon-fw"></i> Bloquear</a>
                                </li>
                                <li>
                                    <a href="javascript:logout();"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>




                </ul>
            </div>


        </div>
    </header>




