<?php
namespace Amasty\RulesPro\Model\Rule\Condition\Total\Status;

/**
 * Interceptor class for @see \Amasty\RulesPro\Model\Rule\Condition\Total\Status
 */
class Interceptor extends \Amasty\RulesPro\Model\Rule\Condition\Total\Status implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Rule\Model\Condition\Context $context, \Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory $collectionFactory, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $collectionFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getValueParsed()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValueParsed');
        if (!$pluginInfo) {
            return parent::getValueParsed();
        } else {
            return $this->___callPlugins('getValueParsed', func_get_args(), $pluginInfo);
        }
    }
}
