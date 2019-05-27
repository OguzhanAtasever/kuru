<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KullaniciController extends Controller
{
    public function oturumac(){
    	//gelen istegin degeri post ise bir işlem yapmamızı sağlar->isMethod()
    	if(request()->isMethod('POST')){
    		//email adresini ve şifreyi bos bırakmamayı kontrol edelim
    		$this->validate(request(),[
    			'email'=>'required|email',
    			'sifre'=>'required'
    		]);
            $credentials=[
                'email'=>request()->get('email'),
                'password'=>request()->get('sifre'),
                'yonetici_mi'=>1
            ];
            if(auth()->attempt($credentials,request()->has('benihatirla'))){
            //giriş başarılı ise anasayfaya yönlendir 
                  return redirect()->route('yonetim.anasayfa');
            }else{
                //başarısız ise hata mesajı gönder
                return back()->withInput()->withErrors(['email'=>'Giriş Hatalı!']);
            }
    	}
    	 return view('yonetim.oturumac');
    	}
    }
}
