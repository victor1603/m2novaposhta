<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\StreetRepositoryInterface;

class Streets implements ResolverInterface
{
    /**
     * @var StreetRepositoryInterface
     */
    protected $streetRepository;


    public function __construct(
        StreetRepositoryInterface $streetRepository
    )
    {
        $this->streetRepository = $streetRepository;
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
        return $this->streetRepository->getGraqhQlList($args['settlement_ref'], $args['search']);
    }
}
