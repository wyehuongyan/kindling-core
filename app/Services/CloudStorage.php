<?php namespace App\Services;

use Illuminate\Support\Facades\Config;
use Aws\CloudFront\Exception\Exception;
use Aws\S3\S3Client;
use Imagick;

class CloudStorage {

    public function __construct() {
        $this->bucket = Config::get('app.storage.s3');

        $this->client = S3Client::factory(array(
            'profile' => 'sprubix_s3',
            'region' => 'ap-southeast-1'
        ));
    }

    public function deleteObjects($objectArray) {
        try {
            $result = $this->client->deleteObjects(array(
                // Bucket is required
                'Bucket' => $this->bucket,
                // Objects is required
                'Objects' => $objectArray
            ));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function putObject($fileName, $resizeValue, $storageFilePath, $containerPath, $key) {
        // 1. resize
        // 2. upload to s3
        // 3. record url

        $image = new Imagick();
        $image->readImage($fileName);

        // step 1
        // even original has to be resized due to 6 plus uploading images > 750px width
        $image = $this->resizeImage($resizeValue, $image);

        $image->writeImage($storageFilePath); // write to file for s3 upload later

        // step 2
        $bucketPath = $this->bucket . $containerPath;

        $result = $this->client->putObject(array(
            'Bucket'     => $bucketPath,
            'Key'        => $key,
            'SourceFile' => $storageFilePath,
            'ACL'        => 'public-read'
        ));

        unlink($storageFilePath);

        return cdn($containerPath . "/" . $key);
    }

    public function resizeImage($size, $image) {
        $image->resizeImage($size, 0, Imagick::FILTER_LANCZOS, 1);

        return $image->getImage();
    }
}