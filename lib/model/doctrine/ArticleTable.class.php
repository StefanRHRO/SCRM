<?php

/**
 * ArticleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ArticleTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ArticleTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Article');
    }

    public function getArticlesNichtBestelltQuery() {
        $query = $this->getArticlesQuery();
        $query->addWhere('a.bestellt = ? OR a.bestellt IS NULL', 0);
        return $query;
    }

    public function getArticlesQuery() {
        return Doctrine_Query::create()
                        ->from('Article a')->where('a.deleted_at IS NULL');
    }

}