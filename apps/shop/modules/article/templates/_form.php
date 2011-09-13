<?php use_helper('Number', 'jQuery') ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php

$tarifkosten = (null !== $article->tarif_id) ? Doctrine::getTable('Tarif')->find($article->tarif_id)->kosten : 0.00;
$laufzeitkosten = (null !== $article->laufzeit_id) ? Doctrine::getTable('Laufzeit')->find($article->laufzeit_id)->kosten
        : 0.00;
$portierungkosten = (null !== $article->portierung_id)
        ? Doctrine::getTable('Portierung')->find($article->portierung_id)->kosten : 0.00;
$guthabenkosten = (null !== $article->guthaben_id) ? Doctrine::getTable('Guthaben')->find($article->guthaben_id)->kosten
        : 0.00;
$modemkosten = (null !== $article->modem_id) ? Doctrine::getTable('Modem')->find($article->modem_id)->kosten : 0.00;
$ipkosten = (null !== $article->ip_id) ? Doctrine::getTable('Ip')->find($article->ip_id)->kosten : 0.00;

$laufzeit_in_monaten = (null !== $article->laufzeit_id)
        ? Doctrine::getTable('Laufzeit')->find($article->laufzeit_id)->laufzeit_in_monaten : 0;

$servicekosten = (1 == $article->service) ? 79.00 : 0;

?>

