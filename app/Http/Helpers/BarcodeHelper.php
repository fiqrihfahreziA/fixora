// app/Helpers/BarcodeHelper.php
<?php

namespace App\Helpers;

class BarcodeHelper
{
    public static function generateBarcode($text)
    {
        $code = '';
        $chars = ['0','1','2','3','4','5','6','7','8','9'];
        
        // Simple barcode generator (Code 128)
        // Atau bisa pake library native:
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_128);
        
        return 'data:image/png;base64,' . base64_encode($barcode);
    }
}