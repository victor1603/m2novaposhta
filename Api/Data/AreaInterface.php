<?php

namespace CodeCustom\NovaPoshta\Api\Data;

interface AreaInterface
{
    const ENTITY_ID         = 'entity_id';
    const DESCRIPTION       = 'description';
    const DESCRIPTION_RU    = 'description_ru';
    const REF               = 'ref';
    const AREAS_CENTER      = 'areas_center';

    /**
     * @param $entity_id
     * @return mixed
     */
    public function setEntityId($entity_id);
    /**
     * @return mixed
     */
    public function getEntityId();
    /**
     * @param $description
     * @return mixed
     */
    public function setDescription($description);
    /**
     * @return mixed
     */
    public function getDescription();
    /**
     * @param $description
     * @return mixed
     */
    public function setDescriptionRu($description_ru);
    /**
     * @return mixed
     */
    public function getDescriptionRu();
    /**
     * @param $ref
     * @return mixed
     */
    public function setRef($ref);
    /**
     * @return mixed
     */
    public function getRef();
    /**
     * @param $areas_center
     * @return mixed
     */
    public function setAreasCenter($areas_center);
    /**
     * @return mixed
     */
    public function getAreasCenter();

}
