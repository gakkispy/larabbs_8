<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Reply;

class TopicReplied extends Notification
{
    use Queueable;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {   
        // 注入回复实体，方便 toDatabase 方法中的使用
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // 开启通知的频道
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $topic = $this->reply->topic;
        $user = $this->reply->user;
        $link = $topic->link(['#reply' . $this->reply->id]);

        // 存入数据库里的数据
        return [
            'reply_id'   => $this->reply->id,
            'reply_content' => $this->reply->content,
            'user_id'     => $user->id,
            'user_name'   => $user->name,
            'user_avatar' => $user->avatar,
            'topic_link'  => $link,
            'topic_id'    => $topic->id,
            'topic_title' => $topic->title,
        ];
    }
}
