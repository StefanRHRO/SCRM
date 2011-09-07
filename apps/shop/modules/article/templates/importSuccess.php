<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h1>Interessenten Importieren</h1>

    <div class="notification warning">
        Bitte beachten Sie, dass nur CSV Dateien unterstützt werden. Eine Beispiel Datei können Sie <a href="#">hier herrunterladen</a>
        <?php if($_POST) { ?>
        <br /><strong><?php echo $cnt_import ?> Datensätze importiert</strong>
        <?php } ?>
    </div>
    <form action="<?php echo url_for('article/doImport') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php echo $form ?>
        <input type="submit" value="Import" />
    </form>