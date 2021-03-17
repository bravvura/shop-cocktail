<?php
namespace Amasty\Storelocator\Controller\Location\SaveReview;

/**
 * Interceptor class for @see \Amasty\Storelocator\Controller\Location\SaveReview
 */
class Interceptor extends \Amasty\Storelocator\Controller\Location\SaveReview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Amasty\Storelocator\Api\ReviewRepositoryInterface $reviewRepository, \Amasty\Storelocator\Model\ReviewFactory $reviewFactory, \Magento\Customer\Model\Session $customerSession)
    {
        $this->___init();
        parent::__construct($context, $reviewRepository, $reviewFactory, $customerSession);
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
