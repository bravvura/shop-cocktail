<?php
namespace Dotdigitalgroup\Email\Controller\Report\Bestsellers;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Controller\Report\Bestsellers
 */
class Interceptor extends \Dotdigitalgroup\Email\Controller\Report\Bestsellers implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Dotdigitalgroup\Email\Helper\Data $data, \Magento\Framework\App\Action\Context $context, \Magento\Framework\Escaper $escaper, \Dotdigitalgroup\Email\Helper\Config $configHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Dotdigitalgroup\Email\Model\FailedAuthFactory $failedAuthFactory, \Dotdigitalgroup\Email\Model\ResourceModel\FailedAuth $failedAuthResource, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->___init();
        parent::__construct($data, $context, $escaper, $configHelper, $storeManager, $failedAuthFactory, $failedAuthResource, $timezone);
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
