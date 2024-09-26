<?php

declare (strict_types=1);

namespace App\Repository;

interface FieldMappingServiceInterface
{
    public function mapFields(array $data): array;
}
