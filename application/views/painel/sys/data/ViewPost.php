<div id="content-container">
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">
                <?php $arry['sel'] = 'categoria'; $arry['t1'] = 'menu_admin'; $arry['t2'] = 'menu_admin_categorias';
                echo $this->Model->recupera_fields($arry,$post['campo'])[0]['nome']; ?></h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="demo-pli-home"></i></a></li>
            <li><a href="javascript:void(0);"><?php $arry['sel'] = 'categoria'; $arry['t1'] = 'menu_admin'; $arry['t2'] = 'menu_admin_categorias';
                    echo $this->Model->recupera_fields($arry,$post['campo'])[0]['nome']; ?></a></li>
            <li class="active"><?php $arry['sel'] = 'id'; $arry['t1'] = 'menu_admin'; $arry['t2'] = 'menu_admin';
                echo $this->Model->recupera_fields($arry,$post['campo'])[0]['nome']; ?></li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>


    <div id="page-content">


        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" id="button">Minha Tabela</h3>

            </div>


            <div class="clearfixs"></div>
            <br>
            <div class="panel-body">

                <?php echo $this->Model->newbuttomtable($post);?>

                <table id="demo-dt-addrow" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>

                    <?php echo $this->Model->theadViewAdmin($post);?>

                    </thead>
                    <tbody>
                    <?php echo $this->Model->rowstbodyViewAdmin($post); ?>
                    </tbody>
                    <tfoot>

                    <?php echo $this->Model->theadViewAdmin($post);?>

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php $arry['sel'] = 'id'; $arry['t1'] = 'menu_admin'; $arry['t2'] = 'menu_admin';
                            echo $this->Model->recupera_fields($arry,$post['campo'])[0]['nome']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="float: left;width: 100%;text-align: center!important;padding-left:35%;"><img src="https://media1.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" style="width: 200px;float: left;"></p>
                    </div>
                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


<script>
    $(document).ready(function() {
        $('#demo-dt-addrow').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );

    $(document).ready(function() {
        var table = $('.table').DataTable();

        $('.table tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#button').click( function () {

            $.each( $( ".selected" ), function() {

                //Aqui Envia Itens a Serem Deletados
            });

        } );
    } );
</script>