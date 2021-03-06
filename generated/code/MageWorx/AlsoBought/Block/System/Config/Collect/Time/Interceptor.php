<?php
namespace MageWorx\AlsoBought\Block\System\Config\Collect\Time;

/**
 * Interceptor class for @see \MageWorx\AlsoBought\Block\System\Config\Collect\Time
 */
class Interceptor extends \MageWorx\AlsoBought\Block\System\Config\Collect\Time implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \MageWorx\AlsoBought\Helper\Data $helper, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $helper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'render');
        if (!$pluginInfo) {
            return parent::render($element);
        } else {
            return $this->___callPlugins('render', func_get_args(), $pluginInfo);
        }
    }
}
