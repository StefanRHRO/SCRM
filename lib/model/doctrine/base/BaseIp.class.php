<?php

/**
 * BaseIp
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $beschreibung
 * @property float $kosten
 * @property integer $zahlintervall_id
 * @property Zahlintervall $Zahlintervall
 * @property Doctrine_Collection $Articles
 * 
 * @method string              getName()             Returns the current record's "name" value
 * @method string              getBeschreibung()     Returns the current record's "beschreibung" value
 * @method float               getKosten()           Returns the current record's "kosten" value
 * @method integer             getZahlintervallId()  Returns the current record's "zahlintervall_id" value
 * @method Zahlintervall       getZahlintervall()    Returns the current record's "Zahlintervall" value
 * @method Doctrine_Collection getArticles()         Returns the current record's "Articles" collection
 * @method Ip                  setName()             Sets the current record's "name" value
 * @method Ip                  setBeschreibung()     Sets the current record's "beschreibung" value
 * @method Ip                  setKosten()           Sets the current record's "kosten" value
 * @method Ip                  setZahlintervallId()  Sets the current record's "zahlintervall_id" value
 * @method Ip                  setZahlintervall()    Sets the current record's "Zahlintervall" value
 * @method Ip                  setArticles()         Sets the current record's "Articles" collection
 * 
 * @package    shopping_cart
 * @subpackage model
 * @author     Stefan Riedel
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIp extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ip');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('beschreibung', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('kosten', 'float', null, array(
             'type' => 'float',
             'notnull' => true,
             'unsigned' => true,
             ));
        $this->hasColumn('zahlintervall_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Zahlintervall', array(
             'local' => 'zahlintervall_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Article as Articles', array(
             'local' => 'id',
             'foreign' => 'ip_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}