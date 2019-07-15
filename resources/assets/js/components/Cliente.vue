<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Clientes
                        <button @click="abrilModal('persona', 'registrar')" type="button" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Documento</option>
                                      <option value="descripcion">Email</option>
                                      <option value="descripcion">Telefono</option>
                                    </select>
                                    <input type="text" v-model="buscar"  @keyup.enter="listarPersona(1,buscar,criterio)"   class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Tipo Documento</th>
                                    <th>Numero</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td>
                                        <button @click="abrilModal('persona', 'actualizar', persona)" type="button" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.tipo_documento"></td>
                                    <td v-text="persona.num_documento"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="paginacion.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : ''] ">
                                    <a class="page-link" href="#"  @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <!-- <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li> -->
                                <li class="page-item" v-if="paginacion.current_page < paginacion.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}"  role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- a'adiendo titulo, dinamico -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close"  @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de cliente">
                                        <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="tipo_documento" class="form-control" placeholder="Tipo de Documento">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Numero Documento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="num_documento" class="form-control" placeholder="Numero de documento">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="">
                                        <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="ej: example@gmail.com">
                                    </div>
                                </div>

                                    <!-- <div v-show="errorCategoria" class="form-group div-error" > -->
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMjs" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    <!-- </div> -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                             <button v-if="tipoAccion==1" type="button" class="btn btn-primary" @click="registrarCliente()">Guardar</button>
                             <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        
        </main>
</template>






<script>
  export default {

      data() {
          return {
              persona_id:0,
              nombre : '',
              tipo_documento: 'DNI',
              num_documento: '',
              direccion: '',
              telefono: '',
              email: '',
              arrayPersona : [], // para almacenar la lista de categorias
              modal : 0 , //para mostrar o ocultar la ventana modal
              tituloModal : '',
              tipoAccion: 0,
            //  errorCategoria : 0,
              errorMostrarMjs: [],
              paginacion: {
                'total' : 0,
                'current_page' :0,
                'per_page' :0,
                'last_page' : 0 ,
                'from' :0,
                'to' :0
              },
              offset:3,
              criterio: 'nombre',
              buscar: ''
          }
      },
      computed:{
          isActived: function(){
              return this.paginacion.current_page;
          },

          //calcula los elementos de la paginacion
          pagesNumber: function(){
              if(!this.paginacion.to){
                  return [];
              }
              var from = this.paginacion.current_page - this.offset;
              if(from < 1){
                  from = 1;
              }
              var to = from + (this.offset + 2);
              if(to >= this.paginacion.last_page){
                  to = this.paginacion.last_page;
              }

              var pagesArray = [];
              while( from <= to){
                  pagesArray.push(from);
                  from++;
              }
              return pagesArray;
          }
      },
    methods :{
        listarPersona(page,buscar,criterio){
            let me = this;
            var url = '/cliente?page='+page + '&buscar='+ buscar + '&criterio=' + criterio;
            //obteniendo todo lo que me devuelve la lista
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayPersona = respuesta.personas.data;
                me.paginacion = respuesta.pagination;
            })
            .catch(function(error) {
                 console.log(error);
            });
        },
         cambiarPagina(page,buscar,criterio){
             let me = this;
                //actualiza la pagina actual
             me.paginacion.current_page = page;
             //envia la peticion para visualizar la data de esa pagina
             me.listarPersona(page,buscar,criterio);
        },
        registrarCliente(){
            // if(this.validarCategoria()){
            //     return;
            // }
            this.errorMostrarMjs = [];
            if(!this.nombre){
               this.errorMostrarMjs.push("El nombre del cliente es requerido!");
            } 
            let me = this;
           
             axios.post('/cliente/registrar',{
                  'nombre' : this.nombre,
                  'tipo_documento': this.tipo_documento,
                  'num_documento': this.num_documento,
                  'direccion': this.direccion,
                  'telefono': this.telefono,
                  'email': this.email,
             }).then(function (response) {
                 me.cerrarModal();
                 me.listarPersona(1, '' , 'nombre');
             }).catch(function (error) {
                 console.log(error);
             })

        },
        actualizarPersona(){
            this.errorMostrarMjs = [];
            if(!this.nombre){
               this.errorMostrarMjs.push("El nombre del cliente es requerido!");
            }else{

            let me = this;
            axios.put('/cliente/actualizar',{
                  'nombre' : this.nombre,
                  'tipo_documento': this.tipo_documento,
                  'num_documento': this.num_documento,
                  'direccion': this.direccion,
                  'telefono': this.telefono,
                  'email': this.email,
                  'id':this.persona_id
             }).then(function (response) {
                 me.cerrarModal();
                 me.listarPersona(1, '' , 'nombre');
             }).catch(function (error) {
                 console.log(error);
             }) 

            }
        },
        // validarCategoria(){
        //     this.errorCategoria = 0;
        //     this.errorMostrarMjs = [];

        //     if(!this.nombre) this.errorMostrarMjs.push("El nombre de la categoria es requerido!");
        //     if(this.errorMostrarMjs.length) this.errorCategoria = 1;
        //     return this.errorCategoria;
        // },
        cerrarModal(){
             this.modal = 0;
             this.tituloModal = '';
             this.nombre = '';
             this.tipo_documento='DNI';
             this.num_documento= '';
             this.direccion= '';
             this. telefono= '';
             this.email= '';
        },
        abrilModal(modelo, accion, data=[]){
            switch(modelo){
                case "persona":
                {
                    switch(accion){
                        case 'registrar':
                        {
                             this.modal = 1;
                             this.tituloModal = 'Registrar Cliente';
                             this.tipoAccion = 1;
                             this.nombre = '';
                             this.tipo_documento='DNI';
                             this.num_documento= '';
                             this.direccion= '';
                             this. telefono= '';
                             this.email= '';
                             break;

                        }
                        case 'actualizar':
                        {
                            console.log(data);
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Cliente';
                            this.tipoAccion = 2;
                            this.nombre = data['nombre'];
                            this.tipo_documento=data['tipo_documento'];
                            this.num_documento= data['num_documento'];
                            this.direccion= data['direccion'];
                            this.telefono= data['telefono'];
                            this.email= data['email'];
                            this.persona_id = data['id'];
                            break;
                        }

                    }
                }

            }
        }
    },
    mounted(){
         this.listarPersona(1,this.buscar, this.criterio);
     }
    }
</script>

<style>

.modal-content{
    width: 100% !important;
    position: absolute !important;
}
.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a;
}

.div-error{
    display: flex;
    justify-content: center;
}

.text-error{
    color: red !important;
    font-weight: bold; 

}


</style>
