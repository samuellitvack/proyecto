<template>
 <div class="row justify-content-center">
 <div class="col-md-8">
      <center><h2>Descargar boletín de calificaciones</h2></center>
      <label for="dni-alumno" class="col-form-label">DNI</label>
      <input type="text" class="form-control" v-model="curso.DNI" placeholder="Ingrese su DNI">
      <label for="curso-nivel" class="col-form-label">Año:</label>
      <select class="form-control" v-model="curso.Nivel">
          <option v-for="i in 6" v-bind:value="i">{{ i }}</option>
      </select>
      <label for="curso-division" class="col-form-label">División:</label>
      <select class="form-control" id="curso-division" v-model="curso.Division">
          <option v-for="i in 10" v-bind:value="i">{{ i }}</option>
      </select>
      <label for="curso-anio" class="col-form-label">Año de cursada:</label>
      <select class="form-control" id="curso-anio" v-model="curso.Anio">
          <option v-for="i in 131" v-bind:value=(i+1899)>{{ i+1899 }}</option>
      </select><br>
      <center><button @click="buscarboletin()" class="btn btn-primary">Buscar</button></center>
      <div id="mensaje" @click="mostrarError=false" v-if="mostrarError">
         {{ errores }}
      </div>
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
                pos: '',
                curso: {'DNI': '', 'Nivel': '', 'Division': '', 'Anio': ''},
                mostrarError: false,
                mostrarMensaje: false,
                errores: '',
                archivo: ''   
              }
        },

        mounted() {
            console.log('Componente boletin OK');
        },

        methods: {
          buscarboletin(){
                let formdata = new FormData();
                formdata.append("DNI", this.curso.DNI);
                formdata.append("Nivel", this.curso.Nivel);
                formdata.append("Division", this.curso.Division);
                formdata.append("Anio", this.curso.Anio);

                axios.post('/boletin/descargar', formdata,  {responseType: 'blob'}).then( response =>{
                    if(response.data.size == 55){
                        this.errores = "No se encontraron resultados.",
                        this.mostrarError = true;
                    }else{
                        let archivourl = window.URL.createObjectURL(new Blob([response.data]));
                        let crearlink = document.createElement('a');
                        crearlink.href = archivourl;
                        crearlink.setAttribute('download', 'libreta.pdf');
                        crearlink.click();
                        this.mostrarError = false;
                    }
                });
          }
        }
    }
</script>
