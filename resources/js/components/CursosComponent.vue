<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <div class="modal fade" id="ncursomodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Crear curso</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="curso-nivel" class="col-form-label">Año:</label>
              <select class="form-control" v-model="curso.Nivel">
                   <option v-for="i in 6" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-division" class="col-form-label">División:</label>
              <select class="form-control" id="curso-division" v-model="curso.Division">
                   <option v-for="i in 10" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-año" class="col-form-label">Año de cursada:</label>
              <select class="form-control" id="curso-año" v-model="curso.Año">
                   <option v-for="i in 131" v-bind:value=(i+1899)>{{ i+1899 }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-asignaturas" class="col-form-label">Asignaturas:</label>
              <multiselect v-model="materias_curso" :options="materias" :multiple="true" track-by="id" :custom-label="materiaslabel"></multiselect>
            </div>
          </form>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores">
                  {{ error }}
              </p>
           </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button @click="agregarCurso()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edcursomodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Modificar curso</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="curso-nivel" class="col-form-label">Año:</label>
              <select class="form-control" v-model="curso.Nivel">
                   <option v-for="i in 6" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-division" class="col-form-label">División:</label>
              <select class="form-control" id="curso-division" v-model="curso.Division">
                   <option v-for="i in 10" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-anio" class="col-form-label">Año de cursada:</label>
              <select class="form-control" id="curso-anio" v-model="curso.Año">
                   <option v-for="i in 131" v-bind:value=(i+1899)>{{ i+1899 }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-asignaturas" class="col-form-label">Asignaturas:</label>
              <multiselect v-model="materias_curso" :options="materias" :multiple="true" track-by="id" :custom-label="materiaslabel"></multiselect>
            </div>
          </form>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores">
                  {{ error }}
              </p>
           </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button @click="actualizarCurso()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="alumnoscursomodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Alumnos en este curso</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="curso-asignaturas" class="col-form-label">Alumnos:</label>
              <multiselect placeholder="Buscar" v-model="alumnos_curso" :options="alumnos" :multiple="true" track-by="id" :custom-label="alumnoslabel"></multiselect>
            </div>
          </form>

          <table id="alumnostabla" class="table table-bordered">
          <thead>
            <tr>
              <th>DNI</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Notas</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="alumno in alumnos_curso">
                <td>{{ alumno.DNI}}</td>
                <td>{{ alumno.Nombre }}</td>
                <td>{{ alumno.Apellido}}</td>
                <td><button data-toggle="modal" data-target="" class="btn btn-secondary" onclick="document.getElementById('table_notas').setAttribute('style', 'display: block')" @click="buscarnotas(curso.id, alumno.id)">Administrar</button></td>
            </tr>
          </tbody>
          </table>
          <table style="display: none;" id="table_notas" class='table table-bordered'>
          <button class="btn btn-dark">Cerrar</button>
            <thead>
             <tr>
              <th>Materia</th>
              <th>Primer trimestre</th>
              <th>Segundo trimestre</th>
              <th>Tercer trimestre</th>
              <th>Acción</th>
             </tr>
           </thead>
           <tbody>
           <tr v-for="(m, index) in materias_curso">
            <td>{{ m.Nombre }}</td>
            <td><input value="6.00" type="text" id="nota_1" name="nota_1" disabled="true"></td>
            <td><input value="6.50" type="text" id="nota_2" name="nota_2" disabled="true"></td>
            <td><input value="8.00" type="text" id="nota_3" name="nota_3" disabled="true"></td>
            <!--
            <td><button id="btn_editar" onclick="document.getElementById('nota_1').disabled = false; document.getElementById('nota_2').disabled = false; document.getElementById('nota_3').disabled = false;    document.getElementById('btn_guardar<').style.display = 'block'; document.getElementById('btn_editar').style.display = 'none';" class="btn btn-secondary"><i class="fa fa-edit"></i></button>
            -->
            <td>
            <button class="btn btn-secondary"><i class="fa fa-edit"></i></button>
            <button style="display: none" id="btn_guardar" class="btn btn-secondary"><i class="fa fa-save"></i></button></td>
           </tr>
           </tbody>
          </table>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores">
                  {{ error }}
              </p>
           </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button @click="actualizarAlumnos()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de cursos</h3></i></center>
  <button @click="limpiarinputs()" type="button" class="btn btn-success" data-toggle="modal" data-target="#ncursomodal" style="color: white">Cargar</button><br><br>

  <table id="tabla_cursos" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>Curso</th>
      <th>Año de cursada</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
            <tr v-for="(curso, index) in cursos" :key="index">
                <td>{{ curso.Nivel }}° {{ curso.Division }}</td>
                <td>{{ curso.Año}}</td>
                <td>
                <button data-toggle="modal" data-target="#edcursomodal" class="btn btn-primary" @click="buscarmaterias(curso.id); asignar(curso)">Modificar</button>
                <button data-toggle="modal" data-target="#alumnoscursomodal" class="btn btn-secondary" @click="asignar(curso);pos=index; buscaralumnos(curso.id);buscarmaterias(curso.id)">Alumnos</button>
                <!--
                <button data-toggle="modal" data-target="#alumnoscursomodal" class="btn btn-dark" @click="asignar(curso);pos=index; buscaralumnos(curso.id);">Asistencias</button>
                -->
                <button class="btn btn-danger" @click="asignar(curso);pos=index;eliminarCurso()">Eliminar</button>
                </td>
            </tr>
    </tbody>
  </table>
</div>
</div>
</template>

<style>
  input {
    border: none;
    background-color: transparent;
  }
  #errores{ 
    color: red;
  }

  #mensaje{
    color: green;
  }

  thead{
    background-color: #f0f0f5;
  }

