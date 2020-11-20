$(function() {
    $(".box-contact").on("click", function() {
        $(".box-address").slideUp(150);
        //console.log("Subiu todos os cards");

        if (!$(this).hasClass('contact-active')) {
            $(".box-contact").removeClass("contact-active");
            //console.log("removeu de todos a classe active");
            $(this).addClass("contact-active");
            //console.log("adicionou a classe active ao elemento");
            $(this).find(".box-address").slideDown(150);
            //console.log("desceu apenas o slide clicado");
        } else {
            $(this).removeClass("contact-active");
            //console.log("removeu a classe active");
        }
    });
});

$(function(){
    $(".link-ask ").hover(function(e){
        e.preventDefault();
        $(this).addClass("link-active");
        $(this).find(".link-answer").toggleClass("d-flex");
    })
});

$(function() {
    $(".box-contact").hover(function() {
        $(this).toggleClass("border-primary");
    });   
});




$(function() {
    var content = $("#modalAddress");

    $(".m-view").on("click", function() {
        var action = $(this).attr("data-action");

        $.ajax({
            url: action,     
            type: "GET",
            data: {},
            dataType: "JSON",
            beforeSend: function(){},
            success: function(result) {
                content.find("p").eq(0).find("span").html("   " + result.cep);
                content.find("p").eq(1).find("span").html("   " + result.logradouro);
                content.find("p").eq(2).find("span").html("   " + result.complemento);
                content.find("p").eq(3).find("span").html("   " + result.bairro);
                content.find("p").eq(4).find("span").html("   " + result.cidade);
                content.find("p").eq(5).find("span").html("   " + result.estado);
   
                $("#modalAddress").modal("show");
            },
            erro: function(){},
            complete: function(){}, 
        });
    });
});

$(function() {
    var inputCep = $("#formAddress").find("div").eq(2).find("input");

    inputCep.on("blur", function(e) {
        cep = inputCep.val();
        var action = "https://viacep.com.br/ws/" + cep +"/json";
        
        $.ajax({
            url: action,     
            type: "GET",
            data: {},
            dataType: "JSON",
            beforeSend: function(){},
            success: function(result) {
                if (!result.erro) {
                    $(".cep-erro").html("");
                    $("#formAddress").find("div").eq(3).find("input").val(result.logradouro);
                    $("#formAddress").find("div").eq(5).find("input").val(result.bairro);
                    $("#formAddress").find("div").eq(6).find("input").val(result.localidade);
                    $("#formAddress").find("div").eq(7).find("input").val(result.uf);
                } else {
                    $(".cep-erro").html("CEP inexistente!  :( ");
                }
            },
            erro: function(){
                alert("erro");
            },
            complete: function(){}, 
        });
    });
});

$(function() {
    var content = $("#modalDelete");

    $(".m-delete").on("click", function() {
        var action = $(this).attr("data-action");

        $("#modalDelete").modal("show");

        $("#modalDelete").find(".btn-danger").on("click", function() {
            window.location.href = action;
        });
    });
});