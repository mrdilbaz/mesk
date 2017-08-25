@extends('layouts.master')

@section('content')
  <div class='container'>
    <div class='form-group'><input class="form-control form-control-lg" type="text" name='isim' value='{{$kayit->isim}}'></div>    
    <div id='waveform' style='height:130px;overflow-x:visible;'></div>
    <div id="waveform-timeline"></div>
    <div style="text-align: center">
        <button class="btn btn-primary" onclick="wavesurfer.playPause()">
            <i class="glyphicon glyphicon-play"></i>
            Play
        </button>

        <p class="row">
            <div class="col-xs-1">
            <i class="glyphicon glyphicon-zoom-in"></i>
            </div>

            <div class="col-xs-10">
            <input id="slider" type="range" min="1" max="10" value="1" style="width: 100%" />
            </div>

            <div class="col-xs-1">
            <i class="glyphicon glyphicon-zoom-out"></i>
            </div>
        </p>
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
            waveColor: '#22963b',
            progressColor: '#06591c',
            scrollParent: true,
            minPxPerSec:1,
            renderer:'MultiCanvas',

        });
        wavesurfer.load('{{ asset($kayit->dosya) }}');
        

        wavesurfer.on('ready', function () {
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

        var slider = document.querySelector('#slider');

        slider.oninput = function () {
            var zoomLevel = Number(slider.value);
            wavesurfer.zoom(zoomLevel);
        }; 
    </script>
@endsection