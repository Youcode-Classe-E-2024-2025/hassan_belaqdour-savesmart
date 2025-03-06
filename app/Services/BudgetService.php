<?php

namespace App\Services;

class BudgetService
{
    public static function calculerRepartition503020($revenuMensuel)
    {
        $besoins = $revenuMensuel * 0.5;
        $envies = $revenuMensuel * 0.3;
        $epargne = $revenuMensuel * 0.2;

        return [
            'besoins' => $besoins,
            'envies' => $envies,
            'epargne' => $epargne,
        ];
    }
}