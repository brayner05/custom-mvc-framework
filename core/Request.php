<?php

namespace Core;

class Request {
    public function __construct(
        public private(set) string $method,
        public private(set) string $path,
        public private(set) string $uri,
        public private(set) array $query,
        public private(set) string $body
    ) {
    }
}
