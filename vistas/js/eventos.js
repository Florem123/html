$(document).ready(function(){
  $('#nuevasubc').hide();
  $("#tipo_ova").change(function(){
            var pal = ($('select[id=tipo_ova]').val());
            var ident= pal.slice(0,3);
            var tipo= parseInt(pal.slice(4));
            $('#id_tipo').val(tipo);
            console.log(tipo);
            $('#id_objeto_ident').val(ident);
            $.ajax({
                  url:"nroova.php",
                  type:"POST",    
                  datatype:"json",    
                  data:  {ident:ident},    
                  success: function(data) {
                    console.log(data);
                    var d= data.slice(1);
                    console.log(d);
                    var nro= parseInt(d)+1;
                    console.log(nro);
                    $('#id_objeto_nro').val(nro);
                    $('#id_obj').val(ident+"-"+nro);
                   }
                }); 
          });

  $("#agregarsub").on( "click", function() {
    $('#nuevasubc').show();
     });


    $("#categoria").on('change', function () {
        $("#categoria option:selected").each(function () {
            var cate = $(this).val();
            $.post("subcat.php", { cate: cate }, function(data) {
                $("#subcat").html(data);
            });     
        });
   });


    $("#enviar").on( "click", function() {
      var categ = ($('select[id=categoria]').val());
      var subcateg = ($('select[id=subcat]').val());
      var idrec= $('#idrecurso').val();
      console.log(categ);
      console.log(subcateg);
      console.log(idrec);
      if (categ!=0) {
      $.post("filtro1.php", { categ: categ, subcateg: subcateg, idrec: idrec }, function(data) {
                $("#resul").html(data);
            });  
      }

     });

    $("#enviar2").on( "click", function() {
      var recu = ($('select[id=recurso]').val());
      var idsubcat= $('#idsubcat').val();
      console.log(recu);
      console.log(idsubcat);
      if (recu!=0) {
      $.post("filtro2.php", { recu: recu, idsubcat: idsubcat}, function(data) {
                $("#resul").html(data);
            });  
      }

     });

    $("#enviar3").on( "click", function() {
      var recu = ($('select[id=recurso]').val());
      var idcat= $('#idcat').val();
      console.log(recu);
      console.log(idcat);
      if (recu!=0) {
      $.post("filtro3.php", { recu: recu, idcat: idcat}, function(data) {
                $("#resul").html(data);
            });  
      }

     });

    $("#enviarop").on( "click", function() {
      var nom= $('#nombre').val();
      var mail= $('#email').val();
      var coment= $('#coment').val();
      var usu= $('#usu').val();
      var tipo= $('#tipo').val();
      var id_objeto= $('#id_objeto').val();
      console.log(nom);
      console.log(usu);
      console.log(tipo);
      console.log(id_objeto);
      if (coment!='') {
        $.post("mail/sendbymail.php", { nom: nom, mail: mail, coment: coment, usu:usu, tipo: tipo, id_objeto: id_objeto}, function(data) {
              if(data == "null"){
                alert ("Error al enviar comentario");                   
              }else{   
                 alert ("Su comentario se envió correctamente"); 
                  $("#myForm").css("display","none");            
                  $('#botonen').attr("disabled","disabled");                                                           
              }
        });  
      }

     });


});
