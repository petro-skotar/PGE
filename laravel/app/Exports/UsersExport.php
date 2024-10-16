<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Article;
use App\Models\EventsSections;
use App\Models\EventsSectionsRegistrations;
use App\Models\EventsUsersRegistrations;

class UsersExport implements FromView
{
	public function __construct(int $id)
	{
		$this->id = $id;
	}
	
    public function view(): View
    {
        $EventsUsersRegistrations = EventsUsersRegistrations::where('event_id', $this->id)->orderBy('created_at')->get();
		$event = Article::where('module','events')->where('domen',\DATA::domen())->where('id',$this->id)->first();
		
		# все секции текущего мероприятия
		$is_event_reg = EventsSections::where('event_id',$this->id)->get();
		
		# все зарегистрированные секции всех пользователей
		$is_event_reg_sections = EventsSectionsRegistrations::where('event_id',$this->id)->get();
		
		return view('admin.events.users_registrations_export', [
            'EventsUsersRegistrations' => $EventsUsersRegistrations,
            'event' => $event,
            'is_event_reg' => $is_event_reg,
            'is_event_reg_sections' => $is_event_reg_sections,
            'UserStatus' => \DATA::UserStatus,
        ]);
    }
}