<?php

use Illuminate\Database\Seeder;
use App\Subscription;
use App\User;
use App\Channel;
use App\Video;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'johndoe@mail.com'
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@mail.com'
        ]);

        $channel1 = factory(Channel::class)->create([
            'user_id' => $user1->id
        ]);

        $channel2 = factory(Channel::class)->create([
            'user_id' => $user2->id
        ]);

        $channel1->subscriptions()->create([
            'user_id' => $user2->id
        ]);

        $channel2->subscriptions()->create([
            'user_id' => $user1->id
        ]);

        factory(Subscription::class, 100)->create([
            'channel_id' => $channel1->id
        ]);

        factory(Subscription::class, 100)->create([
            'channel_id' => $channel2->id
        ]);

        $video = factory(Video::class)->create([
            'channel_id' => $channel1->id
        ]);

        factory(Comment::class, 50)->create([
            'video_id' => $video->id
        ]);

        $comment = Comment::first();

        factory(Comment::class, 50)->create([
            'video_id' => $video->id,
            'comment_id' => $comment->id
        ]);

       /* \DB::table('subscriptions')->delete();
        \DB::table('channels')->delete();
        \DB::table('users')->delete();

        factory(User::class, 3)->create()->each(function($user) {
            $user->channel()->save(factory(Channel::class)->make())
                ->each(function($channel) {
                    $channel->subscriptions()->save(factory(Subscription::class)->make());
                });
        });*/
    }
}
