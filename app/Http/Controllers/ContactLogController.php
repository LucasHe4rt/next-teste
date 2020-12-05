<?php

namespace App\Http\Controllers;

use App\Models\ContactLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactLogController extends Controller
{
    private $model;

    public function __construct(ContactLog $contactLog)
    {
        $this->model = $contactLog;
    }

    public function index()
    {
        // return view();
    }

    public function all()
    {
        try {
            return $this->sendSuccessResponse('get', ['contact_logs' => $this->model->all()]);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
        }
    }

    private function sendSuccessResponse(string $message, array $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    private function sendErrorResponse(string $message, array $data = [], int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function show(int $id)
    {
        try {
            return $this->sendSuccessResponse('get', [
                'contact_log' => $this->model->findOrFail($id)
            ]);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3|max:255',
                'email' => 'required|email:dns|max:255',
                'phone' => 'required|numeric',
                'message' => 'required',
                'file' => 'required|file|mimes:doc,docx,odt,pdf|max:25000'
            ]);

            $newContactLog = $this->model;
            $newContactLog->name = $request->name;
            $newContactLog->email = $request->email;
            $newContactLog->phone = $request->phone;
            $newContactLog->message = $request->message;
            $newContactLog->file_path = $request->file->store('files');
            $newContactLog->save();

            return $this->sendSuccessResponse('created', ['contact_log' => $newContactLog], 201);

        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
        }

    }

    public function destroy(int $id)
    {
        try {
            $this->model->findOrFail($id)->delete();

            return $this->sendSuccessResponse('deleted', []);

        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
        }
    }
}
