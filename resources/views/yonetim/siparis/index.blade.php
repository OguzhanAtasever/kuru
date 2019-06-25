@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')

   <h1 class="page-header">Sipariş Yönetimi</h1>
            <h3 class="sub-header">Sipais Listesi</h3>
                <div class="well">
                    <div class="btn-group pull-right">
                        <a href="{{route('yonetim.siparis.yeni')}}" class="btn btn-primary">Yeni</a>
                    </div>
                    <form method="post" action="{{route('yonetim.siparis')}}" class="form-inline">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="search">Ara</label>
                            <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Siparis Ara...." value="{{ old('aranan')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ara</button>
                        <a href="{{route('yonetim.siparis')}}" class="btn btn-primary">Temizle</a>
                    </form>
                </div>
                @include('layouts.partials.alert')
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sipariş Kodu</th>
                                <th>Kullanıcı</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                                <th>Sipariş Tarihi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($list)==0)
                            <tr><td colspan="7" class="text-center">Kayıt Bulunamadı</td></tr>
                        @endif
                           {{-- veritabanından gelen tüm kayıtları listeleyecek  --}}
                           @foreach($list as $gelen)
                            <tr>
                                <td>{{ $gelen->id }}</td>
                                <td>{{ $gelen->sepet->kullanici->adsoyad}}</td>
                                <td>{{ $gelen->siparis_tutari*((100+config('cart.tax'))/100) }}</td>
                                <td>{{ $gelen->durum }}</td>
                                <td>{{ $gelen->olusturulma_tarihi }}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('yonetim.siparis.duzenle',$gelen->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.siparis.sil' ,$gelen->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin Misiniz?')">
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