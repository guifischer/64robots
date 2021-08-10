<?php

namespace App\Models;

use App\Http\Requests\RelateFamilyRequest;
use App\Notifications\PersonAdded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Korridor\LaravelHasManyMerged\HasManyMergedRelation;

class Person extends Model
{
    use Notifiable;
    use HasManyMergedRelation;
    use HasFactory;

    protected $table = "people";
    protected $fillable = [ 'firstnames', 'lastname'];
    protected static function booted()
    {
        static::created(function ($person) {
            $person->notify(new PersonAdded());
        });
    }

    /*
     * Relations
     */
    public function family()
    {
        return $this->hasManyMerged(Family::class, ['husband_id', 'wife_id'])->with(["husband", "wife", "children"]);
    }

    /*
     * General Functions
     */

    public function relateFamily(RelateFamilyRequest $request)
    {
        $this->child_from_family_id = $request->child_from_family_id;
        $this->save();

        return $this;
    }
    
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    /*
     * Helpers
     */

    public function fullname()
    {
        return $this->firstnames . ' ' . $this->lastname;
    }
}
