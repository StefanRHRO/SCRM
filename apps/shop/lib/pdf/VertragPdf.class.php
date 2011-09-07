<?php

class VertragPdf {

    /**
     * @var Zend_Pdf
     */
    protected $_zendPdf = null;

    /**
     * @var Article
     */
    protected $_article = null;
    protected $_vorlagenPfad = null;

    public function __construct(Article $article, Zend_Pdf $zendPdf = null) {
        $this->_article = $article;
        if (null != $zendPdf) {
            $this->_zendPdf = $zendPdf;
        } else {
            $this->_initZendPdf();
        }
    }

    protected function _initZendPdf() {
        $this->_vorlagenPfad = sfConfig::get('sf_app_dir') . '/data/vorlagen/mddsl_2.pdf';
        $this->_zendPdf = Zend_Pdf::load($this->_vorlagenPfad);
    }

    public function fill() {
        if ($this->_zendPdf instanceof Zend_Pdf) {
            $fontH = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER);
            $template = $this->_zendPdf->pages[0];
            $template->setFont($fontH, 15);

            $y = 677;
            switch ($this->_article->getTitel()) {
                case 'Herr':
                    $x = 70;
                    break;
                case 'Frau':
                    $x = 33;
                    break;
            }
            $x = 33;
            $template->drawText('X', $x, $y, 'UTF-8');

            $y -= 20;
            $template->drawText($this->_article->getName(), $x, $y, 'UTF-8');
            $y -= 77;
            $template->drawText($this->_article->getVorname(), $x, $y, 'UTF-8');
            $y -= 33;
            $template->drawText($this->_article->getStrasse(), $x, $y, 'UTF-8');
            $x += 254;
            $template->drawText($this->_article->getHnr(), $x, $y, 'UTF-8');
            $x = 33;
            $y -= 37;
            $template->drawText($this->_article->getPlz(), $x, $y, 'UTF-8');
            $x += 64;
            $template->drawText($this->_article->getOrt(), $x, $y, 'UTF-8');
            $x = 33;
            $y -= 34;
            $template->drawText($this->_article->getVorwahl() . $this->_article->getRfn(), $x, $y, 'UTF-8');
            $y -= 34;
            $fax = $this->_article->getFax();
            if (!empty($fax)) {
                $template->drawText($this->_article->getFax(), $x, $y, 'UTF-8');
            }
            $y -= 32;
            $template->drawText($this->_article->getMail(), $x, $y, 'UTF-8');

            $y -= 100;
            $template->drawText($this->_article->getName(), $x, $y, 'UTF-8');
            
            $x += 150;
            $template->drawText($this->_article->getVorname(), $x, $y, 'UTF-8');
            
            $x = 33;
            $y -= 33;
            $template->drawText($this->_article->getKto(), $x, $y, 'UTF-8');
            
            $blz = $this->_article->getBlz();
            $oneToThree = substr($blz, 0, 3);
            $x += 148;
            $template->drawText($oneToThree, $x, $y, 'UTF-8');
            
            $fourToSix = substr($blz, 3, 3);
            $x += 35;
            $template->drawText($fourToSix, $x, $y, 'UTF-8');
            
            $sixToEight = substr($blz, 6);
            $x += 35;
            $template->drawText($sixToEight, $x, $y, 'UTF-8');
            
            $tarif = $this->_article->getTarif();
            $x = 331;
            switch ($tarif->getName()) {
                case 'country-9':
                    $y = 667;
                    break;
                case 'country-18':
                    $y = 645;
                    break;
                case 'country-d':
                    $y = 625;
                    break;
                case 'all-net':
                    $y = 480;
                    break;
                case 'speed-d':
                    $y = 500;
                    break;
                case 'up-d':
                    $y = 522;
                    break;
                case 'medium-d':
                    $y = 544;
                    break;
                case 'daily-d':
                    $y = 565;
                    break;
            }
            $template->drawText('X', $x, $y, 'UTF-8');
            $guthaben = $this->_article->getGuthaben();
            if ($guthaben->getName() != 'kein') {
                $y = 403;
                switch ($guthaben->getName()) {
                    case 'euro-499':
                        $x = 378;
                        break;
                    case 'euro-999':
                        $x = 436;
                        break;
                    case 'euro-1999':
                        $x = 480;
                        break;
                    case 'euro-2999':
                        $x = 540;
                        break;
                }
                $template->drawText('X', $x, $y, 'UTF-8');
            }

            $portierung = $this->_article->getPortierung();
            $y = 387;
            switch ($portierung->getName()) {
                case 'neu':
                    $x = 481;
                    break;
                case 'portieren':
                    $x = 332;
                    break;
            }
            $template->drawText('X', $x, $y, 'UTF-8');
            
            $laufzeit = $this->_article->getLaufzeit();
            $y = 275;
            switch($laufzeit->getName()) {
                case 'monate-36':
                    $x = 330;
                    break;
                case 'monate-24':
                    $x = 420;
                    break;
                case 'monate-12':
                    $x = 508;
                    break;
            }
            $template->drawText('X', $x, $y, 'UTF-8');
            
            $modem = $this->_article->getModem();
            $y = 215;
            switch ($modem->getName()) {
                case 'adsl':
                    $x = 331;
                    break;
                case 'vdsl':
                    $x = 455;
                    break;
            }
            $template->drawText('X', $x, $y, 'UTF-8');
        } else {
            throw new ExceptionPdf('Benötige Zend_Pdf Instanz.');
        }
    }

    public function render() {
        return $this->_zendPdf->render();
    }

}