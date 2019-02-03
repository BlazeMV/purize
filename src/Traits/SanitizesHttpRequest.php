<?php

namespace Blaze\Purize\Traits;

use Blaze\Purize\Sanitizer;

trait SanitizesHttpRequest
{
    /**
     * @throws \Exception
     */
    public function prepareForValidation()
    {
        parent::prepareForValidation();
        
        $sanitizer = new Sanitizer($this->all(), $this->sanitizers());
        $this->replace($sanitizer->sanitize());
    }
}