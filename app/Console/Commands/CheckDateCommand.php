<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\EmployeeAbsence;

class CheckDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-date-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Получите записи, где дата окончания совпадает с текущей датой
        $recordsToUpdate = EmployeeAbsence::whereDate('dateEndAbsence', Carbon::now()->toDateString())->get();

        // Обновите поле type на 0 для этих записей
        foreach ($recordsToUpdate as $record) {
            $record->update(['absenceType' => 0]);
        }
    }
}
