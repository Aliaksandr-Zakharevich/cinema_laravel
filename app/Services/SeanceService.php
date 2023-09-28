<?php

namespace App\Services;

use App\Models\Hall;
use App\Models\Session;

class SeanceService
{
    public function isValidTimeSeance(array $data)
    {
        $newSeanceInTimestamp = strtotime($data['start_date']);
        $seances = Session::query()
            ->where('movie_id', $data['movie_id'])
            ->where('hall_id', $data['hall_id'])
            ->get();
        $hall = Hall::find($data['hall_id']);

        if (strtotime($hall->opening_time, $newSeanceInTimestamp) > $newSeanceInTimestamp
            || strtotime($hall->closing_time, $newSeanceInTimestamp) < $newSeanceInTimestamp) {
            return false;
        }

        if ($newSeanceInTimestamp < strtotime('now')) {
            return false;
        }

        for ($i = 0; $i < count($seances); $i++) {
            $durationWithCleaning = $seances[$i]->movie->duration + $hall->cleaning_time;
            $currentSeanceInTimestamp = strtotime($seances[$i]->start_date);
            if (
                ($newSeanceInTimestamp > $currentSeanceInTimestamp
                    && $newSeanceInTimestamp < strtotime("+{$durationWithCleaning}minutes", $currentSeanceInTimestamp))
                || ($currentSeanceInTimestamp > $newSeanceInTimestamp
                    && $currentSeanceInTimestamp < strtotime("+{$durationWithCleaning}minutes", $newSeanceInTimestamp)
                )) {
                return false;
            }
        }
        return true;
    }
}
