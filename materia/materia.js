var app = {
    elemConteudo: $('#conteudo'),
    lista: {
        carregar: function() {
            $.post("materia/lista.php", "", function(retorno) {
                app.elemConteudo.empty().append(retorno);
                app.form.bindLinks();
            });
        }
    }, // end lista
    form: {
        btnSalvar: {},
        btnCancelar: {},
        carregar: function(id) {
            // Update ou insert
            param = (id) ? "id=" + id : "";

            $.post("materia/form.php", param, function(retorno) {
                app.elemConteudo.empty().append(retorno);
                app.form.setBtnSalvar();
                app.form.setBtnCancelar();
            });
        },
        bindLinks: function() {
            // Espara-se que "app.elemConteudo" seja a tabela (lista)
            var tabela = app.elemConteudo,
                links  = tabela.find('a');

            links.each(function() {
                var tr = $(this).parent().parent(),
                    id = tr.attr('id').split("-")[1];

                $(this).click(function() {
                    app.form.carregar(id);
                });
            });
        },
        getMateria: function(){
            var materia = {};

            materia.id             = $("#frm-id").val();
            materia.url            = $("#frm-url").val();
            materia.titulo         = $("#frm-titulo").val();
            materia.resumo         = $("#frm-resumo").val();
            materia.keywords       = $("#frm-keywords").val();
            materia.nivel          = $("#frm-nivel").val();
            materia.secao          = $("#frm-secao").val();
            materia.autor          = $("#frm-autor").val();
            materia.dt_criacao     = $("#frm-dt-criacao").val();
            materia.dt_atualizacao = $("#frm-dt-atualizacao").val();
            materia.ordem          = $("#frm-ordem").val();

            return materia;
        },        
        setBtnSalvar: function() {
            this.btnSalvar = $('#ctr-acao-salvar');
            this.btnSalvar.click(function() {
                var strJsonMateria = JSON.stringify( app.form.getMateria() );
                
                $.post("materia/crud.php", "ac=update&materia="+strJsonMateria, function(resp){
                    //var resp = JSON.parse(resp);
                    console.log(resp)

//                    if( resp.lastInsertId){
//                        
//                    } else {
//                        if( resp.erro != undefined){
//                            ctrMsgErro.mostrar(resp.erro);
//                        } else {
//                            ctrMsgErro.mostrar("ERRO:"+resp);
//                        }
//                    }
                });
            });
        },
        setBtnCancelar: function() {
            this.btnCancelar = $('#ctr-acao-cancelar');
            this.btnCancelar.click(function() {
                app.lista.carregar();
            });
        }
    }// end form

};//end materia

app.lista.carregar();

