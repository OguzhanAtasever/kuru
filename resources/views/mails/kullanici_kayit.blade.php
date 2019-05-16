<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$kullanici->adsoyad}} Kaydınız başarılı bir şekilde tamamlandı</p>
<p>Kaydinizi aktifleştirmek için
    <a href="{{ config('app.url') }}/kulanici/aktiflestir/{{ $kullanici->aktivasyon_anahtari }}">tıklayın</a>
    veya aşağıdaki bağlantıyı tarayıcınızda açınız  </p>
<p>
    {{ config('app.url') }}/kullanici/aktiflestir/{{ $kullanici->aktivasyon_anahtari }}
</p>
