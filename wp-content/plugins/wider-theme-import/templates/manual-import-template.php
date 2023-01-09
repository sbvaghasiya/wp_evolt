<?php
/**
 * @Template: manual-import-template.php.
 * @since: 1.0.0
 * author: Wider-Themes
 * @descriptions:
 * @create: 12/19/2018
 */
?>

<div class="evolt-manual-import-layout evolt-m-hidden" style="display: none">
    <div class="evolt-contain">

        <div class="evolt-loading" style="display: none">
            <span class="evolt-pinner"><span class="fa fa-spinner fa-spin"></span></span>
        </div>
        <span class="dashicons dashicons-dismiss"></span>
        <div class="evolt-contain-wrap">
            <div class="evolt-tabs-head">
                <div class="tabs-demos evolt-mi-active" data-id="select-demo">
                    <span><?php esc_html_e('Select Demo', CTI_TEXT_DOMAIN) ?></span>
                </div>
                <div class="tabs-demos"
                     data-id="attachments">
                    <span><?php esc_html_e('Download Attachment', CTI_TEXT_DOMAIN) ?></span>
                </div>
            </div>
            <div class="evolt-tabs-content">
                <div class="tabs-contents evolt-mi-demo-list" id="select-demo">
                    <?php
                    if (!empty($demo_list)):
                        foreach ($demo_list as $demo):
                            $file_demo_info = $path . $demo . '/demo-info.json';
                            $demo_installed = $current_demo_installed === $demo ? true : false;
                            if (file_exists($file_demo_info)):
                                $info_demo = json_decode(file_get_contents($file_demo_info), true);
                                $link = "#";
                                if (file_exists($path . $demo . '/options.json')) {
                                    $options = json_decode(file_get_contents($path . $demo . '/options.json'), true);
                                    $link = $options['attachment'];
                                }
                                ?>
                                <div class="evolt-mi-demo-item">
                                    <div class="evolt-mi-item-inner">
                                        <div class="evolt-mi-image">
                                            <img src="<?php echo $url . $demo . '/screenshot.png' ?>" alt="">
                                            <div class="evolt-mi-preview">
                                                <h4 class="evolt-mi-demo-title"><?php echo esc_attr($info_demo['name']) ?></h4>
                                                <a class="evolt-mi-select" href="#"
                                                   data-attachment="<?php echo esc_url($link) ?>" data-demo="<?php echo esc_attr($demo) ?>">
                                                    <span><?php esc_html_e('Select', CTI_TEXT_DOMAIN) ?></span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            <?php
                            endif;
                        endforeach;
                    else:
                        ?>
                        <div class="evolt-ie-demo-empty">
                            <span class="dashicons dashicons-warning"></span>
                            <h4 class="evolt-ie-notice-empty"><?php echo esc_html__('Demos data is empty') ?></h4>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="tabs-contents" id="attachments">
                    <div class="evolt-mi-demo-item-selected">
                        <div class="evolt-mi-item-inner">
                            <div class="evolt-mi-image evolt-mi-image-selected">
                                <img src="<?php echo evolt_ie()->assets_url . '/evolt-ie.jpg' ?>" alt="">
                                <div class="evolt-mi-preview">
                                    <h4 class="evolt-mi-demo-title-selected"></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="evolt-mi-download-att">
                        <div class="evolt-mi-dl-step step-1">
                            <h4><?php echo esc_html__('Step 1:', CTI_TEXT_DOMAIN) ?></h4>
                            <button id="evolt-download-attachment-btn"
                                    data-attachment="#"><?php echo esc_html__('Download Attachments File', CTI_TEXT_DOMAIN) ?></button>
                        </div>
                        <div class="evolt-mi-dl-step step-2">
                            <h4><?php echo esc_html__('Step 2:', CTI_TEXT_DOMAIN) ?></h4>
                            <p>Please <b>"<?php esc_html_e("Upload", CTI_TEXT_DOMAIN) ?>
                                    "</b> <?php esc_html_e("and", CTI_TEXT_DOMAIN) ?>
                                <b>"<?php esc_html_e("Unzip", CTI_TEXT_DOMAIN) ?>"</b> file
                                to <b><?php echo wp_upload_dir()['basedir'] ?>/</b></p>
                        </div>
                        <div class="evolt-mi-dl-step step-3">
                            <input type="checkbox" id="evolt-accept-unzip-done" value="evolt-accept">
                            <label for="evolt-accept-unzip-done"><?php esc_html_e("I uploaded and unzipped file", CTI_TEXT_DOMAIN) ?></label>
                        </div>
                        <div class="evolt-mi-dl-step step-4">
                            <button><?php esc_html_e("Import Demo Data", CTI_TEXT_DOMAIN) ?></button>
                            <form method="post" style="display: none">
                                <input type="hidden" name="evolt-ie-id" value="<?php echo esc_attr($demo) ?>">
                                <input type="hidden" name="action" value="evolt-import">
                                <input type="hidden" name="manual_importing" value="true">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>