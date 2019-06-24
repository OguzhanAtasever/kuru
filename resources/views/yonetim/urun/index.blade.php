@extends('yonetim.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')

   <h1 class="page-header">Ürün Yönetimi</h1>
            <h3 class="sub-header">Ürün Listesi</h3>
                <div class="well">
                    <div class="btn-group pull-right">
                        <a href="{{route('yonetim.urun.yeni')}}" class="btn btn-primary">Yeni</a>
                    </div>
                    <form method="post" action="{{route('yonetim.urun')}}" class="form-inline">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="search">Ara</label>
                            <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Ürün Ara...." value="{{ old('aranan')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ara</button>
                        <a href="{{route('yonetim.urun')}}" class="btn btn-primary">Temizle</a>
                    </form>
                </div>
                @include('layouts.partials.alert')
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Slug</th>
                                <th>Resim</th>
                                <th>Ürün Adı</th>
                                <th>Fiyatı</th>
                                <th>Kayıt Tarihi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($list)==0)
                            <tr><td colspan="7" class="text-center">Kullanıcı Bulunamadı</td></tr>
                        @endif
                           {{-- veritabanından gelen tüm kayıtları listeleyecek  --}}
                           @foreach($list as $gelen)
                            <tr>
                                <td>{{ $gelen->id }}</td>
                                <td>
                                    <img src="{{ $gelen->detay->urun_resmi != null ? asset('uploads/urunler/'. $gelen->detay->urun_resmi) : 'http://via.placeholder.com/120x120?text=UrunResmi'}}" style="width:120px">
                                </td>
                                <td>{{ $gelen->slug }}</td>
                                <td>{{ $gelen->urun_adi }}</td>
                                <td>{{ $gelen->fiyati }}</td>
                                <td>{{ $gelen->olusturulma_tarihi }}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('yonetim.urun.duzenle',$gelen->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.urun.sil' ,$gelen->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin Misiniz?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{--sayfa numaraları düzgün bir şekilde geldi--}}
                    {{$list->links()}}
                </div>


@endsection