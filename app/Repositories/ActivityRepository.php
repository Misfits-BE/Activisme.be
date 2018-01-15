<?php 

namespace ActivismeBe\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Pagination\Paginator;

/**
 * Class ActivityRepository
 *
 * @package ActivismeBe\Repositories
 */
class ActivityRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    /**
     * Zoek voor een specifieke log in de databank opslag. 
     * 
     * @param  string $term    De opgegegeven zoekterm door de gebruiker.
     * @param  int    $perPage De aantal records de gebruiker wilt weergeven per pagina. 
     * @return \Illuminate\Pagination\Paginator
     */
    public function searchLogs(string $term, $perPage): Paginator
    {
        return $this->entity()->where('description', 'LIKE', "%{$term}%")->simplePaginate($perPage);
    }
}