<?php

namespace CodeCustom\NovaPoshta\Api;

use CodeCustom\NovaPoshta\Api\Data\AreaInterface;

interface AreaRepositoryInterface
{
    const AREA_REF              = 'Ref';
    const AREA_DESCRIPTION      = 'Description';
    const AREA_DESCRIPTION_RU   = 'DescriptionRu';
    const AREA_AREASCENTER      = 'AreasCenter';
    const NP_ENTITY_FIELD       = 'ref';

    const NP_MODEL_NAME         = 'Address';
    const NP_CALLED_METHOD      = 'getAreas';

    /**
     * @param \CodeCustom\NovaPoshta\Api\AreaInterface $area
     * @return mixed
     */
    public function save(AreaInterface $area);
    /**
     * @param array $params
     * @return mixed
     */
    public function getList(array $params = []);
    /**
     * @param array $areas
     * @return mixed
     */
    public function syncLoadedAreas(array $areas = []);

}
