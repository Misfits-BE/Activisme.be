<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Gift;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class GiftRepository
 *
 * @package ActivismeBe\Repositories
 */
class GiftRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Gift::class;
    }

    public function validatePlan($givenPlan)
    {
        $plans = ['7.00', '12.00', '17.00', '22.00'];

        foreach ($plans as $plan) {
            if ($givenPlan == $plan) {
                return true;
            }
        }

        return false;
    }

    public function prefillPlan($plan) 
    {
        switch ($plan) { // Bepaal het bedrag en opslag in variable voor te laten passeren naar form.
            case 'brons':   $plan = '7.00';  break; 
            case 'zilver':  $plan = '12.00'; break;
            case 'goud':    $plan = '17.00'; break;
            case 'diamant': $plan = '22.00'; break;

            default: $plan = '7.00'; // Geen geldig plan opgegeven dus val terug op het minimale plan. 
        }

        return $plan;
    }
}