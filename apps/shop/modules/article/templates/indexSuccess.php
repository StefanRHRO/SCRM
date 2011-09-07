<?php use_helper('Date') ?>
<h1>Interessenten Übersicht</h1>
<form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
        <tbody>
        <tr>
            <th>#</th>
            <th>Kundennummer</th>
            <th>Tarifdetails</th>
            <th>Adresse</th>
            <th>Kontodaten</th>
            <th>E-Mail Adresse</th>
            <th>Bestellt</th>
            <?php if($sf_user->isSuperAdmin()) { ?>
            <th>letzte Änderung</th>
            <?php } ?>
            <th></th>
        </tr>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>"><?php echo $article->getId() ?></a>
            </td>
            <td><?php echo $article->getKdnr() ?></td>
            <td>
                Tarif: <?php echo $article->getTarif() ?><br/>
                Laufzeit: <?php echo $article->getLaufzeit() ?><br/>
                Portierung: <?php echo $article->Portierung->beschreibung  ?><br/>
                Guthaben: <?php echo (string)$article->getGuthaben() ?><br/>
                feste IP: <?php echo $article->Ip->name ?><br/>
                Modem: <?php  echo $article->getModem() ?>
                Service: <?php echo (($service = $article->getService()) == 1) ? 'Ja' : 'Nein' ?>
            </td>
            <td>
                <?php echo $article->getTitel() . ' ' . $article->getVorname() . ' ' . $article->getName() ?><br/>
                <?php echo $article->getStrasse() ?><br/>
                <?php echo $article->getPlz() . '/' . $article->getOrt() ?><br/>
                Tel.: <a
                    href="sip:/<?php echo $article->getVorwahl() . $article->getRfn() ?>"><?php echo $article->getVorwahl() . '/' . $article->getRfn() ?></a><br/>
                Fax: <?php echo ($article->getFax()) ? $article->getFax() : 'kein Fax' ?>
            </td>
            <td>
                Kontonummer: <?php echo $article->getKto() ?><br/>
                BLZ: <?php echo $article->getBlz() ?>
            </td>
            <td><?php echo $article->getMail() ?></td>
            <td><?php echo (($bestellt = $article->getBestellt()) == 1) ? 'Ja' : 'Nein' ?></td>
            <?php if($sf_user->isSuperAdmin()) { ?>
            <th><?php echo $article->sfGuardUser ?><br /><?php echo format_datetime($article->getUpdatedAt(), 'g', $sf_user->getCulture()) ?><br />Aktuelle Version: <?php echo $article->version ?></th>
            <?php } ?>
            <td><a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>"><img src="/images/icons/pencil.png" title="<?php echo $article ?> bearbeiten" alt="<?php echo $article ?> bearbeiten" /></a>
                <a href="<?php echo url_for('article/delete?id=' . $article->getId()) ?>"><img src="/images/icons/delete.png" title="<?php echo $article ?> löschen" alt="<?php echo $article ?> löschen" /></a>
            <a href="<?php echo url_for('article/export?id=' . $article->getId() . '&typ=pdf') ?>"><img src="/images/icons/page_white_go.png" title="<?php echo $article ?> Vertrag erstellen" alt="<?php echo $article ?> Vertrag erstellen" /></a></td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<div class="grid_3">
<?php if ($pager->haveToPaginate()): ?>
<div class="pagination">
    <a href="<?php echo url_for('article/index', $article) ?>?page=1"> <img
            src="/images/icons/bullet_arrow_left_2.png"
            alt="Erste Seite" title="Erste Seite"/> </a>
    <a href="<?php echo url_for('article/index', $article) ?>?page=<?php echo $pager->getPreviousPage() ?>">
        <img src="/images/icons/bullet_arrow_left.png" alt="zurück" title="zurück"/>
    </a>
    <?php foreach ($pager->getLinks() as $page): ?> <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?> <?php else: ?>
    <a href="<?php echo url_for('article/index', $article) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
    <?php endif; ?> <?php endforeach; ?>
    <a href="<?php echo url_for('article/index', $article) ?>?page=<?php echo $pager->getNextPage() ?>">
        <img src="/images/icons/bullet_arrow_right.png" alt="vor" title="vor"/>
    </a>
    <a href="<?php echo url_for('article/index', $article) ?>?page=<?php echo $pager->getLastPage() ?>">
        <img src="/images/icons/bullet_arrow_right_2.png" alt="letzte Seite" title="letzte Seite"/>
    </a></div>
<?php endif; ?>
    </div>
    <div class="grid_3">
<div class="pagination_desc"><strong><?php echo count($pager) ?></strong> Interessenten
    <?php if ($pager->haveToPaginate()): ?> - Seite <strong><?php echo $pager->getPage() ?>/<?php echo
    $pager->getLastPage() ?></strong> <?php endif; ?>
</div>
    </div>
    <div class="grid_6">
<a href="<?php echo url_for('article/new') ?>">Neuen Interessenten hinzufügen</a> - <a
        href="<?php echo url_for('article/import') ?>">Interessenten importieren</a>
        </div>
