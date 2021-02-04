<?php

namespace App\Jobs;

use App\Comment;
use App\Mail\NegativeCommentReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Support\Facades\Mail;

class SentimentAnalysis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $comment_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = Comment::find($this->comment_id);
        $commentText = $comment->comment;

        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('google_credentials.json'), 
            'projectId' => 'getabeer',
        ]);

        $language = $cloud->language();
        $annotation = $language->analyzeSentiment($commentText);
        $sentiment = $annotation->sentiment();
        $sentiment_score = $sentiment['score'];

        if ($sentiment_score < 0) {
            $bag = [
                'comment' => $commentText,
                'pub' => $comment->brewery->name,
                'score' => $sentiment_score,
            ];

            $contactMail = new NegativeCommentReceived($bag);
            $emailAdmin = 'tiziano@tizio.it';
            Mail::to($emailAdmin)->send($contactMail);
        }
    }
}
