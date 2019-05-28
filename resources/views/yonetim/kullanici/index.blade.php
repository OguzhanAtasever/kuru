@extends('yonetim.layouts.master')
@section('title','Kullanici Yönetimi')
@section('content')

   <h1 class="page-header">Kullanıcı Yönetimi</h1>
            <h3 class="sub-header">Kullanıcı Listesi</h3>
                <div class="well">
                    <div class="btn-group pull-right">
                        <a href={{ route('yonetim.kullanici.yeni') }} class="btn btn-primary">Yeni</a>
                    </div>
                    <form method="post" action="{{route('yonetim.kullanici')}}" class="form-inline">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="search">Ara</label>
                            <input type="text" class"form-control form-control-sm" name="aranan" id="aranan" placeholder="Ad,Email Ara...." value="{{ old('aranan')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ara</button>
                        <a href="{{route('yonetim.kullanici')}}" class="btn btn-primary">Temizle</a>
                    </form>
                </div>
                @include('layouts.partials.alert')
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Ad Soyad</th>
                                <th>Email</th>
                                <th>Aktif Mi</th>
                                <th>Yönetici Mi</th>
                                <th>Kayıt Tarihi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           {{-- veritabanından gelen tüm kayıtları listeleyecek  --}}
                           @foreach($list as $gelen)
                            <tr>
                                <td>{{ $gelen->id }}</td>
                                <td>{{ $gelen->adsoyad }}</td>
                                <td>{{ $gelen->email }}</td>
                                <td>
                                 @if($gelen->aktif_mi)
                                    <span class="label label-success">Aktif</span>
                                 @else
                                    <span class="label label-warning">Pasif</span>
                                 @endif
                                </td>
                                <td>
                                 @if($gelen->yonetici_mi)
                                    <span class="label label-success">Yönetici</span>
                                 @else
                                    <span class="label label-warning">Müşteri</span>
                                 @endif
                                </td>
                                <td>{{ $gelen->olusturulma_tarihi }}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('yonetim.kullanici.duzenle',$gelen->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{route('yonetim.kullanici.sil' ,$gelen->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin Misiniz?')">
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