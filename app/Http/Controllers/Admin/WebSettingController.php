<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SmtpRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SmtpRepositoryInterface;

class WebSettingController extends Controller
{
    private $smtpRepository;

    public function __construct(SmtpRepositoryInterface $smtpRepository)
    {
        $this->smtpRepository = $smtpRepository;
    }

    public function index()
    {
        return view('admin.pages.webSetting.index', [
            'smtp'      => $this->smtpRepository->getFirstSmtp(),
        ]);
    }

    function smtp(SmtpRequest $request)
    {
        $dataToUpdateOrCreate = [
            'host'         => $request->host,
            'port'         => $request->port,
            'encryption'   => $request->encryption,
            'username'     => $request->username,
            'password'     => $request->password,
            'from_address' => $request->from_address,
            'from_name'    => $request->from_name,
            'sender_email' => $request->sender_email,
            'sender_name'  => $request->sender_name,
            'status'       => $request->status,
        ];

        $smtp = $this->smtpRepository->updateOrCreateSmtp($dataToUpdateOrCreate);

        $toastMessage = $smtp->wasRecentlyCreated ? 'Data has been created successfully!' : 'Data has been updated successfully!';
        toastr()->success($toastMessage);
        return redirect()->back();
    }
}
