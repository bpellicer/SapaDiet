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
    /** Obté l'array de pes de l'Usuari **/
    let pesos = {!! json_encode($pesos) !!};
    var historicPes = $('#historicPes');
    /** Aplica la font Poppins **/
    Chart.defaults.font.family = "Poppins";
    let arrayData = [];
    /** Bucle que guarda en una array objectes del tipus {data:x, pes:y} **/
    for(let i = pesos.length - 1; i>=0; i--){
        let data = {};
        data.x = pesos[i].data;
        data.y = pesos[i].pes;
        arrayData.push(data);
    }
    /** Crea un nou gràfic **/
    var myChart = new Chart(historicPes, {
        type: 'line',
        data: {
            datasets: [{
                label:"Pes",
                data: arrayData,
                backgroundColor: [
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 159, 64)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 206, 86)',
                    'rgba(255, 99, 132)',
                    'rgba(173,99,89)'
                ],
                borderColor: "#5DCA53",
                borderWidth: 1,
                hoverBackgroundColor: "#555",
                pointRadius:8,
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio:false,
            plugins: {
                title: {
                    display: true,
                    text: 'Histograma del pes',
                    font:{
                        size: 15
                    }
                },
                subtitle:{
                    display:true,
                    text:'(Kg)',
                    position:"left"
                },
                legend:{
                    display:true,
                    position:'bottom',
                    labels:{
                        color:"black"
                    }
                },
                tooltip:{
                    backgroundColor: "#D7F1B7",
                    borderWidth:1,
                    borderColor:"black",
                    titleColor:"black",
                    bodyColor:"black"
                }
            }
        }
    });
    myChart.canvas.parentNode.style.height = '430px';
</script>

<script>
    let dies = {!! json_encode($dies) !!};
    let kcalDies = {!! json_encode($arrayKcal7Dies) !!};

    var historicKcal = $('#historicKcal');

    /** Aplica la font Poppins **/
    Chart.defaults.font.family = "Poppins";

    let arrayData2 = [];

    /** Bucle que guarda en una array objectes del tipus {dia:x, kcal:y} **/
    for(let i = 0; i < dies.length; i++){
        let data = {};
        data.x = dies[i];
        data.y = kcalDies[i];
        arrayData2.push(data);
    }

    /** Crea un nou gràfic **/
    var histogramaKcal = new Chart(historicKcal, {
        type: 'bar',
        data: {
            datasets: [{
                label:"Kilocalories",
                data: arrayData2,
                backgroundColor: [
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 159, 64)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 206, 86)',
                    'rgba(255, 99, 132)',
                    'rgba(173,99,89)'
                ]
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio:false,
            plugins: {
                title: {
                    display: true,
                    text: 'Histograma de les Kilocalories',
                    font:{
                        size: 15
                    }
                },
                subtitle:{
                    display:true,
                    text:'(Kcal)',
                    position:"left"
                },
                legend:{
                    display:true,
                    position:'bottom',
                    labels:{
                        color:"black"
                    }
                },
                tooltip:{
                    backgroundColor: "#D7F1B7",
                    borderWidth:1,
                    borderColor:"black",
                    titleColor:"black",
                    bodyColor:"black"
                }
            }
        }
    });
    histogramaKcal.canvas.parentNode.style.height = '430px';
</script>
<x-layout.footerAuth/>
