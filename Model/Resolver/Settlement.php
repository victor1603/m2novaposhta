<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use CodeCustom\NovaPoshta\Api\SettlementRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Settlement implements ResolverInterface
{
    protected $settlementRepositoty;

    public function __construct(
        SettlementRepositoryInterface $settlementRepository
    )
    {
        $this->settlementRepositoty = $settlementRepository;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return \Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (isset($args['only_warehause']) && $args['only_warehause'] == 1) {
            $result = $this->settlementRepositoty->getGraphQlList(['warehouse' => '1']);
        } else {
            $result = $this->settlementRepositoty->getGraphQlList(['description_ru' => $args['search']]);
        }

        return $result;
    }

}
