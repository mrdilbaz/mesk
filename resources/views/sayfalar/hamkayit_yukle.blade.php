@extends('layouts.master')

@section('content')
<div class="container">
  <form>
    <div class="form-group row">
      <label for="isim" class="col-sm-2 col-form-label">İsim</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="isim" placeholder="İsim">
      </div>
    </div>
    <div class="form-group row">
      <label for="tip" class="col-sm-2 col-form-label">Kayıt Tipi</label>
      <div class="col-sm-10">
        {!! Form::select("tip", $tipler, null, ['class'=>'custom-select form-control']) !!}
      </div>
    </div>
    <div class="form-group row">
      <label for="dosya" class="col-sm-2 col-form-label">Kayıt Tipi</label>
      <div class="col-sm-10">
        {!! Form::file("dosya", ['class'=>'custom-file-input']) !!}
        <span class="custom-file-control" style='left:15px !important;right:15px !important'></span>
      </div>
    </div>
    <div class="row"><br/>
    </div>
    <div class="form-group row justify-content-end">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Yükle</button>
      </div>
    </div>
  </form>
</div>

@endsection