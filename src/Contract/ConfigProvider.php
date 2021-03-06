<?php

declare(strict_types=1);

namespace ReliqArts\Contract;

interface ConfigProvider
{
    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(?string $key, $default = null);
}
