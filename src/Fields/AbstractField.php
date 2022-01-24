<?php

namespace EeObjects\Fields;

abstract class AbstractField
{
    /**
     * The specific ID for the field
     * @var int
     */
    protected $field_id = 0;

    /**
     * The coloquial name the field goes by
     * @var string
     */
    protected $field_name = '';

    /**
     * The Settings for the Field
     * @var array
     */
    protected $settings = [];

    /**
     * The hard coded options from the Control Panel
     * @var array
     */
    protected $field_options = [];

    /**
     * Should return the raw column name for the dataset
     * @return string
     */
    abstract public function getRawColName(): string;

    /**
     * Should return the processed data ready for use
     * @param mixed $value The data stored in channel_data table(s)
     * @return mixed
     */
    public function read($value)
    {
        return $value;
    }

    /**
     * If the Field requires external storage, it's done here
     *  AFTER the Entry is created/modified
     * @return bool
     */
    public function save($value)
    {
        return true;
    }

    /**
     * Should validate the data for the Field
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        return true;
    }

    /**
     * Converts the processed data for storage in the channel_data set
     * @param $value
     * @return mixed
     */
    public function prepValueForStorage($value)
    {
        return $value;
    }

    /**
     * Should handle any post Entry delete cleanup
     *  Called AFTER an Entry is deleted
     * @return bool
     */
    public function delete()
    {
        return true;
    }

    /**
     * @param array $settings
     * @return $this
     */
    public function setSettings(array $settings): AbstractField
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    protected function setting(string $key, $default = null)
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        }

        return $default;
    }

    /**
     * @param $field_id
     * @return $this
     */
    public function setFieldId(int $field_id): AbstractField
    {
        $this->field_id = $field_id;

        return $this;
    }

    /**
     * @param $field_name
     * @return $this
     */
    public function setFieldName($field_name)
    {
        $this->field_name = $field_name;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->field_id;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->field_name;
    }

    /**
     * Returns an array of exploded pipes
     * @param $value
     * @return string[]
     */
    protected function explodePipe($value)
    {
        $pieces = explode('|', $value);
        if ($pieces) {
            return $pieces;
        }

        return $value;
    }

    /**
     * Returns the configured Key/Value pairs if configured using the UI
     * @return array
     */
    protected function getValueLabelPairs()
    {
        if (is_array($this->setting('value_label_pairs'))) {
            return $this->setting('value_label_pairs');
        }
    }
}
