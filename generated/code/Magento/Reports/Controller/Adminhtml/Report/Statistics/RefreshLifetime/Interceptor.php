<?php
namespace Magento\Reports\Controller\Adminhtml\Report\Statistics\RefreshLifetime;

/**
 * Interceptor class for @see \Magento\Reports\Controller\Adminhtml\Report\Statistics\RefreshLifetime
 */
class Interceptor extends \Magento\Reports\Controller\Adminhtml\Report\Statistics\RefreshLifetime implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, array $reportTypes)
    {
        $this->___init();
        parent::__construct($context, $dateFilter, $reportTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        if (!$pluginInfo) {
            return parent::execute();
        } else {
            return $this->___callPlugins('execute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
