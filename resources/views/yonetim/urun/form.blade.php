@extends('yonetim.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')

   <h1 class="page-header">Ürün Yönetimi</h1>
            <form method="post" action="{{ route('yonetim.urun.kaydet' ,$gelen->id) }}" enctype="multipart/form-data">
                	{{ csrf_field() }}

                	<div class="pull-right">
	                	 <button type="submit" class="btn btn-primary">
                            {{ @$gelen->id > 0 ?  "Güncelle":"Kaydet" }}
	                	 </button>
                	</div>

					 <h2 class="sub-header">
					 	Ürün {{ @$gelen->id > 0 ? "Düzenle" :"Ekle" }}
					 </h2>
                    
                     @include('layouts.partials.errors')
                     @include('layouts.partials.alert ')

        
                    <div class="row">
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label for="urun_adi">Ürün Adı</label>
                                <input type="text" class="form-control" id="urun_adi" name="urun_adi" placeholder="Ürün Adı" value="{{ old('urun_adi' , $gelen->urun_adi ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="hidden" name="original_slug" value="{{old('slug',$gelen->slug) }}">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{old('slug',$gelen->slug) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label for="aciklama">Açıklama</label>
                                <textarea class="form-control" id="aciklama" name="aciklama">
                                   {{old('aciklama',$gelen->aciklama)}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        	<div class="form-group">
                                <label for="fiyati">Fiyatı</label>
                                <input type="text" class="form-control" id="fiyati" name="fiyati" placeholder="Fiyatı" value="{{ old('fiyati' , $gelen->fiyati ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="goster_slider" value="0">
                            <input type="checkbox" name="goster_slider" value="1" {{ old('goster_slider' ,$detay->goster_slider ) ? 'checked' : '' }}>
                           Slider'da Göster
                        </label>
                        <label>
                            <input type="hidden" name="goster_gunun_firsati" value="0">
                            <input type="checkbox" name="goster_gunun_firsati" value="1" {{ old('goster_gunun_firsati' ,$detay->goster_gunun_firsati ) ? 'checked' : '' }}>
                           Günün Fırsatında Göster
                        </label>
                        <label>
                            <input type="hidden" name="goster_one_cikan" value="0">
                            <input type="checkbox" name="goster_one_cikan" value="1"  {{ old('goster_one_cikan' ,$detay->goster_one_cikan ) ? 'checked' : '' }} >
                            Öne Çıkan Alanında Göster
                        </label>
                        <label>
                            <input type="hidden" name="goster_cok_satan" value="0">
                            <input type="checkbox" name="goster_cok_satan" value="1"  {{ old('goster_cok_satan' ,$detay->goster_cok_satan) ? 'checked' : '' }}>
                           Çok Satan Alanında Göster
                        </label>
                        <label>
                            <input type="hidden" name="goster_indirimli" value="0">
                            <input type="checkbox" name="goster_indirimli" value="1" {{ old('goster_indirimli' ,$detay->goster_indirimli) ? 'checked' : '' }}>
                            İndirimli Ürünlerde Göster
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label for="kategoriler">Kategoriler</label>
                               <select name="kategoriler[] " class="form-control" id="kategoriler" multiple>
                                   @foreach($kategoriler as $kategori)
                                    <option value="{{$kategori->id}}"
                                          {{ collect( old('kategoriler' ,$urun_kategorileri))->contains($kategori->id) ? 'selected' : ''}}>{{$kategori->kategori_adi}}
                                    </option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @if($gelen->detay->urun_resmi!=null)
                            <img src="/uploads/urunler/{{$gelen->detay->urun_resmi }}" style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
                        @endif
                        <label for="urun_resmi">Ürün Resmi</label>
                        <input type="file" name="urun_resmi" id="urun_resmi">
                    </div>
                </form>
@endsection
@section('head')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection
@section('footer')
   <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.4/plugins/autogrow/plugin.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
   <script>
   
   $(function(){
       $('#kategoriler').select2({
           //ekstra özellikler burada verilebilir
           placeholder:'Lütfen Kategori Seçiniz'
       });

       //option ile ckeditöre farklı özellikler vrebiliriz(renk,dil vb)
       var options={
           uiColor:'#f4645f',
           language:'tr',
           extraPlugins:'autogrow',
           autoGrow_minHeight:250,
           autoGrow_maxHeight:600,
           filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
           filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
           filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
           filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
       }; 
       CKEDITOR.replace('aciklama',options);
   });
    </script>
@endsection