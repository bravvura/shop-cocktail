<?php
namespace Magento\Sales\Block\Order\Items;

/**
 * Interceptor class for @see \Magento\Sales\Block\Order\Items
 */
class Interceptor extends \Magento\Sales\Block\Order\Items implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, array $data = [], ?\Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $itemCollectionFactory = null)
    {
        $this->___init();
        parent::__construct($context, $registry, $data, $itemCollectionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        if (!$pluginInfo) {
            return parent::toHtml();
        } else {
            return $this->___callPlugins('toHtml', func_get_args(), $pluginInfo);
        }
    }
}
