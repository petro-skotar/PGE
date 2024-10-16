<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Mediateka;
use Smalot\PdfParser\Parser;

class GetTextFromFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	
	public $timeout = 600;
	
	protected $id;
	
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
	
    public function handle()
    {
		$Mediateka = Mediateka::find($this->id);
        if($Mediateka->filetype == 'pdf' && !empty($Mediateka->filepath)){
			$Mediateka->file_text = 'BigFile';
			$Mediateka->save();
			$pdfParser = new Parser();
			$pdf = $pdfParser->parseFile(storage_path('app/public/'.$Mediateka->filepath));
			$content = mb_convert_encoding($pdf->getText(),'utf-8');
			$content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $content);  
			$content = iconv('utf-8', 'utf-8//ignore', $content); 
			$content = preg_replace('/[^\pL\pN\pP\pS\pZ]/u', '', $content); 
			if (empty($content)) $content = 'no';
			$Mediateka->file_text = $content;			
			$Mediateka->save();
		}
		
    }
}
