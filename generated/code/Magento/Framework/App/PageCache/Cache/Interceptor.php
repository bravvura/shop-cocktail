<?php
namespace Magento\Framework\App\PageCache\Cache;

/**
 * Interceptor class for @see \Magento\Framework\App\PageCache\Cache
 */
class Interceptor extends \Magento\Framework\App\PageCache\Cache implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Cache\Frontend\Pool $frontendPool, $cacheIdentifier = null)
    {
        $this->___init();
        parent::__construct($frontendPool, $cacheIdentifier);
    }

    /**
     * {@inheritdoc}
     */
    public function load($identifier)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        if (!$pluginInfo) {
            return parent::load($identifier);
        } else {
            return $this->___callPlugins('load', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save($data, $identifier, $tags = [], $lifeTime = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        if (!$pluginInfo) {
            return parent::save($data, $identifier, $tags, $lifeTime);
        } else {
            return $this->___callPlugins('save', func_get_args(), $pluginInfo);
        }
    }
}
