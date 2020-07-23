<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\Data\AreaInterface;
use CodeCustom\NovaPoshta\Api\AreaRepositoryInterface;
use Magento\Framework\App\ResourceConnection;
use CodeCustom\NovaPoshta\Model\Area as AreaModel;
use CodeCustom\NovaPoshta\Model\ResourceModel\Area as AreaResource;
use CodeCustom\NovaPoshta\Model\AreaFactory;

class Area implements AreaRepositoryInterface
{

    /**
     * @var \CodeCustom\NovaPoshta\Model\Area
     */
    protected $area;
    /**
     * @var AreaResource
     */
    protected $areaResource;
    /**
     * @var ResourceConnection
     */
    protected $resource;
    /**
     * @var AreaFactory
     */
    protected $areaFactory;

    public function __construct(
        AreaModel $area,
        AreaResource $areaResource,
        ResourceConnection $resource,
        AreaFactory $areaFactory
    )
    {
        $this->area = $area;
        $this->areaResource = $areaResource;
        $this->resource = $resource;
        $this->areaFactory = $areaFactory;
    }

    /**
     * @param AreaInterface $area
     * @return mixed|void
     */
    public function save(AreaInterface $area)
    {
        try {
            $this->areaResource->save($area);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save Source'), $exception);
        }
    }


    public function getList(array $params = [])
    {
        return [];
    }


    /**
     * @param $value
     * @param $field
     * @return AreaModel
     */
    public function getByField($value, $field)
    {
        $object = $this->areaFactory->create();
        $this->areaResource->load($object, $value, $field);
        return $object;
    }

    /**
     * Sync areas after NP loaded
     * @param array $areas
     * @return bool
     */
    public function syncLoadedAreas(array $areas = [])
    {
        if (!empty($areas)) {
            foreach ($areas as $areaData) {
                $area = $this->getByField($areaData[self::AREA_REF], self::NP_ENTITY_FIELD);
                $area->setRef($areaData[self::AREA_REF]);
                $area->setDescription($areaData[self::AREA_DESCRIPTION]);
                $area->setDescriptionRu($areaData[self::AREA_DESCRIPTION_RU]);
                $area->setAreasCenter($areaData[self::AREA_AREASCENTER]);
                $this->save($area);
            }
            return true;
        }
        return false;
    }

}
