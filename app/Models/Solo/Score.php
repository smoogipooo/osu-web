<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Solo;

use App\Exceptions\GameCompletedException;
use App\Libraries\ScoreCheck;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property float|null $accuracy
 * @property int $beatmap_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $ended_at
 * @property int $id
 * @property int|null $max_combo
 * @property array|null $mods
 * @property bool|null $passed
 * @property float|null $pp
 * @property string|null $rank
 * @property int $ruleset_id
 * @property \Carbon\Carbon $started_at
 * @property array|null $statistics
 * @property int|null $total_score
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class Score extends Model
{
    use SoftDeletes;

    protected $table = 'solo_scores';
    protected $dates = ['started_at', 'ended_at'];
    protected $casts = [
        'passed' => 'boolean',
        'mods' => 'array',
        'statistics' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isCompleted(): bool
    {
        return $this->ended_at !== null;
    }

    public function complete(array $params): void
    {
        if ($this->isCompleted()) {
            throw new GameCompletedException('cannot modify score after submission');
        }

        $this->fill($params);

        ScoreCheck::assertCompleted($this);

        $this->save();
    }
}
