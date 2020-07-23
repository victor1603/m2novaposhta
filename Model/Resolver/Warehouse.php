<?php


namespace CodeCustom\NovaPoshta\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\WarehouseRepositoryInterface;

class Warehouse implements ResolverInterface
{

    protected $warehouseRepository;

    public function __construct(
        WarehouseRepositoryInterface $warehouseRepository
    )
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return $this->warehouseRepository->getGraphQlList($args['city_ref'], $args['search']);
    }
}
