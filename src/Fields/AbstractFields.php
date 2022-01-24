<?php

namespace EeObjects\Fields;

use ExpressionEngine\Service\Model\Model;

abstract class AbstractFields
{
    /**
     * @var Config
     */
    protected $config = null;

    /**
     * The shortname for where the parent Field group lives
     * @var bool
     */
    protected $config_domain = false;

    /**
     * @param Model $item
     * @return array
     */
    abstract public function translateFieldData(Model $item): array;

    /**
     * @param int $field_id
     * @return mixed
     */
    abstract public function getFieldById(int $field_id);
}
