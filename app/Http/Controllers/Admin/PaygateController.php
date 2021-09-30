<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Paygates\PaygateRepositoryInterface;
use Illuminate\Http\Request;

class PaygateController extends Controller
{
    /**
     * Define global variable
     *
     * @var PaygateRepositoryInterface
     */
    protected $payGateRepository;

    /**
     * PaygateController constructor.
     * @param PaygateRepositoryInterface $payGateRepository
     */
    public function __construct(PaygateRepositoryInterface $payGateRepository)
    {
        $this->payGateRepository = $payGateRepository;
    }

    /**
     * Function get list pay gate
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $payGates = $this->payGateRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.paygates.index', compact('payGates'));
    }

    /**
     * Function get an pay gate
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $payGate = $this->payGateRepository->find($id);
        if (!empty($payGate)) {
            $payGate->conf = json_decode($payGate->configs, true);
        }

        return view('admin.pages.paygates.edit', compact('payGate'));
    }

    /**
     * Function update an pay gate
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        $tempConf = array();
        $_arrTemp = array_reverse($param, true);
        $index = 0;
        foreach ($_arrTemp as $key=>$value) {
            if ($index <= 3) {
                $tempConf[$key] = $value;
            }
            $index++;
        }
        $param['configs'] = json_encode($tempConf);
        $update = $this->payGateRepository->update($param, $id);
        if ($update) {
            return redirect('/admin/paygates/index');
        }

        return redirect('/admin/paygates/'.$id.'/edit');
    }
}
