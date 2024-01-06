<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;


trait ThumpDefaultTrait
{

    /**
     * @param string|null $imageName
     *
     * @return array<int, string>|null
     */
    protected function getSearchThumpFile(?string $imageName): ?array
    {
        $data_ = [];

        try {

            $arr = @scandir(public_path('images/thump'));

            if (!empty($arr) && !empty($imageName)) {

                $image = explode('.', $imageName);
                $pattern = "/^" . $image[0] . "/";

                foreach ($arr as $string) {
                    if (preg_match($pattern, $string))
                        $data_[] = $string;
                }
                return $data_;
            }

            return $data_;
        } catch (\Exception $exception) {
            Log::error('FileInfoTrait ( getSearchThumpFile ) : ' . $exception->getMessage());

            return $data_;
        }
    }

    /**
     *
     * @param UploadedFile|null $file
     *
     * @return array<string, string>
     */
    protected function getFileInfo(?UploadedFile $file): array
    {
        if (!is_null($file)) {
            $this->data_['name'] = $file?->getClientOriginalName();
            $this->data_['type'] = $file?->getClientOriginalExtension();
            $this->data_['file'] = str($this->data_['name'])->slug() . '-' . uniqid() . '.' . $this->data_['type'];

            return $this->data_;
        }

        return $this->data_;
    }

    /**
     * @param array<int, string>|null $thumps
     *
     * @return bool
     */
    protected function thumpDelete(?array $thumps = []): bool
    {
        $result = true;
        if (!empty($thumps)) {

            foreach ($thumps as $value) {
                $result = $this->deleteImage($value, 'thump');
            }

            return $result;
        }

        return true;
    }
}
