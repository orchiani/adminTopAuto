<template>
<div>
  <div class="card">
                    <div class="buscador-div">
                        <input v-model="buscar" v-on:input="listarUsuarios(1, buscar)" type="textfield" class="buscador" placeholder="Buscar...">
                    </div>
                    <div class="card-body">
                    </div>
                </div>
<div class="tabla-div">
    <table class="table-prueba">
        <thead>
          <tr style="text-align: center;">  
              <th  class="table-header-prueba table-data-longtextA"> Nombre </th>
              <th  class="table-header-prueba table-data-longtextB"> Usuario </th>
              <th  class="table-header-prueba table-data-longtextC"> Rol </th>
              <th class="table-header-prueba table-data-longtextC"> Activo </th>
            </tr>
          </thead>
          <tbody>
            <tr v-on:click="abrirModal('usuario', 'actualizar', usuario)" v-for="usuario in arrayUsuarios" :key="usuario.id">
            <td style="max-width=20%; min-width=15%;" class="table-data-prueba"><div class="div-prueba1" v-text="usuario.nombre"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba"><div class="div-prueba2" v-text="usuario.usuario"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba">
              <div class="div-prueba3" v-if="usuario.id_rol==1"> Full </div>
              <div class="div-prueba3" v-if="usuario.id_rol==2"> Administrador </div>
              <div class="div-prueba3" v-if="usuario.id_rol==3"> Vendedor </div>
              </td>
              <td class="table-data-prueba">
              <div class="div-prueba3" v-if="usuario.activo==1"> Activado </div>
              <div class="div-prueba3" v-if="usuario.activo==0"> Desactivado </div>
              </td>
             </tr>
            <div id="container-floating">
           <div id="floating-button" v-on:click="abrirModal('usuario', 'registrar')">
            <p class="plus">+</p>
           </div>
          </div>
          </tbody>
        </table>      

          <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">

	      <ul class="pagination">
		      <li v-if="pagination.current_page > 1" class="pagination-item--wide first"> <a style="border-left: 1px solid #fbc02d; font-weight: 500;" v-on:click.prevent="cambiarPagina(pagination.current_page - 1, buscar)" class="pagination-link--wide first" href="#">Anterior</a> </li>
	      	<li v-for="page in pageNumber" :key="page" class="pagination-item first-number"> <a style="border-left: 1px solid #fbc02d; font-weight: 500;" v-on:click.prevent="cambiarPagina(page, buscar)" v-text="page" class="pagination-link" href="#"></a> </li>
	      	<li v-if="pagination.current_page < pagination.last_page" class="pagination-item--wide last"> <a style="border-left: 1px solid #fbc02d; font-weight: 500;" v-on:click.prevent="cambiarPagina(pagination.current_page + 1, buscar)" class="pagination-link--wide last" href="#">Siguiente</a> </li>
	</ul>

