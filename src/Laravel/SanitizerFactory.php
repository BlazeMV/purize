<?php

namespace Blaze\Purize\Laravel;

use Blaze\Purize\Sanitizer;

class SanitizerFactory
{
    /**
     * @var Sanitizer $sanitizer
     */
    protected $sanitizer;
    
    /**
     * @param  array $data
     * @param  array $rules
     * @return array
     */
    public function sanitize(array $data, array $rules)
    {
        $sanitizer = $this->makeSanitizer($data, $rules);
        
        return $sanitizer->sanitize();
    }
    
    /**
     * @param array $data
     * @param array $rules
     * @return Sanitizer
     */
    protected function makeSanitizer(array $data, array $rules)
    {
        $this->sanitizer = new Sanitizer($data, $rules);
    
        return $this->sanitizer;
    }
}