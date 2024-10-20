<?php

use Symfony\Flex\Recipe;

return [
    new Recipe('my-bundle', function (Recipe $recipe) {
        $recipe
            ->copy('resource/config/ii-workflow.yaml', 'config/packages/ii-workflow.yaml')
        ;
    }),
];
