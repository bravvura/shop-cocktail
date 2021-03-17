<?php
namespace Amasty\PageSpeedOptimizer\Console\Command\OptimizeCommand2;

/**
 * Interceptor class for @see \Amasty\PageSpeedOptimizer\Console\Command\OptimizeCommand2
 */
class Interceptor extends \Amasty\PageSpeedOptimizer\Console\Command\OptimizeCommand2 implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Amasty\PageSpeedOptimizer\Console\Command\Operation\Optimize $optimizeCommand, \Amasty\PageSpeedOptimizer\Model\ConfigProvider $configProvider, $name = null)
    {
        $this->___init();
        parent::__construct($optimizeCommand, $configProvider, $name);
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
