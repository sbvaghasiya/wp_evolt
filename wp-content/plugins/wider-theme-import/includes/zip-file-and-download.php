<?php
/**
 * @Template: zip-file-and-download.php
 * @since: 1.0.0
 * @author: Wider-Themes
 * @descriptions:
 * @create: 23-Nov-17
 */
if(!defined('ABSPATH')){
    die();
}

function evolt_ie_download_demo_zip(){

    $_cache = trailingslashit(ABSPATH . 'wp-content/uploads/evolt-ie-demo');

    if(!is_dir($_cache))
        wp_mkdir_p($_cache);

    if(!class_exists('ZipArchive'))
        exit();

    $zip = new ZipArchive;
    $zip->open($_cache . 'evolt-demo-data.zip', ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);

    evolt_ie_zip_folder(ct_ie()->theme_dir, $zip);

    $zip->close();

    return $_cache . 'evolt-demo-data.zip';
}

function evolt_ie_zip_folder($folder, $zipFile, $sub = '', $remove = array())
{

    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we start by going through all files in $folder
    $f = scandir($folder);

    $f = array_diff($f, array('..', '.'));

    $sub = !empty($sub) ? $sub . '/' : '';

    foreach ($f as $_f) {

        if (in_array($_f, $remove)) continue;

        if (is_dir($folder . $_f)) {

            $__f = trailingslashit($folder . $_f);

            $zipFile->addEmptyDir($sub . $_f);

            evolt_ie_zip_folder($__f, $zipFile, $sub . $_f);

        } elseif (is_file($folder . $_f)) {
            $zipFile->addFile($folder . $_f, $sub . $_f);
        }
    }
}