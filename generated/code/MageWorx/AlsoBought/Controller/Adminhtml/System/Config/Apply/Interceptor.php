<?php
namespace MageWorx\AlsoBought\Controller\Adminhtml\System\Config\Apply;

/**
 * Interceptor class for @see \MageWorx\AlsoBought\Controller\Adminhtml\System\Config\Apply
 */
class Interceptor extends \MageWorx\AlsoBought\Controller\Adminhtml\System\Config\Apply implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \MageWorx\AlsoBought\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($context, $resultJsonFactory, $helper);
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
