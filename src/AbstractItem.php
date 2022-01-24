<?php

namespace EeObjects;

use ExpressionEngine\Service\Model\Model;

abstract class AbstractItem
{
    /**
     * The raw data available from the ExpressionEngine Model
     *  Note that this ONLY includes flat data stored in the channel_data table
     * @var array
     */
    protected $data = [];

    /**
     * Contains any set data from a `set()` call
     * @var array
     */
    protected $set_data = [];

    /**
     * The ExpressionEngine Model our Item is derived from
     * @var Model|null
     */
    protected $model = null;

    /**
     * AbstractItem constructor.
     * @param Model|null $item
     */
    public function __construct(Model $item = null)
    {
        if ($item instanceof Model) {
            $this->init($item);
        }
    }

    /**
     * Sets the Item object up and populates the data
     * @param Model $item
     */
    protected function init(Model $item): void
    {
        $this->model = $item;
        $this->data = $item->toArray();
        $this->set_data = [];
    }

    /**
     * Set an array as the data payload
     * @param array $data
     * @param false $replace_all
     * @return $this
     */
    public function setData(array $data, $replace_all = false): AbstractItem
    {
        if ($replace_all) {
            $this->set_data = [];
        }

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * Should write the Item
     * @return bool
     */
    abstract public function save(): bool;

    /**
     * Should remove an Item
     * @return mixed
     */
    abstract public function delete();

    /**
     * Will convert an Item into an array[]
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Should return the specified value
     * @param $key
     * @param null $default
     * @return mixed
     */
    abstract public function get($key, $default = null);

    /**
     * Should set the value
     * @param string $key
     * @param $value
     * @return AbstractItem
     */
    abstract public function set(string $key, $value): AbstractItem;
}
