@extends('layouts.master')

@section('content')
<div class="container">
  
  {!! Form::open(["route"=>"hamkayit/yukle","files"=>"true"]) !!}
  
    <div class="form-group row">
      <label for="isim" class="col-sm-2 col-form-label">İsim</label>
      <div class="col-sm-10">
        {!! Form::text("isim", "", ["class"=>"form-control","placeholder"=>"İsim"]) !!}
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
        {!! Form::file("dosya", ['class'=>'custom-file-input','style'=>'min-width:100%']) !!}
        <span class="custom-file-control" style='left:15px !important;right:15px !important'></span>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-2"></div>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary btn-block"><b>Yükle</b></button>
      </div>
    </div>
  </form>
</div>

@endsection