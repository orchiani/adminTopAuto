<template>
<div>
  <div class="card">
                    <div class="buscador-div">
                        <input v-model="buscar" maxlength="100" v-on:input="listarProductos(1, buscar)" type="textfield" class="buscador" placeholder="Buscar...">
                    </div>
                    <div class="card-body">
                    </div>
                </div>
<div class="tabla-div">
    <table class="table-prueba">
        <thead>
          <tr style="text-align: center;">
              <th  class="table-header-prueba table-data-longtextA"> Código </th>
              <th  class="table-header-prueba table-data-longtextB"> Descripcion </th>
              <th  class="table-header-prueba table-data-longtextC"> Descripcion Adicional </th>
              <th  class="table-header-prueba table-data-longtextD"> Precio </th>
              <th  class="table-header-prueba table-data-longtextE"> Estado </th>
            </tr>
          </thead>
          <tbody>
            <tr v-on:click="abrirModal('producto', 'actualizar', producto)" v-for="producto in arrayProducto" :key="producto.codigo">
            <td style="max-width=20%; min-width=15%;" class="table-data-prueba"><div class="div-prueba1" v-text="producto.codigo"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba"><div class="div-prueba2" v-text="producto.descripcion"> </div> </td>
            <td style="max-width=20%; min-width=20%;" class="table-data-prueba"><div class="div-prueba3" v-text="producto.descripcion_adicional"> </div> </td>
            <td style="max-width=20%; min-width=15%;" class="table-data-prueba"><div class="div-prueba4" v-text="'$ ' +producto.precio"> </div> </td>
            <td class="table-data-icons">
            <div style="display: inline;" v-if="producto.activo==1">
              <span class="badge badge-danger">Suspendido</span>
            </div>
            <div style="display: inline;" v-if="producto.oferta_volumen==1">
              <span class="badge badge-warning">Oferta por volumen</span>
            </div>
            <div style="display: inline;" v-if="producto.envase_nuevo==1">
              <span class="badge badge-primary">Envase nuevo</span>
            </div>
            <div style="display: inline;" v-if="producto.escala_descuento==1">
              <span class="badge badge-warning">Escala por descuentos</span>
            </div>
            <div style="display: inline;" v-if="producto.oferta_lanzamiento==1">
              <span class="badge badge-success">Oferta por lanzamiento</span>
            </div>
            <div style="display: inline;" v-if="producto.agotar_stock==1">
              <span class="badge badge-danger">Agotar Stock</span>
            </div>
            <div style="display: inline;" v-if="producto.embarque==1">
              <span class="badge badge-danger">Embarque</span>
            </div>
            </td>
            </tr>
            <div id="container-floating">
           <div id="floating-button" v-on:click="abrirModal('producto', 'registrar')">
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
        <div class="modal-content">

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
        </thead>
        <tbody>
        <tr>
        <td style="border-bottom: 0; width: 250px; ">
        <div style="padding-left: 0; width: 100;" class="primer-fila-modal">
         <label style="border-bottom: 0; width: 50%; padding-left: 0;" class="headers-primer-fila-modal table-headers-modal"> Codigo </label>
        <input maxlength="10" :disabled="modificar == 0 || tipoAccion==2" type="text" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45);  text-align:center;  width: 100%; padding: 7px 0; " v-model="codigo" onblur="this.placeholder = 'Codigo..'" onfocus="this.placeholder = ''" placeholder="Codigo..">
        </div>
        </td>
         <td style="border-bottom: 0; width: 600px;">
        <div style="padding-left: 40px; width: 100%;" class="primer-fila-modal">
         <label style="border-bottom: 0; width: 50%; padding-left: 0;" class="headers-primer-fila-modal table-headers-modal"> Descripcion </label>
       <input maxlength="60" :disabled="modificar == 0" type="text"  style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center; width: 100%; padding: 7px 0;" v-model="descripcion" onblur="this.placeholder = 'Descripcion..'" onfocus="this.placeholder = ''" placeholder="Descripcion..">
        </div>
        </td>
        <td style="border-bottom: 0; padding-left: 45px;">
        <div v-if="imagen && !url">
          <img style="height: 60px; width: 100px;" :src="baseUrl + '/img/productos/' + imagen">
           </div>
           <div  v-if="url  && !imagen">
          <img style="height: 60px; width: 100px;" :src="url">
           </div>
        </td>
         </tr>

         </tbody>
        </table>
        </div>
        <br>
        <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0; padding-left: 1%;"  class="headers-primer-fila-modal table-headers-modal"> Precio </th>
        <th style="border-bottom: 0; padding-left: 1%;" class="headers-primer-fila-modal table-headers-modal"> Precio 2 </th>
        <th style="border-bottom: 0; padding-left: 1%;" class="headers-primer-fila-modal table-headers-modal"> Precio 3 </th>
        </thead>
        <tbody>
        <td style="border-bottom: 0;">
        <div style="padding-left: 0px; " class="primer-fila-modal">
        <input maxlength="9" :disabled="modificar == 0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="precio" onblur="this.placeholder = 'Precio..'" onfocus="this.placeholder = ''" placeholder="Precio..">
          </div>
         </td>
        <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
        <input maxlength="9" :disabled="modificar == 0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="precio2" onblur="this.placeholder = 'Precio 2..'" onfocus="this.placeholder = ''" placeholder="Precio 2..">
          </div>
         </td>
         <td style="border-bottom: 0; padding-left: 40px;">
        <div class="primer-fila-modal">
        <input maxlength="9" :disabled="modificar == 0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="precio3" onblur="this.placeholder = 'Precio 3..'" onfocus="this.placeholder = ''" placeholder="Precio 3..">
          </div>
         </td>
        </tbody>
        </table>
        <br>
        <table style="width: 100%;">
        <thead>
        <th style="border-bottom: 0;" class="texto-descripcion table-headers-modal" > Descripcion adicional </th>
        </thead>
        <tbody>
        <td style="border-bottom: 0;">
        <input maxlength="120" :disabled="modificar == 0" type="textarea" style="border: 0; border-bottom: 1px solid rgb(251, 192, 45); text-align:center;  width: 100%; padding: 7px 0;" v-model="descripcion_adicional" onblur="this.placeholder = 'Descripcion adicional..'" onfocus="this.placeholder = ''" placeholder="Descripcion adicional..">
        </td>
        </tbody>
        </table>

        <br>
        <table style="width: 100%; text-align:center;">
        <thead>
        <th style="border-bottom: 0;" class="table-headers-modal" > Suspendido </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Oferta x volumen </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Envase nuevo </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Escala descuentos </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Oferta x lanzamiento </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Agotar stock </th>
        <th style="border-bottom: 0;" class="table-headers-modal" > Embarque </th>
        </thead>
        <tbody>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
         <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="activo" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
             <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="oferta_volumen" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
            <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="envase_nuevo" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
        <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="escala_descuento" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
         <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="oferta_lanzamiento" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
          <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="agotar_stock" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        <td style="padding-top: 7px;padding-left: 20px; border-bottom: 0;">
        <label class="label">
                 <input class="label__checkbox" :disabled="modificar == 0" type="checkbox" checked="unchecked" v-model="embarque" />
                    <span class="label__text">
                       <span class="label__check">
                         <i class="fa fa-check icon"></i>
                       </span>
                   </span>
            </label>
        </td>
        </tbody>
        </table>
          <br>
          <br>
          <div class="ultima-fila-modal">
          <table style="width: 100%; text-align:center;">
          <thead>
          <th style="border-bottom: 0;" class="table-headers-modal" > Marca </th>
          <th style="border-bottom: 0;" class="table-headers-modal" > Categoria </th>
          <th style="border-bottom: 0;" class="table-headers-modal"> Fragancias </th>
          <th style="border-bottom: 0;" class="table-headers-modal"> Talles </th>
          </thead>
          <tbody>
          <td style="border-bottom: 0; padding-bottom: 45px;" >
          <select :disabled="modificar == 0" v-model="id_marca">
          <option v-for="marca in arrayMarcas" :key="marca.codigo" :value="marca.codigo" v-text="marca.nombre" > </option>
          </select>
          </td>
          <td  style="border-bottom: 0; padding-bottom: 45px;" >
           <select :disabled="modificar == 0" v-model="id_categoria">
             <option v-for="categoria in arrayCategorias" :key="categoria.codigo" :value="categoria.codigo" v-text="categoria.nombre" > </option>
          </select>
          </td>

          //Selectores Multiples
          <td style="border-bottom: 0;" >
           <select :disabled="modificar == 0" multiple v-model="fragancias">
             <option  v-for="fragancia in arrayFragancias" :key="fragancia.codigo" :value="fragancia.codigo" v-text="fragancia.nombre" > </option>
          </select>
          </td>
          <td style="border-bottom: 0;" >
           <select :disabled="modificar == 0" multiple v-model="talles">
              <option v-for="talle in arrayTalles" :key="talle.codigo" :value="talle.codigo" v-text="talle.nombre" > </option>
          </select>
          </td>
          </tbody>

          </table>
          </div>

        </div>

        <!-- Modal footer -->
        <div style="border-top: 0;" class="modal-footer">
        <div class="errores-modal" v-show="errorProducto==1">
           <div>
               <div class="icon-warning" v-for="error in errorMostrarMsjProducto" :key="error" v-text="error">
               </div>
            </div>
         </div>
         <input id="selectedFile" type="file" @change="handlerImagenes" style="position:absolute;visibility:hidden;"/>
          <button type="button" style="margin-right: 25%;" :disabled="modificar == 0" class="btn btn-secondary" onclick="selectedFile.click()" v-on:click="imagen = ''"> Imagen </button>
          <button type="button" class="btn btn-secondary" v-on:click="cerrarModal()" >Cerrar</button>
          <button type="button" class="btn btn-secondary" v-on:click="registrarProducto()" v-if="tipoAccion==1">Guardar</button>
          <button type="button" class="btn btn-secondary" v-if="modificar==1 && tipoAccion==2" v-on:click="handlerModificar()">Guardar</button>
          <button type="button" class="btn btn-secondary" v-if="tipoAccion==2 && modificar==0" v-on:click="activarModificarModal()">Modificar</button>
        </div>

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
          codigo: '',
          descripcion: '',
          descripcion_adicional: '',
          id_marca: '',
          id_categoria: '',
          oferta_volumen: '',
          envase_nuevo: '',
          escala_descuento: '',
          oferta_lanzamiento: '',
          agotar_stock: '',
          embarque: '',
          precio: '',
          activo: '',
          arrayProducto: [],
          modal: 0,
          tituloModal: '',
          tipoAccion: 0,
          errorProducto: 0,
          errorMostrarMsjProducto: [],
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
          precio2: '',
          precio3: '',
          imagen: '',
          url: '',
          arrayFragancias: [],
          arrayTalles: [],
          arrayCategorias: [],
          arrayMarcas: [],
          fragancias: {},
          talles: {},
          fragancias2: [],
          fragancias3: [],
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
        listarFragancias(page, buscar){
          let me = this;
          var url = '/fragancia';
          axios.get(url)
          .then(function(response){
            me.arrayFragancias = response.data.fragancias.data;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        obtenerFraganciasPorProducto(codigo){
          let me = this;
          var url = '/producto/fragancias/codigo='+codigo;
          axios.get(url)
          .then(function(response){
            me.fragancias2 = response.data.fragancias;
            console.log(me.fragancias2.id_fragancia);
          })
          .catch(function(error){
            console.log(error);
          })
        },
        listarTalles(){
          let me = this;
          var url = '/talles';
          axios.get(url)
          .then(function(response){
            me.arrayTalles = response.data.talles;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        listarMarcas(page, buscar){
          let me = this;
          var url = '/marca';
          axios.get(url)
          .then(function(response){
            me.arrayMarcas = response.data.marcas.data;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        listarCategorias(page, buscar){
          let me = this;
          var url = '/categoria';
          axios.get(url)
          .then(function(response){
            me.arrayCategorias = response.data.categorias.data;
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        listarProductos(page, buscar){
          let me = this;
          var url = '/producto?page=' + page + '&buscar=' + buscar;
          axios.get(url)
          .then(function(response){
            me.arrayProducto = response.data.productos.data;
            me.pagination = response.data.pagination;
            me.listarMarcas();
            me.listarCategorias();
            me.listarFragancias();
            me.listarTalles();
            me.getBaseUrl();
          })
          .catch(function(error) {
            console.log(error);
          });
        },
        activarModificarModal(){
              this.modificar = 1;
        },
        desactivarModificarModal(){
              this.modificar = 0;
        },
        cambiarPagina(page, buscar){
            let me = this;
            me.pagination.current_page = page;
            me.listarProductos(page, buscar);
        },
        registrarProducto(){
          if(this.validarProducto()){
            return;
          }
          let me = this;
          me.getBaseUrl();
          axios.post('/producto/agregar', {
                   'codigo': this.codigo,
                   'descripcion': this.descripcion,
                   'descripcion_adicional': this.descripcion_adicional,
                   'id_marca': this.id_marca,
                   'id_categoria': this.id_categoria,
                   'precio': this.precio.replace(",", "."),
                   'precio2': this.precio2.replace(",", "."),
                   'precio3': this.precio3.replace(",", "."),
                   'image': this.image,
                   'activo': this.activo,
                   'oferta_volumen': this.oferta_volumen,
                   'envase_nuevo': this.envase_nuevo,
                   'escala_descuento': this.escala_descuento,
                   'oferta_lanzamiento': this.oferta_lanzamiento,
                   'agotar_stock': this.agotar_stock,
                   'fragancias': this.fragancias,
                   'embarque': this.embarque,
                   'talles': this.talles,
          }).then(function (response){
              me.cerrarModal();
              me.listarProductos(1, '');
          }).catch(function (error){
              console.log(error.response);
          })
        },
        handlerModificar(){
          this.desactivarModificarModal();
          this.actualizarProducto();
        },
        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case "producto":
              {
                switch(accion){
                  case 'registrar':
                  {
                    me.getBaseUrl();
                    this.modal = 1;
                    this.codigo = '';
                    this.descripcion = '';
                    this.descripcion_adicional = '';
                    this.id_marca = 0;
                    this.id_categoria = '';
                    this.precio = '';
                    this.precio2 = '';
                    this.precio3 = '';
                    this.activo = false;
                    this.oferta_volumen = false;
                    this.envase_nuevo = false;
                    this.escala_descuento = false;
                    this.oferta_lanzamiento = false;
                    this.agotar_stock = false;
                    this.embarque = false;
                    this.fragancias = 0;
                    this.talles = 0;
                    this.imagen = '';
                    this.image = '';
                    this.url = '';
                    this.tituloModal = 'Añadir Producto';
                    this.tipoAccion = 1;
                    this.modificar = 1;
                    break;
                  }
                  case 'actualizar':
                  {
                    me.getBaseUrl();
                    this.modal = 1;
                    this.codigo = data['codigo'];
                    this.descripcion = data['descripcion'];
                    this.descripcion_adicional = data['descripcion_adicional'];
                    this.id_marca = data['id_marca'];
                    this.id_categoria = data['id_categoria'];
                    this.precio = data['precio'];
                    this.precio2 = data['precio2'];
                    this.precio3 = data['precio3'];
                    this.activo = data['activo'];
                    this.oferta_volumen = data['oferta_volumen'];
                    this.envase_nuevo = data['envase_nuevo'];
                    this.escala_descuento = data['escala_descuento'];
                    this.oferta_lanzamiento = data['oferta_lanzamiento'];
                    this.agotar_stock = data['agotar_stock'];
                    this.embarque = data['embarque'];
                    this.fragancias = data['fragancias'];
                    this.talles = data['talles'];
                    this.imagen = data['imagen'];
                    this.tituloModal = 'Modificar Producto';
                    this.tipoAccion = 2;
                    this.modificar = 0;
                    break;
                  }
                }
              }
          }
        },
        actualizarProducto(){
        if(this.validarProducto()){
            return;
          }
          let me = this;
          axios.post('/producto/actualizar', {
                   'codigo': this.codigo,
                   'descripcion': this.descripcion,
                   'descripcion_adicional': this.descripcion_adicional,
                   'id_marca': this.id_marca,
                   'id_categoria': this.id_categoria,
                   'precio': this.precio,
                   'precio2': this.precio2,
                   'precio3': this.precio3,
                   'activo': this.activo,
                   'oferta_volumen': this.oferta_volumen,
                   'envase_nuevo': this.envase_nuevo,
                   'escala_descuento': this.escala_descuento,
                   'oferta_lanzamiento': this.oferta_lanzamiento,
                   'agotar_stock': this.agotar_stock,
                   'embarque': this.embarque,
                   'fragancias': this.fragancias,
                   'talles': this.talles,
                    'image': this.image,

          }).then(function (response){
              me.cerrarModal();
              me.listarProductos(1, '');
          }).catch(function (error){
              console.log(error.response);
          })
        },
        validarProducto(){
           this.errorProducto = 0;
           this.errorMostrarMsjProducto = [];
           if(!this.codigo){
             this.errorMostrarMsjProducto.push("El código del articulo es requerido");
           }
           if(!this.descripcion){
             this.errorMostrarMsjProducto.push("La descripción del articulo es requerida");
           }
           if(this.errorMostrarMsjProducto.length) this.errorProducto = 1;

          return this.errorProducto;
        },
        cerrarModal(){
          this.modal = 0;
          this.tituloModal = '';
          this.nombre = '';
          this.descripcion = '';
          this.descripcion_adicional = '';
          this.id_marca = '';
          this.id_categoria = '';
          this.precio = '';
          this.precio2 = '';
          this.precio3 = '';
          this.activo = '';
          this.oferta_volumen = '';
          this.envase_nuevo = '';
          this.escala_descuento = '';
          this.oferta_lanzamiento = '';
          this.agotar_stock = '';
          this.embarque = '';
          this.fragancias = {};
          this.talles = {};
          this.imagen = '';
          this.url = '';
          this.image = '';
        }
      },
        mounted() {
            this.listarProductos(1, this.buscar);
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

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
    width: 60%;
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
