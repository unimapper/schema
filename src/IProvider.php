<?php

namespace UniMapper\Schema;

use UniMapper\Entity\Reflection;

interface IProvider
{

    public function createSchema(Reflection $reflection);

}