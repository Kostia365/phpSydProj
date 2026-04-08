<?php

class getGoodsDto
{
    public function __construct(
        public string $name,
        public int    $cost,
        public string $description,
    )
    {
    }
}