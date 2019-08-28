<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <table id="tabla_alumnos" class="table table-striped table-bordered table-hover">
               <thead>
                <tr>
                  <td>DNI</td>
                  <td>Nombre</td>
                  <td>Apellido</td>
                  <td colspan="2">Acción</td>
                </tr>
               </thead>
               <tbody>
                <tr v-for="(alumno, index) in alumnos" :key="index">
                    <td>@{{ alumno.nombre }}</td>
                    <td>@{{ alumno.apellido }}</td>
                    <td>@{{ alumno.valor }}</td>
                    <td><button onclick="mostrar_editar()" @click="pos=index;asignar(cliente)">Editar</button>
                    <button @click="asignar(cliente);pos=index;eliminarCliente()">Borrar</button></td>
                </tr>
               </tbody>
               </table>
            </div>
        </div>
    </div>
</template>

<script>
    $(document).ready(function() {
        $('#tabla_alumnos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });

    export default {
        data(){
            return {
                alumnos: ''
            }
        },

        mounted() {
            console.log('Componente alumnos OK');
            this.cargar_alumnos();
        },

        methods: {
            cargar_alumnos: function(){
                axios.get('alumnos').then(response=>{
                    this.alumnos = response;
                    console.log(response);
                });
            },

            agregarAlumno: function(){
                let formdata = new FormData();
                formdata.append("nombre", this.cliente.nombre);
                formdata.append("apellido", this.cliente.apellido);
                formdata.append("sexo", this.cliente.sexo);

                axios.post('alumnos/agregar', formdata).then( response =>{
                    if(response.data.error){
                        this.mensaje_error = response.data.mensaje;
                        this.mostrarMensaje = false;
                        this.mostrarError = true;
                    }else{
                        let sexo_nombre = this.varios.filter(sex=>sex.id==this.cliente.sexo);
                    this.clientes.push({id:response.data.ultimoid,nombre:this.cliente.nombre,apellido:this.cliente.apellido,sexo:this.cliente.sexo,valor:sexo_nombre[0].valor});
                    this.limpiarForm();
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                    this.mensaje = response.data.mensaje;
                }
            });
        },

        eliminarAlumno: function(){
            axios.delete('alumnos/eliminar/'+this.cliente.id).then( response =>{
                this.clientes.splice(this.pos, 1);
                this.limpiarForm();
                this.mostrarError = false;
                this.mostrarMensaje = true;
                this.mensaje = response.data.mensaje;
            });
        },

        actualizarAlumno: function(){
            let formdata = new FormData();
            formdata.append("id", this.cliente.id);
            formdata.append("nombre", this.cliente.nombre);
            formdata.append("apellido", this.cliente.apellido);
            formdata.append("sexo", this.cliente.sexo);

            axios.post('alumnos/actualizar', formdata).then( response =>{
                if(response.data.error){
                    this.mensaje_error = response.data.mensaje;
                    this.mostrarMensaje = false;
                    this.mostrarError = true;
                }else{
                    this.clientes[this.pos] = this.cliente;
                    this.mensaje = response.data.mensaje;
                    this.mostrarError = false;
                    this.mostrarMensaje = true;
                }
            });
        },

        }
    }
</script>
