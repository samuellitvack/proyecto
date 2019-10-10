<!DOCTYPE html>
<html>
<body>
<h3>Fecha: <?php echo date('Y-m-d'); ?></h3>
<h1>Escuela de educación secundaria</h1><br>
@foreach($alumno as $a)
<h2>Alumno: <u>{{ $a->Nombre_alumno}} {{ $a->Apellido_alumno }}</u> DNI: <u>{{ $a->DNI_alumno }} </u></h2>
@endforeach
@foreach($curso as $c)
<h2>Curso: <u>{{ $c->Curso_nivel }}° {{ $c->Curso_division }}° {{ $c->Curso_año}}</u></h2>
@endforeach
<table align="center">
  <tr>
    <th>Asignatura</th>
    <th>Primer trimestre</th>
    <th>Segundo trimestre</th>
    <th>Tercer trimestre</th>
    <th>Diciembre</th>
    <th>Febrero/Marzo</th>
    <th>Promedio anual</th>
    <th>Calificación final</th>
  </tr>
  @foreach($notas as $n)
  <tr>
    <td>{{ $n->Nombre_materia }}</td>
    <td>{{ $n->nota_1 }}</td>
    <td>{{ $n->nota_2 }}</td>
    <td>{{ $n->nota_3 }}</td>
    <td></td>
    <td></td>
    <td><?php echo round((($n->nota_1+$n->nota_2+$n->nota_3)/3),2); ?></td>
    <td><?php echo round((($n->nota_1+$n->nota_2+$n->nota_3)/3),2); ?></td>
  </tr>
  @endforeach
</table>
<br><br>
<table align="center">
<tr>
	<th>Inasistencias anuales</th>
</tr>
<tr>
	<td>{{ $justificada }} / {{ $inasistencia }}</td>
</tr>
</table>
<br><br><br><br>
<h2>Firmas</h2>

<table align="center">
  <tr>
    <th>&nbsp;</th>
    <th>Autoridad</th>
    <th>Alumno/a</th>
    <th>Adulto responsable</th>
  </tr>
  <tr>
    <td>Primer trimestre</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Segundo trimestre</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tercer trimestre</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Promedio anual</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<style type="text/css">
	table {
		border-collapse: collapse;
	}

	table, th, td{
		border: 1px solid black;
	}

	h1 {
		text-align: center;
	}

	h2 {
		text-align: center;
	}
</style>