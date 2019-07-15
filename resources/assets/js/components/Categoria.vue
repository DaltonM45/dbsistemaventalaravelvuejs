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
                        <i class="fa fa-align-justify"></i> Categorías
                        <button @click="abrilModal('categoria', 'registrar')" type="button" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar"  @keyup.enter="listarCategorias(1,buscar,criterio)"   class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCategorias(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                    <td>
                                        <button @click="abrilModal('categoria', 'actualizar', categoria)" type="button" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="categoria.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categoria.id)" >
                                            <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(categoria.id)" >
                                            <i class="icon-check"></i>
                                            </button>
                                        </template>
                                       
                                    </td>
                                    <td v-text="categoria.nombre"></td>
                                    <td v-text="categoria.descripcion"></td>
                                    <td>
                                        <div v-if="categoria.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">desactivado</span>
                                        </div>
                                        
                                    </td>
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                        <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="ingrese descripcion">
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
                             <button v-if="tipoAccion==1" type="button" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                             <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
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
              categoria_id:0,
              nombre : '',
              descripcion : '',
              arrayCategoria : [], // para almacenar la lista de categorias
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

        listarCategorias(page,buscar,criterio){
            let me = this;
            var url = '/categoria?page='+page + '&buscar='+ buscar + '&criterio=' + criterio;
            //obteniendo todo lo que me devuelve la lista
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayCategoria = respuesta.categorias.data;
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
             me.listarCategorias(page,buscar,criterio);
        },
        registrarCategoria(){
            // if(this.validarCategoria()){
            //     return;
            // }
            this.errorMostrarMjs = [];
            if(!this.nombre){
               this.errorMostrarMjs.push("El nombre de la categoria es requerido!");
            } else{

            let me = this;
           
             axios.post('/categoria/registrar',{
                 'nombre' : this.nombre,
                 'descripcion' : this.descripcion
             }).then(function (response) {
                 me.cerrarModal();
                 me.listarCategorias(1, '' , 'nombre');
             }).catch(function (error) {
                 console.log(error);
             })

            }

        },
        actualizarCategoria(){
            this.errorMostrarMjs = [];
            if(!this.nombre){
               this.errorMostrarMjs.push("El nombre de la categoria es requerido!");
            }else{

            let me = this;
            axios.put('/categoria/actualizar',{
                
                 'nombre' : this.nombre,
                 'descripcion' : this.descripcion,
                 'id' : this.categoria_id

             }).then(function (response) {
                 me.cerrarModal();
                 me.listarCategorias(1, '' , 'nombre');
             }).catch(function (error) {
                 console.log(error);
             }) 

            }
        },
        desactivarCategoria(id){
            swal({
            title: "Estas seguro de desactivar esta categoria?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {

                let me = this;
                axios.put('/categoria/desactivar',{
                    'id' :id
                }).then(function (response) {
                    me.listarCategorias(1, '' , 'nombre');

                    swal("El registro ha sido desactivado", {
                    icon: "success",
                    });

                }).catch(function (error) {
                    console.log(error);
                })
            }
            });
        },
        activarCategoria(id){
             let me = this;
                axios.put('/categoria/activar',{
                    'id' :id
                }).then(function (response) {
                    me.listarCategorias(1, '' , 'nombre');
                }).catch(function (error) {
                    console.log(error);
                })
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
             this.nombre='';
            this.descripcion='';
        },
        abrilModal(modelo, accion, data=[]){
            switch(modelo){
                case "categoria":
                {
                    switch(accion){
                        case 'registrar':
                        {
                             this.modal = 1;
                             this.tituloModal = 'Registrar Categoria';
                             this.nombre='';
                             this.descripcion='';
                             this.tipoAccion = 1;
                             break;

                        }
                        case 'actualizar':
                        {
                            console.log(data);
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Categoria';
                            this.tipoAccion = 2;
                            this.categoria_id = data['id'];
                            this.nombre=data['nombre'];
                            this.descripcion=data['descripcion'];
                            break;
                        }

                    }
                }

            }
        }
    },
    mounted(){
         this.listarCategorias(1,this.buscar, this.criterio);
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
