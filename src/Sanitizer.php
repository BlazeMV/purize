<?php

namespace Blaze\Purize;

class Sanitizer
{
    /**
     * @var array $data Data to be sanitized
    */
    protected $data;
    
    /**
     * @var array $rules Rules
     */
    protected $rules;
    
    /**
     * Sanitizer constructor.
     *
     * @param array $data
     * @param array $rules
     */
    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }
    
    /**
     * sanitizes an array of data provided with the set of rules provided
     *
     * @return array
     */
    public function sanitize()
    {
        foreach ($this->rules as $field => $methods) {
            if (array_has($this->data, $field)) {
                $this->setDataValue($field, $methods);
            } else {
                if (strpos($field, '.*.') === false) {
                    continue;
                }
                try {
                    $parts = explode('.*.', $field);
                    if (!array_has($this->data, $parts[0])) {
                        continue;
                    }
                    $items = array_get($this->data, $parts[0]);
                    foreach ($items as $key => $item) {
                        $field = "$parts[0].$key.$parts[1]";
                        $this->setDataValue($field, $methods);
                    }
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }
        return $this->data;
    }
    
    /**
     * @param $key
     * @param $methods
     * @return mixed
     */
    protected function setDataValue($key, $methods)
    {
        if (is_array($methods)) {
            foreach ($methods as $method) {
                array_set($this->data, $key, $this->call($method, array_get($this->data, $key)));
            }
        } else {
            array_set($this->data, $key, $this->call($methods, array_get($this->data, $key)));
        }
        
        return array_get($this->data, $key);
    }
    
    /**
     * @param $method
     * @param $data
     * @return mixed
     */
    protected function call($method, $data)
    {
        if (is_callable($method)) {
            return call_user_func_array($method, [$data]);
        } else {
            return $data;
        }
    }
}