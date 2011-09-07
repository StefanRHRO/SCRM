<table>
  <tbody>
    <tr>
      <th>#</th>
      <td><?php echo $article->getId() ?></td>
    </tr>
    <tr>
      <th>Tarif:</th>
      <td><?php echo $article->getTarif() ?></td>
    </tr>
    <tr>
      <th>Laufzeit:</th>
      <td><?php echo $article->getLaufzeit() ?></td>
    </tr>
    <tr>
      <th>Portierung:</th>
      <td><?php echo $article->getPortierung() ?></td>
    </tr>
    <tr>
      <th>Guthaben:</th>
      <td><?php echo $article->getGuthaben() ?></td>
    </tr>
    <tr>
      <th>Modem:</th>
      <td><?php echo $article->getModem() ?></td>
    </tr>
    <tr>
      <th>Ip:</th>
      <td><?php echo $article->getIp() ?></td>
    </tr>
    <tr>
      <th>Fp:</th>
      <td><?php echo $article->getFp() ?></td>
    </tr>
    <tr>
      <th>Upl:</th>
      <td><?php echo $article->getUpl() ?></td>
    </tr>
    <tr>
      <th>Service:</th>
      <td><?php echo $article->getService() ?></td>
    </tr>
    <tr>
      <th>Kdnr:</th>
      <td><?php echo $article->getKdnr() ?></td>
    </tr>
    <tr>
      <th>Titel:</th>
      <td><?php echo $article->getTitel() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $article->getName() ?></td>
    </tr>
    <tr>
      <th>Vorname:</th>
      <td><?php echo $article->getVorname() ?></td>
    </tr>
    <tr>
      <th>Gebdat:</th>
      <td><?php echo $article->getGebdat() ?></td>
    </tr>
    <tr>
      <th>Strasse:</th>
      <td><?php echo $article->getStrasse() ?></td>
    </tr>
    <tr>
      <th>Plz:</th>
      <td><?php echo $article->getPlz() ?></td>
    </tr>
    <tr>
      <th>Ort:</th>
      <td><?php echo $article->getOrt() ?></td>
    </tr>
    <tr>
      <th>Kto:</th>
      <td><?php echo $article->getKto() ?></td>
    </tr>
    <tr>
      <th>Blz:</th>
      <td><?php echo $article->getBlz() ?></td>
    </tr>
    <tr>
      <th>Vorwahl:</th>
      <td><?php echo $article->getVorwahl() ?></td>
    </tr>
    <tr>
      <th>Rfn:</th>
      <td><?php echo $article->getRfn() ?></td>
    </tr>
    <tr>
      <th>Fax:</th>
      <td><?php echo $article->getFax() ?></td>
    </tr>
    <tr>
      <th>Mail:</th>
      <td><?php echo $article->getMail() ?></td>
    </tr>
    <tr>
      <th>Bestellt:</th>
      <td><?php echo $article->getBestellt() ?></td>
    </tr>
    <tr>
      <th>Feld1:</th>
      <td><?php echo $article->getFeld1() ?></td>
    </tr>
    <tr>
      <th>Feld2:</th>
      <td><?php echo $article->getFeld2() ?></td>
    </tr>
    <tr>
      <th>Feld3:</th>
      <td><?php echo $article->getFeld3() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Bearbeiten</a>
&nbsp;
<a href="<?php echo url_for('article/index') ?>">Zurück zur Liste</a>
