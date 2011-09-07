<?php

/**
 * article actions.
 *
 * @package    shopping_cart
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 24 2011-08-10 20:26:58Z sriedel $
 */
class articleActions extends sfActions {

    public function executeOptions(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
            $table = ucfirst($request->getGetParameter('table'));
            $id = $request->getGetParameter('id');
            $data = Doctrine::getTable($table)->findWithZahlintervall($id)->toArray(true);
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            return $this->renderText(json_encode($data));
        }
    }

    public function prepareInlinePdf($outFilename, $buffer) {

        /*header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Content-Length: ' . $this->bufferlen);
        header('Content-Disposition: inline; filename="' . basename($name) . '";');*/

        $response = $this->getContext()->getResponse();
        $response->clearHttpHeaders();
        $response->addCacheControlHttpHeader('Cache-control', 'public, must-revalidate, max-age=0');
        $response->setContentType('application/pdf', TRUE);
        $response->setHttpHeader('Pragma', 'public');
        $response->setHttpHeader('Last-Modified', 'Sat, 26 Jul 1997 05:00:00 GMT');
        $response->setHttpHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        //$response->setHttpHeader('Content-Transfer-Encoding', 'binary', TRUE);
        $response->setHttpHeader('Content-Length', strlen($buffer));
        $response->setHttpHeader('Content-Disposition', 'inline; filename=' . $outFilename, TRUE);
        $response->sendHttpHeaders();
    }

    public function executeDownload() {
        $this->prepareInlinePdf('foo.txt');
        readfile($url);
        return sfView::HEADER_ONLY;
    }

    public function executeExport(sfWebRequest $request) {
        $this->forward404Unless($article = $this->article = Doctrine_Core::getTable('Article')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
        $this->vertrag = new VertragPdf($article);
        $this->vertrag->fill();
        $content = $this->vertrag->render();
        $this->prepareInlinePdf('vertrag.pdf', $content);
        echo $content;
        return sfView::HEADER_ONLY;
    }

    public function executeImport(sfWebRequest $request) {
        $this->form = new ImportForm();
    }

    public function executeDoImport(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ImportForm();

        $this->processImport($request, $this->form);

        $this->setTemplate('import');
    }

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        $this->articles = Doctrine::getTable('Article');
        $this->pager = new sfDoctrinePager(
                        'Article',
                        sfConfig::get('app_max_articles')
        );
        if ($user->isSuperAdmin()) {
            $query = $this->articles->getArticlesQuery();
        } else {
            $query = $this->articles->getArticlesNichtBestelltQuery();
        }

        $this->pager->setQuery($query);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->articles = $this->pager->getResults();
    }

    public function executeShow(sfWebRequest $request) {
        $this->article = Doctrine_Core::getTable('Article')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->article);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new ArticleForm();
        $this->article = Doctrine_Core::getTable('Article')->create();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ArticleForm();
        $this->article = Doctrine_Core::getTable('Article')->create();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($article = $this->article = Doctrine_Core::getTable('Article')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArticleForm($article);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($article = $this->article = Doctrine_Core::getTable('Article')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArticleForm($article);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($article = Doctrine_Core::getTable('Article')->find(array($request->getParameter('id'))), sprintf('Object article does not exist (%s).', $request->getParameter('id')));
        $article->delete();

        $this->redirect('article/index');
    }

    protected function processImport(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getPostParameters(), $request->getFiles());
        if ($form->isValid()) {
            $file = $this->form->getValue('file');
            $file->save();
            $fp = fopen($file->getSavedName(), 'r');
            $felder = array(
                'portierung',
                'ip', 'fp', 'upl', 'service', 'kdnr', 'titel', 'name',
                'vorname', 'gebdat', 'strasse', 'plz', 'ort', 'kto', 'blz',
                'vorwahl', 'rfn', 'fax', 'mail', 'bestellt', 'feld1',
                'feld2', 'feld3'
            );
            $this->cnt_import = 0;
            while ($data = fgetcsv($fp, 10000, ';')) {
                $bind = array();
                $int_form = new Article();
                foreach ($felder as $key => $feld) {

                    $int_form->{$feld} = $data[$key];
                }
                try {
                    $int_form->save();
                    $this->cnt_import++;
                } catch (Exception $e) {
                    throw $e;
                }
            }
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $article = $form->save();

            $this->redirect('article/edit?id=' . $article->getId());
        }
    }

}
