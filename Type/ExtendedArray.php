<?php

namespace TA\ExtendedArray\Type;

/**
 * ParamArray is an implementation of
 * a request data structure
 */
class ExtendedArray extends \ArrayObject
{
    public function __construct($data = array())
    {
        if ($data == null) {
            $data = array();
        }

        parent::__construct(
            $data,
            \ArrayObject::STD_PROP_LIST | \ArrayObject::ARRAY_AS_PROPS
        );
    }

    public function has($key)
    {
        return isset($this[$key]);
    }

    /**
     * Return true if all of the keys are
     * in the array
     */
    public function hasAll($keys)
    {
        if (empty($keys) || !is_array($keys)) {
            return false;
        }

        $countKeys = count($this->getSubArray($keys));

        return $countKeys == count($keys);
    }

    /**
     * Return true if one of the keys is
     * in the array
     */
    public function hasOne($keys)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $this->toArray())) {
                return true;
            }
        }

        return false;
    }

    public function getAll($keys, $default = null)
    {
        if (empty($keys)) {
            return $default;
        }

        $result = $this->getSubArray($keys);

        if (!empty($result)) {
            return $result;
        }

        return $default;
    }

    public function get($key, $default = null)
    {
        if (isset($this[$key])) {
            return $this[$key];
        }

        return $default;
    }

    public function remove($key)
    {
        if ($this->has($key)) {
            $removed = $this[$key];
            unset($this[$key]);

            return $removed;
        }

        return false;
    }

    public function toArray()
    {
        return $this->getArrayCopy();
    }

    public function set($key, $value)
    {
        $this[$key] = $value;
    }

    public function getSubArray($keys)
    {
        return array_intersect_key(
            $this->toArray(),
            array_flip($keys)
        );
    }
}
