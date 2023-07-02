<?php



namespace App\Shared;

use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class Globals
{
    public function jsondecode()
    {
        try {
            return file_get_contents( filename: 'php://input') ?
            json_decode( file_get_contents(filename: 'php://input'), associative: false ) : [];
        } catch (Exception $e){
            return [];
        }
    }

    public function success(string $message = 'success', array $data = null) : JsonResponse
    {
        return new JsonResponse([
            'status' => 1,
            'message' => $message,
            'data' => $data
        ], status:200);
    }

    public function error(string $message = 'error', int $codeHttp = 500) : JsonResponse
    {
        return new JsonResponse([
            'status' => 0,
            'message' => $message,
        ], $codeHttp);
    }
}