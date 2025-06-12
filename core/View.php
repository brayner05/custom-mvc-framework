<?php

namespace Core;

class View {
    public function __construct(
        public private(set) string $name,
        public private(set) array $data
    ) {
    }
}
