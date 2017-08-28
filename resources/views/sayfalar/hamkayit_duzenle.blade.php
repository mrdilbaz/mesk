@extends('layouts.master')

@section('content')
  <div class='container'>
    <div class='form-group'><input class="form-control form-control-lg" type="text" name='isim' value='{{$kayit->isim}}'></div>    
    <div class='row justify-content-end no-gutters pb-2'>
        <div class='mr-auto'>
        
            <button id='play-button' class="btn btn-success btn-sm" onclick="wavesurfer.playPause()" >
                <i class="fa fa-play"></i>
                Oynat
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
    <div class='row justify-content-center'>
        
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
            waveColor: '#22963b',
            progressColor: '#06591c',
            normalize:true
        });

        wavesurfer.load('{{ asset($kayit->dosya) }}');
        

        wavesurfer.on('ready', function () {
            $('#wave-loading').hide();
            var timeline = Object.create(WaveSurfer.Timeline);

            timeline.init({
                wavesurfer: wavesurfer,
                container: '#waveform-timeline'
            });

            wavesurfer.enableDragSelection({});

            // Add a couple of pre-defined regions
            wavesurfer.addRegion({
                start: 25, // time in seconds
                end: 300, // time in seconds
                color: 'hsla(100, 100%, 30%, 0.1)'
            });
        });

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
@endsection