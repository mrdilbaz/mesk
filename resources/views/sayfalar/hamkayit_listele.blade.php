@extends('layouts.master')

@section('content')
  <div class='container'>

    @isset($yukleme)
    
        @if ($yukleme)
            <div class="alert alert-success fade show" role="alert">
                <strong>Yeni Kayıt Eklendi!</strong> Yüklenen kayıdı listeden seçip düzenleyebilirsiniz.
            </div>
        @else
            <div class="alert alert-danger fade show" role="alert">
                <strong>Bir sorun oluştu!</strong> Kayıt yüklenemedi.
            </div>
        @endif

    @endisset

  <table class="table table-hover table-border">
  <thead class="table-info">
    <tr>
      <th style='width:65% !important;'>İsim</th>
      <th style='width:10% !important;'>Türü</th>
      <th style='width:10% !important;' class='text-right'>Uzunluk</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    

  @foreach($kayitlar as $kayit)
    <tr>
      <td>{{$kayit->isim}}</th>
      <td>{{$kayit->tipisim()}}</td>
      <td class='text-right'>{{$kayit->saniye()}}</td>
      <td class='text-right'>
        <div class='mx-auto'>
        <button class='btn btn-outline-primary btn-sm'>Düzenle</button>
        <button class='btn btn-outline-danger btn-sm'>Sil</button>
        </div>
      </td>
    </tr>
  @endforeach
</tbody>
</table>
</div>
@endsection

@section('footer')
@parent
    <script>
        setTimeout(function(){
            $('.alert').alert('close');
        }, 3000);
    </script>
@endsection