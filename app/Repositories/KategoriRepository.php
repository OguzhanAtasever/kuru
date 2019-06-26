<?php

namespace App\Repositories;

use App\Models\Kategori;
use App\Interfaces\KategoriRepositoryInterface;

class KategoriRepository implements KategoriRepositoryInterface
{
    public function hepsi()
    {
        return Kategori::all();
    }
}
