<?php

/**
 * ArticleVersion filter form base class.
 *
 * @package    shopping_cart
 * @subpackage filter
 * @author     Stefan Riedel
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticleVersionFormFilter extends BaseFormFilterDoctrine
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
      'tarif_id'      => new sfWidgetFormFilterInput(),
      'laufzeit_id'   => new sfWidgetFormFilterInput(),
      'guthaben_id'   => new sfWidgetFormFilterInput(),
      'modem_id'      => new sfWidgetFormFilterInput(),
      'portierung_id' => new sfWidgetFormFilterInput(),
      'ip_id'         => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
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
      'tarif_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'laufzeit_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'guthaben_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modem_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'portierung_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('article_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleVersion';
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
      'tarif_id'      => 'Number',
      'laufzeit_id'   => 'Number',
      'guthaben_id'   => 'Number',
      'modem_id'      => 'Number',
      'portierung_id' => 'Number',
      'ip_id'         => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'version'       => 'Number',
    );
  }
}
