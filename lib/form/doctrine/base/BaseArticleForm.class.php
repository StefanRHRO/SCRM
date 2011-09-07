<?php

/**
 * Article form base class.
 *
 * @method Article getObject() Returns the current form's model object
 *
 * @package    shopping_cart
 * @subpackage form
 * @author     Stefan Riedel
 * @version    SVN: $Id: BaseArticleForm.class.php 13 2011-07-29 06:30:00Z sriedel $
 */
abstract class BaseArticleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fp'            => new sfWidgetFormInputText(),
      'upl'           => new sfWidgetFormInputText(),
      'service'       => new sfWidgetFormInputText(),
      'kdnr'          => new sfWidgetFormInputText(),
      'titel'         => new sfWidgetFormInputText(),
      'name'          => new sfWidgetFormInputText(),
      'vorname'       => new sfWidgetFormInputText(),
      'gebdat'        => new sfWidgetFormDate(),
      'strasse'       => new sfWidgetFormInputText(),
      'plz'           => new sfWidgetFormInputText(),
      'ort'           => new sfWidgetFormInputText(),
      'kto'           => new sfWidgetFormInputText(),
      'blz'           => new sfWidgetFormInputText(),
      'vorwahl'       => new sfWidgetFormInputText(),
      'rfn'           => new sfWidgetFormInputText(),
      'fax'           => new sfWidgetFormInputText(),
      'mail'          => new sfWidgetFormInputText(),
      'bestellt'      => new sfWidgetFormInputText(),
      'termin'        => new sfWidgetFormDate(),
      'feld1'         => new sfWidgetFormInputText(),
      'feld2'         => new sfWidgetFormInputText(),
      'feld3'         => new sfWidgetFormInputText(),
      'tarif_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarif'), 'add_empty' => true)),
      'laufzeit_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Laufzeit'), 'add_empty' => true)),
      'guthaben_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Guthaben'), 'add_empty' => true)),
      'modem_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modem'), 'add_empty' => true)),
      'portierung_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Portierung'), 'add_empty' => true)),
      'ip_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ip'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'version'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fp'            => new sfValidatorPass(array('required' => false)),
      'upl'           => new sfValidatorPass(array('required' => false)),
      'service'       => new sfValidatorPass(array('required' => false)),
      'kdnr'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'titel'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'vorname'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'gebdat'        => new sfValidatorDate(array('required' => false)),
      'strasse'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'plz'           => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'ort'           => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'kto'           => new sfValidatorInteger(array('required' => false)),
      'blz'           => new sfValidatorInteger(array('required' => false)),
      'vorwahl'       => new sfValidatorPass(array('required' => false)),
      'rfn'           => new sfValidatorPass(array('required' => false)),
      'fax'           => new sfValidatorPass(array('required' => false)),
      'mail'          => new sfValidatorPass(array('required' => false)),
      'bestellt'      => new sfValidatorPass(array('required' => false)),
      'termin'        => new sfValidatorDate(array('required' => false)),
      'feld1'         => new sfValidatorPass(array('required' => false)),
      'feld2'         => new sfValidatorPass(array('required' => false)),
      'feld3'         => new sfValidatorPass(array('required' => false)),
      'tarif_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tarif'), 'required' => false)),
      'laufzeit_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Laufzeit'), 'required' => false)),
      'guthaben_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Guthaben'), 'required' => false)),
      'modem_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modem'), 'required' => false)),
      'portierung_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Portierung'), 'required' => false)),
      'ip_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ip'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'version'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Article';
  }

}
