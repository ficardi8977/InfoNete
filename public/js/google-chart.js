function cargarGraficos(){
google.charts.load('current', {'packages':['corechart', 'controls', 'table']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(generarGraficoBarra);
      google.charts.setOnLoadCallback(generarGraficoTorta);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function generarGraficoTorta() {
        obtenerProductosVendidosPDF();
      }

      function generarGraficoBarra(){
        obtenerSuscripcionesTotalesPDF();
      }
}

        function obtenerSuscripcionesTotalesPDF() {
          $.ajax({
              type:  'GET',
              url: '/suscripcion/estadisticasTotales',
              success:  function (result) {
  
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Producto');
                  data.addColumn('number', 'Totales')
  
                  // convertir el json de resultado de endpoint en object array
                  const objetoRespuesta = JSON.parse(result);
     
                  for (var i = 0; i < objetoRespuesta.length; i++) {
                      data.addRow([objetoRespuesta[i].Producto, parseInt(objetoRespuesta[i].Cantidad)]);
                  }
                  // Set chart options
                  var options = {'title':'Productos con mas suscripciones',
                               'width':500,
                               'height':300};
                  
                var divGrafico = document.getElementById('barChart_div');
                                  
                var pdfBarra = document.getElementById('pdfBarra');
                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.BarChart(divGrafico);
                pdfBarra.addEventListener('click', function () {
                  debugger;
                  var doc = new jsPDF();
                  doc.addImage(chart.getImageURI(), 50, 10);
                  doc.save('SuscripcionesTotales.pdf');
                }, false);
                chart.draw(data, options);
              }
          });
        }

        function obtenerProductosVendidosPDF() {
          $.ajax({
              type:  'GET',
              url: '/producto/ventas',
              success:  function (result) {
  
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Topping');
                  data.addColumn('number', 'Slices')
  
                  // convertir el json de resultado de endpoint en object array
                  const objetoRespuesta = JSON.parse(result);
     
                  for (var i = 0; i < objetoRespuesta.length; i++) {
                      data.addRow([objetoRespuesta[i].Producto, parseInt(objetoRespuesta[i].Cantidad)]);
                  }
                  // Set chart options
                  var options = {'title':'Productos con mas ventas realizadas',
                               'width':400,
                               'height':300};
        
                var divGrafico = document.getElementById('pieChart_div')
                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(divGrafico);

                var pdfTorta = document.getElementById('pdfTorta');

                pdfTorta.addEventListener('click', function () {
                  debugger;
                  var doc = new jsPDF();
                  doc.addImage(chart.getImageURI(), 50, 10);
                  doc.save('ProductosVendidos.pdf');
                }, false);

                chart.draw(data, options);
                              
              }
          });
        }
    
