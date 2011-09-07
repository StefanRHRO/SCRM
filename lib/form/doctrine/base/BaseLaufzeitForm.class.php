<?php

/**
 * Laufzeit form base class.
 *
 * @method Laufzeit getObject() Returns the current form's model object
 *
 * @package    shopping_cart
 * @subpackage form
 * @author     Stefan Riedel
 * @version    SVN: $Id: BaseLaufzeitForm.class.php 13 2011-07-29 06:30:00Z sriedel $
 */
abstract class BaseLaufzeitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'beschreibung'        => new sfWidgetFormInputText(),
      'kosten'              => new sfWidgetFormInputText(),
      'laufzeit_in_monaten' => new sfWidgetFormInputText(),
      'zahlintervall_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zahlintervall'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255)),
      'beschreibung'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'kosten'              => new sfValidatorNumber(),
      'laufzeit_in_monaten' => new sfValidatorInteger(),
      'zahlintervall_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zahlintervall'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('laufzeit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Laufzeit';
  }

}
