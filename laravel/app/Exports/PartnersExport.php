<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Article;

class PartnersExport implements FromView
{
    public function view(): View
    {
		$articles = Article::where('active','1')->where('module','partners')->where('domen',\DATA::domen())->orderBy('position','desc')->get();
		return view('admin.partners.export', [
            'articles' => $articles,
        ]);
    }
}
