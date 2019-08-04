<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LineBotService;
use App\Services\WebhookResponseService;
use App\Transformers\Requests\WebhookRequestTransformer;

class WebhookController extends Controller
{

    public function __construct(
        WebhookResponseService $responseService,
        LineBotService $bot
    ){
        $this->bot = $bot;
        $this->responseService = $responseService;
    }

    public function index(Request $request,WebhookRequestTransformer $reqTransformer)
    {
        Log::info("Request from Line",$request->all());

        foreach ($request['events'] as $event) {

            $webhookRequest = $reqTransformer->tramsforRequest($event);

            $this->bot->pushMessage(
                $webhookRequest['userId'],
                $response = $this->responseService->returnResponse($webhookRequest['content']));
        }

        return $response;
    }
}
