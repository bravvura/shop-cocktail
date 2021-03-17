<?php
namespace Magento\Elasticsearch\Model\Adapter\BatchDataMapper\ProductDataMapper;

/**
 * Interceptor class for @see \Magento\Elasticsearch\Model\Adapter\BatchDataMapper\ProductDataMapper
 */
class Interceptor extends \Magento\Elasticsearch\Model\Adapter\BatchDataMapper\ProductDataMapper implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Elasticsearch\Model\Adapter\Document\Builder $builder, \Magento\Elasticsearch\Model\Adapter\FieldMapperInterface $fieldMapper, \Magento\Elasticsearch\Model\Adapter\FieldType\Date $dateFieldType, \Magento\AdvancedSearch\Model\Adapter\DataMapper\AdditionalFieldsProviderInterface $additionalFieldsProvider, \Magento\CatalogSearch\Model\Indexer\Fulltext\Action\DataProvider $dataProvider, array $excludedAttributes = [], array $sortableAttributesValuesToImplode = [])
    {
        $this->___init();
        parent::__construct($builder, $fieldMapper, $dateFieldType, $additionalFieldsProvider, $dataProvider, $excludedAttributes, $sortableAttributesValuesToImplode);
    }

    /**
     * {@inheritdoc}
     */
    public function map(array $documentData, $storeId, array $context = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'map');
        if (!$pluginInfo) {
            return parent::map($documentData, $storeId, $context);
        } else {
            return $this->___callPlugins('map', func_get_args(), $pluginInfo);
        }
    }
}
