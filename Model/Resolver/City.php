<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\CityRepositoryInterface;

class City implements ResolverInterface
{
    /**
     * @var CityRepositoryInterface
     */
    protected $cityRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
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
        return $this->cityRepository->getGraphQlList(['description_ru' => $args['search']]);
    }

}
