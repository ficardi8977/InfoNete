google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(generarGraficoTorta);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function generarGraficoTorta() {

        var result = obtenerProductosVendidos();
      }

      function obtenerProductosVendidos() {
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
                    debugger;
                    data.addRow([objetoRespuesta[i].Producto, parseInt(objetoRespuesta[i].Cantidad)]);
                }
                // Set chart options
                var options = {'title':'Productos con mas ventas realizadas',
                             'width':400,
                             'height':300};
      
              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
              chart.draw(data, options);
              
            }
        });
    }
