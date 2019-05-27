@extends('yonetim.layouts.master')
@section('title','Kullanici Yönetimi')
@section('content')

   <h1 class="page-header">Kullanıcı Yönetimi</h1>

  
                <form method="post" action="{{ route('yonetim.kullanici.kaydet' , @$gelen->id) }}">
                	{{ csrf_field() }}

                	<div class="pull-right">
	                	 <button type="submit" class="btn btn-primary">

	                	 	{{ @$gelen->id > 0 ?  "Güncelle":"Kaydet" }}
	                	 </button>
                	</div>

					 <h2 class="sub-header">
					 	Kullanıcı {{ @$gelen->id > 0 ? "Düzenle" :"Ekle" }}
					 </h2>

                    <div class="row">
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" id="adsoyad" placeholder="Ad Soyad" value="{{$gelen->adsoyad }}">
                            </div>
                            <div class="form-group">
                                <label for="sifre">Şifre</label>
                                <input type="password" class="form-control" id="sifre" placeholder="Şifre" value="{{$gelen->sifre }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" value="{{$gelen->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                <input type="text" class="form-control" id="adres" placeholder="Adres" value="{{$gelen->detay->adres }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="text" class="form-control" id="telefon" placeholder="Telefon" value="{{$gelen->detay->telefon }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ceptelefonu">Cep Telefonu</label>
                                <input type="text" class="form-control" id="ceptelefonu" placeholder="Cep telefonu" value="{{$gelen->detay->ceptelefonu }}">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="aktif_mi" value="1" {{$gelen->aktif_mi ? 'checked' : '' }}> Aktif Mi
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="yonetici_mi" value="1" {{@$gelen->yonetici_mi ? 'checked' : '' }}> Yönetici Mi
                        </label>
                    </div>
                   
                </form>
@endsection