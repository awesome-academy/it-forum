<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $table = 'follows';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'followable_type',
        'followable_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function followable()
    {
        return $this->morphTo();
    }

    public function userFollowing()
    {
        return $this->belongsTo('App\User', 'followable_id');
    }

    public function tagFollowing()
    {
        return $this->belongsTo('App\Tag', 'followable_id');
    }

    public function checkFollowUser($currentId, $targetId)
    {
        $where = [
            'user_id' => $currentId,
            'followable_type' => 'App\User',
            'followable_id' => $targetId,
        ];
        $follow = Follow::where($where)->first();

        if (!empty($follow)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkFollowTag($currentId, $targetId)
    {
        $where = [
            'user_id' => $currentId,
            'followable_type' => 'App\Tag',
            'followable_id' => $targetId,
        ];
        $follow = Follow::where($where)->first();

        if (!empty($follow)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFollowerList($userId, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_USER', 16) : $limit;
        $where = [
            'followable_id' => $userId,
            'followable_type' => 'App\User',
        ];
        $followerList = Follow::where($where)->with('user')->paginate($limit);

        return $followerList;
    }

    public function getFollowingList($userId, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_USER', 16) : $limit;
        $where = [
            'user_id' => $userId,
            'followable_type' => 'App\User',
        ];
        $followingList = Follow::where($where)->with('userFollowing')->paginate($limit);

        return $followingList;
    }

    public function getFollowingTagList($userId, $limit = null)
    {
        $limit = is_null($limit) ? config('constants.PAGINATION_LIMIT_USER', 16) : $limit;
        $where = [
            'user_id' => $userId,
            'followable_type' => 'App\Tag',
        ];
        $followingTagList = Follow::where($where)->with('tagFollowing')->paginate($limit);

        return $followingTagList;
    }
}
