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
    <tr>
      <td>{{$kayit->isim}}</th>
      <td>{{$kayit->tipisim()}}</td>
      <td class='text-right'>{{$kayit->saniye()}}</td>
      <td class='text-right'>
        <div class='mx-auto'>
        <a href='hamkayit/duzenle/{{$kayit->id}}'  class='btn btn-outline-primary btn-sm'>Düzenle</a>
        <button class='btn btn-outline-danger btn-sm'>Sil</button>
        </div>
      </td>
    </tr>
  @endforeach
</tbody>
</table>
</div>
@endsection