<?php

/**
 * Article form.
 *
 * @package    shopping_cart
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: ArticleForm.class.php 23 2011-08-10 12:37:59Z sriedel $
 */
class ArticleForm extends BaseArticleForm {

    public function configure() {

        $years = range(date('Y') - 18, date('Y') - 98);
        $years_list = array_combine($years, $years);

        $termin_years = range(date('Y'), date('Y') + 2);
        $termin_years_list = array_combine($termin_years, $termin_years);

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'tarif_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarif'), 'add_empty' => false), array('class' => 'option')),
            'laufzeit_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Laufzeit'), 'add_empty' => false), array('class' => 'option')),
            'guthaben_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Guthaben'), 'add_empty' => false), array('class' => 'option')),
            'modem_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modem'), 'add_empty' => false), array('class' => 'option')),
            'portierung_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Portierung'), 'add_empty' => false), array('class' => 'option')),
            'ip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ip'), 'add_empty' => false), array('class' => 'option')),
            'fp' => new sfWidgetFormInputCheckbox(),
            'upl' => new sfWidgetFormInputCheckbox(),
            //'service' => new sfWidgetFormInputCheckbox(array(), array('value' => 1)),
            'service' => new sfWidgetFormChoice(array(
                'multiple' => false,
                'choices' => array('Nein', 'Ja + 79.- einmalig'),
                'expanded' => false,
            )),
            'kdnr' => new sfWidgetFormInputText(array('label' => 'Kundennummer')),
            'titel' => new sfWidgetFormChoice(array(
                'multiple' => false,
                'choices' => array('Herr' => 'Herr', 'Herr Dr.' => 'Herr Dr.', 'Frau' => 'Frau', 'Frau Dr.' => 'Frau Dr.'),
                'expanded' => false,
            )),
            'name' => new sfWidgetFormInputText(),
            'vorname' => new sfWidgetFormInputText(),
            'gebdat' => new sfWidgetFormDate(array(
                'years' => $years_list,
                'label' => 'Geburtsdatum',
                'format' => '%day% %month% %year%'
            )),
            'termin' => new sfWidgetFormDate(array(
                'label' => 'Terminwunsch',
                'format' => '%day% %month% %year%',
                'years' => $termin_years_list
            )),
            'strasse' => new sfWidgetFormInputText(array('label' => 'Straße')),
            'hnr' => new sfWidgetFormInputText(array('label' => 'Hausnummer'), array('size' => 1)),
            'adr_zusatz' => new sfWidgetFormInputText(array('label' => 'Adress Zusatz')),
            'plz' => new sfWidgetFormInputText(),
            'ort' => new sfWidgetFormInputText(),
            'kto' => new sfWidgetFormInputText(array('label' => 'Kontonummer')),
            'blz' => new sfWidgetFormInputText(array('label' => 'Bankleitzahl')),
            'vorwahl' => new sfWidgetFormInputText(),
            'rfn' => new sfWidgetFormInputText(array('label' => 'Rufnummer')),
            'fax' => new sfWidgetFormInputText(),
            'mail' => new sfWidgetFormInputText(array('label' => 'E-Mail-Adresse')),
            'bestellt' => new sfWidgetFormInputCheckbox(array(), array('value' => 1)),
            'feld1' => new sfWidgetFormInputText(),
            'feld2' => new sfWidgetFormInputText(),
            'feld3' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'tarif_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tarif'), 'required' => true), array('required' => 'Bitte wählen Sie einen Tarif aus!')),
            'laufzeit_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Laufzeit'), 'required' => true), array('required' => 'Bitte wählen Sie eine Laufzeit aus!')),
            'guthaben_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Guthaben'), 'required' => false), array('required' => 'Bitte wählen Sie Guthaben aus!')),
            'modem_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modem'), 'required' => true), array('required' => 'Bitte wählen Sie ein Modem aus!')),
            'portierung_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Portierung'), 'required' => false), array('required' => 'Portierung ja oder nein!')),
            'ip_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ip'), 'required' => true), array('required' => 'Bitte wählen Sie aus, ob eine feste IP Adresse gewünscht ist!')),
            'termin' => new sfValidatorDate(array('required' => true, 'min' => strtotime("+14 day"), 'date_format_range_error' => 'd.m.Y'), array('required' => 'Bitte geben Sie einen Termin an.', 'bad_format' => '"%value%" ist nicht im richtigem Format: %date_format%.', 'max' => 'Maximal gültiges Datum ist: %max%', 'min' => 'Mindestens gültiges Datum ist: %min%')),
            'fp' => new sfValidatorPass(array('required' => false)),
            'upl' => new sfValidatorPass(array('required' => false)),
            'service' => new sfValidatorPass(array('required' => false)),
            'kdnr' => new sfValidatorString(array('max_length' => 255, 'required' => true), array('required' => 'Bitte geben Sie eine Kundennummer an!')),
            'titel' => new sfValidatorString(array('max_length' => 15, 'required' => true), array('required' => 'Bitte geben Sie eine Anrede an!')),
            'name' => new sfValidatorString(array('max_length' => 50, 'required' => true), array('required' => 'Bitte geben Sie einen Namen ein!')),
            'vorname' => new sfValidatorString(array('max_length' => 50, 'required' => true), array('required' => 'Bitte geben Sie den Vornamen ein!')),
            'gebdat' => new sfValidatorDate(array('required' => true), array('required' => 'Bitte geben Sie das Geburtsdatum an!')),
            'strasse' => new sfValidatorString(array('max_length' => 200, 'required' => true), array('required' => 'Bitte geben Sie die Straße an!', 'max_length' => 'Der Straßenname ist zu lang. Bitte nicht mehr als %max_length% Zeichen.')),
            'adr_zusatz' => new sfValidatorString(array('max_length' => 200, 'required' => false), array('max_length' => 'Adresszusatz ist zu lang. Bitte nicht mehr als %max_length% Zeichen.')),
            'hnr' => new sfValidatorString(array('max_length' => 25, 'required' => true), array('required' => 'Die Hausnummer bitte nicht vergessen.', 'max_length' => 'Die Hausnummer ist zu lang. Bitte nicht mehr als %max_length% Zeichen benutzen.')),
            'plz' => new sfValidatorString(array('max_length' => 5, 'min_length' => 5, 'required' => true), array('required' => 'Bitte geben Sie eine PLZ an.', 'max_length' => 'Eine PLZ hat %max_length% Zeichen', 'min_length' => 'Eine PLZ hat %min_length% Zeichen')),
            'ort' => new sfValidatorString(array('max_length' => 200, 'required' => true), array('required' => 'Bitte geben Sie einen Ort an.', 'max_length' => 'Der Ortsname ist zu lang. Bitte nicht mehr als %max_length% Zeichen benutzen.')),
            'kto' => new sfValidatorInteger(array('required' => true), array('invalid' => '%value% ist keine Zahl.', 'required' => 'Bitte geben Sie eine Kontonummer an!')),
            'blz' => new sfValidatorInteger(array('required' => true), array('invalid' => '%value% ist keine Zahl.', 'required' => 'Bitte geben Sie eine Bankleitzahl an!')),
            'vorwahl' => new sfValidatorPass(array('required' => true), array('required' => 'Bitte geben Sie eine Vorwahl an!')),
            'rfn' => new sfValidatorPass(array('required' => true), array('required' => 'Bitte geben Sie eine Rufnummer an!')),
            'fax' => new sfValidatorPass(array('required' => false)),
            'mail' => new sfValidatorEmail(array('required' => true), array('required' => 'Bitte geben Sie eine E-Mail Adresse an!')),
            'bestellt' => new sfValidatorPass(array('required' => false)),
            'feld1' => new sfValidatorPass(array('required' => false)),
            'feld2' => new sfValidatorPass(array('required' => false)),
            'feld3' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));
        $this->useFields(array('kdnr', 'titel', 'name', 'vorname', 'gebdat', 'strasse', 'hnr', 'adr_zusatz', 'plz', 'ort', 'kto', 'blz', 'vorwahl', 'rfn', 'fax', 'mail', 'termin', 'tarif_id', 'laufzeit_id', 'portierung_id', 'guthaben_id', 'modem_id', 'ip_id', 'service', 'feld1', 'feld2', 'feld3', 'bestellt'));

        $this->widgetSchema->setNameFormat('article[%s]');
    }

}
