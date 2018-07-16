 @extends('layouts.master') 
 
 @section('content')

<div class='container'>

	<div class='row justify-content-end no-gutters pb-2'>
		
	<div class='container' style='height:150px'>
		<div id='wave-loading' style='position:absolute;text-align:center;width:100%;top:2.5em'>
			<h2 class='text-muted font-italic'>Yükleniyor</h2>
		</div>
		<div id='waveform'></div>
		<div id="waveform-timeline"></div>
	</div>
	

	<?php 
	?>

	</div>
	@endsection 
	
	@section('footer') 
	
	@parent
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.timeline.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.regions.min.js"></script>

	<script>
		{{--  var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#4A9B62',
            progressColor: '#0D5C25',
            autoCenter:false,
            minPxPerSec:0.1
        });

        wavesurfer.load('{{ asset($kayit->dosya) }}');  --}}
        

{{--          wavesurfer.on('ready', function () {
            $('#wave-loading').hide();
            var timeline = Object.create(WaveSurfer.Timeline);

            timeline.init({
                wavesurfer: wavesurfer,
                container: '#waveform-timeline'
            });

            wavesurfer.enableDragSelection({drag:false});


            currentZoom = 1072 / wavesurfer.getDuration();
            minZoom = currentZoom;
        });  --}}


        
	</script>



	<style>

	</style>
	@endsection