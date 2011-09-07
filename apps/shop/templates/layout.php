<?php use_helper('jQuery') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<div id="header" class="png_bg">

    <div id="head_wrap" class="container_12">

        <!-- start of logo - you could replace this with an image of your logo -->
        <div id="logo" class="grid_4">
            <h1>CRM - 1 beta</h1>
        </div>
        <!-- end logo -->

        <!-- start control panel -->
        <div id="controlpanel" class="grid_8">
            <?php if ($sf_user->isAuthenticated()) { ?>
            <ul>

                <li><p>Eingeloggt als: <?php echo $sf_user ?></p></li>
                <li><a class="logout icon" href="<?php echo url_for('@sf_guard_signout') ?>" class="first">Logout</a>
                </li>
                <li><a class="settings icon" href="#" class="first">Einstellungen</a></li>

            </ul>
            <?php } ?>
        </div>
        <!-- end control panel -->
        <!-- start navigation -->
        <div id="navigation" class=" grid_12">
            <ul>
                <li><a href="<?php echo url_for('article/index') ?>" class="first">Interessenten Übersicht</a></li>
                <li><a href="<?php echo url_for('article/import') ?>" class="first">Interessenten importieren</a>
                    <ul>
                        <ul></ul>
                    </ul>
            </ul>
        </div>
        <!-- end navigation -->
    </div>
</div>
<div id="main_content_wrap" class="container_12">
    <?php echo $sf_content ?>

    <!-- START FOOTER -->

    <div id="footer" class="grid_12">

        <p>© Copyright <?php echo date('Y') ?> Stefan Riedel</p>

    </div>
    <!-- END FOOTER -->
</div>
</div>
</body>
</html>