<div class="grid_6">
    <?php if ($form->hasErrors()) { ?>
    <div class="notification failure canhide">
        <p><strong>ERROR: </strong>
            Es sind Fehler beim Speichern aufgetreten</p>
    </div>
    <?php } ?>
    <form action="<?php echo url_for('article/' . ($form->getObject()->isNew() ? 'create'
                                             : 'update') . (!$form->getObject()->isNew()
                                             ? '?id=' . $form->getObject()->getId() : '')) ?>"
          method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put"/>
        <?php endif; ?>
        <table>
            <tfoot>
            <tr>
                <td colspan="2">
                    &nbsp;<a href="<?php echo url_for('article/index') ?>">Zurück zur Übersicht</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo link_to('Löschen', 'article/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Sind Sie sicher?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Speichern"/>
                </td>
            </tr>
            </tfoot>
            <tbody>
            <?php echo $form ?>
            </tbody>
        </table>
    </form>
</div>
<div class="grid_6">
    <h5>Kosten</h5>
    <input type="hidden" name="laufzeit_in_monaten" id="laufzeit_in_monaten"
           value="<?php echo $laufzeit_in_monaten ?>"/>
    <table>
        <tr>
            <th></th>
            <th>mntl. Kosten</th>
            <th>einmalige Kosten</th>
            <th>Kosten Gesamt</th>
        </tr>
        <tr>
            <th>Tarifkosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_tarif_id_mntl_hidden"
                       id="article_tarif_id_mntl_hidden"
                       value="<?php echo $tarifkosten ?>"/><span
                    id="article_tarif_id_mntl_text"><?php echo format_currency($tarifkosten, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_tarif_id_einmalig_hidden"
                       id="article_tarif_id_einmalig_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_tarif_id_einmalig_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_tarif_id_gesamt_hidden"
                       id="article_tarif_id_gesamt_hidden"
                       value="<?php echo $tarifkosten_gesamt = $tarifkosten * $laufzeit_in_monaten ?>"/><span
                    id="article_tarif_id_gesamt_text"><?php echo format_currency($tarifkosten_gesamt, '€') ?></span>
            </td>


        </tr>
        <tr>
            <th>Laufzeitkosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_laufzeit_id_mntl_hidden"
                       id="article_laufzeit_id_mntl_hidden"
                       value="<?php echo $laufzeitkosten ?>"/><span
                    id="article_laufzeit_id_mntl_text"><?php echo format_currency($laufzeitkosten, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_laufzeit_id_einmalig_hidden"
                       id="article_laufzeit_id_einmalig_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_laufzeit_id_einmalig_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_laufzeit_id_gesamt_hidden"
                       id="article_laufzeit_id_gesamt_hidden"
                       value="<?php echo $laufzeitkosten_gesamt = $laufzeitkosten * $laufzeit_in_monaten ?>"/><span
                    id="article_laufzeit_id_gesamt_text"><?php echo format_currency($laufzeitkosten_gesamt, '€') ?></span>
            </td>
        </tr>

        <tr>
            <th>Portierungskosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_portierung_id_mntl_hidden"
                       id="article_portierung_id_mntl_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_portierung_id_mntl_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_portierung_id_einmalig_hidden"
                       id="article_portierung_id_einmalig_hidden"
                       value="<?php echo $portierungkosten ?>"/><span
                    id="article_portierung_id_einmalig_text"><?php echo format_currency($portierungkosten, '€') ?></span>
            </td>
            <td><input class="gesamt_werte" type="hidden" name="article_portierung_id_gesamt_hidden"
                       id="article_portierung_id_gesamt_hidden"
                       value="<?php echo $portierungskosten_gesamt = $portierungkosten ?>"/><span
                    id="article_portierung_id_gesamt_text"><?php echo format_currency($portierungkosten, '€') ?></span>
            </td>


        </tr>
        <tr>
            <th>Guthaben</th>
            <td><input class="mntl_werte" type="hidden" name="article_guthaben_id_mntl_hidden"
                       id="article_guthaben_id_mntl_hidden"
                       value="<?php echo $guthabenkosten ?>"/><span
                    id="article_guthaben_id_mntl_text"><?php echo format_currency($guthabenkosten, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_guthaben_id_einmalig_hidden"
                       id="article_guthaben_id_einmalig_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_guthaben_id_einmalig_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_guthaben_id_gesamt_hidden"
                       id="article_guthaben_id_gesamt_hidden"
                       value="<?php echo $guthabenkosten_gesamt = $guthabenkosten * $laufzeit_in_monaten ?>"/><span
                    id="article_guthaben_id_gesamt_text"><?php echo format_currency($guthabenkosten_gesamt, '€') ?></span>
            </td>
        </tr>
        <tr>
            <th>Modemkosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_modem_id_mntl_hidden"
                       id="article_modem_id_mntl_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_modem_id_mntl_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_modem_id_einmalig_hidden"
                       id="article_modem_id_einmalig_hidden"
                       value="<?php echo $modemkosten ?>"/><span
                    id="article_modem_id_einmalig_text"><?php echo format_currency($modemkosten, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_modem_id_gesamt_hidden"
                       id="article_modem_id_gesamt_hidden"
                       value="<?php echo $modemkosten_gesamt = $modemkosten ?>"/><span
                    id="article_modem_id_gesamt_text"><?php echo format_currency($modemkosten, '€') ?></span></td>
        </tr>

        <tr>
            <th>IP-Kosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_ip_id_mntl_hidden" id="article_ip_id_mntl_hidden"
                       value="<?php echo $ipkosten ?>"/><span
                    id="article_ip_id_mntl_text"><?php echo format_currency($ipkosten, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_ip_id_einmalig_hidden"
                       id="article_ip_id_einmalig_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_ip_id_einmalig_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_ip_id_gesamt_hidden"
                       id="article_ip_id_gesamt_hidden"
                       value="<?php echo $ipkosten_gesamt = $ipkosten * $laufzeit_in_monaten ?>"/><span
                    id="article_ip_id_gesamt_text"><?php echo format_currency($ipkosten_gesamt, '€') ?></span></td>
        </tr>

        <tr>
            <th>Servicekosten</th>

            <td><input class="mntl_werte" type="hidden" name="article_service_mntl_hidden"
                       id="article_service_mntl_hidden"
                       value="<?php echo 0 ?>"/><span
                    id="article_service_mntl_text"><?php echo format_currency(0, '€') ?></span></td>
            <td><input class="einmalig_werte" type="hidden" name="article_service_einmalig_hidden"
                       id="article_service_einmalig_hidden"
                       value="<?php echo $servicekosten ?>"/><span
                    id="article_service_einmalig_text"><?php echo format_currency($servicekosten, '€') ?></span></td>
            <td><input class="gesamt_werte" type="hidden" name="article_service_gesamt_hidden"
                       id="article_service_gesamt_hidden"
                       value="<?php echo $servicekosten_gesamt = $servicekosten ?>"/><span
                    id="article_service_gesamt_text"><?php echo format_currency($servicekosten, '€') ?></span></td>
        </tr>

        <tr>
            <th>Gesamtkosten</th>

            <td><input type="hidden" name="gesamt_mntl_hidden" id="gesamt_mntl_hidden"
                       value="<?php echo $gesamtkosten_mntl = $tarifkosten + $laufzeitkosten + $guthabenkosten + $ipkosten ?>"/><span
                    id="gesamt_mntl_text"><?php echo format_currency($gesamtkosten_mntl, '€') ?></span></td>
            <td><input type="hidden" name="gesamt_einmalig_hidden" id="gesamt_einmalig_hidden"
                       value="<?php echo $gesamtkosten_einmalig = $portierungkosten + $modemkosten + $servicekosten ?>"/><span
                    id="gesamt_einmalig_text"><?php echo format_currency($gesamtkosten_einmalig, '€') ?></span></td>
            <td><input type="hidden" name="gesamt_gesamt_hidden" id="gesamt_gesamt_hidden"
                       value="<?php echo $gesamtkosten_gesamt = $tarifkosten_gesamt + $laufzeitkosten_gesamt + $guthabenkosten_gesamt + $ipkosten_gesamt + $portierungskosten_gesamt + $modemkosten_gesamt + $servicekosten_gesamt ?>"/><span
                    id="gesamt_gesamt_text"><?php echo format_currency($gesamtkosten_gesamt, '€') ?></span></td>


        </tr>
    </table>
</div>
<div class="clear"></div>
<?php
    
    $refresh_image_path = image_path('icons/arrow_refresh_small');

    $url = url_for('article/options');
    $googleMapUrl = url_for('ajax/GoogleMap');
$result = <<<JS

        /**
        * @todo refaktorieren!!1!
*/
    
    
    var refresh_ort_image = $('<img/>', {
        src: '{$refresh_image_path}',
        width: 16,
        height: 16,
        title: 'Ort erfassen',
        alt: 'Ort erfassen'
    }).click(function(){
        var strasse = $('#article_strasse');
        var hnr = $('#article_hnr');
        var plz = $('#article_plz');
        var ort = $('#article_ort');
        var q = strasse.val() + ' ' + hnr.val() + ',' + plz.val();
    
        var data = {
            q: q,
        }
    
        $.ajax({
            url: '{$googleMapUrl}',
            data: data,
            dataType: 'json',
            success: function(r) {
                var country = r.Placemark[0].AddressDetails.Country;
                var city = country.AdministrativeArea.SubAdministrativeArea.Locality.LocalityName;
                var postalcode = country.AdministrativeArea.SubAdministrativeArea.Locality.DependentLocality.PostalCode
                
                if (country.CountryNameCode == 'DE' && city.length>0 && postalcode.PostalCodeNumber == plz.val()) {
                    ort.val(city);
                } else {
                    alert('Konnte keinen Ort finden!');
                }
            }
        });
    });
        
        
    $('#article_plz').after(refresh_ort_image);
    
        $('#article_service').change(function(){
            var id = $(this).attr('id');
            var kosten_mntl = $('#' + id + '_mntl_text');
            var kosten_mntl_hidden = $('#' + id + '_mntl_hidden');
            var kosten_einmalig = $('#' + id + '_einmalig_text');
            var kosten_einmalig_hidden = $('#+' + id + '_einmalig_hidden');
            var kosten_gesamt = $('#' + id + '_gesamt_text');
            var kosten_gesamt_hidden = $('#' + id + '_gesamt_hidden');

            var gesamt_mntl = $('#gesamt_mntl_text');
            var gesamt_mntl_hidden = $('gesamt_mntl_hidden');
            var gesamt_einmalig = $('#gesamt_einmalig_text');
            var gesamt_einmalig_hidden = $('gesamt_einmalig_hidden');
            var gesamt_gesamt = $('#gesamt_gesamt_text');
            var gesamt_gesamt_hidden = $('gesamt_gesamt_hidden');

            var status = $(this).is(':checked');
            if(status == true) {
                kosten_mntl.text($.formatNumber(0, {locale:"de", format:'##0.00 €'}));
                        kosten_mntl_hidden.val(0);
                        kosten_einmalig.text($.formatNumber(79, {locale:"de", format:'##0.00 €'}));
                        kosten_einmalig_hidden.val(79);
                        kosten_gesamt.text($.formatNumber(79, {locale:"de", format:'##0.00 €'}));
                        kosten_gesamt_hidden.val(79);
            }
            else {
                kosten_mntl.text($.formatNumber(0, {locale:"de", format:'##0.00 €'}));
                        kosten_mntl_hidden.val(0);
                        kosten_einmalig.text($.formatNumber(0, {locale:"de", format:'##0.00 €'}));
                        kosten_einmalig_hidden.val(0);
                        kosten_gesamt.text($.formatNumber(0, {locale:"de", format:'##0.00 €'}));
                        kosten_gesamt_hidden.val(0);
            }
            mntl_gesamt = 0;

                        $('input.mntl_werte').each(function(i, field){
                            var feld = $(field);
                            mntl_gesamt += parseInt(feld.val());
                        });
                        gesamt_mntl.text($.formatNumber(mntl_gesamt, {locale:"de", format:'##0.00 €'}));
                        gesamt_mntl_hidden.val(mntl_gesamt);


                        einmalig_gesamt = 0;

                        $('input.einmalig_werte').each(function(i, field){
                            var feld = $(field);
                            einmalig_gesamt += parseInt(feld.val());
                        });
                        gesamt_einmalig.text($.formatNumber(einmalig_gesamt, {locale:"de", format:'##0.00 €'}));
                        gesamt_einmalig_hidden.val(einmalig_gesamt);

                        gesamt_gesamt_wert = 0;

                        $('input.gesamt_werte').each(function(i, field){
                            var feld = $(field);
                            gesamt_gesamt_wert += parseInt(feld.val());
                        });
                        gesamt_gesamt.text($.formatNumber(gesamt_gesamt_wert, {locale:"de", format:'##0.00 €'}));
                        gesamt_gesamt_hidden.val(gesamt_gesamt_wert);

        });

        var article_modem_id = $('#article_modem_id');
        article_modem_id.change(function(){
            var value = $(this).val();
            var tarif_value = $('#article_tarif_id').val();
            if(value == 17 && (tarif_value == 66 || tarif_value == 67 || tarif_value == 70)) {
                alert('In diesem Tarif ist nur das VDSL Modem möglich.');
                $(this).val('18');
            }
        });
            
        $('select.option').change(function(){
            var obj = $(this);
            var value = obj.val();
            var name = obj.attr('name');
            if(value.length > 0) {
                var id = $(this).attr('id');
                var value = $(this).val();

                var model_a = id.split('_');
                var table = model_a[1];

                var laufzeit_in_monaten = $('#laufzeit_in_monaten').val();

                $.ajax({
                    url: '{$url}',
                    data: {table: table, id: value},
                    dataType: 'json',
                    success: function(resp) {
                        if(name == 'article[tarif_id]') {
                            if(resp.is_country == 1) {
                                $('#article_guthaben_id').val('').attr('disabled', true).trigger('change');
                                $('#article_portierung_id').val('').attr('disabled', true).trigger('change');
                            }
                            else {
                                $('#article_guthaben_id').attr('disabled', false).trigger('change');
                                $('#article_portierung_id').attr('disabled', false).trigger('change');
                            }
                            
                            if(resp.id == 66 || resp.id == 67 || resp.id == 70) {
                                article_modem_id.val('18');
                            }

                        }
                        var kosten_mntl = $('#' + id + '_mntl_text');
                        var kosten_mntl_hidden = $('#' + id + '_mntl_hidden');
                        var kosten_einmalig = $('#' + id + '_einmalig_text');
                        var kosten_einmalig_hidden = $('#+' + id + '_einmalig_hidden');
                        var kosten_gesamt = $('#' + id + '_gesamt_text');
                        var kosten_gesamt_hidden = $('#' + id + '_gesamt_hidden');

                        var gesamt_mntl = $('#gesamt_mntl_text');
                        var gesamt_mntl_hidden = $('gesamt_mntl_hidden');
                        var gesamt_einmalig = $('#gesamt_einmalig_text');
                        var gesamt_einmalig_hidden = $('gesamt_einmalig_hidden');
                        var gesamt_gesamt = $('#gesamt_gesamt_text');
                        var gesamt_gesamt_hidden = $('gesamt_gesamt_hidden');

                        switch(resp.Zahlintervall.name) {
                            case 'monatlich':
                                var mntl = resp.kosten;
                                var einmalig = 0;
                                var gesamt = resp.kosten*laufzeit_in_monaten;
                                break;
                            case 'einmalig':
                                var mntl = 0;
                                var einmalig = resp.kosten;
                                var gesamt = resp.kosten;
                                break;
                        }

                        kosten_mntl.text($.formatNumber(mntl, {locale:"de", format:'##0.00 €'}));
                        kosten_mntl_hidden.val(mntl);
                        kosten_einmalig.text($.formatNumber(einmalig, {locale:"de", format:'##0.00 €'}));
                        kosten_einmalig_hidden.val(einmalig);
                        kosten_gesamt.text($.formatNumber(gesamt, {locale:"de", format:'##0.00 €'}));
                        kosten_gesamt_hidden.val(gesamt);

                        mntl_gesamt = 0;

                        $('input.mntl_werte').each(function(i, field){
                            var feld = $(field);
                            mntl_gesamt += parseInt(feld.val());
                        });
                        gesamt_mntl.text($.formatNumber(mntl_gesamt, {locale:"de", format:'##0.00 €'}));
                        gesamt_mntl_hidden.val(mntl_gesamt);


                        einmalig_gesamt = 0;

                        $('input.einmalig_werte').each(function(i, field){
                            var feld = $(field);
                            einmalig_gesamt += parseInt(feld.val());
                        });
                        gesamt_einmalig.text($.formatNumber(einmalig_gesamt, {locale:"de", format:'##0.00 €'}));
                        gesamt_einmalig_hidden.val(einmalig_gesamt);

                        gesamt_gesamt_wert = 0;

                        $('input.gesamt_werte').each(function(i, field){
                            var feld = $(field);
                            gesamt_gesamt_wert += parseInt(feld.val());
                        });
                        gesamt_gesamt.text($.formatNumber(gesamt_gesamt_wert, {locale:"de", format:'##0.00 €'}));
                        gesamt_gesamt_hidden.val(gesamt_gesamt_wert);

                    }
                });
            }
        });
JS;
echo javascript_tag($result);


?>