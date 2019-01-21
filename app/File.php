<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Scopes\OwnFile;

class File extends Model
{

    protected $table = 'files';
    protected $primaryKey = 'id';
    public $ids = [];

    protected $fillable = [
        'id',
        'f_id',
        'user_id',
        'filename',
        'filename_ecrypt',
        'is_folder',
        'parent_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OwnFile);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checkExistFile($id)
    {
        if (!empty($file = File::find($id))) {
            return $file;
        }

        return false;
    }

    public function createRootFolder()
    {
        $data = [
            'user_id' => Auth::id(),
            'f_id' => '1',
            'filename' => 'root',
            'is_folder' => 1,
        ];
        $file = new File();

        return $file->firstOrCreate(['f_id' => '1', 'user_id' => Auth::id()], $data);
    }

    public function saveFile($input)
    {
        $parentFile = $this->checkExistFile($input['id']);
        $file = File::where([
            'filename' => $input['fileName'],
            'is_folder' => $input['is_folder'],
            'parent_id' => $parentFile->f_id,
        ])->first();

        if (!empty($parentFile) && $parentFile->is_folder == 1 && !empty($input['fileName']) && empty($file)) {
            $extFile = $this->getExtensionFile($input['fileName']); // get duoi file
            $file = new File();
            $file->user_id = Auth::id();
            $file->filename = $input['fileName'];
            $file->filename_ecrypt = md5(Auth::id() . $input['fileName'] . now()) . $extFile;
            $file->is_folder = $input['is_folder'];
            $file->parent_id = $parentFile->f_id;
            $file->f_id = md5(date('YmdHis'));
            $file->save();

            return $file;
        }

        return false;
    }

    public function updateFile($input)
    {
        $file = $this->checkExistFile($input['id']);
        $anotherFile = File::where([
            'filename' => $input['fileName'],
            'is_folder' => $file->is_folder,
            'parent_id' => $file->parent_id,
        ])->first();

        if (!empty($file) && !empty($input['fileName']) && empty($anotherFile)) {
            $file->update(['filename' => $input['fileName']]);

            return $file;
        }

        return false;
    }

    public function deleteFile($input)
    {
        $file = $this->checkExistFile($input['id']);

        if (!empty($file) && $file->id != 1) {
            if ($file->is_folder == 1) {
                $this->getAllChildrenIds($file->id);
                $ids = $this->ids;

                return File::whereIn('id', $ids)->delete();
            } else {
                return $file->delete();
            }
        }

        return false;
    }

    public function getParentFile($id)
    {
        return File::where('f_id', $id)->first();
    }

    public function getFileByParentId($parentId)
    {
        return File::where('parent_id', $parentId)->orderBy('is_folder', 'desc')->get();
    }

    public function getAllChildrenIds($parentId)
    {
        $allChildFile = File::where('parent_id', $parentId)->get();
        $this->ids[] = $parentId;

        foreach ($allChildFile as $key => $file) {
            if (!empty($this->getFileByParentId($file->id)->toArray())) {
                $this->getAllChildrenIds($file->id);
            }
        }
    }

    public function getExtensionFile($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!empty($ext)) {
            return '.' . $ext;
        } else {
            return '';
        }
    }
}