</div>


      </div>  
     <div class="container">
       <div :class="{'mostrar' : modal}" class="modal fade" id="myModal">
       <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border: 0;">
      
        <!-- Modal Header -->
        <div style="border-bottom: 0;" class="modal-header">
          <h4 class="modal-title" v-text="tituloModal"></h4>
          <button type="button" class="close" v-on:click="cerrarModal()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="primer-fila-div" >
        <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0;" class="headers-primer-fila-modal table-headers-modal"> Nombre </th>
        <th style="border-bottom: 0;" class="headers-primer-fila-modal table-headers-modal"> Usuario </th>
        <th style="border-bottom: 0;" class="headers-primer-fila-modal table-headers-modal"> Password </th>
        <th style="border-bottom: 0;" class="headers-primer-fila-modal table-headers-modal"> Rol </th>
        <th style="border-bottom: 0;" class="headers-primer-fila-modal table-headers-modal"> Zonas </th>
        <th style="border-bottom: 0;" class="header-primer-fila-modal table-headers-modal"> Activo </th>
        </thead>
        <tbody>
        <tr>
        <td style="border-bottom: 0;">
        <div class="primer-fila-modal"> 
        <input maxlength="15" type="text" :disabled="modificar == 0" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45);  text-align:center;  width: 100%; padding: 7px 0; " v-model="nombre" onblur="this.placeholder = 'Nombre..'" onfocus="this.placeholder = ''" placeholder="Nombre..">
        </div>
        </td>
        <td style="border-bottom: 0;">
        <div class="primer-fila-modal"> 
        <input maxlength="15" type="text" :disabled="modificar == 0" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="usuario" onblur="this.placeholder = 'Usuario..'" onfocus="this.placeholder = ''" placeholder="Usuario..">
          </div>
         </td>
        <td style="border-bottom: 0;">
        <div class="primer-fila-modal"> 
        <input maxlength="15" type="password" :disabled="modificar == 0" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="password" onblur="this.placeholder = 'Password..'" onfocus="this.placeholder = ''" placeholder="Password.."> 
          </div>
         </td>
        <td style="border-bottom: 0;">
        
        <div class="primer-fila-modal"> 
        <select style="margin-top: 11%; width: 100%;" :disabled="modificar == 0" v-model="rol">
          <option value="1"> Full </option>
          <option value="2"> Administrador </option>
          <option value="3"> Vendedor </option>
          </select> 
          </div>  
         </td>
        <td style="border-bottom: 0;" >
           <div class="primer-fila-modal"> 
           <select :disabled="modificar == 0" multiple v-model="zonas">
             <option  v-for="zona in arrayZonas" :key="zona.codigo" :value="zona.codigo" v-text="zona.nombre" > </option>
          </select> 
             </div> 
          </td>
         <td style="padding-top: 7px;padding-left: 20px; margin-bottom: 0; border-bottom: 0;">
           <div class="primer-fila-modal"> 
        <label style="margin-bottom: 0px; border-bottom: 0;" class="label">
                 <input style="margin-bottom: 0px; border-bottom: 0;" class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="activo" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>   
             </div>     
        </td>
         <td style="border-bottom: 0; padding-left: 45px;">
            <div class="primer-fila-modal"> 
        <div v-if="imagen && !url">
          <img style="height: 60px; width: 100px;" :src="baseUrl + '/img/usuarios/' + imagen">
           </div>
           <div  v-if="url  && !imagen">
          <img style="height: 60px; width: 100px;" :src="url">
           </div>
            </div>     
        </td>    
         </tr>
         
         </tbody>
        </table>
        </div>
          </div>
            
        </div>
        
        <!-- Modal footer -->
        <div style="border-top: 0; background: #fff;" class="modal-footer">
        <div class="errores-modal" v-show="errorUser==1"> 
           <div> 
               <div class="icon-warning" v-for="error in errorMostrarMsjUser" :key="error" v-text="error">
               </div>
            </div>
         </div>
          <input id="selectedFile" type="file" @change="handlerImagenes" style="position:absolute;visibility:hidden;"/>
          <button type="button" style="margin-right: 25%;" :disabled="modificar == 0" class="btn btn-secondary" onclick="selectedFile.click()" v-on:click="imagen = ''"> Imagen </button>
          <button type="button" class="btn btn-secondary" v-on:click="cerrarModal()" >Cerrar</button>
          <button type="button" class="btn btn-secondary" v-on:click="registrarUsuario()" v-if="tipoAccion==1">Guardar</button>
          <button type="button" class="btn btn-secondary" v-if="modificar==1 && tipoAccion==2" v-on:click="handlerModificar()">Guardar</button>
          <button type="button" class="btn btn-secondary" v-if="tipoAccion==2 && modificar==0" v-on:click="activarModificarModal()">Modificar</button>
        </div>
        
       </div>
        </div>
          </div>
          </div>
</template>



