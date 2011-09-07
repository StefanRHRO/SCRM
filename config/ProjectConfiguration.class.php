<?php
require_once realpath(dirname(dirname(__FILE__))) . '/lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        $this->enablePlugins('sfDoctrinePlugin');
        $this->enablePlugins('sfJqueryReloadedPlugin');
        $this->enablePlugins('sfDoctrineGuardPlugin');

        // diese Zeilen hinzufügen
        //ZendFramework integration
        $zf_path = sfConfig::get('sf_lib_dir') . '/vendor/zf';
        set_include_path($zf_path . PATH_SEPARATOR . get_include_path());
        require_once($zf_path . '/Zend/Loader/Autoloader.php');
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Namespace_');
    }
}
