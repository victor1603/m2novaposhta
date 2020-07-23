<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\AreaInterface;
use Magento\Framework\Model\AbstractModel;


class Area extends AbstractModel implements AreaInterface
{
    public function _construct()
    {
        $this->_init(\CodeCustom\NovaPoshta\Model\ResourceModel\Area::class);
    }

    public function setEntityId($entity_id)
    {
        $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function setDescriptionRu($description_ru)
    {
        $this->setData(self::DESCRIPTION_RU, $description_ru);
    }

    public function getDescriptionRu()
    {
        return $this->getData(self::DESCRIPTION_RU);
    }

    public function setRef($ref)
    {
        $this->setData(self::REF, $ref);
    }

    public function getRef()
    {
        return $this->getData(self::REF);
    }

    public function setAreasCenter($areas_center)
    {
        $this->setData(self::AREAS_CENTER, $areas_center);
    }

    public function getAreasCenter()
    {
        return $this->getData(self::AREAS_CENTER);
    }
}
