<?php 

namespace ActivismeBe\Traits; 

/**
 * Trait voor het intern loggen van gebruikers activiteit. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
trait ActivityLog 
{
    public function writeActivity(string $logName, $model, string $logMessage): void
    {
        activity($logName)
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log($logMessage);
    }
}