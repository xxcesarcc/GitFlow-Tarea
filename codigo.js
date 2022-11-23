$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password =$.trim($("#password").val());    
    
   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o password',
      });
      return false; 
    }else{
        Swal.fire({
            type:'success',
            title:'¡Conexión exitosa!',
            confirmButtonColor:'#3085d6',
            confirmButtonText:'Ingresar'
        }).then((result) => {
            if(result.value){
                window.location.href = "CRUD/index.php";
            }
        })
    }
})