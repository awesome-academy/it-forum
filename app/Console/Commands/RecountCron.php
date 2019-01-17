<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\AnswerRepositoryInterface;

class RecountCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recount:cron';
    protected $postRepository;
    protected $answerRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command recount total answer and total vote of posts and total vote of answers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        AnswerRepositoryInterface $answerRepository
    ) {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->postRepository->recountDataPost();
        $this->answerRepository->recountDataAnswer();
        $this->info('Recount:Cron Cummand Run successfully!');
    }
}
