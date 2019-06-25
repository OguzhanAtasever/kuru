<?php
namespace App\Http\Controllers\Yonetim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siparis;
 
class SiparisController extends Controller
{
        public function index(){
                //index içinde aramayla ilgili gelen bir deger varsa
                if(request()->filled('aranan'))
                {
                //arama yapıldıktan sonra textte aranan degerin kalması sağlanır.(flash ile)
                request()->flash();
                $aranan=request('aranan');
                //aranan degere göre liste filtreleme
                $list=Siparis::with('sepet.kullanici')
                    ->where('adsoyad','like',"%$aranan%")
                    ->orWhere('id',$aranan)
                    ->orderByDesc('id')
                    ->paginate(8)
                    ->appends('aranan',$aranan);
                } else{
                        //veritabanındaki tüm kullanıcıları çekeceğiz.paginate->sayfalama işlemi yapıyoruz.
                        $list=Siparis::orderByDesc('id')->paginate(8);
                }
                return view('yonetim.siparis.index',compact('list'));
        }
        public function form($id=0) {
            if($id>0){
                //veritabanından çekme işlemi
                $gelen=Siparis::with('sepet.sepet_urunler.urun')->find($id); 
              }
            return view('yonetim.siparis.form' , compact('gelen'));
        }
        public function kaydet($id=0){

                        //dogrulama işlemi
                        $this->validate(request(), [
                        'urun_adi'   =>'required',
                        'adres'      =>'required',
                        'telefon'    =>'required',
                        'durum'      =>'required'
                        ]);
                            
                     $data=request()->only('adsoyad','adres','telefon','ceptelefonu','durum');
                    
                        //dogrulama işi başarılı bir şekilde gerçekleşirse
                        if($id>0){
                            //guncelle
                            //firstorfail ilk degeri alma
                            $gelen=Siparis::where('id',$id)->firstOrFail();
                            $gelen->update($data);
                        }
                 
                    return redirect()
                    ->route('yonetim.siparis.duzenle' ,$gelen->id)
                    ->with('mesaj','Güncellendi')
                    ->with('mesaj_tur','success'); 
        }
        public function sil($id){
            //silinecek veriyi veritabanından buluyoruz
            Siparis::destroy($id);
          
            return redirect()
            ->route('yonetim.siparis')
            ->with('mesaj' ,'Kayıt silindi')
            ->with('mesaj_tur','success');
        }
}
