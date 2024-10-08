<?php

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        // parent::configure();

        // if(request()->is('admin/*')){
        //     $this->addNonceForDirective(Directive::STYLE);
        // }

        $this
        ->addNonceForDirective(Directive::SCRIPT)
        //start of basic policy
        ->addDirective(Directive::BASE, Keyword::SELF)
        ->addDirective(Directive::CONNECT, Keyword::SELF)
        ->addDirective(Directive::DEFAULT, Keyword::SELF)
        ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
        ->addDirective(Directive::IMG, Keyword::SELF)
        ->addDirective(Directive::MEDIA, Keyword::SELF)
        ->addDirective(Directive::OBJECT, Keyword::NONE)
        ->addDirective(Directive::SCRIPT, Keyword::SELF)
        ->addDirective(Directive::STYLE, Keyword::UNSAFE_INLINE)
        ->addDirective(Directive::STYLE, Keyword::SELF)
        ->addDirective(Directive::FRAME, Keyword::SELF)
        ->addDirective(Directive::FONT, Keyword::SELF);

        //end of basic policy

        //start of custom policy
        $this
        //start of
        ->addDirective(Directive::IMG, 'data:')
        ->addDirective(Directive::IMG, 'blob:')
        ->addDirective(Directive::FONT, 'data:') //remove as this and above belongs for development template of welcome page

        //start of common
        ->addDirective(Directive::IMG, 'intl-tel-input.com')
        ->addDirective(Directive::IMG, 'i3.ytimg.com')
        ->addDirective(Directive::FONT, 'at.alicdn.com')
        ->addDirective(Directive::FONT, 'fonts.gstatic.com')
        ->addDirective(Directive::STYLE, 'fonts.googleapis.com')
        ->addDirective(Directive::FRAME, 'www.google.com')
        ->addDirective(Directive::FRAME, 'www.youtube.com')
        ->addDirective(Directive::STYLE, 'cdn.jsdelivr.net')
        ->addDirective(Directive::IMG, 'cdn.jsdelivr.net')
        ->addDirective(Directive::SCRIPT, 'cdn.jsdelivr.net');
    }

}

?>
