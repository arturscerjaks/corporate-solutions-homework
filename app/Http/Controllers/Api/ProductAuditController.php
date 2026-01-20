<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductAudit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductAuditController extends Controller
{
    /**
     * Summary of index
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $pagination = (int) $request->query('page_size', 20);
        $orderBy = $request->query('order_by', 'created_at');
        $orderDir = $request->query('order_dir', 'desc');

        $audits = ProductAudit::with(['product', 'user'])
            ->orderBy($orderBy, $orderDir)
            ->paginate($pagination);

        return response()->json($audits);
    }
}
