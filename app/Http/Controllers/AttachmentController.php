<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'file' => 'required|file|max:5000|mimes:' . $this->getAllowedFileTypes(),
        'attachable_id' => 'required|integer',
        'attachable_type' => 'required',
        ]);

        // save the file
        if ($fileUid = $request->file->store('/upload', 'public')) {
            return Attachment::create([
                'filename' => $request->file->getClientOriginalName(),
                'uid' => $fileUid,
                'size' => $request->file->getClientSize(),
                'mime' => $request->file->getMimeType(),
                'attachable_id' => $request->get('attachable_id'),
                'attachable_type' => $request->get('attachable_type'),
            ]);
        }

        return response(['msg' => 'Unable to upload your file.'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        return (string) $attachment->delete();
    }

    /**
     * Remove . prefix so laravel validator can use allowed files
     *
     * @return string
     */
    private function getAllowedFileTypes()
    {
        return str_replace('.', '', config('attachment.allowed', ''));
    }
}
