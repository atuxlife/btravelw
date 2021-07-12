// Valor inicial del mapa
var mymap = null;
var layers = [];
var myGroup = null;

// Función para inicializar el mapa
function iniMap(){

    mymap = L.map('mapid').setView([35.1291,-89.9727], 5);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 10,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

}

// Carga inicial del mapa
document.addEventListener("DOMContentLoaded", function(event) {
    iniMap();
});

// Solicitar datos para renderizar en mapa e insertar en la base de datos
$(document).on('click','#btnReport',function(){

    mymap.remove();
    iniMap();

    let params = {
        'model'  : 'inicio',
        'method' : 'getWeatherInfo',
        'args'   : ''
    };
    
    $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType: 'json',
        data: params,
        cache: false, // Appends _={timestamp} to the request query string
        success: function(dres) {

            $.each(dres, function(i, item) {

                L.marker([item.lat,item.lon]).addTo(mymap)
                    .bindPopup("<p><b>Ciudad: </b>"+item.city+"<br><b>Temperatura: </b>"+item.tempe+"°C<br><b>Humedad: </b>"+item.humed+"%</p>").openPopup();

            });

        }
    });

});

// Botón de listar histórico de reportes de clima
$(document).on('click','#btnSearch',function(){

    $('#rptLst').html('');
    let fini = $('#fecIni').val(), ffin = $('#fecFin').val();
    let dfini = new Date(fini), dffin = new Date(ffin);
    let status = true;

    if( fini.length > 0 && ffin.length > 0 ){
        if( dffin.getTime() < dfini.getTime() ){
            toastr.error('La fecha final no puede ser menor a la inicial');
            status = false;
        }
    } else if( fini.length == 0 && ffin.length > 0 ){
        fini = ffin;
    } else if( fini.length > 0 && ffin.length == 0 ){
        ffin = fini;
    }

    if( status ){
        
        let params = {
            'model'  : 'inicio',
            'method' : 'lstWeatherInfo',
            'args'   : {
                'dfini' : fini,
                'dffin' : ffin
            }
        };
        
        $.ajax({
            url: 'index.php',
            type: 'POST',
            dataType: 'json',
            data: params,
            cache: false, // Appends _={timestamp} to the request query string
            success: function(dres) {

                if( dres.sts == 0 ){

                    let lin = '<div class="list-group">';

                    $.each(dres.res, function(i, item) {
                        lin += '<a href="#" idw="'+item.id+'" class="list-group-item list-group-item-action report-list">'+item.datetimerep+'</a>';
                    });

                    lin += '</div>';

                    $('#rptLst').html(lin);

                } else {
                    toastr.error('La consulta no ha traído resultados, verifique las fechas ingresadas.');
                }
                
            }
        });

    }

});

// Mostrar datos de una fecha hora específica de reporte
$(document).on('click','.report-list',function(e){

    e.preventDefault();
    mymap.remove();
    iniMap();

    $('.report-list').removeClass('active');
    $(this).addClass('active');
    let idw = $(this).attr('idw');

    let params = {
        'model'  : 'inicio',
        'method' : 'shwDataHist',
        'args'   : idw
    };
    
    $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType: 'json',
        data: params,
        cache: false, // Appends _={timestamp} to the request query string
        success: function(dres) {

            console.log(JSON.stringify(dres.rawdata));

            $.each(JSON.parse(dres.rawdata), function(i, item) {

                L.marker([item.lat,item.lon]).addTo(mymap)
                    .bindPopup("<p><b>Ciudad: </b>"+item.city+"<br><b>Temperatura: </b>"+item.tempe+"°C<br><b>Humedad: </b>"+item.humed+"%</p>").openPopup();

            });
            
        }
    });

});