<template>
<div>
  <div class="card">
                    <div class="buscador-div">
                        <input v-model="buscar" maxlength="100" v-on:input="listarClientes(1, buscar)" type="textfield" class="buscador" placeholder="Buscar...">
                    </div>
                    <div class="card-body">
                    </div>
                </div>
<div class="tabla-div">
    <table class="table-prueba">
        <thead>
          <tr style="text-align: center;">
              <th  class="table-header-prueba table-data-longtextC"> Código </th>
              <th  class="table-header-prueba table-data-longtextA"> Nombre de fantasía </th>
              <th  class="table-header-prueba table-data-longtextB"> Razon social </th>
            </tr>
          </thead>
          <tbody>
            <tr v-on:click="abrirModal('cliente', 'actualizar', cliente)" v-for="cliente in arrayClientes" :key="cliente.codigo">
             <td style="max-width=20%; min-width=15%;" class="table-data-prueba"><div class="div-prueba1" v-text="cliente.codigo"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba"><div class="div-prueba2" v-text="cliente.nombre_fantasia"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba"><div class="div-prueba3" v-text="cliente.razon_social"> </div> </td>
             </tr>
            <div id="container-floating">
           <div id="floating-button" v-on:click="abrirModal('cliente', 'registrar')">
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
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Codigo </th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Razon social</th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Nombre de fantasía </th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> CUIT / DNI </th>
        </thead>
        <tbody>
        <tr>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0 || tipoAccion==2" maxlength="20" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="codigo" type="text" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="40" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="razon" type="text" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="60" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="nombre" type="text" />
        </div>
        </td>
         <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="30" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="cuitdni" type="text" />
        </div>
        </td>
        </tr>
        </tbody>
        </table>
         <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Nro de cuenta</th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Teléfono </th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Direccion </th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Código postal </th>
        </thead>
        <tbody>
        <tr>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="cuenta" type="number" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="25" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="telefono" type="text" />
        </div>
        </td>
         <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="25" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="direccion" type="text" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="20" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="codigopostal" type="text" />
        </div>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Web </th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Email</th>
        <th style="border-bottom: 0; padding-left: 40px;" class="headers-primer-fila-modal table-headers-modal"> Teléfono 2 </th>
        </thead>
        <tbody>
        <tr>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
         <input :disabled="modificar == 0" maxlength="30" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="web" type="text" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="30" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="email" type="email" />
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
          <input :disabled="modificar == 0" maxlength="30" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="telefono2" type="text" />
        </div>
        </td>
        </tr>
        </tbody>
        </table>
         <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0; padding-left: 40px; padding-top: 2%;" class="headers-primer-fila-modal table-headers-modal"> Provincia </th>
        <th style="border-bottom: 0; padding-left: 40px; padding-top: 2%;" class="headers-primer-fila-modal table-headers-modal"> Localidad </th>
        <th style="border-bottom: 0; padding-left: 40px; padding-top: 2%;" class="headers-primer-fila-modal table-headers-modal"> Condición de IVA </th>
        </thead>
        <tbody>
        <tr>
         <td style="border-bottom: 0; padding-left: 6%;">
           <select :disabled="modificar == 0" style="text-align: center;" v-model="provincia">
              <option v-for="provincia in arrayProvincias" :key="provincia.codigo" :value="provincia.codigo" v-text="provincia.nombre" > </option>
          </select>
          </td>
         <td style="border-bottom: 0; padding-left: 10%;">
           <select :disabled="modificar == 0" style="text-align: center;" v-model="localidad">
              <option v-for="localidad in arrayLocalidades" :key="localidad.codigo" :value="localidad.codigo" v-text="localidad.nombre" > </option>
          </select>
          </td>
        <td style="border-bottom: 0; padding-left: 10%;">
           <select :disabled="modificar == 0" style="text-align: center;" v-model="condiciondeiva">
              <option v-for="condiciondeiva in arrayCondiciondeiva" :key="condiciondeiva.codigo" :value="condiciondeiva.codigo" v-text="condiciondeiva.nombre" > </option>
          </select>
          </td>
        </tr>
        </tbody>
        </table>
        </div>

        </div>
          </div>



        <!-- Modal footer -->
        <div style="border-top: 0; background: #fff;" class="modal-footer">
        <div class="errores-modal" v-show="errorCliente==1">
           <div>
               <div class="icon-warning" v-for="error in errorMostrarMsjCliente" :key="error" v-text="error">
               </div>
            </div>
         </div>
          <button type="button" class="btn btn-secondary" v-on:click="cerrarModal()" >Cerrar</button>
          <button type="button" class="btn btn-secondary" v-on:click="registrarCliente()" v-if="tipoAccion==1">Guardar</button>
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
          codigo: 0,
          nombre: '',
          razon: '',
          cuitdni: '',
          condiciondeiva: 0,
          email: '',
          provincia: 0,
          localidad: 0,
          direccion: '',
          codigopostal: '',
          web: '',
          cuenta: '',
          telefono: '',
          telefono2: '',
          modal: 0,
          tituloModal: '',
          tipoAccion: 0,
          errorCliente: 0,
          arrayClientes: [],
          errorMostrarMsjCliente: [],
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
          arrayCondiciondeiva: [],
          arrayProvincias: [],
          arrayLocalidades: []
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
         listarProvincias(){
          let me = this;
          var url = '/provincias';
          axios.get(url)
          .then(function(response){
            me.arrayProvincias = response.data.provincias;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
         listarLocalidades(){
          let me = this;
          var url = '/localidades';
          axios.get(url)
          .then(function(response){
            me.arrayLocalidades = response.data.localidades;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
         listarCondicionDeIva(){
          let me = this;
          var url = '/condiciondeiva';
          axios.get(url)
          .then(function(response){
            me.arrayCondiciondeiva = response.data.condiciondeiva;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        listarClientes(page, buscar){
          let me = this;
          var url = '/cliente?page=' + page + '&buscar=' + buscar;
          axios.get(url)
          .then(function(response){
            me.arrayClientes = response.data.clientes.data;
            me.pagination = response.data.pagination;
            me.listarProvincias();
            me.listarLocalidades();
            me.listarCondicionDeIva();

          })
          .catch(function(error) {
            console.log(error);
          });
        },
        cambiarPagina(page, buscar){
            let me = this;
            me.pagination.current_page = page;
            me.listarClientes(page, buscar);
        },
        registrarCliente(){
          if(this.validarCliente()){
            return;
          }
          this.modificar = 1;
          let me = this;
          axios.post('/cliente/agregar', {
                   'nombre_fantasia': this.nombre,
                   'razon_social': this.razon,
                   'id_provincia': this.provincia,
                   'id_iva': this.condiciondeiva,
                   'id_localidad': this.localidad,
                   'email': this.email,
                   'web': this.web,
                   'cuenta': this.cuenta,
                   'cuit': this.cuitdni,
                   'telefono': this.telefono,
                   'telefono2': this.telefono2,
                   'direccion': this.direccion,
                   'codigo_postal': this.codigopostal,
                   'codigo': this.codigo
          }).then(function (response){
              me.cerrarModal();
              me.listarClientes(1, '');
              this.modificar = 0;
          }).catch(function (error){
              console.log(error.response);
          })
        },
        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case "cliente":
              {
                switch(accion){
                  case 'registrar':
                  {
                   this.nombre = '';
                   this.razon = '';
                   this.provincia = 0;
                   this.condiciondeiva = 0;
                   this.localidad = 0;
                   this.email = '';
                   this.web = '';
                   this.cuenta = '';
                   this.cuitdni = '';
                   this.telefono = '';
                   this.telefono2 = '';
                   this.direccion = '';
                   this.codigopostal = '';
                   this.codigo = '';
                    this.modal = 1;
                    this.tituloModal = 'Añadir Cliente';
                    this.tipoAccion = 1;
                    this.modificar = 1;
                    break;
                  }
                  case 'actualizar':
                  {
                     this.nombre = data['nombre_fantasia'];
                   this.razon = data['razon_social'];
                   this.provincia = data['id_provincia'];
                   this.condiciondeiva = data['id_iva'];
                   this.localidad = data['id_localidad'];
                   this.email = data['email'];
                   this.web = data['web'];
                   this.cuenta = data['cuenta'];
                   this.cuitdni = data['cuit'];
                   this.telefono = data['telefono'];
                   this.telefono2 = data['telefono2'];
                   this.direccion = data['direccion'];
                   this.codigopostal = data['codigo_postal'];
                   this.codigo = data['codigo'];
                    this.modal = 1;
                    this.tituloModal = 'Modificar Cliente';
                    this.tipoAccion = 2;
                    this.modificar = 0;
                    break;
                  }
                }
              }
          }
        },
        actualizarCliente(){
        if(this.validarCliente()){
            return;
          }
          let me = this;
          axios.post('/cliente/actualizar', {
                   'nombre_fantasia': this.nombre,
                   'razon_social': this.razon,
                   'id_provincia': this.provincia,
                   'id_iva': this.condiciondeiva,
                   'id_localidad': this.localidad,
                   'email': this.email,
                   'web': this.web,
                   'cuenta': this.cuenta,
                   'cuit': this.cuitdni,
                   'telefono': this.telefono,
                   'telefono2': this.telefono2,
                   'direccion': this.direccion,
                   'codigo_postal': this.codigopostal,
                   'codigo': this.codigo
          }).then(function (response){
              me.cerrarModal();
              me.listarClientes(1, '');
          }).catch(function (error){
              console.log(error.response);
          })
        },
        validarCliente(){
           this.errorCliente = 0;
           this.errorMostrarMsjCliente = [];
           if(!this.razon){
             this.errorMostrarMsjCliente.push("La razon social del cliente es requerida");
           }
           if(!this.nombre){
             this.errorMostrarMsjCliente.push("El nombre del cliente es requerido");
           }
           if(!this.codigo){
             this.errorMostrarMsjCliente.push("El código del cliente es requerido");
           }

           if(this.errorMostrarMsjCliente.length) this.errorCliente = 1;

          return this.errorCliente;
        },
        cerrarModal(){
          this.modal = 0;
          this.tituloModal = '';
          this.nombre = '';
          this.codigo = '';
          this.modificar = 0;
        },
      activarModificarModal(){
              this.modificar = 1;
        },
        desactivarModificarModal(){
              this.modificar = 0;
        },
         handlerModificar(){
          this.desactivarModificarModal();
          this.actualizarCliente();
        }
        },
        mounted() {
            this.listarClientes(1, this.buscar);
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
