<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <div class="modal fade" id="npreceptormodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Nuevo preceptor</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="preceptor-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="preceptor-dni" v-model="preceptor.DNI" placeholder="Número de documento">
            </div>
            <div class="form-group">
              <label for="preceptor-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="preceptor-nombre" v-model="preceptor.Nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
              <label for="preceptor-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="preceptor-apellido" v-model="preceptor.Apellido" placeholder="Apellido">
            </div>
            <div class="form-group">
              <label for="preceptor-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="preceptor-fecha-nac" v-model="preceptor.Fecha_nac" placeholder="Fecha de nacimiento">
            </div>
            <div class="form-group">
              <label for="preceptor-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="preceptor-telefono" v-model="preceptor.Telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
              <label for="preceptor-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="preceptor-direccion" v-model="preceptor.Direccion" placeholder="Dirección">
            </div>
            <div class="form-group">
              <label for="preceptor-nacionalidad" class="col-form-label">Nacionalidad:</label>
                <select class="form-control" v-model="preceptor.Nacionalidad">
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
           <button @click="agregarPreceptor()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edpreceptormodal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Modificar preceptor</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="preceptor-dni" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="preceptor-dni" v-model="preceptor.DNI" readonly="true">
            </div>
            <div class="form-group">
              <label for="preceptor-nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="preceptor-nombre" v-model="preceptor.Nombre">
            </div>
            <div class="form-group">
              <label for="preceptor-apellido" class="col-form-label">Apellido:</label>
              <input type="text" class="form-control" id="preceptor-apellido" v-model="preceptor.Apellido">
            </div>
            <div class="form-group">
              <label for="preceptor-fecha-nac" class="col-form-label">Fecha de nacimiento:</label>
              <input type="date" lass="form-control" id="preceptor-fecha-nac" v-model="preceptor.Fecha_nac">
            </div>
            <div class="form-group">
              <label for="preceptor-telefono" class="col-form-label">Teléfono:</label>
              <input type="text" class="form-control" id="preceptor-telefono" v-model="preceptor.Telefono">
            </div>
            <div class="form-group">
              <label for="preceptor-direccion" class="col-form-label">Dirección:</label>
              <input type="text" class="form-control" id="preceptor-direccion" v-model="preceptor.Direccion">
            </div>
            <div class="form-group">
              <label for="preceptor-nacionalidad" class="col-form-label">Nacionalidad:</label>
              <select class="form-control" v-model="preceptor.Nacionalidad">
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
           <button @click="actualizarPreceptor()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelpreceptor" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
             <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
          <h4> Está seguro/a que quiere borrar este preceptor?</h4>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
           <button @click="eliminarPreceptor()" type="button" class="btn btn-danger">Si</button>
        </div>
      </div>
    </div>
  </div>

  <div id="mensaje" @click="mostrarMensaje=false" v-if="mostrarMensaje">
    {{ mensaje }}
  </div>
  <center><i><h3>Gestión de preceptores</h3></i></center>
  <button @click="limpiarinputs(); limpiarerrores();" type="button" class="btn btn-success" data-toggle="modal" data-target="#npreceptormodal" style="color: white">Nuevo</button><br><br>
  <table id="tabla_preceptores" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>DNI</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Acciones</th>
    </tr>
    </thead>
        <tbody>
            <tr v-for="(preceptor, index) in preceptores" :key="index">
                <td>{{ preceptor.DNI }}</td>
                <td>{{ preceptor.Nombre }}</td>
                <td>{{ preceptor.Apellido }}</td>
                <td>
                <button data-toggle="modal" data-target="#edpreceptormodal" class="btn btn-primary" @click="limpiarerrores(); asignar(preceptor)">Modificar</button>
                <button data-toggle="modal" data-target="#modaldelpreceptor" class="btn btn-danger" @click="asignar(preceptor);pos=index">Borrar</button>
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
                preceptores: [],
                paises: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                mensaje: '',
                preceptor: []
            }
        },

        mounted() {
            console.log('Componente preceptores OK');
            this.cargar_preceptores();
            this.cargar_paises();
        },

        methods: {
            asignar(preceptor){
                this.preceptor = preceptor;
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
                this.preceptor = [];
            },

            limpiarerrores(){
              this.errores = '';
              this.mensaje = '';
            },

            tabla_preceptores(){
                    $(document).ready(function() {
                        $('#tabla_preceptores').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                        });
                    });
            },

            cargar_preceptores(){
                axios.get('/preceptores').then(response=>{
                    this.preceptores = response.data;
                    this.tabla_preceptores();
                });
            },

            agregarPreceptor(){
                let formdata = new FormData();
                formdata.append("DNI", this.preceptor.DNI);
                formdata.append("Nombre", this.preceptor.Nombre);
                formdata.append("Apellido", this.preceptor.Apellido);
                formdata.append("Fecha_nac", this.preceptor.Fecha_nac);
                formdata.append("Telefono", this.preceptor.Telefono);
                formdata.append("Direccion", this.preceptor.Direccion);
                formdata.append("Nacionalidad", this.preceptor.Nacionalidad);

                axios.post('/preceptores/nuevo', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.preceptores.push({id:response.data.ultimoid,DNI:this.preceptor.DNI,Nombre:this.preceptor.Nombre,Apellido:this.preceptor.Apellido,Fecha_nac:this.preceptor.Fecha_nac,Telefono:this.preceptor.Telefono,Direccion:this.preceptor.Direccion,Nacionalidad:this.preceptor.Nacionalidad});
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('npreceptormodal');
                        this.preceptor = this.preceptor;
                    }
                });
            },

            eliminarPreceptor(){
                axios.delete('/preceptores/eliminar/'+this.preceptor.id).then( response =>{
                    this.preceptores.splice(this.pos, 1);
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                    this.cerrar_modal('modaldelpreceptor');
                });
            },


            actualizarPreceptor(){
                let formdata = new FormData();
                formdata.append("id", this.preceptor.id);
                formdata.append("DNI", this.preceptor.DNI);
                formdata.append("Nombre", this.preceptor.Nombre);
                formdata.append("Apellido", this.preceptor.Apellido);
                formdata.append("Fecha_nac", this.preceptor.Fecha_nac);
                formdata.append("Telefono", this.preceptor.Telefono);
                formdata.append("Direccion", this.preceptor.Direccion);
                formdata.append("Nacionalidad", this.preceptor.Nacionalidad);

                axios.post('/preceptores/actualizar', formdata).then( response =>{
                    if(response.data.error){
                        this.errores = response.data;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        this.preceptores[this.pos] = this.preceptor;
                        this.mostrarError = false;
                        this.mostrarMensaje = true;
                        this.mensaje = response.data.mensaje;
                        this.cerrar_modal('edpreceptormodal');
                    }
                });
            }
        }
    }
</script>
