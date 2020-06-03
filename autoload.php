<?php
class ImageOptimizer
{

    public static function onUpload($upload, $mime, &$error)
    {
        $pathToImage = $upload->getTempPath();
        if (!is_file($pathToImage . 'yoholock')) {
            if (strpos($pathToImage, 'localcopy') !== false) {
                ImageOptimizer::processOpt('/tmp/yoho_' . $upload->getTitle(), $pathToImage);
                unlink('/tmp/yoho_' . $upload->getTitle());
            } elseif (strpos($pathToImage, 'chunkedupload') !== false) {
                copy($pathToImage, '/tmp/yoho_' . $upload->getTitle());
                ImageOptimizer::processOpt($pathToImage);
            }
        } else {
            unlink($pathToImage . 'yoholock');
        }
    }

    public static function onUploadForm($upload)
    {
        $pathToImage = $upload->mUpload->getTempPath();
        fopen($pathToImage . 'yoholock', "w");
        ImageOptimizer::processOpt($pathToImage);
        return true;
    }

    public static function processOpt($pathToImage, $newpath = null)
    {
        if ($newpath == null) {
            $newpath = $pathToImage;
        }
        $MOZJPEG_PATH  = dirname(__FILE__) . '/' . 'include/cjpeg';
        $PNGQUANT_PATH = dirname(__FILE__) . '/' . 'include/pngquant';
        $GIFSICLE_PATH = dirname(__FILE__) . '/' . 'include/gifsicle';
        switch (mime_content_type($pathToImage)) {
            case 'image/jpeg':
                shell_exec($MOZJPEG_PATH . ' -optimize -progressive ' . escapeshellarg($pathToImage) . ' > ' . escapeshellarg($pathToImage . 'yoho'));
                copy($pathToImage . 'yoho', $newpath);
                unlink($pathToImage . 'yoho');
                break;
            case 'image/png':
                shell_exec($PNGQUANT_PATH . ' -f ' . escapeshellarg($pathToImage) . ' -o ' . escapeshellarg($pathToImage . 'yoho'));
                copy($pathToImage . 'yoho', $newpath);
                unlink($pathToImage . 'yoho');
                break;
            case 'image/gif':
                shell_exec($GIFSICLE_PATH . ' -O3 --scale 0.5 -i ' . escapeshellarg($pathToImage) . ' -o ' . escapeshellarg($pathToImage . 'yoho'));
                copy($pathToImage . 'yoho', $newpath);
                unlink($pathToImage . 'yoho');
                break;
            default:
                break;
        }
    }
}
