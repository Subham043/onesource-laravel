<?php

namespace App\Modules\Notification\Services;

use App\Modules\Notification\Models\Template;
use App\Modules\Notification\Requests\TemplateRequest;

class TemplateService
{
    public function get(): Template|null
    {
        return Template::filterByRoles()->first();
    }

    public function update(TemplateRequest $request): Template
    {
        $template = Template::updateOrCreate(
            [
                'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id
            ],
            [
                ...$request->safe()->only([
                    'footer',
                ]),
            ]
        );
        if($request->file('logo') && $request->file('logo')->isValid()){
            $file = $request->file('logo')->hashName();
            $request->file('logo')->storeAs((new Template)->logo_path,$file);
            $template->update(
                [
                    'logo' => $file,
                ]
            );
        }
        return $template;
    }

}
