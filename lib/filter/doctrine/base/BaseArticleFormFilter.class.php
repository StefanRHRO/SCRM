<?php

/**
 * Article filter form base class.
 *
 * @package    shopping_cart
 * @subpackage filter
 * @author     Stefan Riedel
 * @version    SVN: $Id: BaseArticleFormFilter.class.php 13 2011-07-29 06:30:00Z sriedel $
 */
abstract class BaseArticleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fp'            => new sfWidgetFormFilterInput(),
      'upl'           => new sfWidgetFormFilterInput(),
      'service'       => new sfWidgetFormFilterInput(),
      'kdnr'          => new sfWidgetFormFilterInput(),
      'titel'         => new sfWidgetFormFilterInput(),
      'name'          => new sfWidgetFormFilterInput(),
      'vorname'       => new sfWidgetFormFilterInput(),
      'gebdat'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'strasse'       => new sfWidgetFormFilterInput(),
      'plz'           => new sfWidgetFormFilterInput(),
      'ort'           => new sfWidgetFormFilterInput(),
      'kto'           => new sfWidgetFormFilterInput(),
      'blz'           => new sfWidgetFormFilterInput(),
      'vorwahl'       => new sfWidgetFormFilterInput(),
      'rfn'           => new sfWidgetFormFilterInput(),
      'fax'           => new sfWidgetFormFilterInput(),
      'mail'          => new sfWidgetFormFilterInput(),
      'bestellt'      => new sfWidgetFormFilterInput(),
      'termin'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'feld1'         => new sfWidgetFormFilterInput(),
      'feld2'         => new sfWidgetFormFilterInput(),
      'feld3'         => new sfWidgetFormFilterInput(),
      'tarif_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarif'), 'add_empty' => true)),
      'laufzeit_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Laufzeit'), 'add_empty' => true)),
      'guthaben_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Guthaben'), 'add_empty' => true)),
      'modem_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modem'), 'add_empty' => true)),
      'portierung_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Portierung'), 'add_empty' => true)),
      'ip_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ip'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'version'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fp'            => new sfValidatorPass(array('required' => false)),
      'upl'           => new sfValidatorPass(array('required' => false)),
      'service'       => new sfValidatorPass(array('required' => false)),
      'kdnr'          => new sfValidatorPass(array('required' => false)),
      'titel'         => new sfValidatorPass(array('required' => false)),
      'name'          => new sfValidatorPass(array('required' => false)),
      'vorname'       => new sfValidatorPass(array('required' => false)),
      'gebdat'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'strasse'       => new sfValidatorPass(array('required' => false)),
      'plz'           => new sfValidatorPass(array('required' => false)),
      'ort'           => new sfValidatorPass(array('required' => false)),
      'kto'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'blz'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vorwahl'       => new sfValidatorPass(array('required' => false)),
      'rfn'           => new sfValidatorPass(array('required' => false)),
      'fax'           => new sfValidatorPass(array('required' => false)),
      'mail'          => new sfValidatorPass(array('required' => false)),
      'bestellt'      => new sfValidatorPass(array('required' => false)),
      'termin'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'feld1'         => new sfValidatorPass(array('required' => false)),
      'feld2'         => new sfValidatorPass(array('required' => false)),
      'feld3'         => new sfValidatorPass(array('required' => false)),
      'tarif_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tarif'), 'column' => 'id')),
      'laufzeit_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Laufzeit'), 'column' => 'id')),
      'guthaben_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Guthaben'), 'column' => 'id')),
      'modem_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Modem'), 'column' => 'id')),
      'portierung_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Portierung'), 'column' => 'id')),
      'ip_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ip'), 'column' => 'id')),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('article_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Article';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'fp'            => 'Text',
      'upl'           => 'Text',
      'service'       => 'Text',
      'kdnr'          => 'Text',
      'titel'         => 'Text',
      'name'          => 'Text',
      'vorname'       => 'Text',
      'gebdat'        => 'Date',
      'strasse'       => 'Text',
      'plz'           => 'Text',
      'ort'           => 'Text',
      'kto'           => 'Number',
      'blz'           => 'Number',
      'vorwahl'       => 'Text',
      'rfn'           => 'Text',
      'fax'           => 'Text',
      'mail'          => 'Text',
      'bestellt'      => 'Text',
      'termin'        => 'Date',
      'feld1'         => 'Text',
      'feld2'         => 'Text',
      'feld3'         => 'Text',
      'tarif_id'      => 'ForeignKey',
      'laufzeit_id'   => 'ForeignKey',
      'guthaben_id'   => 'ForeignKey',
      'modem_id'      => 'ForeignKey',
      'portierung_id' => 'ForeignKey',
      'ip_id'         => 'ForeignKey',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'version'       => 'Number',
    );
  }
}
