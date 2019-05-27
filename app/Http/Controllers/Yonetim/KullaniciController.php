<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kullanici;
use Hash;

class KullaniciController extends Controller
{
    public function oturumac(){

        //web.phpde route tanımladığım match fonku için post mu get mi kontrol yapmamız gerek
        //giriş işlemleri
        if(request()->isMethod('POST'))
        {
            //formdan gelen değerleri validate edelim.email ve şifre alanlarının boş olmamasının kontrolunu yapıyoruz.
            $this->validate(request(),[
                //required alanın doldurulması gerekliliğini belirtir.
                'email'=>'required|email',
                'sifre'=>'required'

            ]);
            //dogrulama yapıldıktan sonra artık giriş işlemine geçiyoruz.Giriş işlemlerini dizide tanımlıyoruz.
            $credentials=[
                'email'=>request()->get('email'),
                'password'=>request()->get('sifre'),
                'yonetici_mi'=>1,
                'aktif_mi'=>1

            ];

            //credential degerini saglıyorsa
            //laravelde müşteri ve yönetici arayüzü için farklı kullanıcılar için guard yapısı tanımlayabiliriz

            if(Auth::guard('yonetim')->attempt($credentials,request()->has('benihatirla')))
            {
                return redirect()->route('yonetim.anasayfa');
            }else{
                //giriş yapmadığı zaman.withinput degeri geri geldiği zaman email adesinin yazılı gelmesini sağlar.
                //witherrorsu oluşturduğumuz hata dosyasını oturumacbladede include etmemiz gerek
                return back()->withInput()->withErrors(['email'=>'Giriş Hatalı!']);
            } 
        }
        return view('yonetim.oturumac');
   }
   public function oturumukapat(){
      //yönetimle ilgili giriş yapılan yer auth::guard yeri
        Auth::guard('yonetim')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.oturumac');
   }

   public function index(){
         //veritabanındaki tüm kullanıcıları çekeceğiz.paginate->sayfalama işlemmi yapıyoruz.
        $list=Kullanici::orderByDesc('olusturulma_tarihi')->paginate(8);
        return view('yonetim.kullanici.index',compact('list'));
   }
   public function form($id=0)
    {
     $gelen=new Kullanici;
     if($id>0){
        $gelen=Kullanici::find($id); 
     }
     return view('yonetim.kullanici.form',compact('gelen'));

   }
   public function kaydet($id=0){
     //id degeri 0 geldiyse kayıt ekleyecektir.
        $this->validate(request(),[
           'adsoyad'=>'required',
           'email'=> 'required|email'
        ]);
        $data=request()->only('adsoyad','email');

        //filled fonku belirlenen bir alanın dolu olup olmadığını kontrol eder
        if(request()->filled('sifre'))
        {
            //şifre alanında dolu olduğunu belirtiriz
            $data['sifre']=Hash::make(request('sifre'));
        }
        //has bir alanın(checkbox alanları gibi) doldurulup doldurulmadığını kontrol eder
        $data['aktif_mi']=request()->has('aktif_mi') ? 1: 0; 
        $data['yonetici_mi']=request()->has('yonetici_mi') ? 1: 0; 


        //dogrulama işi başarılı bir şekilde gerçekleşirse
        if($id>0){
            //guncelle
            $gelen=Kullanici::where('id',$id)->firstOrFail();
            $gelen=update($data);
        }else{
            //kaydet
            $gelen=Kullanici::create($data);
        }

        return redirect()
        ->route('yonetim.kullanici.duzenle' ,$gelen->id)
        ->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi' ))
        ->with('mesaj_tur','success'); 
   }
}

