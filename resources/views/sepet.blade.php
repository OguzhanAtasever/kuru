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
                        <td style="width:120px">
                            <a href="{{ route('urun',$urunCartItem->options->slug) }}">
                                <img src="http://via.placeholder.com/120x100?text=UrunResmi">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('urun',$urunCartItem->options->slug) }}"> {{--slug değerini nasıl çektiğmiz önemli--}}
                            {{ $urunCartItem->name }}
                            </a>

                            <form action="{{ route('sepet.kaldir',$urunCartItem->rowId) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-danger" value="Sepetten Kaldır">
                            </form>

                        </td> {{--Alttürden dolayı name olarak kullanıyoruz --}}
                        <td>{{ $urunCartItem->price }}</td>
                        <td>
                            <a href="#" class="btn btn-xs btn-default urun-adet-azalt"
                               data-id="{{ $urunCartItem->rowId }}" data-adet="{{ $urunCartItem->qty-1  }}">-</a>
                            <span style="padding: 10px 20px">{{$urunCartItem->qty}}</span>
                            <a href="#" class="btn btn-xs btn-default urun-adet-artir"
                               data-id="{{ $urunCartItem->rowId }}" data-adet="{{ $urunCartItem->qty+1  }}">+</a> {{--Buradakiler app.js içerisine gönderilerek orada işleniyor
                                --}}
                        </td>
                        <td class="text-right">{{ $urunCartItem->subtotal }}</td>

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
                    <form action="{{ route('sepet.bosalt') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">

                    </form>
                    <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
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
@section('footer')
    <script>
        $(function () {
            $('.urun-adet-artir, .urun-adet-azalt').on('click',function () {
                var id= $(this).attr('data-id');
                var adet = $(this).attr('data-adet');
                $.ajax({
                    type: 'PATCH',
                    url: '{{url('sepet/guncelle')}}/'+id,
                    data: {adet: adet},
                    success:function () {
                        window.location.href = '{{ route('sepet') }}';

                    }
                });
            });

        })
    </script>
@endsection
