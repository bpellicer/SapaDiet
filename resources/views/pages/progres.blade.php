@include('partials.headcontent')
<x-layout.navAuth/>
@if (session()->has('pesAlturaError'))
    <x-alerta nom="error2" missatge="{{ session('pesAlturaError') }}"/>
@endif
@if (session()->has('pesAlturaUpdate'))
    <x-alerta nom="success2" missatge="{{ session('pesAlturaUpdate') }}"/>
@endif
@include('components.content.progres')

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

<script>
    let pesos = {!! json_encode($pesos) !!};
    console.log(pesos);
    var ctx = $('#myChart');
    Chart.defaults.font.family = "Poppins";
    let arrayData = [];
    for(let i = 0; i<pesos.length; i++){
        let data = {};
        data.x = pesos[i].data;
        data.y = pesos[i].pes;
        arrayData.push(data);
        console.log(pesos[i]);
    }
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Pes Usuari',
                data: arrayData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                hoverBackgroundColor: "#555"
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio:false,
            plugins: {
                title: {
                    display: true,
                    text: 'Histograma del pes',
                    fontSize:10
                }
            }
        }
    });
    myChart.canvas.parentNode.style.height = '430px';
</script>

<x-layout.footerAuth/>
