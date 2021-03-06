<?php

/**
 * GuthabenTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class GuthabenTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object GuthabenTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Guthaben');
    }

    public function getGuthabenForForm()
    {
        $retData = $this->_getGuthaben();
        return $retData;
    }

    protected function _getGuthaben()
    {
        $data = $this->createQuery('a')->execute();
        $retData = array();
        if (!empty($data)) {
            foreach ($data as $value) {
                $retData[$value->getPrimaryKey()] = $value;
            }
        }
        return $retData;
    }

    public function findWithZahlintervall($id)
    {
        $q = Doctrine_Query::create()
                ->from($this->getTableName() . ' x')
                ->leftJoin('x.Zahlintervall z')
                ->where('x.id = ?', $id);
        return $q->fetchOne();
    }
}