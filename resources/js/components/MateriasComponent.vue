<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <div class="modal fade" id="nmateriamodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Nueva materia</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="materia-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="materia-nombre" v-model="materia.Nombre" placeholder="Nombre">
            </div>
          </form>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores['mensaje']">
                  {{ error }}
              </p>
           </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button @click="agregarMateria()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edmateriamodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Modificar materia</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="materia-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="materia-nombre" v-model="materia.Nombre">
            </div>
          </form>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores['mensaje']">
                  {{ error }}
              </p>
           </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button @click="actualizarMateria()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelmateria" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <h4> Está seguro/a que quiere eliminar esta materia?</h4>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
           <button @click="eliminarMateria()" type="button" class="btn btn-danger">Si</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de materias</h3></i></center>
  <button @click="limpiarinputs()" type="button" class="btn btn-success" data-toggle="modal" data-target="#nmateriamodal" style="color: white">Crear</button><br><br>

  <table id="tabla_materias" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Acciones</th>
    </tr>
    </thead>
        <tbody>
            <tr v-for="(materia, index) in materias" :key="index">
                <td>{{ materia.Nombre }}</td>
                <td>
                <button data-toggle="modal" data-target="#edmateriamodal" class="btn btn-primary" @click="asignar(materia)">Modificar</button>
                <button data-toggle="modal" data-target="#modaldelmateria" class="btn btn-danger" @click="asignar(materia);pos=index">Eliminar</button></td>
            </tr>
        </tbody>
  </table>
<!--
<pre>
{{ $data }}
</pre>
-->
</div>
</div>
</template>

<style>
  #errores{ 
    color: red;
  }

  #mensaje{
    color: green;
  }
</style>

<script>
    import datatables from 'datatables'
    export default {
        data(){
            return {
                materias: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                mensaje: '',
                materia: []
            }
        },

        mounted() {
            console.log('Componente materias OK');
            this.cargar_materias();
        },

        methods: {
            asignar(materia){
                this.materia = materia;
            },

            cerrar_modal(modal_n){
                $(function () {
                    $('#'+modal_n).modal('toggle');
                });
            },

            limpiarinputs(){
                this.materia = [];
                this.errores = [];
            },

            tabla_materias(){
                    $(document).ready(function() {
                        $('#tabla_materias').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                        });
                    });
            },

            cargar_materias(){
                axios.get('/materias').then(response=>{
                    this.materias = response.data;
                    this.tabla_materias();
                });
            },

            agregarMateria(){
                let formdata = new FormData();
                formdata.append("Nombre", this.materia.Nombre);

                if(this.materia.Nombre){
                  axios.post('/materias/nuevo', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.materias.push({id:response.data.ultimoid,Nombre:this.materia.Nombre});
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('nmateriamodal');
                    }
                  });
                }
            },

            eliminarMateria(){
                axios.delete('/materias/eliminar/'+this.materia.id).then( response =>{
                    this.materias.splice(this.pos, 1);
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                    this.cerrar_modal('modaldelmateria');
                });
            },


            actualizarMateria(){
                let formdata = new FormData();
                formdata.append("id", this.materia.id);
                formdata.append("Nombre", this.materia.Nombre);

                axios.post('/materias/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.materias[this.pos] = this.materia;
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('edmateriamodal');
                    }
                });
            }
        }
    }
</script>
