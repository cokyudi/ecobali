@extends('template', ['user'=>$user])
@section('map','active')

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
<style type="text/css">
    #mapid { height: 100%; width:100%;}
    .marker {
        background-size: cover;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
      }
      .mapboxgl-popup {
        max-width: 200px;
      }
</style>
@endpush

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
    </div>
    <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
    <!--/ Revenue, Hit Rate & Deals -->
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="card">
            <div class="card-header">
                <h4 class="card-title">Participants Map</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-content collapse show">
                        <div class="card-body height-700">
                            <div id="mapid" ></div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    </div>
</div>

</div>
    <!-- END: Content-->
<!-- BEGIN: Customizer-->
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-danger box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
        <h4 class="text-uppercase mb-0">Data Filter Customizer</h4>
        <hr>

        <form id="filterForm" name="filterForm">

            <h5 class="mt-1 mb-1 text-bold-500">Category</h5>
            <div class="form-group ">
                <select id="id_category" name="id_category[]" multiple="multiple" class="select2 form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                </select>
            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">District</h5>
            <div class="form-group ">
                <select id="id_district" name="id_district[]" multiple="multiple" class="select2 form-control">
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->district_name}}</option>
                    @endforeach

                </select>
            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">Regency</h5>
            <div class="form-group ">
                <select class="select2 form-control" id="id_regency" name="id_regency[]" multiple="multiple">
                    @foreach($regencies as $regency)
                        <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-actions text-right">
                <button id='backBtn' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="saveBtn"  value="create" type="button" class="btn btn-success">
                    <i class="la la-check-square-o"></i> Filter
                </button>
            </div>

        </form>

    </div>
</div>
<!-- End: Customizer-->
<!-- END: Content -->
@endsection

@push('ajax_crud')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>

<script>

    mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2twbXBweGkzMmgycTJvcmkxM3ozeDhmaCJ9.w1rN2S1A6G5SJFoitaoQvQ';
        var map = new mapboxgl.Map({
        container: 'mapid', // container id
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [115.188919, -8.409518], // starting position [lng, lat]
        zoom: 9 // starting zoom
    });

</script>

<script type="text/javascript">

    $(document).ready(function() {
        var markers=[];

        getParticipantsInformation(markers);

        $('#backBtn').click(function() {

            $('#id_category').val(null).trigger('change');
            $('#id_district').val(null).trigger('change');
            $('#id_regency').val(null).trigger('change');
            markers.forEach(element => {
                element.remove();
            });
            markers = [];
            getParticipantsInformation(markers);
        });

        $('#saveBtn').click(function() {
            markers.forEach(element => {
                element.remove();
            });
            markers = [];
            getParticipantsInformation(markers);
        });


    });

    function getParticipantsInformation (markers) {
        var idCategory = $('#id_category').val();
        var idDistrict = $('#id_district').val();
        var idRegency = $('#id_regency').val();

        var params = {
            idCategory: idCategory,
            idDistrict: idDistrict,
            idRegency: idRegency
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
			type: "GET",
			url: "getMapParticipantsInformation",
			data:params,
			success: function (data) {
                map.flyTo({
                    center: [115.188919, -8.409518],
                    zoom: 9
                });
                var geojson = {
                    'type': 'FeatureCollection',
                    'features': data.data,
                };
                geojson.features.forEach(function (marker) {
                    // create a HTML element for each feature
                    var el = document.createElement('div');
                    el.className = 'marker';
                    el.style.backgroundImage = 'url(/images/markers/marker-'+marker.properties.category+'.png)';
                    el.style.height = '45px';
                    el.style.width = '45px';

                    // make a marker for each feature and add it to the map
                    var pin = new mapboxgl.Marker(el)
                    .setLngLat(marker.geometry.coordinates)
                    .setPopup(
                        new mapboxgl.Popup({ offset: 25 }) // add popups
                        .setHTML(
                            '<h5>' +
                            marker.properties.title +
                            '</h5>' +
                            marker.properties.description +
                            ''
                        )
                    )
                    .addTo(map);
                    markers.push(pin);

                    el.addEventListener("click", e => {
                        map.flyTo({
                            center: marker.geometry.coordinates,
                            zoom: 20
                        });
                    });
                });

                console.log(markers);
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
    }
</script>
@endpush
