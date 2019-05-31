<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(){
            //index içinde aramayla ilgili gelen bir deger varsa
            if(request()->filled('aranan') || request()->filled('ust_id'))
            {
            //arama yapıldıktan sonra textte aranan degerin kalması sağlanır.(flash ile)
            request()->flash();
            $aranan=request('aranan');
            $ust_id=request('ust_id');
            //aranan degere göre liste filtreleme
            $list=Kategori::with('ust_kategori')
                ->where('kategori_adi', 'like',"%$aranan%")
                ->where('ust_id', $ust_id)
                ->orderByDesc('id')
                ->paginate(2)
                ->appends(['aranan'=>$aranan,'ust_id'=>$ust_id]);
            } else{
                //session içinde gelen input degerlerini sıfırlamış oluyor
                request()->flush();
                    //veritabanındaki tüm kullanıcıları çekeceğiz.paginate->sayfalama işlemi yapıyoruz.
                    $list=Kategori::with('ust_kategori')->orderByDesc('id')->paginate(8);
            }

            $anakategoriler=Kategori::whereRaw('ust_id is null')->get();
            return view('yonetim.kategori.index',compact('list','anakategoriler'));
    }
    public function form($id=0)
        {
        //id degeri her zaman gönderilmeyeceği için default bir deger için 0 varsayılacaktır.
        //id gelmediğinde boş bir kullanıcı olarak görünecektir.
        $gelen=new Kategori;
        if($id>0){
            //veritabanından çekme işlemi
            $gelen=Kategori::find($id); 
        }

        $kategoriler=Kategori::all();
        return view('yonetim.kategori.form',compact('gelen','kategoriler'));

    }

    public function kaydet($id=0){
            //id degeri 0 olarak geldiyse yeni bir kayıt eklicek

            //üst id boş olarak geldiğinde otomtik olarak null deger olarak eklemektedir.
            $data=request()->only('kategori_adi','slug','ust_id');
            //requestten gelen slug degeri doldurulmamışsa bu degeri otomatik olarak kendimiz oluşturabiliriz.
            if(!request()->filled('slug')){
                $data['slug']=str_slug(request('kategori_adi'));
                request()->merge(['slug' => $data['slug']]);
            }

                //dogrulama işlemi
                $this->validate(request(), [
                'kategori_adi'   =>'required',
                'slug'=> (request('original_slug') != request('slug') ? 'unique:kategori,slug' : ' ')
                ]);
            //dogrulama işi başarılı bir şekilde gerçekleşirse
                if($id>0){
                    //guncelle
                    //firstorfail ilk degeri alma
                    $gelen=Kategori::where('id',$id)->firstOrFail();
                    $gelen->update($data);

                }else{
                    //kaydet
                    $gelen=Kategori::create($data);
                }

            return redirect()
            ->route('yonetim.kategori.duzenle' ,$gelen->id)
            ->with('mesaj',($id>0 ? 'Güncellendi' : 'Kaydedildi' ))
            ->with('mesaj_tur','success'); 
    }
    public function sil($id){
        
        //many to many tablolarından veri silmek için attach/detach şeklinde iki komut vardır.
        //attach kayıt eklemeyi sağlar,detach silmeye yarar
        $kategori=Kategori::find($id);
        $kategori->urunler()->detach();
        Kategori::destroy($id);

        return redirect()
            ->route('yonetim.kategori')
            ->with('mesaj' ,'Kayıt silindi')
            ->with('mesaj_tur','success');
    }
}
