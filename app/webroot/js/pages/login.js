jQuery(document).ready(function() {
    $("#btnLogin").on('click', function() {

        let datastring = $("#loginForm").serialize();


        $.ajax({
            url: "/AdmUsers/login",
            type: "post",
            dataType: "json",
            data: datastring,
            beforeSend: function(data) {
                $("#btnLogin").hide(200);
                $("#loaderButtonLogin").show(300);
            },
            success: function(data) {
                if (data.status) {
                    swal(data.title, data.message, data.icon, { buttons: false, timer: 2000 });
                    setTimeout(function() {
                        window.location.href = data.redirect;
                    }, 2200);
                } else {
                    swal(data.title, data.message, data.icon);
                }
                $("#loaderButtonLogin").hide(2000);
                $("#btnLogin").show(3000);
            },
            error: function(data) {
                $("#loaderButtonLogin").hide(2000);
                $("#btnLogin").show(3000);
                swal("Ops!", "Serviço indisponível, tente mais tarde!", "error");
                console.log('Erro');
            }
        });
        console.log('login');

    });
});