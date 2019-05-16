@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Adet Fiyatı</th>
                        <th>Adet</th>
                        <th>Tutar</th>

                    </tr>
                    @foreach(Cart::content() as $urunCartItem) {{--Cart::content ile içindeki her şeyi çekebiliyoruz--}}
                    <tr>
                        <td style="width:120px"> <img src="http://via.placeholder.com/120x100?text=UrunResmi"></td>
                        <td>
                            <a href="{{ route('urun',$urunCartItem->options->slug) }}"> {{--slug değerini nasıl çektiğmiz önemli--}}
                            {{ $urunCartItem->name }}
                            </a>
                        </td> {{--Alttürden dolayı name olarak kullanıyoruz --}}
                        <td>{{ $urunCartItem->price }}</td>
                        <td>
                            <a href="#" class="btn btn-xs btn-default">-</a>
                            <span style="padding: 10px 20px">{{$urunCartItem->qty}}</span>
                            <a href="#" class="btn btn-xs btn-default">+</a>
                        </td>
                        <td class="text-right">{{ $urunCartItem->subtotal }}</td>
                        <td>
                            <a href="#">Sil</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Alt Toplam</th>
                        <th>{{ Cart::subtotal() }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">KDV</th>
                        <th>{{ Cart::tax() }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Genel Toplam</th>
                        <th>{{ Cart::total() }}</th>
                    </tr>
                </table>
                <div>
                    <a href="#" class="btn btn-info pull-left">Sepeti Boşalt</a>
                    <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>
            @else
                <p>Sepetinizde ürün bulunmamaktadır</p>
                <div>
                    <a href="{{ route('anasayfa') }}" class="btn btn-info pull-left">Alışverişe Devam Et</a>

                </div>
            @endif



        </div>
    </div>
@endsection