<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Traits\CanManageForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    use CanManageForm;

    public function init(): RedirectResponse
    {
        $this->clearForm();
        $this->setFormStep(['init', 'validation']);
        $this->passStep('init');

        return redirect()->route('content.create.form');
    }

    public function form(): RedirectResponse|View|Factory
    {
        if (! $this->checkPassesStep('init')) {
            return redirect()->route('content.create.init');
        }

        return view('admin.content.create-form');
    }

    public function validation(): View|Factory
    {
        return view('admin.content.index');
    }

    public function confirm(): View|Factory
    {
        return view('admin.content.index');
    }

    public function store(): View|Factory
    {
        return view('admin.content.index');
    }
}
