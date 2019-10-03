<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
  <label class="col-form-label"><b>Primer trimestre:</b></label><br>
  <label class="col-form-label"><b>Inicio: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="primerc_fecini" v-model="config.primerc_fecini">
  <label class="col-form-label"><b>Fin: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="primerc_fecfin" v-model="config.primerc_fecfin"><br>
  
  <label class="col-form-label"><b>Segundo trimestre:</b></label><br>
  <label class="col-form-label"><b>Inicio: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="segundoc_fecini" v-model="config.segundoc_fecini">
  <label class="col-form-label"><b>Fin: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="segundoc_fecfin" v-model="config.segundoc_fecfin"><br>

  <label class="col-form-label"><b>Tercer trimestre:</b></label><br>
  <label class="col-form-label"><b>Inicio: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="tercerc_fecini" v-model="config.tercerc_fecini">
  <label class="col-form-label"><b>Fin: </b></label>
  <input style="background-color: white;" type="date" class="form-control" id="tercerc_fecfin" v-model="config.tercerc_fecfin"><br>

  <button @click="actualizar_configuracion()" class="btn btn-success">Guardar</button>
 </div>
 </div>
</template>

<style>
  #mensaje{
    color: green;
  }
</style>

<script>
    export default {
        data(){
            return {
                config: [],
                pos: '',
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                mensaje: ''            
              }
        },

        mounted() {
            console.log('Componente configuracion OK');
            this.cargar_configuracion();
        },

        methods: {
            cargar_configuracion(){
                axios.get('/configuracion/datos').then(response=>{
                    this.config = response.data[0];
                    console.log(this.config);
                });
            },

            actualizar_configuracion(){
                let formdata = new FormData();
                formdata.append("primerc_fecini", this.config.primerc_fecini);
                formdata.append("primerc_fecfin", this.config.primerc_fecfin);
                formdata.append("segundoc_fecini", this.config.segundoc_fecini);
                formdata.append("segundoc_fecfin", this.config.segundoc_fecfin);
                formdata.append("tercerc_fecini", this.config.tercerc_fecini);
                formdata.append("tercerc_fecfin", this.config.tercerc_fecfin);

                if(this.config.primerc_fecini != undefined && this.config.primerc_fecfin != undefined && this.config.segundoc_fecini != undefined && this.config.segundoc_fecfin != undefined && this.config.tercerc_fecini != undefined && this.config.tercerc_fecfin != undefined){
                    axios.post('/configuracion/actualizar', formdata);
                }else{
                    alert("Revise las fechas");
                }
            }
        }
    }
</script>
