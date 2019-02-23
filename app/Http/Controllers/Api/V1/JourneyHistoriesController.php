<?php

namespace App\Http\Controllers\Api\V1;

use Changers\Models\JourneyHistory;
use Changers\Services\JourneyHistoryService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

/**
 * @group Journey management
 *
 * APIs for managing interacting with user's journey history
 */
class JourneyHistoriesController extends Controller
{

    /**
     * Compute lifetime distance
     *
     * This endpoint allows the client to get his lifetime distance for each mobility type.
     *
     * @authenticated
     *
     * @queryParam journey_type required The type of journey, Must be one of  'walking' , 'biking' , 'driving' , 'flying'. Example: walking
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @response {
     *  "computed_distance": 4
     * }
     */
    public function compute_distance(Request $request)
    {
        if(! in_array($request->get('journey_type', ''), [JourneyHistory::MOBILITY_TYPES])) {
            return response()->json([
                'message' => 'Invalid journey type selected',
                'debug_info' => 'The {journey_type} param should be one of '.implode(', ',JourneyHistory::MOBILITY_TYPES)
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $computed_distance = rand(100, 300);

        return response()->json([
            'computed_distance' => $computed_distance
        ], JsonResponse::HTTP_CREATED);
    }

    /**
     * Log journey
     *
     * This endpoint allows the client to send his journey log.
     *
     * @authenticated
     *
     * @bodyParam distance integer required The distance traveled. Metric system of measurement. Example: 200
     * @bodyParam journey_type string required The type of journey, Must be one of  'walking' , 'biking' , 'driving" , 'flying'. Example: walking
     * @bodyParam start_time datetime required The time the journey started. Use ISO 8601 format. Example: 2019-02-23T00:00:00Z
     * @bodyParam end_time datetime required The time the journey ended. Use ISO 8601 format. Example: 2019-02-23T17:09:28.889Z
     *
     * @param Request $request
     * @param JourneyHistoryService $journeyHistoryService
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * @response {
     *  "journey_log": {
     *      "id": 23,
     *      "journey_type": "walking",
     *      "distance": 200,
     *      "start_time": "2019-02-23UTC23:00:0017",
     *      "end_time": "2019-02-23UTC23:00:0017"
     *      }
     * }
     */
    public function create(Request $request, JourneyHistoryService $journeyHistoryService)
    {
        $this->validate($request, [
           'distance' => 'required|integer',
           'journey_type' => ['required', Rule::in(JourneyHistory::MOBILITY_TYPES)],
           'start_time' => 'required|date_format:Y-m-d\TH:i:s.uO',
           'end_time' => 'required|date_format:Y-m-d\TH:i:s.uO|after_or_equal:start_time',
        ]);

        if($journeyHistoryService->logJourney($request->all())) {
            return response()->json([
                'journey_log' => $journeyHistoryService->getResult()
            ], JsonResponse::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'We were unable to log the requested journey',
                'errors' => $journeyHistoryService->getErrors(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

}
