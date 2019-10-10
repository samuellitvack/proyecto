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
              <p v-for="error in errores['mensaje']">
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
          <!--
            <div class="form-group">
              <label for="curso-nivel" class="col-form-label">Año:</label>
              <select class="form-control" v-model="curso.Nivel" disabled>
                   <option v-for="i in 6" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-division" class="col-form-label">División:</label>
              <select class="form-control" id="curso-division" v-model="curso.Division" disabled>
                   <option v-for="i in 10" v-bind:value="i">{{ i }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="curso-anio" class="col-form-label">Año de cursada:</label>
              <select class="form-control" id="curso-anio" v-model="curso.Año" disabled>
                   <option v-for="i in 131" v-bind:value=(i+1899)>{{ i+1899 }}</option>
              </select>
            </div>
            -->
            <div class="form-group">
              <label for="curso-asignaturas" class="col-form-label">Asignaturas:</label>
              <multiselect v-model="materias_curso" :options="materias" :multiple="true" track-by="id" :custom-label="materiaslabel"></multiselect>
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
            </tr>
          </thead>
          <tbody>
              <tr v-for="alumno in alumnos_curso">
                <td>{{ alumno.DNI}}</td>
                <td>{{ alumno.Nombre }}</td>
                <td>{{ alumno.Apellido}}</td>
            </tr>
          </tbody>
          </table>

          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores['mensaje']">
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

  <div class="modal fade" id="notasmodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div style="max-width: 90%;" class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Calificaciones</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
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
                <td><button onClick="document.getElementById('div_tabla_notas').scrollIntoView({block: 'end',  behavior: 'smooth'});" id="btn_adminotas" data-toggle="modal" data-target="" class="btn btn-secondary" @click="efectos_1(); asignar_alumno(alumno); buscarnotas(curso.id, alumno.id)">Administrar</button></td>
            </tr>
          </tbody>
          </table>

          <div style="display:none; overflow-x:auto;" id="div_tabla_notas" class="table-responsive">
          <button @click="guardar_notas(); efectos_2()" onClick="window.scrollTo(0, 0);" id="cerrar_tabla" class="btn btn-dark">Guardar cambios</button><label><b>&nbsp;&nbsp;&nbsp;Alumno: {{ alumno.Nombre }} {{ alumno.Apellido}}</b></label>
          <table id="table_notas" class='table table-bordered'>
            <thead>
             <tr>
              <th>Materia</th>
              <th>Primer trimestre</th>
              <th>Segundo trimestre</th>
              <th>Tercer trimestre</th>
             </tr>
           </thead>
           <tbody>
           <tr v-for="nota in notas">
            <td>{{ nota.materia_nombre }}</td>
            <td><input v-model="nota.nota1" type="text" id="nota_1"></td>
            <td><input v-model="nota.nota2" type="text" id="nota_2"></td>
            <td><input v-model="nota.nota3" type="text" id="nota_3"></td>
           </tr>
           </tbody>
          </table>
          </div>

           <!--
           <pre>
           {{ $data }}
           </pre>
           -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="asistenciasmodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div style="max-width: 90%;" class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Cargar Asistencias </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <center><h2><label>Seleccionar fecha: </label><input v-model="fecha" type="date"><button class="btn btn-success" @click="buscarasistencias(curso.id,fecha); efecto_asistencia()">Buscar</button></h2></center><br>
          <div style="display:none; overflow-x:auto;" id="div_tabla_asistencias" class="table-responsive">
          <div id="errores" @click="mostrarError=false" v-if="mostrarError">
              <p v-for="error in errores['mensaje']">
                  {{ error }}
              </p>
           </div>
          <button @click="guardar_asistencias()" class="btn btn-dark">Guardar cambios</button><br><br>
          <table id="asistenciastabla" class="table table-bordered">
          <thead>
            <tr>
              <th>Alumno (DNI, Nombre, Apellido)</th>
              <th>Presente</th>
              <th>Justificada</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="asistencia in asistencias">
                <td>{{ asistencia.DNI_alumno}} {{ asistencia.Nombre_alumno }} {{ asistencia.Apellido_alumno}}</td>
                <td><input v-model="asistencia.Presente" type="checkbox"></td>
                <td><input v-model="asistencia.Justificada" type="checkbox"></td>
            </tr>
          </tbody>
          </table>
          </div>
        </div>
        <!--
        <pre>
        {{ $data }}
        </pre>
        -->
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelcurso" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <h4> Está seguro/a que quiere eliminar este curso?</h4>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
           <button @click="eliminarCurso()" type="button" class="btn btn-danger">Si</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de cursos</h3></i></center>
  <button @click="limpiarinputs()" type="button" class="btn btn-success" data-toggle="modal" data-target="#ncursomodal" style="color: white">Crear</button><br><br>
  <div id="cursospdf">
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
                <button data-toggle="modal" data-target="#edcursomodal" class="btn btn-primary" @click="asignar(curso); buscarmaterias(curso.id)">Modificar</button>
                <button data-toggle="modal" data-target="#alumnoscursomodal" class="btn btn-secondary" @click="asignar(curso);pos=index; buscaralumnos(curso.id);buscarmaterias(curso.id)">Alumnos</button>
                <button data-toggle="modal" data-target="#notasmodal" class="btn btn-info" @click="asignar(curso);pos=index; buscaralumnos(curso.id)">Notas</button>
                <button data-toggle="modal" data-target="#asistenciasmodal" class="btn btn-dark" @click="asignar(curso);pos=index">Asistencias</button>
                <button data-toggle="modal" data-target="#modaldelcurso" class="btn btn-danger" @click="asignar(curso);pos=index">Eliminar</button>
                </td>
            </tr>
    </tbody>
  </table>
  </div>
</div>
</div>
</template>

<style>
  input {
    border: none;
    background-color: transparent;
  }

  input:focus{
    outline: none;
  }

  #errores{ 
    color: red;
    font-size: 20px;
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
                fecha: '',
                asistencias: [],
                alumnos: [],
                alumno: [],
                alumnos_curso: [],
                mensaje: '',
                curso: [],
                notas: []
            }
        },

        mounted() {
            console.log('Componente cursos OK');
            this.cargar_alumnos();
            this.cargar_materias();
            this.cargar_cursos();
            this.efectos_3();
            this.efectos_3_asistencias();
        },

        methods: {
            asignar(curso){
                this.curso = curso;
            },

            asignar_alumno(alumno){
                this.alumno = alumno;
            },

            cerrar_modal(modal_n){
                $(function () {
                    $('#'+modal_n).modal('toggle');
                });
            },

            efectos_1(){
                $(function () {
                    $('#div_tabla_notas').attr('style','display:block');
                });
            },

            efectos_2(){
                $(function () {
                    $('#div_tabla_notas').attr('style','display:none');
                });
                this.notas = [];
                this.alumno = [];
            },

            efectos_3(){
              $(function (){
                 $("#notasmodal").on('hide.bs.modal', function(){
                  $('#div_tabla_notas').attr('style','display:none');
                  this.notas = [];
                  this.alumno = [];
                });
              });
            },

            efecto_asistencia(){
              $(function (){
                $('#div_tabla_asistencias').attr('style','display:block');
              });
            },

            efectos_2_asistencias(){
                $(function () {
                    $('#div_tabla_asistencias').attr('style','display:none');
                });
                this.asistencias = [];
                this.fecha = '';
            },

            efectos_3_asistencias(){
              $(function (){
                 $("#asistenciasmodal").on('hide.bs.modal', function(){
                  $('#div_tabla_asistencias').attr('style','display:none');
                });
              });
              this.asistencias = [];
              this.fecha = '';
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
                        this.errores = response.data;
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
                    this.cerrar_modal('modaldelcurso');
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
                        this.errores = response.data;
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

            buscarasistencias(id_curso, fecha){
              axios.get('/cursos/asistencias/'+id_curso+'/'+this.fecha).then(response=>{
                    this.asistencias = response.data;
                });
            },

            guardar_asistencias(){
              let formdata = new FormData();
              formdata.append("asistencias", JSON.stringify(this.asistencias));
              formdata.append("fecha", this.fecha);
              axios.post('/cursos/asistencias/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                      this.efectos_2_asistencias();
                      this.errores = '';
                    }
                });
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
              axios.get('/notas/'+id_curso+"/"+id_alumno).then(response=>{
                    this.notas = response.data;
                });
            },

            guardar_notas(){
              let formdata = new FormData();
              formdata.append("Notas", JSON.stringify(this.notas));
              formdata.append("id_alumno", this.alumno.id);

              axios.post('/notas/actualizar', formdata);
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>