<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\SocialAccount;
use App\User;
use App\Post;
use App\Answer;
use Carbon\Carbon;
use Socialite;

class UserRepository implements UserRepositoryInterface
{
    protected $fillable = [
        'id',
        'username',
        'fullname',
        'email',
        'image_path',
        'address',
        'phone',
    ];

    /**
     * Specify Model class name
     */
    public function model()
    {
        return new User;
    }
    /**
     */
    public function __construct()
    {
    }

    public function notify($userId, $notify)
    {
        return $this->model()->find($userId)->notify($notify);
    }

    /**
     * Retrieve all data of repository
     */
    public function all($columns = ['*'])
    {
        return $this->model()->all();
    }

    /**
     * Retrieve all data of this month only
     */
    public function getDataMonth()
    {
        return $this->model()->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
    }

    /**
     * Retrieve all data of this week only
     */
    public function getDataWeek()
    {
        return $this->model()->where('created_at', '>=', Carbon::now()->startOfWeek())->get();
    }

    /**
     * Retrieve all data between two days
     */
    public function getDataBetween($start, $end)
    {
        return $this->model()
            ->whereBetween('created_at', [date('Y-m-d', $start) . ' 00:00:00', date('Y-m-d', $end) . ' 23:59:59'])
            ->get();
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model()->paginate($limit, $columns);
    }
    /**
     * Find data by id
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model()->findOrFail($id, $columns);
    }

    /**
     * Find data by keyword
     */
    public function findByKey($field, $keyword)
    {
        return $this->model()->where($field, 'LIKE', '%' . $keyword . '%');
    }

    /**
     * Save a new entity in repository
     */
    public function create(array $input)
    {
        return $this->model()->create($input);
    }

    /**
     * Update a entity in repository by id
     */
    public function update(array $input, $id)
    {
        $model = $this->model()->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $this;
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $user = $this->model()->with('posts')->where('id', $id)->first();
        foreach ($user->posts as $post) {
            $tmpPost = Post::with('answers', 'replies')->where('id', $post->id)->first();
            foreach ($tmpPost->answers as $answer) {
                $tmpAnswer = Answer::with('replies')->where('id', $answer->id)->first();
                foreach ($tmpAnswer->replies as $reply) {
                    $reply->delete();
                }
                $answer->delete();
            }
            foreach ($tmpPost->replies as $reply) {
                $reply->delete();
            }
        }

        return $this->model()->destroy($id);
    }

    public function filter($input, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_USER', 4) : $limit;
        $query = $this->model()->select('*');

        if (!empty($input)) {
            if (!empty($input['username'])) {
                $query = $query->where('username', 'like', '%' . $input['username'] . '%');
            }
        }
        $query = $query->orderBy('id', 'desc')->paginate($limit);

        return $query;
    }

    public function getPostsUser($id, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_NUMBER', 16) : $limit;
        $posts = $this->model()->find($id)->posts()->with('tags')->paginate($limit);

        return $posts;
    }

    public function getAnswerUser($id, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_NUMBER', 16) : $limit;
        $answers = $this->model()->find($id)->answers()->with('post')->paginate($limit);

        return $answers;
    }

    public function saveFollow($input)
    {
        $data = [
            'user_id' => $input['user_id'],
            'followable_type' => 'App\User',
        ];

        $follow = $this->model()->find($input['target_id'])->follows()->where($data)->first();

        if (!empty($follow)) {
            $follow->delete();

            return 'unfollowed';
        } else {
            return $this->model()->find($input['target_id'])->follows()->create($data);
        }
    }

    public function createOrGetUser($user, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($user->getId())->with('user')
            ->first();
        if (!empty($account->user)) {
            return ['isExist' => 1, 'userData' => $account->user];
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $user->getId(),
                'provider' => $provider,
            ]);
            $userExist = $this->model()->whereEmail($user->getEmail())->first();

            if (!$userExist) {
                $user = $this->model()->create([
                    'username' => $user->getName(),
                    'fullname' => 'Your fullname',
                    'email' => $user->getEmail(),
                    'image_path' => now(),
                    'image_path' => $user->getAvatar(),
                    'password' => md5(rand(1, 10000)),
                    'is_social_account' => 1,
                ]);

                $account->user()->associate($user);
                $account->save();
            } else {
                return ['isExist' => 1, 'userData' => $userExist];
            }

            return ['isExist' => 0, 'userData' => $user];
        }
    }
}
