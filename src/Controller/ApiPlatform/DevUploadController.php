<?php

namespace App\Controller\ApiPlatform;

use App\Entity\Development\Development;
use Symfony\Component\HttpFoundation\Request;

class DevUploadController
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
//        dd($request->attributes->get('data'));
        $development = $request->attributes->get('data');
        if (!($development instanceof Development)) {
            throw new \RuntimeException('Error : Need development object');
        }
        $development->setFile($request->files->get('file'));
        $development->setUpdatedAt(new \DateTimeImmutable());
//dd($development);
        return $development;
    }
}
