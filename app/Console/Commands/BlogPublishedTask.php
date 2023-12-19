<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;

class BlogPublishedTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog_published:task';

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
        Blog::where('sechedule_post_on','<=',now())->where('published_status',0)->update(['published_status'=>1]);
        \Log::info("Cron is working fine! sechedule_post_on <=".now());
    }
}
