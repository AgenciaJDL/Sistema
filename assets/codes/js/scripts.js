function reload() {
    $.ajax({
        url: DIR + 'Ajax/NavegacaoView',
        data: {campo: 0},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if (data) {

                if (data == 'reload_action') {
                    window.location.reload();
                } else {
                    $('body').html(data);
                }
                loadpagerequest(0);

            } else {
                loadpagerequest(0);

                alert(data);

            }


        }
    });
}

function view(tipo, campo) {
    $.ajax({
        url: DIR + 'Ajax/NavegacaoView',
        data: {tipo: tipo, campo: campo},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if (data) {

                if (data == 'reload_action') {
                    window.location.reload();
                } else {
                    $('#navigationViewAerea').html(data);
                }
                loadpagerequest(0);

            } else {
                loadpagerequest(0);

                alert(data);

            }


        }
    });
}

function logout() {

    $.ajax({
        url: DIR + 'Ajax/logout',
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {
            alert('erro');
        },
        success: function (data) {

            if (data == 11) {
                window.location.reload();
            } else {

                alert(data);

            }


        }
    });

}

function loadpagerequest(acao) {
    if (acao == 1) {
        $('body').css('opacity', '0.5');
    } else {
        $('body').css('opacity', '1');

    }
}


function newPostTable(acao, tabela, tipo, edit) {

    if (tipo) {
        $('.modal').modal({backdrop: 'static', keyboard: false});

        $.ajax({
            url: DIR + 'Ajax/formFilds',
            data: {acao: acao, tabela: tabela, tipo: tipo},
            type: 'POST',

            error: function (res) {

                alert('Erro ao Carregar o Conteudo');

            },
            success: function (data) {

                if (data) {

                    if (data == 'reload_action') {
                        window.location.reload();
                    } else {
                        $('.modal .modal-body').html(data);
                    }

                } else {

                    alert('Erro ao Carregar e Exibir o Conteudo');

                }


            }
        });

    } else {

        $('.modal').modal({backdrop: 'static', keyboard: false});

        if (edit) {
            $.ajax({
                url: DIR + 'Ajax/formFilds',
                data: {acao: acao, tabela: tabela, edit: edit},
                type: 'POST',

                error: function (res) {

                    alert('Erro ao Carregar o Conteudo');

                },
                success: function (data) {

                    if (data) {

                        if (data == 'reload_action') {
                            window.location.reload();
                        } else {
                            $('.modal .modal-body').html(data);
                        }

                    } else {

                        alert('Erro ao Carregar e Exibir o Conteudo');

                    }


                }
            });
        } else {
            $.ajax({
                url: DIR + 'Ajax/formFilds',
                data: {acao: acao, tabela: tabela},
                type: 'POST',

                error: function (res) {

                    alert('Erro ao Carregar o Conteudo');

                },
                success: function (data) {

                    if (data) {

                        if (data == 'reload_action') {
                            window.location.reload();
                        } else {
                            $('.modal .modal-body').html(data);
                        }

                    } else {

                        alert('Erro ao Carregar e Exibir o Conteudo');

                    }


                }
            });
        }


    }

}


function editar_item(action, tabela, id) {
    newPostTable(1, tabela, '', id);
}

function saveForm(table) {

    var form = $('form').serialize();

    $.ajax({
        url: DIR + 'Ajax/ProcessarForm',
        data: form,
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                if (data == 11) {
                    $('.modal').modal('hide');
                    view(1, table);
                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });
}

function addSelect(edit) {

    if ($('#' + edit).hasClass('selected')) {

        $('#' + edit).removeClass('selected');


    } else {

        $('#' + edit).addClass('selected');
        $('.removeallselects').removeClass('disabled');

    }

}

function delecsts(table, item, multiple) {

    $.ajax({
        url: DIR + 'Ajax/deleteitens',
        data: {table: table, item: item},
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                var tables = $('#demo-dt-addrow').DataTable();


                if (data == 11) {
                    if (multiple == 1) {


                        tables.row('.selected').remove().draw(false);


                    } else {
                        view(1, table);

                    }
                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });
}


function chagestatus(arrdata, id, table) {

    var status = arrdata.value;
    $.ajax({
        url: DIR + 'Ajax/changestatus',
        data: {table: table, item: id, status: status},
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                var tables = $('#demo-dt-addrow').DataTable();


                if (data == 11) {

                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });


}


function alerts(alerttext) {
    alert(alerttext);
}


