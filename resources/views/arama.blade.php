@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li> <a href="{{route('anasayfa')}}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
        <div class="products bg-content">
            @if(count($urunler)==0)
                Bir ürün bulunamadı
            @endif
            @foreach($urunler as $urun)
                <a href="{{ route('urun',$urun->slug) }}">
                    <img src="http://via.placeholder.com/60x60?text=UrunResmi">
                </a>
                <p> <a href="{{ route('urun',$urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                <p class="price">{{ $urun->fiyati }} ₺</p>
            @endforeach
        </div>
        {{ $urunler->appends(['aranan'=>old('aranan')])->links() }}   {{--links sayfalandırmayla ilgili bğlantıları otomatik getriyor--}}
    </div>
@endsection
