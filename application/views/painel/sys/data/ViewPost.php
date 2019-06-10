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
        <div class="modal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php $arry['sel'] = 'id'; $arry['t1'] = 'menu_admin'; $arry['t2'] = 'menu_admin';
                            echo $this->Model->recupera_fields($arry,$post['campo'])[0]['nome']; ?></h5>
                        <button type="button" class="close btn-destroy" data-dismiss="modal" aria-label="Fechar" onclick="editor.destroy();$('.modal .modal-body').html('<h4>Carregando...</h4>');">
                            <span aria-hidden="true" style="font-size: 15px;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p style="float: left;width: 100%;text-align: center!important;padding-left:35%;"><img src="https://media1.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" style="width: 200px;float: left;"></p>
                    </div>
                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('.modal .modal-body').html('<h4>Carregando...</h4>');">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="saveForm(<?php echo $post['campo'];?>);">Salvar mudanças</button>
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

        } );

        $('#deleteintens').click( function () {

        } );
    } );



    function deletetudo() {
        var txt;
        var r = confirm("Tem Certeza que deseja deletar os itens?");
        if (r == true) {
            $.each( $( ".selected" ), function() {

                //Aqui Envia Itens a Serem Deletados

                delecsts('<?php echo $post['campo'];?>',this.id,1);
            });
        } else {

        }


    }

</script>

<script>

    var editor = new FroalaEditor('#froala-editor')

    // Destroy action.
    document.querySelector('.btn-destroy').addEventListener('click', function (e) {
        e.preventDefault();

        if (editor) {
            editor.destroy()
        }
    });

    // Initialize action.
    document.querySelector('a#btn-init').addEventListener('click', function (e) {
        e.preventDefault();

        if (!editor) {
            editor = new FroalaEditor('#froala-editor');
        }
    });

</script>