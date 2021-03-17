<?php
namespace Mirasvit\SearchGraphQl\Model\Resolver\Magento\Catalog\Category;

/**
 * Interceptor class for @see \Mirasvit\SearchGraphQl\Model\Resolver\Magento\Catalog\Category
 */
class Interceptor extends \Mirasvit\SearchGraphQl\Model\Resolver\Magento\Catalog\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\CatalogGraphQl\Model\Category\Hydrator $hydrator, \Magento\CatalogGraphQl\Model\AttributesJoiner $attributesJoiner)
    {
        $this->___init();
        parent::__construct($hydrator, $attributesJoiner);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(\Magento\Framework\GraphQl\Config\Element\Field $field, $context, \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info, ?array $value = null, ?array $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        if (!$pluginInfo) {
            return parent::resolve($field, $context, $info, $value, $args);
        } else {
            return $this->___callPlugins('resolve', func_get_args(), $pluginInfo);
        }
    }
}
