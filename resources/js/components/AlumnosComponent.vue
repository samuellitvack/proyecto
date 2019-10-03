<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <div class="modal fade" id="nalumnomodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Nuevo alumno</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="alumno-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="alumno-dni" v-model="alumno.DNI" placeholder="Número de documento">
            </div>
            <div class="form-group">
              <label for="alumno-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="alumno-nombre" v-model="alumno.Nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
              <label for="alumno-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="alumno-apellido" v-model="alumno.Apellido" placeholder="Apellido">
            </div>
            <div class="form-group">
              <label for="alumno-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="alumno-fecha-nac" v-model="alumno.Fecha_nac" placeholder="Fecha de nacimiento">
            </div>
            <div class="form-group">
              <label for="alumno-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="alumno-telefono" v-model="alumno.Telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
              <label for="alumno-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="alumno-direccion" v-model="alumno.Direccion" placeholder="Dirección">
            </div>
            <div class="form-group">
              <label for="alumno-nacionalidad" class="col-form-label">Nacionalidad:</label>
                <select class="form-control" v-model="alumno.Nacionalidad">
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
           <button @click="agregarAlumno()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edalumnomodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Modificar alumno</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="alumno-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="alumno-dni" v-model="alumno.DNI" readonly="true">
            </div>
            <div class="form-group">
              <label for="alumno-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="alumno-nombre" v-model="alumno.Nombre">
            </div>
            <div class="form-group">
              <label for="alumno-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="alumno-apellido" v-model="alumno.Apellido">
            </div>
            <div class="form-group">
              <label for="alumno-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="alumno-fecha-nac" v-model="alumno.Fecha_nac">
            </div>
            <div class="form-group">
              <label for="alumno-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="alumno-telefono" v-model="alumno.Telefono">
            </div>
            <div class="form-group">
              <label for="alumno-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="alumno-direccion" v-model="alumno.Direccion">
            </div>
            <div class="form-group">
              <label for="alumno-nacionalidad" class="col-form-label">Nacionalidad:</label>
              <select class="form-control" v-model="alumno.Nacionalidad">
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
           <button @click="actualizarAlumno()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelalumno" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <h4> Está seguro/a que quiere borrar este alumno?</h4>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
           <button @click="eliminarAlumno()" type="button" class="btn btn-danger">Si</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de alumnos</h3></i></center>
  <button @click="limpiarinputs(); limpiarerrores();" type="button" class="btn btn-success" data-toggle="modal" data-target="#nalumnomodal" style="color: white">Nuevo</button><br><br>

  <table id="tabla_alumnos" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Acciones</th>
    </tr>
    </thead>
        <tbody>
            <tr v-for="(alumno, index) in alumnos" :key="index">
                <td>{{ alumno.DNI }}</td>
                <td>{{ alumno.Nombre }}</td>
                <td>{{ alumno.Apellido }}</td>
                <td><button data-toggle="modal" data-target="#edalumnomodal" class="btn btn-primary" @click="limpiarerrores(); asignar(alumno)">Modificar</button><button data-toggle="modal" data-target="#modaldelalumno" class="btn btn-danger" @click="asignar(alumno);pos=index">Eliminar</button></td>
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
                alumnos: [],
                paises: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                mensaje: '',
                alumno: []
            }
        },

        mounted() {
            console.log('Componente alumnos OK');
            this.cargar_alumnos();
            this.cargar_paises();
        },

        methods: {
            asignar(alumno){
                this.alumno = alumno;
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
                this.alumno = [];
            },

            limpiarerrores(){
              this.errores = '';
              this.mensaje = '';
            },

            tabla_alumnos(){
                    $(document).ready(function() {
                        $('#tabla_alumnos').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                        });
                    });
            },

            cargar_alumnos(){
                axios.get('/alumnos').then(response=>{
                    this.alumnos = response.data;
                    this.tabla_alumnos();
                });
            },

            agregarAlumno(){
                let formdata = new FormData();
                formdata.append("DNI", this.alumno.DNI);
                formdata.append("Nombre", this.alumno.Nombre);
                formdata.append("Apellido", this.alumno.Apellido);
                formdata.append("Fecha_nac", this.alumno.Fecha_nac);
                formdata.append("Telefono", this.alumno.Telefono);
                formdata.append("Direccion", this.alumno.Direccion);
                formdata.append("Nacionalidad", this.alumno.Nacionalidad);

                axios.post('/alumnos/nuevo', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.alumnos.push({id:response.data.ultimoid,DNI:this.alumno.DNI,Nombre:this.alumno.Nombre,Apellido:this.alumno.Apellido,Fecha_nac:this.alumno.Fecha_nac,Telefono:this.alumno.Telefono,Direccion:this.alumno.Direccion,Nacionalidad:this.alumno.Nacionalidad});
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('nalumnomodal');
                    }
                });
            },

            eliminarAlumno(){
                axios.delete('/alumnos/eliminar/'+this.alumno.id).then( response =>{
                    this.alumnos.splice(this.pos, 1);
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                    this.cerrar_modal('modaldelalumno');
                });
            },


            actualizarAlumno(){
                let formdata = new FormData();
                formdata.append("id", this.alumno.id);
                formdata.append("DNI", this.alumno.DNI);
                formdata.append("Nombre", this.alumno.Nombre);
                formdata.append("Apellido", this.alumno.Apellido);
                formdata.append("Fecha_nac", this.alumno.Fecha_nac);
                formdata.append("Telefono", this.alumno.Telefono);
                formdata.append("Direccion", this.alumno.Direccion);
                formdata.append("Nacionalidad", this.alumno.Nacionalidad);

                axios.post('/alumnos/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.alumnos[this.pos] = this.alumno;
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('edalumnomodal');
                    }
                });
            }
        }
    }
</script>
