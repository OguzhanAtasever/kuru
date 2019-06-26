<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\KategoriRepositoryInterface;

class KategoriController extends Controller
{
    private  $kategoriRepository;

    public function __construct(KategoriRepositoryInterface $kategoriRepository) {
        $this->kategoriRepository = $kategoriRepository;

    }

    public function kategoriler()
    {
        return response()->json($this->kategoriRepository->hepsi());
    }
}
