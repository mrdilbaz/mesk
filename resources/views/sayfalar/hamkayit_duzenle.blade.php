
@extends('layouts.master')

@section('content')

  <div class='container'>
  
    <div class='form-group'><input class="form-control form-control-lg" type="text" name='isim' value='{{$kayit->isim}}'></div>    
    <div class='row justify-content-end no-gutters pb-2'>
        <div class='mr-auto'>
        
            <button id='playButton' style='width:100px;' class="btn btn-success btn-sm" onclick="PlayPause()" >
                <i class="fa fa-play"></i>
                Oynat
            </button>

            <button id='pauseButton' style='width:100px;display:none' class="btn btn-warning btn-sm"  onclick="PlayPause()" >
                <i class="fa fa-pause"></i>
                Duraklat
            </button>

        </div>
        <div class='px-2'>
            <button class='btn btn-info btn-sm' style='width:80px;' onclick="zoomIn()">
                <i class="fa fa-search-plus" aria-hidden="true"></i>
                Yaklaş
            </button>
        </div>
        <div class=''>
            <button class='btn btn-info btn-sm' style='width:80px;' onclick="zoomOut()">
                <i class="fa fa-search-minus" aria-hidden="true"></i>
                Uzaklaş
            </button>
        </div>
    </div>
    <div class='container' style='height:150px'>
        <div id='wave-loading' style='position:absolute;text-align:center;width:100%;top:2.5em'><h2 class='text-muted font-italic'>Yükleniyor</h2></div>
        <div id='waveform'></div>
        <div id="waveform-timeline"></div>
    </div>
    <div class='lead text-center pt-5 pb-3'><h4 class="display-4">Parçalar</h4></div>
    <div id='parca-listesi' class='pt-3 jumbotron'>
        <div class='row mb-3 pb-2 text-muted' style='border-bottom:1px dashed grey' id='headers'>
            <div class='col-1 text-center'>#</div>
            <div class='col-1'>
                Başlangıç
            </div>
            <div class='col-1'>
                Bitiş
            </div>
            <div class='col-5'>
                Parça Adı
            </div>
            <div class='col-2'>
                
            </div>
            <div class='col-2'>
                
            </div>
        </div>
        

        <div class='row pb-3' id='example-row' style='line-height:38px;display:none' >
            <div class='col-1'><span class='region-badge'>1</span></div>
            <div class='col-1'>
                <input type='text' class='form-control' />
            </div>
            <div class='col-1'>
                <input type='text' class='form-control' />
            </div>
            <div class='col-6'>
                <input type='text' class='form-control' />
            </div>
            <div class='col-1 text-left'>
            
            <button  style='width:75px;' class="btn btn-success btn-sm" onclick="" >
                <i class="fa fa-play"></i>
                Oynat
            </button>
            <button  style='width:75px;display:none' class="btn btn-warning btn-sm"  onclick="" >
                <i class="fa fa-pause"></i>
                Duraklat
            </button>
            
            </div>
            <div class='col-1 text-right'>
                <button class='btn btn-info btn-sm'>Düzenle</button>
            </div>
            <div class='col-1'>
                <button class='btn btn-outline-danger btn-sm'>Sil</button>
            </div>
        </div>

        
        
    </div>

@endsection


@section('footer')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.timeline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.regions.min.js"></script>

    <script>
        
        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#4A9B62',
            progressColor: '#0D5C25',
            autoCenter:false,
            minPxPerSec:0.1
        });

        wavesurfer.load('{{ asset($kayit->dosya) }}');
        

        wavesurfer.on('ready', function () {
            $('#wave-loading').hide();
            var timeline = Object.create(WaveSurfer.Timeline);

            timeline.init({
                wavesurfer: wavesurfer,
                container: '#waveform-timeline'
            });

            wavesurfer.enableDragSelection({drag:false});
        });


        var regionlist = [];

        wavesurfer.on('region-created',function(region){
            regionlist.push(region);
            region.update({attributes :{'id':regionlist.length}});
            
            var regionId = regionlist.length;

            $(region.element).append("<div class='region-badge'>"+regionId+"</div>");
            
            $(region.element).append("<button type='button' onclick='deleteregion("+regionId+")' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>");
            
            var row = $('#example-row').clone().appendTo('#parca-listesi');

            row.show();
            row.find('span.region-badge').html(regionId);

            region.row = row;

            $('.close').click(function(event){
                event.stopPropagation();
            });
        });


        
        
        function PlayPause(){
            wavesurfer.playPause();
            if(wavesurfer.isPlaying()){
                $('#pauseButton').show(false);
                $('#playButton').hide(false);
            } else {
                $('#pauseButton').hide(false);
                $('#playButton').show(false);
            }
        }

        $(document).keypress(function(eventObject){
                if(eventObject.keyCode == 32){
                    if(eventObject.target.tagName != "INPUT"){
                        PlayPause();
                    }
                }
        });

        function deleteregion(regionIndex){
            $("region[data-region-id="+regionIndex+"]").hide();
            regionlist[regionIndex-1].row.hide();
        }


        var currentZoom = 0.1;
        var zoomSensitivity = 0.5;

        function zoomIn(){
            currentZoom = Math.min(currentZoom + zoomSensitivity,50);
            wavesurfer.zoom(currentZoom);
        }

        function zoomOut(){
            currentZoom = Math.max(currentZoom - zoomSensitivity,0.1);
            wavesurfer.zoom(currentZoom);
        }
    </script>



    <style>
    .region-badge{
        border:2px solid white;
        border-radius:40px;
        width:45px;
        height:45px;
        background:#0D3F4D;
        line-height:40px;
        text-align:center;
        font-weight:bolder;
        color:#9ABAC3;
        left:50%;
        position:absolute;
        margin-left:-22.5px;
        top:50%;
        margin-top:-22.5px;
        font-size:24px;
    }

    .region-close{

    }

    .wavesurfer-handle{
        border-left:2px dashed #407382;
    }
    </style>
@endsection