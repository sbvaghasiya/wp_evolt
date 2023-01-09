<?php
/**
 * @Template: Import demo page
 * @version: 1.0.0
 * @author: Wider-Themes
 * @descriptions: Display for import demo page in Dashboard framework
 */

$demo_list = evolt_ie()->get_all_demo_folder();
$current_demo_installed = get_option('evolt_ie_demo_installed', '');
$path = evolt_ie()->theme_dir;
$url = evolt_ie()->theme_url;


$_search = array('M', 'G', 'K', 'm', 'g', 'k');

$memory_limit = (int)str_replace($_search, null, ini_get("memory_limit"));
$max_time = (int)ini_get("max_execution_time");
$max_time_text = $max_time === 0 ? 'unlimit' : $max_time;
$post_max_size = (int)str_replace($_search, null, ini_get('post_max_size'));
$php_ver = PHP_VERSION;
$_notice = ($memory_limit < 128 || ($max_time < 60 && $max_time !==0 )|| $post_max_size < 32) ? 'evolt-ie-warning' : 'evolt-ie-good';

?>
<div class="wrap">
    <div class="evolt-ie-dashboard">
        <div class="evolt-field-info <?php echo esc_attr($_notice); ?>">
            <table class="evolt-server-info">
                <tr>
                    <th><?php esc_html_e('PHP Version:', CTI_TEXT_DOMAIN); ?></th>
                    <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                    <td style="color: #0d880b"><?php echo esc_html($php_ver); ?></td>
                </tr>
                <tr>
                    <th><?php esc_html_e('Memory Limit:', CTI_TEXT_DOMAIN) ?></th>
                    <?php if ($memory_limit >= 128): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (Mb)', ''), $memory_limit); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %s (the minimum required 128M)', ''), $memory_limit); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?php esc_html_e('Max. Execution Time:', CTI_TEXT_DOMAIN) ?></th>
                    <?php if ($max_time >= 60 || $max_time === 0): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (s)', ''), $max_time_text); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %ss (the minimum required 60s)', ''), $max_time_text); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?php esc_html_e('Max. Post Size:', CTI_TEXT_DOMAIN) ?></th>
                    <?php if ($post_max_size >= 32): ?>
                        <td><i class="dashicons dashicons-yes" style="color: #31f531"></i></td>
                        <td style="color: #0d880b"><?php echo sprintf(esc_html__('Currently: %s (Mb)', ''), $post_max_size); ?></td>
                    <?php else: ?>
                        <td><i class="dashicons dashicons-no" style="color: red"></i></td>
                        <td style="color: red"><?php echo sprintf(esc_html__('Currently: %s (the minimum required 32M)', ''), $post_max_size); ?></td>
                    <?php endif; ?>
                </tr>
            </table>
            <div class="evolt-advance-options">
                <ul class="evolt-options">
                    <li class="evolt-show-manual-import"><span
                                class="dashicons dashicons-media-spreadsheet"></span><?php echo esc_html__("Manual Import", CTI_TEXT_DOMAIN) ?>
                    </li>
                    <li class="evolt-show-regenerate-thumbnail"><span
                                class="dashicons dashicons-images-alt"></span><?php echo esc_html__("Regenerate Thumbnails", CTI_TEXT_DOMAIN) ?>
                    </li>
                    <li class="evolt-advance-reset"><span
                                class="dashicons dashicons-update"></span><?php echo esc_html__("Reset Site", CTI_TEXT_DOMAIN) ?>
                    </li>
                </ul>
                <span class="dashicons dashicons-admin-generic"></span>
                <form method="post" class="evolt-reset-form-advance" style="display: none">
                    <?php wp_nonce_field('evolt-reset', '_wp_nonce'); ?>
                    <input type="hidden" name="action" value="evolt-reset">
                </form>
                <form method="post" class="evolt-regenerate-thumbnail-sm" style="display: none">
                    <input type="hidden" name="action" value="evolt-regenerate-thumbnails">
                </form>
            </div>
            <?php
            include_once evolt_ie()->plugin_dir . 'templates/manual-import-template.php';
            ?>
        </div>
        <div class="evolt-import-demos">
            <div class="evolt-import-contains">
                <?php
                if (!empty($demo_list)):
                    foreach ($demo_list as $demo):
                        $file_demo_info = $path . $demo . '/demo-info.json';
                        $demo_installed = $current_demo_installed === $demo ? true : false;
                        if (file_exists($file_demo_info)):
                            $info_demo = json_decode(file_get_contents($file_demo_info), true);
                            ?>
                            <form method="post" class="evolt-ie-demo-item" data-demo="demo-<?php echo $demo ?>"
                                  id="demo-<?php echo $demo ?>">
                                <div class="evolt-ie-item-inner">
                                    <div class="evolt-ie-image">
                                        <img src="<?php echo $url . $demo . '/screenshot.png' ?>" alt="">
                                        <a class="evolt-ie-preview" href="<?php echo esc_attr($info_demo['link']) ?>"
                                           target="_blank">
                                            <span><?php esc_html_e('View Demo', CTI_TEXT_DOMAIN) ?></span>
                                        </a>
                                    </div>
                                    <div class="evolt-ie-meta">
                                        <h4 class="evolt-ie-demo-title"><?php echo esc_attr($info_demo['name']) ?></h4>
                                        <input type="hidden" name="evolt-ie-id" value="<?php echo esc_attr($demo) ?>">
                                        <input type="hidden" name="action" value="evolt-import">
                                        <?php if($demo_installed === false) : ?>
                                            <button class="evolt-import-btn evolt-import-submit button button-primary" name="evolt-import-submit" value="<?php echo base64_encode($demo) ?>">
                                                <?php echo esc_html__('Import Demo', CTI_TEXT_DOMAIN); ?>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="evolt-loading" style="display: none">
                                        <span class="evolt-pinner"><span class="fa fa-spinner fa-spin"></span></span>
                                    </div>
                                </div>
                            </form>
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
        </div>
        <?php
        if (!empty($export_mode)) {
            include_once evolt_ie()->plugin_dir . 'templates/export-page.php';
        }
        ?>
    </div>
</div>