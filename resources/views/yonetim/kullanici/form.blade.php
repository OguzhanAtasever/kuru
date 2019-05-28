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
                    
                     @include('layouts.partials.errors')
                     @include('layouts.partials.alert ')

                    <div class="row">
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label for="adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="{{ old('adsoyad' , $gelen->adsoyad ) }}">
                            </div>
                            <div class="form-group">
                                <label for="sifre">Şifre</label>
                                <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifre" value="{{ old('sifre' ,$gelen->sifre) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email' ,$gelen->email)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" value="{{old('adres',$gelen->detay->adres) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="{{ old('telefon' ,$gelen->detay->telefon) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ceptelefonu">Cep Telefonu</label>
                                <input type="text" class="form-control" id="ceptelefonu" name="ceptelefonu" placeholder="Cep telefonu" value="{{ old('ceptelefonu' ,$gelen->detay->ceptelefonu )}}">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="aktif_mi" value="0">
                            <input type="checkbox" name="aktif_mi" value="1" {{ old('aktif_mi' ,$gelen->aktif_mi )? 'checked' : '' }}> Aktif Mi
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="yonetici_mi" value="0">
                            <input type="checkbox" name="yonetici_mi" value="1" {{ old('yonetici_mi' ,@$gelen->yonetici_mi)  ? 'checked' : '' }}> Yönetici Mi
                        </label>
                    </div>
                   
                </form>
@endsection