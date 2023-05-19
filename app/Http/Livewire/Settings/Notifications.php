<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

use App\Models\Notifications as NotificationsModel;

class Notifications extends Component
{
    public $firstParenReminder;
    public $secondParenReminder;
    public $emailMessage;
    public $reminderOpt = [
        [
            'label' => '1 week',
            'value' => '1_week'
        ],
        [
            'label' => '2 weeks',
            'value' => '2_week'
        ],
        [
            'label' => '1 month',
            'value' => '1_month'
        ]
    ];

    public function mount()
    {
        self::getNotifications();
    }

    public function submit()
    {
        // Clean Notification Table
        NotificationsModel::truncate();
        // Create fresh data
        NotificationsModel::insert([
            [
                'reminder' => $this->firstParenReminder,
                'emailMessage' => $this->emailMessage,
                'field_name' => 'firstParenReminder'
            ],
            [
                'reminder' => $this->secondParenReminder,
                'emailMessage' => $this->emailMessage,
                'field_name' => 'secondParenReminder'
            ]
        ]);

        $this->alert('success', "Successfully created notifications.");
    }

    public function getNotifications()
    {
        $notifications = NotificationsModel::get();

        foreach ($notifications as $key => $notification) {
            $this->{$notification->field_name} = $notification->reminder;
            $this->emailMessage = $notification->emailMessage;
        }
    }

    public function render()
    {
        return view('livewire.settings.notifications');
    }
}
