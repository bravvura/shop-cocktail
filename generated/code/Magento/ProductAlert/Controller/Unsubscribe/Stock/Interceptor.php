<?php
namespace Magento\ProductAlert\Controller\Unsubscribe\Stock;

/**
 * Interceptor class for @see \Magento\ProductAlert\Controller\Unsubscribe\Stock
 */
class Interceptor extends \Magento\ProductAlert\Controller\Unsubscribe\Stock implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, ?\Magento\Store\Model\StoreManagerInterface $storeManager = null, ?\Magento\ProductAlert\Model\StockFactory $stockFactory = null)
    {
        $this->___init();
        parent::__construct($context, $customerSession, $productRepository, $storeManager, $stockFactory);
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
