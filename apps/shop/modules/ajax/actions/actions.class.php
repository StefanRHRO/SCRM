<?php

/**
 * ajax actions.
 *
 * @package    shopping_cart
 * @subpackage ajax
 * @author     Stefan Riedel
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajaxActions extends sfActions {

    public function executeGoogleMap(sfWebRequest $request) {
        $q = $request->getGetParameter('q').',Deutschland';
        $url = 'http://maps.google.com/maps/geo';
        $r = new Zend_Http_Client($url);
        $r->setParameterGet('q', $q);
        $r->setParameterGet('output', 'json');
        $r->setParameterGet('oe', 'utf8');
        $r->setParameterGet('sensor', 'true_or_false');
        $r->setParameterGet('key', 'ABQIAAAAs5o-XpMhY8beOxTY9F56VBRxEpo8WKRrT0gTbU_tY9wXSyUPkBSfsYzp3URejBDJein8rjIdmSBTSg');
        $response = $r->request(Zend_Http_Client::GET);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText($response->getBody());
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('default', 'module');
    }

}
