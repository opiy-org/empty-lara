<?php
/**
 * Created by PhpStorm.
 * User: alex14v
 * Date: 21.06.18
 * Time: 17:09
 */

namespace App\Http\Controllers;


use App\Helpers\l;
use App\Services\ResponseApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseCRUDController extends Controller
{

    protected $modelClass;
    protected $referenceClass;


    /**
     * Validator rules
     *
     * @return array
     *
     */
    public function rules()
    {
        if ($this->referenceClass) {
            if (is_array($this->referenceClass::RULES)) {
                return $this->referenceClass::RULES;
            }
        }

        return [];
    }

    /**
     * Return list of all entities
     *
     * no params
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function index(Request $request)
    {
        $retval = $this->modelClass::get();

        return ResponseApiService::success($retval);
    }


    /**
     * Return entity by id
     *
     * - id int
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function show(int $id, Request $request)
    {
        $retval = $this->modelClass::where('id', $id)
            ->first();

        if (!$retval) {
            return ResponseApiService::notFound();
        }

        return ResponseApiService::success($retval);
    }


    /**
     * Update entity by id
     *
     * - id int
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            return ResponseApiService::validateError($request->all(), $validator);
        }

        $data = $request->all();

        $item = $this->modelClass::where('id', $id)
            ->first();

        if (!$item) {
            return ResponseApiService::notFound();
        }

        $item->update($data);

        return ResponseApiService::success($item);
    }


    /**
     * Create new entity
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            return ResponseApiService::validateError($request->all(), $validator);
        }


        $data = $request->all();

        $item = $this->modelClass::create($data);

        return ResponseApiService::success($item);
    }


    /**
     * Delete entity by id
     *
     * - id int
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(int $id, Request $request)
    {

        $item = $this->modelClass::where('id', $id)
            ->first();

        if (!$item) {
            return ResponseApiService::notFound();
        }

        try {
            $item->delete();
        } catch (\Exception $exception) {
            l::exc($this, $exception);
        }

        return ResponseApiService::success(['deleted']);
    }


}