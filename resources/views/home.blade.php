@extends('layouts.app')

@section('content')
<div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('partials.uploader', [
                        'title' => 'Upload Post Images',
                        'params' => [
                            'attachable_id' => 1,
                            'attachable_type' => 'App\Post'
                        ],
                        'acceptedFiles' => '.jpg,.png',
                        'uploadedFiles' => $post->attachments->toArray()
                    ])
                    @endcomponent
<br>
                    @component('partials.uploader', [
                        'title' => 'Document Uploader',
                        'desc' => 'Upload PDF, DOC, or XLS document',
                        'params' => [
                            'attachable_id' => 2,
                            'attachable_type' => 'App\Post'
                        ],
                        'acceptedFiles' => '.doc,.xls,.pdf, .docx',
                        'uploadedFiles' => $post2->attachments->toArray()
                    ])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
