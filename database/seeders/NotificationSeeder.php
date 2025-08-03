<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::unguard();
        $this->data()->each(function($data) {
            Notification::create($data);
        });
        Notification::reguard();
    }

    /**
     * Supply data for seeding
     *
     * @return collection
     */
    private function data() {
        return collect([
            ['id' => 1, 'notification_title' => 'Notification Title 1', 'notification_details' => 'This is a sample text for notification details. This is for notification 1', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 2, 'notification_title' => 'Notification Title 2', 'notification_details' => 'This is a sample text for notification details. This is for notification 2', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 3, 'notification_title' => 'Notification Title 3', 'notification_details' => 'This is a sample text for notification details. This is for notification 3', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 4, 'notification_title' => 'Notification Title 4', 'notification_details' => 'This is a sample text for notification details. This is for notification 4', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 5, 'notification_title' => 'Notification Title 5', 'notification_details' => 'This is a sample text for notification details. This is for notification 5', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 6, 'notification_title' => 'Notification Title 6', 'notification_details' => 'This is a sample text for notification details. This is for notification 6', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 7, 'notification_title' => 'Notification Title 7', 'notification_details' => 'This is a sample text for notification details. This is for notification 7', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 8, 'notification_title' => 'Notification Title 8', 'notification_details' => 'This is a sample text for notification details. This is for notification 8', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 9, 'notification_title' => 'Notification Title 9', 'notification_details' => 'This is a sample text for notification details. This is for notification 9', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 10, 'notification_title' => 'Notification Title 10', 'notification_details' => 'This is a sample text for notification details. This is for notification 10', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 11, 'notification_title' => 'Notification Title 11', 'notification_details' => 'This is a sample text for notification details. This is for notification 11', 'action'=>'', 'to_user' => 2, 'is_seen' => false],
            ['id' => 12, 'notification_title' => 'Notification Title 12', 'notification_details' => 'This is a sample text for notification details. This is for notification 12', 'action'=>'', 'to_user' => 2, 'is_seen' => false]
        ]);
    }
}
