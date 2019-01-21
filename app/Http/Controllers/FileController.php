<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Session;
use Auth;

class FileController extends Controller
{
    /**
     * View, create, execute code
     * Author: Lampham
     */
    protected $file;
    protected $allFile;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function index()
    {
        $this->file->createRootFolder();

        return view('home.file.index');
    }

    public function postIndex(Request $request)
    {
        $response = $this->getFileByParentId(1, []);

        return response()->json($response);
    }

    public function postRead(Request $request)
    {
        $input = $request->all();
        $fileName = $this->file->find($input['id'])->filename_ecrypt;
        $contents = $this->readFile($fileName);

        if (!empty($input)) {
            if ($contents) {
                return response()->json(['returnCode' => 1, 'data' => $contents]);
            } else {
                return response()->json(['returnCode' => 1, 'data' => '']);
            }
        } else {
            return response()->json(['returnCode' => 0]);
        }
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();

        if (!empty($input)) {
            if ($newFile = $this->file->saveFile($input)) {
                if ($newFile->is_folder == 0) {
                    $this->createFile($newFile->filename_ecrypt);
                }

                return response()->json(['returnCode' => 1, 'data' => $this->getAllFile(1)]);
            } else {
                return response()->json(['returnCode' => 0]);
            }
        } else {
            return response()->json(['returnCode' => 0]);
        }
    }

    public function postEdit(Request $request)
    {
        $input = $request->all();

        if (!empty($input)) {
            if ($this->file->updateFile($input)) {
                return response()->json(['returnCode' => 1, 'data' => $this->getAllFile(1)]);
            } else {
                return response()->json(['returnCode' => 0]);
            }
        } else {
            return response()->json(['returnCode' => 0]);
        }
    }

    public function postEditContent(Request $request)
    {
        $input = $request->all();

        if (!empty($input['id'])) {
            $file = $this->file->checkExistFile($input['id']);

            if ($this->writeFile($file->filename_ecrypt, $input['content'])) {
                return response()->json(['returnCode' => 1]);
            } else {
                return response()->json(['returnCode' => 0]);
            }
        } else {
            return response()->json(['returnCode' => 0]);
        }
    }

    public function postDelete(Request $request)
    {
        $input = $request->all();

        if (!empty($input)) {
            if ($this->file->deleteFile($input)) {
                return response()->json(['returnCode' => 1, 'data' => $this->getAllFile(1)]);
            } else {
                return response()->json(['returnCode' => 2]);
            }
        } else {
            return response()->json(['returnCode' => 0]);
        }
    }

    public function getAllFile($parentId)
    {
        return $this->getFileByParentId($parentId, []);
    }

    public function getFileByParentId($parentId, $arr)
    {
        $parentFile = $this->file->getParentFile($parentId);
        $files = $this->file->getFileByParentId($parentId);
        $arr['file'] = ['label' => $parentFile->filename, 'id' => $parentFile->id];
        $arr['children'] = [];

        foreach ($files as $key => $f) {
            if (!empty($this->file->getFileByParentId($f->f_id)->toArray())) {
                $arr['children'][] = $this->getFileByParentId($f->f_id, $arr['children']);
            } else {
                if ($f->is_folder == 1) {
                    $arr['children'][] = [
                        'file' => ['label' => $f->filename, 'id' => $f->id],
                        'children' => [],
                    ];
                } else {
                    $arr['children'][]['file'] = ['label' => $f->filename, 'id' => $f->id];
                }
            }
        }

        return $arr;
    }

    public function readFile($filename)
    {
        $handle = fopen(public_path(config('constants.DRIVER_PATH') . $filename), 'r');
        $contents = '';

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $contents .= $line;
            }
        }
        fclose($handle);

        return $contents;
    }

    public function createFile($filename)
    {
        $handle = fopen(public_path(config('constants.DRIVER_PATH') . $filename), 'w');
        fclose($handle);
    }

    public function writeFile($filename, $data)
    {
        $file = fopen(public_path(config('constants.DRIVER_PATH') . $filename), 'w');
        fwrite($file, $data);
        fclose($file);

        return true;
    }
}
