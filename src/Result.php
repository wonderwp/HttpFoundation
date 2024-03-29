<?php

namespace WonderWp\Component\HttpFoundation;

class Result implements \JsonSerializable
{
    /**
     * The result code (based on http codes)
     * @var int
     */
    protected $code;
    /**
     * Result data
     * @var string[]
     */
    protected $data = [];

    /**
     * @param int $code
     * @param array $data
     *
     * @codeCoverageIgnore
     */
    public function __construct($code, $data = [])
    {
        $this->code = $code;
        $this->data = $data;
    }

    /**
     * @codeCoverageIgnore
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getData($key = '')
    {
        if (!empty($key)) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        } else {
            return $this->data;
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param array $newData
     *
     * @return $this
     */
    public function addData(array $newData)
    {
        $this->data = $this->data + $newData;

        return $this;
    }

    /** @inheritdoc */
    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode($this);
    }

    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }
}
