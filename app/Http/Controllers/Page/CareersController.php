<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Position;
use App\PositionCategory;
use App\Modules\Mailer\Mailer;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareersFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Partner;

/**
 * Class CareersController
 * @package App\Http\Controllers\Page
 */
class CareersController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return $this
     */
    public function index(Page $page, string $view)
    {
        $categories = PositionCategory::active()
            ->with([
                'positions' => function ($q) {
                    $q->active()
                        ->translated()
                        ->withTranslation()
                        ->orderBy('order')
                        ->get();
                }
            ])
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();

        return view($view)->with(compact('page', 'categories', 'partners'));
    }

    /**
     * @param CareersFormRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CareersFormRequest $request)
    {
        try {

            app()->make(Mailer::class)->send(
                'job_application',
                $request->only([
                    'name',
                    'email',
                    'phone',
                    'position',
                    'category'
                ]),
                function ($m) {
                    $m->to(config('mail.from.address'));
                }
            );

            app()->make(Mailer::class)->send(
                'auto_reply',
                $request->only(['name']),
                function ($m) use ($request) {
                    $m->to($request->get('email'));
                }
            );

            Log::debug('CareersController:store', [
                'request' => $request->all()
            ]);

            swal_success(trans('alerts.apply_to_job_message_succeeded'));

            return back();

        } catch (\Throwable $e) {

            swal_error(trans('alerts.apply_to_job_message_failed'));

            Log::error('CareersController:store', [
                'error'   => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withInput();
        }
    }
}
