 @extends('layouts.master') @section('content')

<div class='container'>

	<div class='form-group'>
		<input class="form-control form-control-lg kayit-isim" type="text" name='isim' value='{{$kayit->isim}}'>
	</div>
	<div class='row justify-content-end no-gutters pb-2'>
		<div class='mr-auto'>

			<button id='playButton' style='width:100px;' class="btn btn-success btn-sm" onclick="PlayPause()">
				<i class="fa fa-play"></i>
				Oynat
			</button>

			<button id='pauseButton' style='width:100px;display:none' class="btn btn-warning btn-sm" onclick="PlayPause()">
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
		<div id='wave-loading' style='position:absolute;text-align:center;width:100%;top:2.5em'>
			<h2 class='text-muted font-italic'>Yükleniyor</h2>
		</div>
		<div id='waveform'></div>
		<div id="waveform-timeline"></div>
	</div>

	<div class='row lead text-center align-items-center pt-5 pb-3'>
		<div class='col-10'>
			<h4 class="display-4" style="font-size:2.5rem !important">Parçalar</h4>
		</div>
		<div class='col text-right'>
			<button class='btn btn-success' onclick='Add();'>
				<i class="fa fa-plus" aria-hidden="true"></i>
			Ekle</button>
		</div>
	</div>
	<div id='parca-listesi'>
		
		<div id='example-row' class="jumbotron" style="padding:3rem !important;display:none">

			<div class='row'>
				<div class='col'>
					<label>İsim:</label>
					<input type='text' class='form-control isim' />
				</div>
				<div class='col-2'>
					<label>Başlangıç:</label>
					<input type='text' class='form-control baslangic pre-disabled' value="00:00" />
				</div>
				<div class='col-2'>
					<label>Bitiş:</label>
					<input type='text' class='form-control bitis pre-disabled' value="00:00" />
				</div>

			</div>

			<div class='row pb-4'>
				<div class='col'>
				<label>Makam:</label>
					<input type='text' class='form-control makam' />
					
				</div>
				<div class='col-5'>
					<label>Güfte:</label>
					<input type='text' class='form-control gufte' />
				</div>
				<div class='col-5'>
					<label>Beste:</label>
					<input type='text' class='form-control beste' />
				</div>
			</div>
			

			<div class="row justify-content-left">
				<div class="col"></div>
				<div class='col-2'>
						<button class='btn btn-info btn-block'>Göster</button>
				</div>
				<div class='col-1'>
						<button class='btn btn-outline-danger btn-block'>Sil</button>
				</div>
			</div>
				
		</div>


		





	</div>

	<div class="row pb-2 pt-5">
		<div class='col'>
			<button class='btn btn-primary btn-block btn-bg' onclick='Save();'>
				Kaydet</button>
	</div>



	
	@endsection @section('footer') @parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.timeline.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/plugin/wavesurfer.regions.min.js"></script>

	<script>

	    var currentZoom = 0.1;
        var minZoom = 0.1;
        var zoomSensitivity = 0.5;


		var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#4A9B62',
            progressColor: '#0D5C25',
            autoCenter:true,
            minPxPerSec:0.1,
			pixelRatio:1
        });

        wavesurfer.load('{{ asset($kayit->dosya) }}');
        

        wavesurfer.on('ready', function () {
            $('#wave-loading').hide();
            var timeline = Object.create(WaveSurfer.Timeline);

            timeline.init({
                wavesurfer: wavesurfer,
                container: '#waveform-timeline'
            });

            //wavesurfer.enableDragSelection({drag:false});


            currentZoom = 1072 / wavesurfer.getDuration();
            minZoom = currentZoom;
        });

		function zoomIn(){
            currentZoom = Math.min(currentZoom + zoomSensitivity,50);
            wavesurfer.zoom(currentZoom);
        }

        function zoomOut(){
            currentZoom = Math.max(currentZoom - zoomSensitivity,minZoom);
            wavesurfer.zoom(currentZoom);
		}


        var parcalar = [];
		var currentStart = 0;
		var initLength = 180;
		var silence = 3;


		function zoomTo(rid){
			var mid = (parcalar[rid].start + parcalar[rid].end) / 2;
			currentZoom = 1072 / (parcalar[rid].end - parcalar[rid].start + 60);
			wavesurfer.seekAndCenter(mid / wavesurfer.getDuration());
			wavesurfer.zoom(currentZoom);
		}



		function Add(){
			var params = {};
			params.id = parcalar.length;
			params.start = currentStart+silence;
			params.end = currentStart + initLength;
			params.drag = false;
			params.resize = true;

			wavesurfer.addRegion(params);

			
		}

         wavesurfer.on('region-created',function(region){
            
            
			region.update({attributes :{'id':parcalar.length}});
            
			var row = $('#example-row').clone().attr("id","parca-"+region.id).appendTo('#parca-listesi');
			row.show();
			
			region.row = row;

			parcalar.push(region);

			currentStart += initLength;
			
			
			var date = new Date(null);
            date.setSeconds(region.start);        
            $(region.row).find('.baslangic').val(date.toISOString().substr(11, 8));
            
			date = new Date(null);
			date.setSeconds(region.end);
            $(region.row).find('.bitis').val(date.toISOString().substr(11, 8));

			$(region.row).find(".btn-outline-danger").click(function(){
                var rid = region.attributes["id"];
                deleteregion(rid);
            });

			$(region.row).find(".btn-info").click(function(){
                var rid = region.attributes["id"];
                zoomTo(rid);
            });

			

			$(region.element).append("<div class='region-badge'>İlahi "+region.attributes["id"]+"</div>");

			$(region.row).find('.isim').on("change",function(){
				$(region.element).find('.region-badge').html($(this).val());
			});

			$(region.row).find('.isim').val("İlahi "+region.attributes["id"]);
			

        });

        wavesurfer.on("region-update-end",function(region){
            var date = new Date(null);
            date.setSeconds(region.start);        
            $(region.row).find('.baslangic').val(date.toISOString().substr(11, 8));
            
			date = new Date(null);
			date.setSeconds(region.end);
            $(region.row).find('.bitis').val(date.toISOString().substr(11, 8));



			currentStart = region.end > currentStart ? region.end : currentStart;

        });

		function Save(){
			
			var validate = true;
			$('.loading').css('display','block');
			$('.isim:visible').each(function(){
				if($(this).val() == ""){
					alert("Parça isimleri boş olamaz.");
					validate = false;
				}
			});

			if(!validate)
				return;

			var list = [];	

			$.each(parcalar,function(key,region){
				var parca = {};
				var row = $(region.row);
				
				parca.isim = row.find('.isim').val();
				parca.baslangic = region.start;
				parca.bitis = region.end;
				list.push(parca);
			});


			var inputData = {};
			inputData.parcalar = list;
			inputData.hamkayit_id = '{{$kayit->id}}';
			inputData.hamkayit_isim = $('.kayit-isim').val();
			inputData._token = "{{ csrf_token() }}";
			
			

			$.post( "{{route('hamkayit/parcala')}}",inputData, function( data ) {
				console.log(data);
				$('.loading').css('display','none');
				//var params = {};
				//params.parcalar = data;
				//post_to_url("{!! route('hamkayit/goster') !!}",params,"post");
      		});
			
		}



        
        
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
            parcalar[regionIndex].row.hide();
            parcalar[regionIndex].remove();
            if(Object.keys(wavesurfer.regions.list).length == 0)
                parcalar = [];
        }




		

		function post_to_url(path, params, method) {
			method = method || "post";

			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", path);

			for(var key in params) {
				if(params.hasOwnProperty(key)) {
					var hiddenField = document.createElement("input");
					hiddenField.setAttribute("type", "hidden");
					hiddenField.setAttribute("name", key);
					hiddenField.setAttribute("value", params[key]);

					form.appendChild(hiddenField);
				}
			}	

			document.body.appendChild(form);
			form.submit();
		}


	</script>



	<style>
	
		.region-badge {
			border: 2px dashed #ccc;
			width: auto;
			padding:0px 15px 0px 15px;
			height: 45px;
			background: inherit;
			line-height: 45px;
			text-align: center;
			font-weight: bolder;
			color: #444;
			left: 0;
			right:0;
			position: absolute;
			margin-left: auto;
			margin-right: auto;
			top: 0;
			margin-top: auto;
			font-size: 20px;
			overflow:hidden;
			
		}

		.region-close {}

		.wavesurfer-handle {
			border-left: 2px dashed #407382;
		}

		label{
			font-size:12px;
			margin-bottom:-10px !important;

		}

		input{
			font-size:12px !important;
		}

		.pre-disabled{
			background-color:#ddd;
		}

		.show{
			position: absolute;
			width: 100px;
			height: 50px;
			margin-top: -35px;
			right: 0;
			margin-right: -35px;
		}
		.loading{
			background: #222;
			position:absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			background-color:rgba(0, 0, 0, 0.5);
			z-index:100;
			color:white;
			text-align center;
			display:none;
		}

		.loading span {
			display: inline-block;
			vertical-align: middle;
			width: .6em;
			height: .6em;
			margin: .19em;
			background: #007DB6;
			border-radius: .6em;
			animation: loading 1s infinite alternate;
			}

			.loading span:nth-of-type(2) {
			background: #008FB2;
			animation-delay: 0.2s;
			}
			.loading span:nth-of-type(3) {
			background: #009B9E;
			animation-delay: 0.4s;
			}
			.loading span:nth-of-type(4) {
			background: #00A77D;
			animation-delay: 0.6s;
			}
			.loading span:nth-of-type(5) {
			background: #00B247;
			animation-delay: 0.8s;
			}
			.loading span:nth-of-type(6) {
			background: #5AB027;
			animation-delay: 1.0s;
			}
			.loading span:nth-of-type(7) {
			background: #A0B61E;
			animation-delay: 1.2s;
			}

			.box{
				position:absolute;
				width: 20%;
				height: 20%;
				left:50%;
				margin-left:-10%;
				top:50%;
				margin-top:-10%;
				text-align:center;
			}

	
			@keyframes loading {
			0% {
				opacity: 0;
			}
			100% {
				opacity: 1;
			}
			}
	</style>
	@endsection