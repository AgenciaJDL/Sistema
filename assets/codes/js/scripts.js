function reload() {
    $.ajax({
        url: DIR+'Ajax/NavegacaoView',
        data: {campo:0},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if(data){

                if(data == 'reload_action'){
                    window.location.reload();
                }else{
                    $('body').html(data);
                }
                loadpagerequest(0);

            }else{
                loadpagerequest(0);

                alert(data);

            }



        }
    });
}

function view(tipo,campo) {
    $.ajax({
        url: DIR+'Ajax/NavegacaoView',
        data: {tipo:tipo,campo:campo},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if(data){

                if(data == 'reload_action'){
                    window.location.reload();
                }else{
                    $('#navigationViewAerea').html(data);
                }
                loadpagerequest(0);

            }else{
                loadpagerequest(0);

                alert(data);

            }



        }
    });
}

function logout(){

    $.ajax({
        url: DIR+'Ajax/logout',
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {
            alert('erro');
        },
        success: function (data) {

            if(data == 11){
                window.location.reload();
            }else{

                alert(data);

            }



        }
    });

}

function loadpagerequest(acao) {
    if(acao == 1){
        $('body').css('opacity','0.5');
    }else{
        $('body').css('opacity','1');

    }
}



function alerts(alerttext) {
    alert(alerttext);
}


