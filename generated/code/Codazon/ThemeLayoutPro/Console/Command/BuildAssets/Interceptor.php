<?php
namespace Codazon\ThemeLayoutPro\Console\Command\BuildAssets;

/**
 * Interceptor class for @see \Codazon\ThemeLayoutPro\Console\Command\BuildAssets
 */
class Interceptor extends \Codazon\ThemeLayoutPro\Console\Command\BuildAssets implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(?string $name = null)
    {
        $this->___init();
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        if (!$pluginInfo) {
            return parent::run($input, $output);
        } else {
            return $this->___callPlugins('run', func_get_args(), $pluginInfo);
        }
    }
}
