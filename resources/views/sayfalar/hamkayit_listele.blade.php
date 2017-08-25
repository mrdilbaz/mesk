@extends('layouts.master')

@section('content')
  <div class='container'>
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
    <tr id='kayit{{$kayit->id}}'>
      <td>{{$kayit->isim}}</th>
      <td>{{$kayit->tipisim()}}</td>
      <td class='text-right'>{{$kayit->saniye()}}</td>
      <td class='text-right'>
        <div class='mx-auto'>
        <a href="{{ route('hamkayit/duzenle',['id'=>$kayit->id]) }}"  class='btn btn-outline-primary btn-sm'>Düzenle</a>
        <button onclick='silmeUyarisi({{$kayit->id}});' class='btn btn-outline-danger btn-sm'>Sil</button>
        </div>
      </td>
    </tr>
  @endforeach
</tbody>
</table>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kayıt Silme İşlemi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bu kaydı silmek istediğinizden emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal etmek istiyorum</button>
        <button type="button" onclick='kayitSilme();' class="btn btn-primary">Evet, Silinsin.</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('footer')
@parent

<script type='text/javascript'>
    var seciliKayit = -1;

    function silmeUyarisi(kayit_id){
      seciliKayit = kayit_id;
      $('#deleteModal').modal('show');
    }

    function kayitSilme(){
     $.post( "{{route('hamkayit/sil')}}",{'kayit_id':seciliKayit,'_token':'{{ csrf_token() }}'}, function( data ) {
        console.log(data);
        $('#kayit'+seciliKayit).hide(true);
        $('#deleteModal').modal('hide');
      });


    }  
 </script>
@endsection