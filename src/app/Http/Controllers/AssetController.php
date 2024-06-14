<?php

namespace PatrykSawicki\DpdApi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AssetController extends Controller
{
    private array $manifest;

    public function __construct()
    {
        $this->manifest = json_decode(file_get_contents(DPD_PATH . '/public/build/manifest.json'), true);
    }

    /**
     * @param string $name
     * @return BinaryFileResponse
     */
    public function sass(string $name): BinaryFileResponse
    {
        if (!isset($this->manifest['resources/sass/' . $name . '.scss']['file'])) {
            abort(404);
        }

        return response()->file(
            DPD_PATH . '/public/build/' . $this->manifest['resources/sass/' . $name . '.scss']['file'],
            [
                'Content-Type' => 'text/css',
            ]
        );
    }

    /**
     * @param string $name
     * @return BinaryFileResponse
     */
    public function js(string $name): BinaryFileResponse
    {
        if (!isset($this->manifest['resources/js/' . $name . '.js']['file'])) {
            abort(404);
        }

        return response()->file(
            DPD_PATH . '/public/build/' . $this->manifest['resources/js/' . $name . '.js']['file'],
            [
                'Content-Type' => 'text/javascript',
            ]
        );
    }

    /**
     * @param string $name
     * @param string $ext
     * @return BinaryFileResponse
     */
    public function img(string $name, string $ext): BinaryFileResponse
    {
        return response()->file(
            DPD_PATH . '/public/img/' . $name . '.' . $ext,
            [
                'Content-Type' => 'image/' . $ext,
            ]
        );
    }
}
