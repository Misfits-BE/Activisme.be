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
    /**
     * Schrijf een gebruikers activiteit naar de databank. 
     * 
     * @param  string $logName      De naam van de logs groep waarin het bericht word gestoken. 
     * @param  mixed  $model        De databank entiteit waarop de handeling is verricht
     * @param  string $logMessage   Het bericht dat dient als log
     * @return void 
     */
    public function writeActivity(string $logName, $model, string $logMessage): void
    {
        activity($logName)
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log($logMessage);
    }
}