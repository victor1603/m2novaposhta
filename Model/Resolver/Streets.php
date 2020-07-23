<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\StreetRepositoryInterface;

class Streets implements ResolverInterface
{
    protected $streetRepository;


    public function __construct(
        StreetRepositoryInterface $streetRepository
    )
    {
        $this->streetRepository = $streetRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return $this->streetRepository->getGraqhQlList($args['city'], $args['search']);
    }
}
