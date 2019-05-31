@extends('yonetim.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')

   <h1 class="page-header">Kategori Yönetimi</h1>

            <form method="post" action="{{ route('yonetim.kategori.kaydet' , @$gelen->id) }}">
                	{{ csrf_field() }}

                	<div class="pull-right">
	                	 <button type="submit" class="btn btn-primary">

	                	 	{{ @$gelen->id > 0 ?  "Güncelle":"Kaydet" }}
	                	 </button>
                	</div>

					 <h2 class="sub-header">
					 	Kategori {{ @$gelen->id > 0 ? "Düzenle" :"Ekle" }}
					 </h2>
                    
                     @include('layouts.partials.errors')
                     @include('layouts.partials.alert ')

                     <div class="row">
                        <div class="col-md-4">
                        	<div class="form-group">
                                <label for="ust_id">Üst Kategori Adı</label>
                                <select name="ust_id" id="ust_id" class="form-control">
                                    <option value="">Ana Kategori</option>
                                {{--Tüm kategorileri burada göstercez--}}
                                    @foreach($kategoriler as $kategori)
                                     <option value="{{$kategori->id}}">
                                            {{$kategori->kategori_adi}}
                                      </option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        	<div class="form-group">
                                <label for="kategori_adi">Kategori Adı</label>
                                <input type="text" class="form-control" id="kategori_adi" name="kategori_adi" placeholder="Kategori Adı" value="{{ old('kategori_adi' , $gelen->kategori_adi ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="hidden" name="original_slug" value="{{old('slug',$gelen->slug) }}">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{old('slug',$gelen->slug) }}">
                            </div>
                        </div>
                    </div>
                </form>
@endsection