</style>

<script>
    import datatables from 'datatables';
    import Multiselect from 'vue-multiselect';

    export default {
	    components: {
	    	Multiselect
	    },

        data(){
            return {
            	i: 0,
                cursos: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                materias_curso: [],
                materias: [],
                alumnos: [],
                alumnos_curso: [],
                mensaje: '',
                curso: []
            }
        },

        mounted() {
            console.log('Componente cursos OK');
            this.cargar_alumnos();
            this.cargar_materias();
            this.cargar_cursos();
        },

        methods: {
            asignar(curso){
                this.curso = curso;
            },

            cerrar_modal(modal_n){
                $(function () {
                    $('#'+modal_n).modal('toggle');
                });
            },

            limpiarinputs(){
                this.curso = [];
                this.materias_curso = [];
            },

            tabla_cursos(){
                    $(document).ready(function() {
                        $('#tabla_cursos').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                        });
                    });
            },

            cargar_cursos(){
                axios.get('/cursos').then(response=>{
                    this.cursos = response.data;
                    this.tabla_cursos();
                });
            },

            agregarCurso(){
                let formdata = new FormData();
                formdata.append("Nivel", this.curso.Nivel);
                formdata.append("Division", this.curso.Division);
                formdata.append("Año", this.curso.Año);
                formdata.append("Materias", JSON.stringify(this.materias_curso));


                axios.post('/cursos/nuevo', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data.mensaje;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.cursos.push({id:response.data.ultimoid,Nivel:this.curso.Nivel,Division:this.curso.Division,Año:this.curso.Año});
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('ncursomodal');
                    }
                });
            },

            eliminarCurso(){
                axios.delete('/cursos/eliminar/'+this.curso.id).then( response =>{
                    this.cursos.splice(this.pos, 1);
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                });
            },


            actualizarCurso(){
                let formdata = new FormData();
                formdata.append("id", this.curso.id);
                formdata.append("Nivel", this.curso.Nivel);
                formdata.append("Division", this.curso.Division);
                formdata.append("Año", this.curso.Año);
                formdata.append("Materias", JSON.stringify(this.materias_curso));

                axios.post('/cursos/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data.mensaje;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.cursos[this.pos] = this.curso;
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('edcursomodal');
                    }
                });
            },

            actualizarAlumnos(){
              let formdata = new FormData();
              formdata.append("id", this.curso.id);
              formdata.append("Alumnos", JSON.stringify(this.alumnos_curso));
              axios.post('/cursos/alumnos/actualiar_alumnos', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data.mensaje;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('alumnoscursomodal');
                    }
                });
            },

            materiaslabel (option) {
            	return `${option.Nombre}`;
            },

            alumnoslabel (option) {
              return `${option.DNI} ${option.Nombre} ${option.Apellido}`;
            },

            cargar_materias(){
            	axios.get('/materias').then(response=>{
            		this.materias = response.data;
            	});
            },

            cargar_alumnos(){
              axios.get('/alumnos').then(response=>{
                this.alumnos = response.data;
              });
            },

            buscarmaterias(id_curso){
            	axios.get('/cursos/materias/'+id_curso).then(response=>{
                    this.materias_curso = response.data;
                });
            },

            buscaralumnos(id_curso){
              axios.get('/cursos/alumnos/'+id_curso).then(response=>{
                    this.alumnos_curso = response.data;
                });
            },

            buscarnotas(id_curso, id_alumno){

            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>