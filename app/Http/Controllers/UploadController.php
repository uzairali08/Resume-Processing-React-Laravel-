<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Collection;
use App\Models\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\UploadNotification;
use App\Mail\DemoMail;
class UploadController extends Controller
{   

    public function uploadFile(Request $req){
        try {
            $filePath = $req->file('file')->store('Uploaded Documents');
            
            $file = new File;
            $file->filepath = $filePath;
            $file->save();
    
            $mailData = [    
                'attachmentPath' => storage_path('app/'.$filePath),    
                'body' => 'This is for testing email using SMTP',
            ];
    
            Mail::to('madm40056@gmail.com')->send(new DemoMail($mailData));
            // Mail::to('hr@soltridge.com')->send(new DemoMail($mailData));
    
            return response()->json([
                'success' => true,
                'message' => 'File uploaded and email sent successfully',
                'result' => $filePath
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'File upload and email sending failed',
                'error' => $e->getMessage()
            ]);
        }
    }
}
