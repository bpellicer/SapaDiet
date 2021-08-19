@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('pesAlturaError'))
    <x-alerta nom="error2" missatge="{{ session('pesAlturaError') }}"/>
@endif
@if (session()->has('pesAlturaUpdate'))
    <x-alerta nom="success2" missatge="{{ session('pesAlturaUpdate') }}"/>
@endif
@include('components.content.progres')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Dogs');

      data.addRows([
        [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
        [6, 11],  [7, 27]
      ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>
<x-layout.footerAuth/>
