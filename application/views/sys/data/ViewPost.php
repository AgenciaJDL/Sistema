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