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
                        <i class="fa fa-align-justify"></i> roles
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar"  @keyup.enter="listarRol(1,buscar,criterio)"   class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarRol(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol in arrayRol" :key="rol.id">
                                    <td v-text="rol.nombre"></td>
                                    <td v-text="rol.descripcion"></td>
                                    <td>
                                        <div v-if="rol.condicion">
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
           
          
        
        </main>
</template>






<script>
  export default {

      data() {
          return {
              rol_id:0,
              nombre : '',
              descripcion : '',
              arrayRol : [], // para almacenar la lista de categorias
              modal : 0 , //para mostrar o ocultar la ventana modal
              tituloModal : '',
              tipoAccion: 0,
            //  errorCategoria : 0,
            
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

        listarRol(page,buscar,criterio){
            let me = this;
            var url = '/rol?page='+page + '&buscar='+ buscar + '&criterio=' + criterio;
            //obteniendo todo lo que me devuelve la lista
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayRol = respuesta.roles.data;
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
             me.listarRol(page,buscar,criterio);
        }
    },
    mounted(){
         this.listarRol(1,this.buscar, this.criterio);
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
