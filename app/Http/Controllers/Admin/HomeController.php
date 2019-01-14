<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;

class HomeController extends Controller
{
    protected $userRepository;
    protected $postRepository;
    protected $tagRepository;
    protected $reportRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PostRepositoryInterface $postRepository,
        TagRepositoryInterface $tagRepository,
        ReportRepositoryInterface $reportRepository
    ) {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all()->count();
        $posts = $this->postRepository->all()->count();
        $tags = $this->tagRepository->all()->count();
        $reports = $this->reportRepository->all()->count();
        $max = $this->findMaxChart($users, $posts, $tags, $reports);

        return view('admin.index', compact('users', 'posts', 'tags', 'reports', 'max'));
    }

    public function monthSearch()
    {
        $users = $this->userRepository->getDataMonth()->count();
        $posts = $this->postRepository->getDataMonth()->count();
        $tags = $this->tagRepository->getDataMonth()->count();
        $reports = $this->reportRepository->getDataMonth()->count();
        $max = $this->findMaxChart($users, $posts, $tags, $reports);

        return view('admin.index', compact('users', 'posts', 'tags', 'reports', 'max'));
    }

    public function weekSearch()
    {
        $users = $this->userRepository->getDataWeek()->count();
        $posts = $this->postRepository->getDataWeek()->count();
        $tags = $this->tagRepository->getDataWeek()->count();
        $reports = $this->reportRepository->getDataWeek()->count();
        $max = $this->findMaxChart($users, $posts, $tags, $reports);

        return view('admin.index', compact('users', 'posts', 'tags', 'reports', 'max'));
    }

    public function customSearch(Request $request)
    {
        $start = $this->findMinDate($request->from, $request->to);
        $end = $this->findMaxDate($request->from, $request->to);
        $users = $this->userRepository->getDataBetween($start, $end)->count();
        $posts = $this->postRepository->getDataBetween($start, $end)->count();
        $tags = $this->tagRepository->getDataBetween($start, $end)->count();
        $reports = $this->reportRepository->getDataBetween($start, $end)->count();
        $max = $this->findMaxChart($users, $posts, $tags, $reports);

        return view('admin.index', compact('users', 'posts', 'tags', 'reports', 'max'));
    }

    public function findMaxChart($users, $posts, $tags, $reports)
    {
        $max = max($users, $posts, $tags, $reports);
        $res = 0;
        for ($i = 0; $i < $max; $i += 50) {
            $res = $i + 50;
        }

        return $res;
    }

    public function findMaxDate($from, $to)
    {
        $from = strtotime($from);
        $to = strtotime($to);
        $diff = $to - $from;
        if ($diff >= 0) {
            return $to;
        } else {
            return $from;
        }
    }

    public function findMinDate($from, $to)
    {
        $from = strtotime($from);
        $to = strtotime($to);
        $diff = $to - $from;
        if ($diff >= 0) {
            return $from;
        } else {
            return $to;
        }
    }
}
