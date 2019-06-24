<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urun;
use App\Models\UrunDetay;
use App\Models\Kategori;

class UrunController extends Controller
{
        public function index(){
                //index içinde aramayla ilgili gelen bir deger varsa
                if(request()->filled('aranan'))
                {
                //arama yapıldıktan sonra textte aranan degerin kalması sağlanır.(flash ile)
                request()->flash();
                $aranan=request('aranan');
                //aranan degere göre liste filtreleme
                $list=Urun::where('urun_adi', 'like',"%$aranan%")
                    ->orWhere('aciklama','like' ,"%$aranan%")
                    ->orderByDesc('id')
                    ->paginate(8)
                    ->appends('aranan',$aranan);
                } else{
                        //veritabanındaki tüm kullanıcıları çekeceğiz.paginate->sayfalama işlemi yapıyoruz.
                        $list=Urun::orderByDesc('id')->paginate(8);
                }
                return view('yonetim.urun.index',compact('list'));
        }
        public function form($id=0) {
            //id degeri her zaman gönderilmeyeceği için default bir deger için 0 varsayılacaktır.
            //id gelmediğinde boş bir kullanıcı olarak görünecektir.
            $gelen=new Urun;
            $urun_kategorileri=[];
            if($id>0){
                //veritabanından çekme işlemi
                $gelen=Urun::find($id); 

                //sadece idleri cekeceğimiz zaman pluck komutunu kullanabiliriz
                //pluck bir tablodan belirli kolonu almaya yarar
                $urun_kategorileri=$gelen->kategoriler()->pluck('kategori_id')->all();
              }
                $kategoriler=Kategori::all();
                $detay = new UrunDetay;
                $detay->urun_id = $gelen->id;
            return view('yonetim.urun.form' , compact('gelen','detay','kategoriler','urun_kategorileri'));

        }
        public function kaydet($id=0){
            //id degeri 0 olarak geldiyse yeni bir kayıt eklicek

                    //üst id boş olarak geldiğinde otomtik olarak null deger olarak eklemektedir.
                    $data=request()->only('urun_adi','slug','aciklama','fiyati');
                    //requestten gelen slug degeri doldurulmamışsa bu degeri otomatik olarak kendimiz oluşturabiliriz.
                    if(!request()->filled('slug')){
                        $data['slug']=str_slug(request('urun_adi'));
                        request()->merge(['slug' => $data['slug']]);
                    }

                        //dogrulama işlemi
                        $this->validate(request(), [
                        'urun_adi'   =>'required',
                        'fiyati'   =>'required',
                        'slug'=> (request('original_slug') != request('slug') ? 'unique:urun,slug' : ' ')
                        ]);
                            
                
                     $data_detay=request()->only('goster_slider','goster_gunun_firsati','goster_one_cikan','goster_cok_satan','goster_indirimli');

                     $kategoriler=request('kategoriler');
                    
                    
                        //dogrulama işi başarılı bir şekilde gerçekleşirse
                        if($id>0){
                            //guncelle
                            //firstorfail ilk degeri alma
                            $gelen=Urun::where('id',$id)->firstOrFail();
                            $gelen->update($data);

                            $gelen->detay()->update($data_detay);
                            //verilen degerleri otomatik olarak senkronize edicek
                            $gelen->kategoriler()->sync($kategoriler);
                        }else{
                            //kaydet
                            $gelen=Urun::create($data);
                            $gelen->detay()->create($data_detay);

                            //yeni kayıt olayının kaydedilme islemi
                            $gelen->kategoriler()->attach($kategoriler);
                        
                        }

                        //urun_resmi adli dosyanın request içine gelip gelmediğini kontrol eder
                        if(request()->hasFile('urun_resmi'))
                        {
                                $this->validate(request(),[
                                    'urun_resmi'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
                                ]);
 
                                $urun_resmi=request()->file('urun_resmi');
                                $urun_resmi=request()->urun_resmi;

                                /*$urun_resmi->extension() ile uzantı çekebiliyoruz*/

                                //bilgisayardan cekecegimiz orjinal dosya adını getclientoriginalname fonk ile
                                //$urun_resmi->getClientOriginalName();

                                //rasgele dosya adı olusturmak icin
                                $dosyaadi=$gelen->id . "-" . time() ."." . $urun_resmi->extension();

                                //sunucu üzerinde dosya adını orjinal olarak  saklamak istersek
                               // $dosyaadi=$urun_resmi->getClientOriginalName();

                               if($urun_resmi->isValid()){

                                 //tek satırda yükleme işlemi yapma 
                                   $urun_resmi->move('uploads/urunler',$dosyaadi);

                                   //varsa güncelle yoksa olustur
                                   UrunDetay::updateOrCreate(
                                       ['urun_id'=>$gelen->id],
                                       ['urun_resmi'=>$dosyaadi]
                                   );
                               }

                        } 
                    return redirect()
                    ->route('yonetim.urun.duzenle' ,$gelen->id)
                    ->with('mesaj',($id>0 ? 'Güncellendi' : 'Kaydedildi' ))
                    ->with('mesaj_tur','success'); 
        }

        public function sil($id){

            //silinecek veriyi veritabanından buluyoruz
            $urun=Urun::find($id);

            //buldugumuz ürünü kategorilerden siliyoruz.
            //many to many yapısında detach ile siliyoruz
            $urun->kategoriler()->detach();

            /*
            ürün detaydanda siliyoruz
            bire bir ilişkili tablolardan siliyoruz
            $urun->detay()->delete();
            */
            
            //ürünün kendisini siliyoruz
            $urun->delete();
            
            Urun::destroy($id);

            return redirect()
            ->route('yonetim.urun')
            ->with('mesaj' ,'Kayıt silindi')
            ->with('mesaj_tur','success');
        }
}
