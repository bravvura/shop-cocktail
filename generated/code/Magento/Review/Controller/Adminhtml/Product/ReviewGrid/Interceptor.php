<?php
namespace Magento\Review\Controller\Adminhtml\Product\ReviewGrid;

/**
 * Interceptor class for @see \Magento\Review\Controller\Adminhtml\Product\ReviewGrid
 */
class Interceptor extends \Magento\Review\Controller\Adminhtml\Product\ReviewGrid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Review\Model\ReviewFactory $reviewFactory, \Magento\Review\Model\RatingFactory $ratingFactory, \Magento\Framework\View\LayoutFactory $layoutFactory)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $reviewFactory, $ratingFactory, $layoutFactory);
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
