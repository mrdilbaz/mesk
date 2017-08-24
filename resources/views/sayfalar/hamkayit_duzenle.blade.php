@extends('layouts.master')

@section('content')
  <div class='container' id='waveform'>
    {!! $kayit !!}
  </div>
@endsection


@section('footer')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js"></script>
    <script>
        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: 'gray',
            progressColor: 'purple'
        });
        wavesurfer.load('{{ asset($kayit->dosya) }}');
    </script>
@endsection