<script>
    export default {
      data(){
        return {
          user_id: 0,
          nombre: '',
          usuario: '',
          password: '',
          rol: '',
          activo: 1,
          arrayUsuarios: [],
          modal: 0,
          tituloModal: '',
          tipoAccion: 0,
          errorUser: 0,
          errorMostrarMsjUser: [],
          pagination: {
              'total': 0,
              'current_page': 0,
              'per_page': 0,
              'last_page': 0,
              'from': 0,
              'to': 0
          },
          offset: 3,
          buscar: '',
          modificar: 0,
          image: '',
          imagen: '',
          url: '',
          arrayZonas: [],
          zonas: {},
          baseUrl: ''
        }
      },
      computed: {
          isActived: function(){
            return this.pagination.current_page;
          },
          //Calcula los elementos de la paginación
          pageNumber: function(){
            if(!this.pagination.to){
              return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
              from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
              to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to) {
              pagesArray.push(from);
              from++;
            }
            return pagesArray;
          }
      },
      methods : {
         getBaseUrl(){
         this.baseUrl = window.location.origin;
        },
        listarZonas(page, buscar){
          let me = this;
          var url = '/zonas';
          axios.get(url)
          .then(function(response){
            me.arrayZonas = response.data.zonas;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
          handlerImagenes(e){
          this.previsualizarImagen(e);
          this.imageChanged(e);
        },
        previsualizarImagen(e){
          let me = this;
           me.url = URL.createObjectURL(e.target.files[0]);
            var fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            fileReader.onload = function(b) {
             me.image = b.target.result;
            }
        },
        imageChanged(e){
            let me = this;
            var fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            fileReader.onload = function(b) {
             me.image = b.target.result;
            }
            
        },
        listarUsuarios(page, buscar){
          let me = this;
          var url = '/user?page=' + page + '&buscar=' + buscar;
          axios.get(url)
          .then(function(response){
            me.arrayUsuarios = response.data.usuarios.data;
            me.pagination = response.data.pagination;
            me.listarZonas();
            me.getBaseUrl();
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        cambiarPagina(page, buscar){
            let me = this;
            me.pagination.current_page = page;
            me.listarUsuarios(page, buscar);
        },
        registrarUsuario(){
          if(this.validarUsuario()){
            return;
          }
          this.modificar = 1;
          let me = this;
          axios.post('/user/agregar', {
                   'nombre': this.nombre, 
                   'usuario': this.usuario,
                   'password': this.password,
                   'id_rol': this.rol,
                   'activo': this.activo,
                   'image': this.image,
                   'zonas': this.zonas,
          }).then(function (response){
              me.cerrarModal();
              me.listarUsuarios(1, '');
              this.modificar = 0;
          }).catch(function (error){
              console.log(error.response);
          })
        },
        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case "usuario":
              {
                switch(accion){
                  case 'registrar':
                  {
                    me.getBaseUrl();
                    this.modal = 1;
                    this.nombre = '';
                    this.usuario = '';
                    this.password = '';
                    this.rol = '';
                    this.activo = 1;
                    this.image = '',
                    this.imagen = '',
                    this.url = '',
                    this.tituloModal = 'Añadir Usuario';
                    this.tipoAccion = 1;
                    this.modificar = 1;
                    this.zonas = {};
                    break;
                  }
                  case 'actualizar':
                  { 
                    me.getBaseUrl();
                    this.modal = 1;
                    this.user_id = data['id'];
                    this.nombre = data['nombre'];
                    this.usuario = data['usuario'];
                    this.password = data['password'];
                    this.activo = data['activo'];
                    this.rol = data['rol'];
                    this.imagen = data['imagen'];
                    this.tituloModal = 'Modificar Usuario';
                    this.tipoAccion = 2;
                    this.modificar = 0;
                    this.zonas = data['zonas'];
                    break;
                  }
                }
              }
          }
        },
        actualizarUsuario(){
        if(this.validarUsuario()){
            return;
          }
          let me = this;
          axios.post('/user/actualizar', {
                   'nombre': this.nombre, 
                   'usuario': this.usuario,
                   'password': this.password,
                   'id_rol': this.rol,
                   'activo': this.activo,
                   'id': this.user_id, 
                   'image': this.image,
                   'zonas': this.zonas,
          }).then(function (response){
              me.cerrarModal();
              me.listarUsuarios(1, '');
          }).catch(function (error){
              console.log(error.response);
          })
        },
        validarUsuario(){
           this.errorUser = 0;
           this.errorMostrarMsjUser = [];
           if(!this.nombre){
             this.errorMostrarMsjUser.push("El nombre del usuario es requerido");
           } 
           if(!this.usuario){
             this.errorMostrarMsjUser.push("El campo usuario es requerido");
           } 
           if(!this.rol){
             this.errorMostrarMsjUser.push("El rol del usuario es requerido");
           }
           if(this.errorMostrarMsjUser.length) this.errorUser = 1;
          
          return this.errorUser;
        },
        cerrarModal(){
          this.modal = 0;
          this.tituloModal = '';
          this.nombre = '';
          this.usuario = '';
          this.password = '';
          this.activo = '';
          this.rol = '';
          this.modificar = 0;
          this.imagen = '';
          this.url = '';
          this.image = '';
          this.zonas = {};
        },
      activarModificarModal(){
              this.modificar = 1;
        },
        desactivarModificarModal(){
              this.modificar = 0;
        },
         handlerModificar(){
          this.desactivarModificarModal();
          this.actualizarUsuario();
        }
        },
        mounted() {
            this.listarUsuarios(1, this.buscar);
    } 
    }
</script>

<style>
    .primer-fila-div{
      padding-right: 4%;
      text-align: center;
    }

    .headers-primer-fila-modal{
        padding-left: 3%;
    }
    .form-codigo-2{

    }
    
    .form-codigo{
      width: 100%;
    }

    
    .codigo{
      width: 20%;
      max-width: 20%;
      border-radius: 7px;
    }

    .table-div{
      width: 100%;
      height: 60%;
    }

    .table-prueba{
      width: 100%;
      height: 60%;
      margin-top: 0px;
      margin-left: 0px;
      align-items: stretch;
      width: 100%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    table.table-prueba tr:hover td {
    background-color: #fbc02d;
} 

    .table-headers{
      padding-left: 10px;
      padding-right: 10px;
      display: inline-block;
    }
    table td:last-child {
      border-right: none;
    }
 
  tr:nth-child(even) {background-color: #f2f2f2;}

  th, td {
    border-bottom: 1px solid #ddd;
      }

    .table-header-prueba{
      padding-top: 13px;
      padding-bottom: 13px;
      border-left: 1px solid #ebebeb;
      border-bottom: 2px solid #ebebeb;
      text-align: center;
      font-weight: 500;
      max-height: initial;
      min-height: initial;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .table-headers-modal{
      font-weight: 500;
    }

    .table-data-prueba{
      padding-bottom: 10px;
      padding-top: 10px;
      border-left: 1px solid #ebebeb;
      text-align: center;
      max-height: initial;
      min-height: initial;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .table-data-icons{
      padding-bottom: 10px;
      padding-top: 10px;
      border-left: 1px solid #ebebeb;
      text-align: center;
      max-height: initial;
      min-height: initial;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .div-prueba1{
        width: 90%;
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
    }

    .div-prueba2{
      width: 90%;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
      display: inline-block;
    }

    .div-prueba3{
      width: 90%;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
      display: inline-block;
      text-align: center;
    }

    .div-prueba4{
      width: 90%;
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis;
      display: inline-block;
    }

    #container-floating{
      position: fixed;
      width: 70px;
      height: 70px;
      bottom: 30px;
      right: 30px;
      z-index: 50px;
    }

    #container-floating1{
      position: fixed;
      width: 70px;
      height: 70px;
      bottom: 30px;
      right: 30px;
      z-index: 20px;
    }

    #container-floating2{
      position: fixed;
      width: 70px;
      height: 70px;
      bottom: 30px;
      right: 30px;
      z-index: 80px;
    }

    .plus{
      color: black;
      position: absolute;
      top: 0;
      display: block;
      bottom: 0;
      left: 0;
      right: 0;
      text-align: center;
      padding: 0;
      margin: 0;
      line-height: 55px;
      font-size: 38px;
      font-family: 'Roboto';
      font-weight: 300;
    }

    #floating-button{
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: #fbc02d;
      position: fixed;
      bottom: 30px;
      right: 30px;
      cursor: pointer;
      box-shadow: 0px 2px 5px #666;
    }   

     #floating-button1{
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: #fbc02d;
      position: fixed;
      bottom: 30px;
      right: 30px;
      cursor: pointer;
      box-shadow: 0px 2px 5px #666;
    }   

     #floating-button2{
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: #fbc02d;
      position: fixed;
      bottom: 30px;
      right: 100px;
      cursor: pointer;
      box-shadow: 0px 2px 5px #666;
    }   

    .btn {
      padding: 14px 24px;
      border: 0 none;
      font-weight: 500;
    }

    .btn:focus, .btn:active:focus, .btn.active:focus {
          outline: 0 none;
      }

    .btn-primary {
      background: #336633;
      color: #ffffff;
    }

    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
      background: #339933;
      color: #ffffff;
    }

    .btn-primary:active, .btn-primary.active {
      background: #336633;
      box-shadow: none;
    }

    .mostrar{
      display: list-item !important;
      opacity: 1 !important;
      position: absolute !important;
      background-color: #3c29297a !important; 
    }

    .modal-lg{
      max-width: 70%;
      padding-top: 15%;
    }

    .modal-dialog {
      width: 60%;
    }

    .texto-descripcion {
      width: 4000px;
    }

    .primer-fila-modal{
      width: 100%; padding-left: 10%;
    }

    th {
      text-align: center;
    }

    select {
      width: 100%;
    border-left: 0px;
    border-right: 0px;
    border-top: 0px; 
    border-bottom: 0px;
    text-align-last:center;
    }


.label__checkbox {
  display: none;
}

.label__check {
  display: inline-block;
  border-radius: 50%;
  border: 5px solid rgba(0,0,0,0.1);
  background: white;
  vertical-align: middle;
  margin-right: 20px;
  width: 2em;
  height: 2em;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: border .3s ease;
  
  i.icon {
    opacity: 0.2;
    font-size: ~'calc(1rem + 1vw)';
    color: transparent;
    transition: opacity .3s .1s ease;
    -webkit-text-stroke: 3px rgba(0,0,0,.5);
  }
  
  &:hover {
    border: 5px solid rgba(0,0,0,0.2);
  }
}

.label__checkbox:checked + .label__text .label__check {
  animation: check .5s cubic-bezier(0.895, 0.030, 0.685, 0.220) forwards;
  
  .icon {
    opacity: 1;
    transform: scale(0);
    color: white;
    -webkit-text-stroke: 0;
    animation: icon .3s cubic-bezier(1.000, 0.008, 0.565, 1.650) .1s 1 forwards;
  }
}

.center {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%,-50%);
}

@keyframes icon {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes check {
  0% {
    width: 1.5em;
    height: 1.5em;
    border-width: 5px;
  }
  10% {
    width: 1.5em;
    height: 1.5em;
    opacity: 0.1;
    background: rgba(0,0,0,0.2);
    border-width: 15px;
  }
  12% {
    width: 1.5em;
    height: 1.5em;
    opacity: 0.4;
    background: rgba(0,0,0,0.1);
    border-width: 0;
  }
  50% {
    width: 2em;
    height: 2em;
    background: #00d478;
    border: 0;
    opacity: 0.6;
  }
  100% {
    width: 2em;
    height: 2em;
    background: #00d478;
    border: 0;
    opacity: 1;
  }
}

.btn-secondary{
  background-color: #fbc02d;
  border-radius: 20px;
}

input:focus { 
    background-color: #fbc02d;
    outline: none;
    outline-width: 0;
}

select:focus {
    width: 100%;
    border-left: 0px;
    border-right: 0px;
    border-top: 0px; 
    border-bottom: 0px;
    text-align-last:center;
    background-color: #fbc02d;
    outline: none;
    outline-width: 0;
    }

.errores-modal{
      padding-right: 35%;
      color: red;
      text-indent: 11%;
      width: 100%;
}

.icon-warning{
  background-image: url(https://cdn2.iconfinder.com/data/icons/perfect-flat-icons-2/512/Error_warning_alert_attention_remove_dialog.png);
    background-color: #fff;
    background-position: 10px;
    background-repeat: no-repeat;
    background-size: 15px;
}

/* Hide HTML5 Up and Down arrows. */
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}


@import url(http://weloveiconfonts.com/api/?family=entypo);

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.pagination-container {
	margin-top: 1em;
	padding-top: 2em;
	text-align: center;
  display: inline-block;
  padding-left: 50%;
  padding-right: 50%;
}

.pagination-item {
	list-style-type: none;
	display: inline-block;
	border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}

	.pagination-item:hover,
	.pagination-item.is-active {
		background-color: #fbc02d;
		border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}
		.pagination-link {
			color: #fff;
		}

	

.pagination-item.first-number {
  border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}

.pagination-link {
	padding: 1.1em 1.6em;
	display: inline-block;
	text-decoration: none;
	color: #000;
  border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}


.pagination-item--wide.first {
	margin: 0 1em 0 0;
  border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}

.pagination-item--wide.last {
	margin: 0 0 0 1em;
  border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}

.pagination-link--wide {
	text-decoration: none;
	color: #000;
	padding: 1.1em 1.6em;
  border-right: 1px solid #fbc02d;
  border-top: 1px solid #fbc02d;
  border-left: 1px solid #fbc02d;
  border-bottom: 1px solid #fbc02d;
}

.pagination-link--wide.first:before,
.pagination-link--wide.last:after {
  font-family: 'entypo';
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
}

.page-link, .pagination-datatables li a, .pagination li a{
  color: #000;
}
.page-link, .pagination-datatables li a, .pagination li a:hover{
  background-color: #fbc02d;
  color: #000;
}

.page-link, .pagination-datatables li a, .pagination li a:focus{
  background-color: #fbc02d;
  color: #000;
}

.buscador:hover{
  background-color: #ebebeb;
}

.buscador:focus{
  background-color: #e4dcdc;
}

</style>


