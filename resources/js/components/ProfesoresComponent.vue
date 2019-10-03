<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <div class="modal fade" id="nprofesormodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Nuevo profesor</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="profesor-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="profesor-dni" v-model="profesor.DNI" placeholder="Número de documento">
            </div>
            <div class="form-group">
              <label for="profesor-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="profesor-nombre" v-model="profesor.Nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
              <label for="profesor-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="profesor-apellido" v-model="profesor.Apellido" placeholder="Apellido">
            </div>
            <div class="form-group">
              <label for="profesor-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="profesor-fecha-nac" v-model="profesor.Fecha_nac" placeholder="Fecha de nacimiento">
            </div>
            <div class="form-group">
              <label for="profesor-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="profesor-telefono" v-model="profesor.Telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
              <label for="profesor-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="profesor-direccion" v-model="profesor.Direccion" placeholder="Dirección">
            </div>
            <div class="form-group">
              <label for="profesor-nacionalidad" class="col-form-label">Nacionalidad:</label>
                <select class="form-control" v-model="profesor.Nacionalidad">
                  <option v-for="pais in paises" v-bind:value="pais">{{ pais }}</option>
                </select>
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
           <button @click="agregarProfesor()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edprofesormodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Modificar profesor</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="profesor-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="profesor-dni" v-model="profesor.DNI" readonly="true">
            </div>
            <div class="form-group">
              <label for="profesor-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="profesor-nombre" v-model="profesor.Nombre">
            </div>
            <div class="form-group">
              <label for="profesor-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="profesor-apellido" v-model="profesor.Apellido">
            </div>
            <div class="form-group">
              <label for="profesor-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="profesor-fecha-nac" v-model="profesor.Fecha_nac">
            </div>
            <div class="form-group">
              <label for="profesor-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="profesor-telefono" v-model="profesor.Telefono">
            </div>
            <div class="form-group">
              <label for="profesor-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="profesor-direccion" v-model="profesor.Direccion">
            </div>
            <div class="form-group">
              <label for="profesor-nacionalidad" class="col-form-label">Nacionalidad:</label>
              <select class="form-control" v-model="profesor.Nacionalidad">
                <option v-for="pais in paises" v-bind:value="pais">{{ pais }}</option>
              </select>
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
           <button @click="actualizarProfesor()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelprofesor" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <h4> Está seguro/a que quiere borrar este profesor?</h4>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
           <button @click="eliminarProfesor()" type="button" class="btn btn-danger">Si</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de profesores</h3></i></center>
  <button @click="limpiarinputs(); limpiarerrores();" type="button" class="btn btn-success" data-toggle="modal" data-target="#nprofesormodal" style="color: white">Nuevo</button><br><br>

  <table id="tabla_profesores" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Acciones</th>
    </tr>
    </thead>
        <tbody>
            <tr v-for="(profesor, index) in profesores" :key="index">
                <td>{{ profesor.DNI }}</td>
                <td>{{ profesor.Nombre }}</td>
                <td>{{ profesor.Apellido }}</td>
                <td>
                <button data-toggle="modal" data-target="#edprofesormodal" class="btn btn-primary" @click="limpiarerrores(); asignar(profesor)">Modificar</button>
                <button data-toggle="modal" data-target="#modaldelprofesor" class="btn btn-danger" @click="asignar(profesor);pos=index">Eliminar</button>
                </td>
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
                profesores: [],
                paises: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                mensaje: '',
                profesor: []
            }
        },

        mounted() {
            console.log('Componente profesores OK');
            this.cargar_profesores();
            this.cargar_paises();
        },

        methods: {
            asignar(profesor){
                this.profesor = profesor;
            },

            cargar_paises(){
                axios.get('/paises.txt').then( response => {
                    this.paises = response.data.split("\n");
                });
            },

            cerrar_modal(modal_n){
                $(function () {
                    $('#'+modal_n).modal('toggle');
                });
            },

            limpiarinputs(){
                this.profesor = [];
            },

            limpiarerrores(){
              this.errores = '';
              this.mensaje = '';
            },

            tabla_profesores(){
                    $(document).ready(function() {
                        $('#tabla_profesores').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                        });
                    });
            },

            cargar_profesores(){
                axios.get('/profesores').then(response=>{
                    this.profesores = response.data;
                    this.tabla_profesores();
                });
            },

            agregarProfesor(){
                let formdata = new FormData();
                formdata.append("DNI", this.profesor.DNI);
                formdata.append("Nombre", this.profesor.Nombre);
                formdata.append("Apellido", this.profesor.Apellido);
                formdata.append("Fecha_nac", this.profesor.Fecha_nac);
                formdata.append("Telefono", this.profesor.Telefono);
                formdata.append("Direccion", this.profesor.Direccion);
                formdata.append("Nacionalidad", this.profesor.Nacionalidad);

                axios.post('/profesores/nuevo', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.profesores.push({id:response.data.ultimoid,DNI:this.profesor.DNI,Nombre:this.profesor.Nombre,Apellido:this.profesor.Apellido,Fecha_nac:this.profesor.Fecha_nac,Telefono:this.profesor.Telefono,Direccion:this.profesor.Direccion,Nacionalidad:this.profesor.Nacionalidad});
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('nprofesormodal');
                    }
                });
            },

            eliminarProfesor(){
                axios.delete('/profesores/eliminar/'+this.profesor.id).then( response =>{
                    this.profesores.splice(this.pos, 1);
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                    this.cerrar_modal('modaldelprofesor');
                });
            },


            actualizarProfesor(){
                let formdata = new FormData();
                formdata.append("id", this.profesor.id);
                formdata.append("DNI", this.profesor.DNI);
                formdata.append("Nombre", this.profesor.Nombre);
                formdata.append("Apellido", this.profesor.Apellido);
                formdata.append("Fecha_nac", this.profesor.Fecha_nac);
                formdata.append("Telefono", this.profesor.Telefono);
                formdata.append("Direccion", this.profesor.Direccion);
                formdata.append("Nacionalidad", this.profesor.Nacionalidad);

                axios.post('/profesores/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.profesores[this.pos] = this.profesor;
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('edprofesormodal');
                    }
                });
            }
        }
    }
</script>
