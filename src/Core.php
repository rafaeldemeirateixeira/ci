<?php

namespace RasTeixeira;

use thiagoalessio\TesseractOCR\TesseractOCR;

/**
 * Core
 */
class Core
{
    /**
     * Retorna a versão do TesseractOCR
     *
     * @return string
     */
    public function version()
    {
        return (new TesseractOCR())->version();
    }

    /**
     * Retorna o texto da imagem
     *
     * @param string $path
     * @return string
     */
    public function imageText(string $path)
    {
        $ocr = new TesseractOCR();
        $ocr->image($path);
        
        return $ocr->run();
    }
}
